<?php

namespace App\Contracts\AbstractClasses;

use App\Contracts\Interfaces\IBaseApiResponseService;
use Error;

abstract class AbsBaseApiService
{
    protected $responceService;

    public function __construct()
    {
        $this->responceService = app(IBaseApiResponseService::class);
    }
}
