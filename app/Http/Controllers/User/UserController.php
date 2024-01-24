<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {
   
    public function profileUser(){

        $user = User::select()
                ->where(['id' => Auth::user()->id])
                ->first();
        $genero = ['MASCULINO', 'FEMENINO'];

        return view('user.profile', [
            'url_profile' => User::adminlte_image(),
            'user_data' => $user,
            'genero' => $genero
        ]);
    }

    

}
