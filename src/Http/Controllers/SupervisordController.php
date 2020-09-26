<?php

namespace JoseBailon\LaravelSupervisordControl\Http\Controllers;

use Illuminate\Routing\Controller;
use Supervisor\Api;

class SupervisordController extends Controller
{
    public function index(Api $lscconector)
    {

        $lscconector->getApiVersion();

        dd($lscconector);
        return "Esto es el controlador";
    }
}
