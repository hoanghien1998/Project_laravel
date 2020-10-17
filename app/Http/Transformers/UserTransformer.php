<?php

namespace App\Http\Transformers;

use Illuminate\Contracts\Support\Arrayable;
use Saritasa\Transformers\BaseTransformer;

/**
 * Transformer user data by add more fields.
 */
class UserTransformer extends BaseTransformer
{
    /**
     * {@inheritdoc}
     */
    public function transform(Arrayable $model): array
    {
        $data = parent::transform($model);
        $data['gender'] = $model->gender;
        $data['role'] = $model->role->name;
        return $data;
    }
}
