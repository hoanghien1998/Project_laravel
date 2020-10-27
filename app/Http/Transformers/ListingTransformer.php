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
        $data['medias'] = $model->documents->filter(function ($document) {
            return $document->group == 'image';
        })->map(function ($document) {
            return [
                'thumbnail' => $document->thumbnail,
                'full' => $document->full,
            ];
        });
        return $data;
    }
}
