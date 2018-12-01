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
    $carbonDate = Carbon::now();
    $date = Carbon::parse($carbonDate)->format('Y-m-d');;
    return $date;
  }
  public function clockIn($dataArray)
  {
    $dayOf = $this->getCurrentDay();
    $userCheckIn = new ClockIn;
    $userCheckIn->user_id = $dataArray['user_id'];
    $userCheckIn->time_in = $dataArray['time_in'];
    $userCheckIn->day_of = $dayOf;
    $userCheckIn->save();
    return response('Check In Successful', 200);
  }
  public function clockOut($dataArray)
  {
    $dayOf = $this->getCurrentDay();
     // catch exception;
    $userCheckOut = ClockIn::where('user_id', $dataArray['user_id'])->where('day_of', $dayOf)->firstOrFail();
    $userCheckOut->time_out = $dataArray['time_out'];
    $userCheckOut->save();
    return response('Check Out Successful', 200);
  }
     // Admin Methods
  public function getAllUsersLogs($dataArray)
  {
    $dataArray['day_of'] = $request->day_of;
    $dataArray['user_id'] = $request->user_id;
     // Relationship 
    $userLogs = User::where('id', $dataArray['user_id'])->with('hasManyLogs')->get();
    return $userLogs;
  }
  public function getAllLogsOnThisDay($dataArray)
  {
    $userLogs = ClockIn::where('day_of', $dataArray['day_of'])->get();
    if ($userLogs == null || isEmpty($userLogs)) {
      return response('No data found', 200);
    }
    return $userLogs;
  }
}