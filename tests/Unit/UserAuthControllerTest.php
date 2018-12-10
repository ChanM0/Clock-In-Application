<?php

namespace Tests\Feature;

namespace Tests\Unit;

use Mockery;

use Tests\TestCase;

use App\Http\Controllers\UserAuthController;

use App\DiInterfaces\UserAuthDiInterface;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use App\Http\Requests\SignUpValidateRequest;

class UserAuthControllerTest extends TestCase
{
    protected $retriever = null;
    protected $controller = null;

    public function setUp()
    {
        parent::setUp();
        $this->retriever = Mockery::spy(UserAuthDiInterface::class);
        $this->controller = new UserAuthController($this->retriever);
    }

    public function test_signup()
    {
        $data = json_encode(
            [
                "access_token" => "serializedToken",
                "token_type" => "bearer",
                "expires_in" => 3600,
                "username" => "fakeTest@email.com",
                "user_id" => 33
            ]
        );

        $input = [
            "email" => "fakeTest@email.com",
            "password" => "fakeTest@email.com",
            "username" => "fakeTest@email.com",
            "password_confirmation" => "fakeTest@email.com"
        ];

        $request = new SignUpValidateRequest($input);

        $this->retriever
            ->shouldReceive('signup')
            ->once()
            ->with($request)
            ->andReturn($data);

        $response = $this->controller->signup($request);

        $this->assertEquals($response, $data);
    }

    public function test_login()
    {
        $data = json_encode(
            [
                "access_token" => "serializedToken",
                "token_type" => "bearer",
                "expires_in" => 3600,
                "username" => "fakeTest@email.com",
                "user_id" => 33
            ]
        );

        $input = [
            "email" => "fakeTest@email.com",
            "password" => "fakeTest@email.com",
        ];

        $request = new Request($input);

        $this->retriever
            ->shouldReceive('login')
            ->once()
            ->andReturn($data);

        $response = $this->controller->login($request);

        $this->assertEquals($response, $data);
    }

    public function test_logout()
    {
        $data = json_encode(
            [
                "message" => "Successfully logged out"
            ]
        );

        $input = [
            "token" => "serializedToken",
        ];

        $request = new Request($input);

        $this->retriever
            ->shouldReceive('logout')
            ->once()
            ->andReturn($data);

        $response = $this->controller->logout($request);

        $this->assertEquals($response, $data);
    }

    public function test_refresh()
    {
        $data = json_encode(
            [
                "access_token" => "serializedToken",
                "token_type" => "bearer",
                "expires_in" => 3600,
                "username" => "fakeTest@email.com",
                "user_id" => 33
            ]
        );

        $input = [
            "token" => "serializedToken",
        ];

        $request = new Request($input);

        $this->retriever
            ->shouldReceive('refresh')
            ->once()
            ->andReturn($data);

        $response = $this->controller->refresh($request);

        $this->assertEquals($response, $data);
    }

    public function test_me()
    {
        $data = json_encode(
            [
                "id" => 33,
                "username" => "fakeTest@email.com",
            ]
        );

        $input = [
            "token" => "serializedToken",
        ];

        $request = new Request($input);

        $this->retriever
            ->shouldReceive('me')
            ->once()
            ->andReturn($data);

        $response = $this->controller->me($request);

        $this->assertEquals($response, $data);
    }

    public function test_getAllUsers()
    {
        $data = json_encode([["id" => 1, "username" => "Wilma Ledner"], ["id" => 2, "username" => "Dr. Sim Jakubowski II"], ["id" => 3, "username" => "Angela Goyette"]]);

        $input = [
            "token" => "serializedToken",
        ];

        $request = new Request($input);

        $this->retriever
            ->shouldReceive('getAllUsers')
            ->once()
            ->andReturn($data);

        $response = $this->controller->getAllUsers($request);

        $this->assertEquals($response, $data);
    }


}
