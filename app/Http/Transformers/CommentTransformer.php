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
        return parent::transform($model);
    }
}
