<?php
namespace App\Http\Controllers;

use App\Http\Resources\ClockInResource;
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
        $dataArray['time_out'] = $request->time;

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
        $dataArray['username'] = $request->username;
        $data = $this->clockInRetriever->getAllUsersLogs($dataArray);
        return $data;
        // $data = ClockInResource::collection($data);
    }
    /**
     * Display the specified resource.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAllLogsOnThisDay(Request $request)
    {
        // return $request->date;
        $dataArray['day_of'] = $request->date;

        $data = $this->clockInRetriever->getAllLogsOnThisDay($dataArray);
        return $data;
        // $data = ClockInResource::collection($data);
    }

}