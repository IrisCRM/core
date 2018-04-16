<?php

namespace Iris\Annotation;

/**
 * @Annotation
 */
class RequestMethod
{
    public $value = [];

    public function getAllowedMethods()
    {
        return array_map('strtoupper', $this->value);
    }
}
