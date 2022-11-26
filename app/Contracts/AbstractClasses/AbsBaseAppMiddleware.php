<?php

namespace App\Contracts\AbstractClasses;

abstract class AbsBaseAppMiddleware
{
    protected $responce;

    public function __construct()
    {
        $this->responce = app(IBaseApiResponseService::class);
    }
}
