<?php

namespace Tarasenko\Time;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TimeController extends Controller
{

    /**
     * Display index views
     * 
     * @return type \Illuminate\Http\Response
     */
    public function index()
    {
        $currentTime = Carbon::now()->toDateTimeString();
        return view('time::index', ['current_time' => $currentTime]);
    }

}