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

    private function findUserByUserId($dayOf, $userId)
    {
        $hasUserClockIn = ClockIn::where('user_id', $userId)->where('day_of', $dayOf)->first();

        return $hasUserClockIn;
    }

    public function clockIn($dataArray)
    {
        $dayOf = $this->getCurrentDay();

        $userId = $dataArray['user_id'];

        $time_in = $dayOf . ' ' . $dataArray['time_in'];

        $hasUserClockIn = $this->findUserByUserId($dayOf, $userId);

        if ($hasUserClockIn != null) {
            return response('User has already clocked in!', 400);
        }

        $userClockIn = new ClockIn;
        $userClockIn->user_id = $userId;
        $userClockIn->time_in = $time_in;
        $userClockIn->day_of = $dayOf;
        $userClockIn->save();
        return response('Clock In Successful', 200);

    }
    public function clockOut($dataArray)
    {
        $dayOf = $this->getCurrentDay();

        $userId = $dataArray['user_id'];

        $timeOut = $dayOf . ' ' . $dataArray['time_out'];

        $hasUserClockIn = $this->findUserByUserId($dayOf, $userId);

        if ($hasUserClockIn->time_out != null) {
            return response('User has already clocked out!', 400);
        }

        $hasUserClockIn->time_out = $timeOut;
        $hasUserClockIn->save();

        return response('Clock Out Successful', 200);
    }
  
  
  // Admin Methods
    public function getAllUsersLogs($dataArray)
    {
        // Relationship 
        $userLogs = User::where('username', $dataArray['username'])->with(['hasManyLogs', 'hasManyLogs.userIdToUsername'])->get();
        // return $userLogs->hasManyLogs;
        $userLogs = $userLogs[0]->hasManyLogs;

        if (!$userLogs) {
            return response('Not Successful');
        }

        return $userLogs;
    }

    public function getAllLogsOnThisDay($dataArray)
    {

        // $userLogs = ClockIn::where('day_of', $dataArray['day_of'])->get();
        $userLogs = ClockIn::where('day_of', $dataArray['day_of'])->with('userIdToUsername')->get();

        if ($userLogs == []) {
            return response(' No data found', 200);
        }

        return $userLogs;
    }
}