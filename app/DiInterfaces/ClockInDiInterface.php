<?php 
namespace App\DiInterfaces;

interface ClockInDiInterface
{
  public function clockIn($dataArray);
  public function clockOut($dataArray);
   // Admin Methods
  public function getAllUsersLogs($dataArray);
  public function getAllLogsOnThisDay($dataArray);
} 