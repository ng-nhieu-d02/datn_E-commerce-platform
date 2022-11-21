<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class storeController extends Controller
{
    public function store($id)
    {
        $store = Store::find($id);
        return view('home.pages.home_store', [
            'store' => $store
        ]);
    }
}
