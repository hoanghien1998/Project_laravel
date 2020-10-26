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
        $data = parent::transform($model);
        $documents =$model->documents()->get();
        $data['thumbnail']=[];
        $data['full']=[];
        foreach ($documents as $document) {
            $data['thumbnail'][] = $document->thumbnail;
            $data['full'][] = $document->full;
        }
        $car_models = $model->carModel()->get();
        $data['name'] = [];
        foreach ($car_models as $car_model) {
            $data['name'][] = $car_model->name;
        }

        $car_tríms = $model->carTrim()->get();
        $data['name_trim'] = [];
        foreach ($car_tríms as $car_trím) {
            $data['name_trim'][] = $car_trím->name;
        }
        return $data;
    }
}
