<?php

namespace JoseBailon\LaravelSupervisordControl\Http\Controllers;

use Illuminate\Routing\Controller;

class SupervisordController extends Controller
{
    public function index(LscConector $lscconector)
    {
        $lscconector->getApiVersion();

        dd($lscconector);
        return "Esto es el controlador";
    }
}
