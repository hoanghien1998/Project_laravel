<?php

namespace App\Http\Transformers;

use Illuminate\Contracts\Support\Arrayable;
use Saritasa\Transformers\BaseTransformer;

/**
 * Transformer user login data.
 */
class AuthTransformer extends BaseTransformer
{
    /**
     * {@inheritdoc}
     */
    public function transform(Arrayable $model): array
    {
        $userTransformer = new UserTransformer();

        $data['user'] = $userTransformer->transform($model);
        return $data;
    }
}
