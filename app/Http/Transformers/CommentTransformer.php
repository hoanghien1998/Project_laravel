<?php

namespace App\Http\Transformers;

use Illuminate\Contracts\Support\Arrayable;
use Saritasa\Transformers\BaseTransformer;

/**
 * Transformer comment data.
 */
class CommentTransformer extends BaseTransformer
{
    /**
     * {@inheritdoc}
     */
    public function transform(Arrayable $model): array
    {
        $data = parent::transform($model);
        $data['first_name'] = $model->user->first_name;

        $data['last_name'] = $model->user->last_name;

        return $data;
    }
}
