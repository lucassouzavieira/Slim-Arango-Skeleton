<?php

namespace App\Core\Contracts\Validation;

interface ValidationInterface
{
    /**
     *
     * @param array $data
     * @return mixed
     */
    public static function validate(array $data);
}