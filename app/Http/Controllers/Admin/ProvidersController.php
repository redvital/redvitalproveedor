<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProvidersController extends Controller
{


    public function index()
    {
        $providers = Provider::all();
        return view('admin.providers.index', compact('providers'));
    }

    public function show(Provider $provider)
    {
        return view('admin.providers.show', compact('provider'));
    }
}
