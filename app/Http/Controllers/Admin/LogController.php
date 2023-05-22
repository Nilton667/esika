<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function __construct() {
        return $this->middleware(['auth']);
    }


    public function log()
    {
    	$logs = \Log::logLists();

    	return view('paginas.logs',compact('logs'));
    }

    public function logdel()
    {
        \Log::logDelete();

        return redirect('logs');
    }
}
