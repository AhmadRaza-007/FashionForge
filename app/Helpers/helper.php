<?php

use App\Models\Collection;
use App\Models\Gift;
use Illuminate\Support\Facades\Cookie;

if (!function_exists('customHelperFunction')) {
    function customHelperFunction()
    {
        return Collection::with('subCollection')->get();
    }
}

if (!function_exists('getGift')) {
    function getGift($id)
    {
        return Gift::find($id)->name;
    }
}
