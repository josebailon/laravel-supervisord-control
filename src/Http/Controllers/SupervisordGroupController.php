<?php

namespace JoseBailon\LaravelSupervisordControl\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\MessageBag;
use Supervisor\Api;
use Throwable;

class SupervisordGroupController extends Controller
{

    /**
     * GROUP STOP
     */
    public function stop(Api $lscconector, MessageBag $message_bag, $id)
    {
        try {
            $lscconector->stopProcessGroup($id);
        } catch (Throwable $e) {
            $message_bag->add('supervisord_error', $e->getMessage());
        }
        return Redirect(Route('lsc_index'))->withErrors($message_bag->all());
    }
    /**
     * GROUP START
     */
    public function start(Api $lscconector, MessageBag $message_bag, $id)
    {
        try {
            $lscconector->startProcessGroup($id);
        } catch (Throwable $e) {
            $message_bag->add('supervisord_error', $e->getMessage());
        }
        return Redirect(Route('lsc_index'))->withErrors($message_bag->all());
    }
}
