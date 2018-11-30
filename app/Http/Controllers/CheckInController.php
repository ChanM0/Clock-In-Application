<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DiInterfaces\ClockInDiInterface;

class ClockInController extends Controller
{
    protected $clockInRetriever = null;
    public function __construct(ClockInDiInterfaces $clockInDiInterface)
    {
        $this->middleware('CustomJWTMiddleWare');
        $this->clockInRetriever = new DependencyInjectClockInInterface($clockInDiInterface);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkIn(Request $request)
    {
        $dataArray['user_id'] = $request->user_id;
        $dataArray['time_in'] = $request->time_in;
        $this->clockInRetriever->checkIn($request);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkOut(Request $request)
    {
        $dataArray['user_id'] = $request->user_id;
        $dataArray['time_out'] = $request->time_out;
        return $this->clockInRetriever->checkOut($dataArray);
    }
     // Admin Methods
    /**
     * Display the specified resource.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAllUsersLogs(Request $request)
    {
        $dataArray['day_of'] = $request->day_of;
        $dataArray['user_id'] = $request->user_id;
        return $this->clockInRetriever->getThisUserLogsOnThisDay($dataArray);
    }
    /**
     * Display the specified resource.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAllLogsOnThisDay(Request $request)
    {
        $dataArray['day_of'] = $request->day_of;
        return $this->clockInRetriever->getAllLogsOnThisDay($dataArray);
    }
}