<?php

use App\Models\Collection;
use Illuminate\Support\Facades\Cookie;

if (!function_exists('customHelperFunction')) {
    function customHelperFunction()
    {
        return Collection::with('subCollection')->get();
    }
}

