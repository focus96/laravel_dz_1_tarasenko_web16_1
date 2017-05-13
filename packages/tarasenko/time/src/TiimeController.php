<?php

namespace Tarasenko\Time;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TimeController extends Controller
{

    public function index()
    {
        $currentTime = Carbon::now()->toDateTimeString();
        return view('time::index', ['current_time' => $currentTime]);
    }

}