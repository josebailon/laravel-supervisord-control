<?php

namespace JoseBailon\LaravelSupervisordControl\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\MessageBag;
use Supervisor\Api;
use Throwable;

class SupervisordController extends Controller
{
    /**
     * INDEX
     */
    public function index(Api $lscconector, MessageBag $message_bag)
    {
        $processes = [];

        $supervisord = [
            'state' => ['statecode' => 2, 'statename' => "DOWN"],
            'pid' => "",
        ];
        try {
            $supervisord = [
                'state' => $lscconector->getState(),
                'pid' => $lscconector->getPid(),
            ];
            $bulkprocesses = $lscconector->getAllProcessInfo();

            foreach ($bulkprocesses as $process) {
                if (!key_exists($process['group'], $processes)) {

                    $processes[$process['group']] = [];
                }
                $processes[$process['group']][] = $process;
            }
        } catch (Throwable $e) {
            $message_bag->add('supervisord_error', $e->getMessage());
        }

        return view('lsc::index', compact(['supervisord', 'processes']))->withErrors($message_bag->all());
    }
    /**
     * SHUTDOWN
     */
    public function shutdown(Api $lscconector, MessageBag $message_bag)
    {
        try {
            $lscconector->shutdown();
        } catch (Throwable $e) {
            $message_bag->add('supervisord_error', $e->getMessage());
        }
        return Redirect(Route('lsc_index'))->withErrors($message_bag->all());
    }

    /**
     * RESTART
     */
    public function restart(Api $lscconector, MessageBag $message_bag)
    {
        try {
            $lscconector->restart();
        } catch (Throwable $e) {
            $message_bag->add('supervisord_error', $e->getMessage());
        }
        return Redirect(Route('lsc_index'))->withErrors($message_bag->all());
    }
}
