<?php 
namespace App\DiServices;

use Carbon\Carbon;
use App\ClockIn;
use App\User;
use App\DiInterfaces\ClockInDiInterface;

class ClockInDiService implements ClockInDiInterface
{

    private function getCurrentDay()
    {
        $timezone = 'America/Los_Angeles';
        $carbonDate = Carbon::now()->tz($timezone);
        $date = Carbon::parse($carbonDate)->format('Y-m-d');;
        return $date;
    }

    private function sanitizeRequest($timeIn)
    {
        $incorrectDateTimeValue = substr($timeIn, 0, -5);
        return str_replace('T', ' ', $incorrectDateTimeValue);
    }

    public function clockIn($dataArray)
    {
    // add logic for double checkin ins
        $dayOf = $this->getCurrentDay();

        $time_in = $dayOf . ' ' . $dataArray['time_in'];

        $userClockIn = new ClockIn;
        $userClockIn->user_id = $dataArray['user_id'];
        $userClockIn->time_in = $time_in;
        $userClockIn->day_of = $dayOf;
        $userClockIn->save();
        return response('Clock In Successful', 200);

    }
    public function clockOut($dataArray)
    {

        $dayOf = $this->getCurrentDay();

        $timeOut = $dayOf . ' ' . $dataArray['time_out'];

     // catch exception;
        $userClockOut = ClockIn::where('user_id', $dataArray['user_id'])->where('day_of', $dayOf)->firstOrFail();

        $userClockOut->time_out = $timeOut;
        $userClockOut->save();


        return response('Clock Out Successful', 200);
    }
  
  
  // Admin Methods
    public function getAllUsersLogs($dataArray)
    {
        $dayOf = $this->getCurrentDay();
    
     // Relationship 
        $userLogs = User::where('id', $dataArray['user_id'])->with('hasManyLogs')->get();
        return $userLogs;
    }

    public function getAllLogsOnThisDay($dataArray)
    {
        $userLogs = ClockIn::where('day_of', $dataArray['day_of'])->get();

        if ($userLogs == []) {
            return response('No data found', 200);

        }

        return $userLogs;
    }
}