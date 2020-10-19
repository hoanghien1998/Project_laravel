<?php

namespace App\Http\Transformers;

use Illuminate\Contracts\Support\Arrayable;
use Saritasa\Transformers\BaseTransformer;

/**
 * Transformer listing data.
 */
class ListingTransformer extends BaseTransformer
{
    /**
     * @param Arrayable $model Model
     * @return array
     */
    public function transform(Arrayable $model): array
    {
        return parent::transform($model);
    }
}
