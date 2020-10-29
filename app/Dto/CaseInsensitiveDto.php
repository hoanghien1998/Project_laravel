<?php

namespace App\Dto;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Saritasa\Dto;

/**
 * Parent class of CaseInsensitive data transfer object.
 * When your dto contains fieldID property, then you can inject fieldId, and it will be injected.
 */
abstract class CaseInsensitiveDto extends Dto implements Arrayable, Jsonable
{
    /**
     * Parent class of CaseInsensitive data transfer object.
     * When your dto contains fieldID property, then you can inject fieldId, and it will be injected.
     *
     * @param string[] $data DTO properties values
     */
    public function __construct(array $data)
    {
        $lowerCaseData = [];
        foreach ($data as $key => $value) {
            $lowerCaseData[strtolower($key)] = $value;
        }
        foreach (static::getInstanceProperties() as $key) {
            if (isset($lowerCaseData[strtolower($key)])) {
                $this->$key = $lowerCaseData[strtolower($key)];
            }
        }
    }

    /**
     * Transform property to array if it also instance of Dto.
     *
     * @return mixed[]
     */
    public function toArray(): array
    {
        $result = [];
        foreach (static::getInstanceProperties() as $key) {
            if ($this->$key instanceof CaseInsensitiveDto) {
                $result[$key] = $this->$key->toArray();
            } else {
                $result[$key] = $this->$key;
            }
        }
        return $result;
    }
}
