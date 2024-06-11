<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    // O método index retorna a view app.home
    public function index(): View
    {
        return view('app.home', ['titulo' => 'Home']);
    }
}