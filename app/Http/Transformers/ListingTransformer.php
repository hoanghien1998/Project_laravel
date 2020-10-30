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

        $data['carTrim'] = $model->carTrim->name;
        $data['carModel'] = $model->carModel->name;

        $data['carMake'] = $model->carModel->carMake->name;

        return $data;
    }
}
