<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __invoke(loginRequest $request)
    {

        if($request->attemp()){

            return to_route('listagem');

        }

        return back()->with(['messagem'=>'Usuário não encontrado']);

    }
}
