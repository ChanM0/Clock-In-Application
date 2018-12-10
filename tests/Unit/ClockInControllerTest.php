<?php

namespace Tests;

use Mockery;

use Tests\TestCase;

use App\Http\Controllers\ClockInController;

use App\DiInterfaces\ClockInDiInterface;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class ClockInControllerTest extends TestCase
{
    protected $retriever = null;
    protected $controller = null;

    public function setUp()
    {
        parent::setUp();
        $this->retriever = Mockery::spy(ClockInDiInterface::class);
        $this->controller = new ClockInController($this->retriever);
    }


    public function test_get_All_Logs_On_This_Day()
    {
        $data = json_encode([
            [
                'day_of' => "2018-12-09",
                'time_in' => "2018-12-09 14:38:03",
                'time_out' => "2018-12-09 14:38:06",
                'user_id_to_username' =>
                    [
                    'id' => 31,
                    'username' => "fdasfdasfdsafdsafasdfadsfasd@email.com"
                ]
            ],
            [
                'day_of' => "2018-12-09",
                'time_in' => "2018-12-09 14:38:03",
                'time_out' => "2018-12-09 14:38:06",
                'user_id_to_username' =>
                    [
                    'id' => 31,
                    'username' => "fdasfdasfdsafdsafasdfadsfasd@email.com"
                ]
            ]
        ]);

        $input = [
            'date' => "2018-12-07",
        ];

        $request = new Request($input);

        $dataArray['day_of'] = $request->date;

        $this->retriever
            ->shouldReceive('getAllLogsOnThisDay')
            ->once()
            ->with($dataArray)
            ->andReturn($data);

        $response = $this->controller->getAllLogsOnThisDay($request);

        $this->assertEquals($response, $data);
    }

    public function test_get_All_Users_Logs()
    {
        $data = json_encode([
            [
                'day_of' => "2018-12-09",
                'time_in' => "2018-12-09 14:38:03",
                'time_out' => "2018-12-09 14:38:06",
                'user_id_to_username' =>
                    [
                    'id' => 31,
                    'username' => "fdasfdasfdsafdsafasdfadsfasd@email.com"
                ]
            ],
            [
                'day_of' => "2018-12-09",
                'time_in' => "2018-12-09 14:38:03",
                'time_out' => "2018-12-09 14:38:06",
                'user_id_to_username' =>
                    [
                    'id' => 31,
                    'username' => "fdasfdasfdsafdsafasdfadsfasd@email.com"
                ]
            ]
        ]);

        $input = [
            'username' => "fdasfdasfdsafdsafasdfadsfasd@email.com",
        ];

        $request = new Request($input);

        $dataArray['username'] = $request->username;

        $this->retriever
            ->shouldReceive('getAllUsersLogs')
            ->once()
            ->with($dataArray)
            ->andReturn($data);

        $response = $this->controller->getAllUsersLogs($request);

        $this->assertEquals($response, $data);
    }

    public function test_clock_in()
    {
        $data = json_encode([
            "data" => "Clock In Successful"
        ]);

        $input = [
            'user_id' => 44,
            'time' => "14:09:38",
        ];

        $request = new Request($input);

        $dataArray['user_id'] = $request->user_id;
        $dataArray['time_in'] = $request->time;

        $this->retriever
            ->shouldReceive('clockIn')
            ->once()
            ->with($dataArray)
            ->andReturn($data);

        $response = $this->controller->clockIn($request);

        $this->assertEquals($response, $data);
    }

    public function test_clock_out()
    {
        $data = json_encode([
            "data" => "Clock Out Successful"
        ]);

        $input = [
            'user_id' => 44,
            'time_out' => "14:39:38",
        ];

        $request = new Request($input);

        $dataArray['user_id'] = $request->user_id;
        $dataArray['time_out'] = $request->time;

        $this->retriever
            ->shouldReceive('clockOut')
            ->once()
            ->with($dataArray)
            ->andReturn($data);

        $response = $this->controller->clockOut($request);

        $this->assertEquals($response, $data);
    }

}
