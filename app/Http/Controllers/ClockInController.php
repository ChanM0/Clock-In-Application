<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DiInterfaces\ClockInDiInterface;

class ClockInController extends Controller
{
    protected $clockInRetriever = null;

    public function __construct(ClockInDiInterface $clockInDiInterface)
    {
        $this->clockInRetriever = $clockInDiInterface;
        $this->middleware('JWT');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function clockIn(Request $request)
    {
        $dataArray['user_id'] = $request->user_id;
        $dataArray['time_in'] = $request->time;

        return $this->clockInRetriever->clockIn($dataArray);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function clockOut(Request $request)
    {
        $dataArray['user_id'] = $request->user_id;
        $dataArray['time_out'] = $request->time_out;
        return $this->clockInRetriever->clockOut($dataArray);
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
        $dataArray['user_id'] = $request->user_id;

        return $this->clockInRetriever->getAllUsersLogs($dataArray);
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