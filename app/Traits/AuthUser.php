<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;



trait AuthUser
{
    public function infoUserMe()
    {
        $user = Auth::user()->with('providerUserMe')->get();
        $userFilter = $user->filter(function ($value) {
            $me = Auth::user()->email;
            return $value->email == $me;
        })->first();

        return $userFilter;
    }
}
