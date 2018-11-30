<?php 
namespace App\DiInterfaces;

interface ClockInDiInterface
{
  public function checkIn($dataArray);
  public function checkOut($dataArray);
   // Admin Methods
  public function getAllUsersLogs($dataArray);
  public function getAllLogsOnThisDay($dataArray);
} 