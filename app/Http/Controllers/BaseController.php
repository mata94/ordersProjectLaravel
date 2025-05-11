<?php

namespace App\Http\Controllers;

use App\Models\User;

class BaseController
{
    public function index()
    {
        $user = User::findOrFail(auth()->id());

        if($user->hasRole('admin')){
            return redirect('/admin/users');
        }else if($user->hasRole('supplier')){
            return redirect('/supplier/available-items');
        } else if($user->hasRole('director')){
            return redirect('/director/pending-contracts');
        }
        else {
            return redirect('/worker/suppliers');
        }
    }
}
