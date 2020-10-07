<?php

namespace App\Http\Requests\DataTable;

use App\Http\Requests\Request;
use Saritasa\DingoApi\Paging\PagingInfo;
use Saritasa\Laravel\Validation\Rule;
use Saritasa\LaravelRepositories\Enums\OrderDirections;

class DataTableRequest extends Request
{
    public const API_PAGE_SIZE_MAX = 'api.maxLimit';
    public const API_PAGE_SIZE_DEFAULT = 'api.defaultLimit';
    public const FILTERS = 'filters';
    public const PAGE = 'page';
    public const PAGE_SIZE = 'per_page';
    public const ORDER_BY = 'order_by';
    public const SORT = 'sort';
    public const SORT_ORDER = 'sort_order';

    /**
     * List of fields allowed to filtering.
     *
     * @var mixed[]
     */
    protected $allow_filters = null;

    /**
     * Sort order default.
     *
     * @var string
     */
    protected $defaultSortOrder = OrderDirections::ASC;

    /**
     * Get the validation rules that apply to the request.
     *
     * @param mixed[] $rules The array of rules for request
     *
     * @return mixed[]
     */
    public function rules(array $rules = []): array
    {
        return array_merge(
            [
                static::PAGE => Rule::int()->min(1)->nullable()->toString(),
                static::PAGE_SIZE => Rule::int()->min(1)->nullable()->toString(),
                static::SORT => Rule::string()->nullable()->toString(),
                static::ORDER_BY => Rule::string()->nullable()->toString(),
                static::SORT_ORDER => Rule::string()->in(OrderDirections::getConstants())->nullable()->toString(),
            ],
            $rules
        );
    }

    /**
     * Returns Paging Data from request.
     *
     * @return PagingInfo
     */
    public function getPagingInfo(): PagingInfo
    {
        $input = $this->only(PagingInfo::KEYS);
        if (isset($input[static::PAGE_SIZE])) {
            $pageSize = (int)$input[static::PAGE_SIZE];
            if ($pageSize <= 0) {
                $input[static::PAGE_SIZE] = config(static::API_PAGE_SIZE_MAX);
            }
            if ($pageSize > config(static::API_PAGE_SIZE_MAX)) {
                $input[static::PAGE_SIZE] = config(static::API_PAGE_SIZE_MAX);
            }
        }
        return new PagingInfo($input);
    }

    /**
     * Returns the data for sorting query.
     *
     * @return SortOptionsData|null
     */
    public function getSortOptions(): ?SortOptionsData
    {
        if (!empty($this->order_by)) {
            return new SortOptionsData([
                SortOptionsData::ORDER_BY => $this->order_by,
                SortOptionsData::SORT_ORDER => $this->sort_order ?? $this->defaultSortOrder,
            ]);
        }

        return null;
    }

    /**
     * Returns the data for filtering.
     *
     * @return mixed[]
     */
    public function getFilters(): array
    {
        return is_null($this->allow_filters) ? [] : $this->only($this->allow_filters);
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        if ($this->query->has(static::SORT)) {
            $sort = explode('|', $this->query->get(static::SORT));
            $this->query->add([
                static::ORDER_BY => $sort[0],
                static::SORT_ORDER => $sort[1] ?? null,
            ]);
        }

        if ($this->query->has(static::FILTERS)) {
            $filters = $this->query->get(static::FILTERS);
            if ($filters && !is_array($filters)) {
                $this->query->set(static::FILTERS, (array)json_decode($filters));
            }
        }
    }
}
