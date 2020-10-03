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
     * {@inheritdoc}
     */
    public function transform(Arrayable $model): array
    {
        return [
            'id' => $model->id,
            'car_model_id' => $model->car_model_id,
            'car_trim_id' => $model->car_trim_id,
            'year' => $model->year,
            'price' => $model->price,
            'created_by' => $model->created_by,
        ];
    }
}
