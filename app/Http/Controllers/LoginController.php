<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class LoginController extends Controller
{
    public function index(Request $request): View
    {
        $error = '';

        if ($request->get('error') == 1) {
            $error = "Usuário e ou senha não existe";
        }
        if ($request->get('error') == 2) {
            $error = "Necessário realizar login para ter acesso";
        }

        return view('site.login', ['titulo' => 'Login', 'error' => $error]);
    }
    
    public function autenticar(Request $request): string
    {
        //rules
        $regras = [
            'usuario' =>   'email',
            'senha' => 'required'
        ];
        //feedback
        $feedback = [
            'usuario.email' => 'Digite o usuário no formato válido',
            'senha.required' => 'Digite a senha'
        ];

        $request->validate($regras, $feedback);

        $email = $request->get('usuario');
        $senha = $request->get('senha');

        $user = new User();

        $usuario = $user->where('email', $email)
        ->where('password', $senha)
        ->get()
        ->first();
        if (isset($usuario->name)) {
            session_start();
            $_SESSION['nome'] = $usuario->name;
            $_SESSION['email'] = $usuario->email;
            return redirect()->route('app.home', ['titulo' => 'Home']);
        } else {
            return redirect()->route('site.login', ['error' => 1]);
        }
    }
    public function sair()
    {
        session_destroy();
        return redirect()->route('site.index', ['titulo' => 'Home']);
    }
}