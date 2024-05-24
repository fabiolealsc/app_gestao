<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('site.login', ['titulo' => 'Login']);
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

        $email = $request->get('email');
        $senha = $request->get('senha');

        $user = new User();

        $existe = $user->where('email', $email)->where('password', password_hash($senha, PASSWORD_DEFAULT))->get()->first();

        if ($existe) {
            return 'Chagamos ateh aqui';
        } else {
            return 'Usuario inexistente';
        }
        //
    }
}