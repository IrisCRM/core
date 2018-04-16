<?php

namespace Iris\Annotation;

/**
 * @Annotation
 */
class RequireAuth
{
    public $value;

    public function isRequire()
    {
        return isset($this->value) ? $this->value : true;
    }
}
