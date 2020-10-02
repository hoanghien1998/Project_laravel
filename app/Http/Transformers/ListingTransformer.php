<?php

namespace App\Http\Transformers;

use Illuminate\Contracts\Support\Arrayable;
use Saritasa\Transformers\BaseTransformer;

/**
 * Transformer user login data.
 */
class ListingTransformer extends BaseTransformer
{
    /**
     * {@inheritdoc}
     */
    public function transform(Arrayable $model): array
    {
        $data = parent::transform($model);

        return $data;
    }
}
