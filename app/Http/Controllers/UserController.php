<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\loginRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function __invoke()
    {

        return view('auth.login');

    }


}
