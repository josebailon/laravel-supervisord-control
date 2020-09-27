<?php

namespace JoseBailon\LaravelSupervisordControl\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\MessageBag;
use Supervisor\Api;
use Throwable;

class SupervisordProcessController extends Controller
{

    /**
     * PROC STOP
     */
    public function stop(Api $lscconector, MessageBag $message_bag, $id)
    {
        try {
            $lscconector->stopProcess($id);
        } catch (Throwable $e) {
            $message_bag->add('supervisord_error', $e->getMessage());
        }
        return Redirect(Route('lsc_index'))->withErrors($message_bag->all());
    }
    /**
     * PROC START
     */
    public function start(Api $lscconector, MessageBag $message_bag, $id)
    {
        try {
            $lscconector->startProcess($id);
        } catch (Throwable $e) {
            $message_bag->add('supervisord_error', $e->getMessage());
        }
        return Redirect(Route('lsc_index'))->withErrors($message_bag->all());
    }
    /**
     * PROC START
     */
    /*    public function restart(Api $lscconector, MessageBag $message_bag, $id)
    {
        try {
            $lscconector->restart($id);
        } catch (Throwable $e) {
            $message_bag->add('supervisord_error', $e->getMessage());
        }
        return Redirect(Route('lsc_index'))->withErrors($message_bag->all());
    }*/
}
