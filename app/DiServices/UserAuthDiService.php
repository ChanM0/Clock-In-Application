<?php 
namespace App\DiServices;

use App\User;
use App\DiInterfaces\UserAuthDiInterface;

class UserAuthDiService implements UserAuthDiInterface
{
  public function signup($dataArray)
  {
    $user = new User([
      'first_name' => $dataArray['first_name'],
      'last_name' => $dataArray['last_name'],
      'email' => $dataArray['email'],
      'password' => bcrypt($dataArray['password']),
    ]);

    $user->save();

    return response()->json(['message' => 'success'], 201);
  }
}