<?php

namespace Farbesofts\Checkrolepast;

use Illuminate\Contracts\Auth\Guard;

class Checkrolepast
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
}
