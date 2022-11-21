<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\PermissionStore;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class storeController extends Controller
{
    public function store($id)
    {
        $store = Store::find($id);
        $permission = PermissionStore::where('id_store','=',$id)->where('id_user','=', Auth::user()->id)->count();

        return view('home.pages.home_store', [
            'store' => $store,
            'permission'    => $permission
        ]);
    }
}
