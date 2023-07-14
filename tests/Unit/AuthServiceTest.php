<?php

namespace Tests\Unit;

use App\Http\Services\AuthService;
use Tests\TestCase;

class AuthServiceTest extends TestCase
{
    public function test_shoud_authenticate_sucessfull_token()
    {
        //SETUP
        $credentials = [
            'email' => 'bwayne@bat.com',
            'password' => 'batsecret'
        ];

        //ARRANGE

        $service = new AuthService() ;

        $result = $service->verifyUserCrendentials($credentials);

        //ASSERT

        $this->assertIsString($result);

    }

    public function test_shoud_not_return_token_with_wrong_credentials()
    {
        $credentials = [
            'email' => 'doidao@bat.com',
            'password' => 'batsecret123'
        ];

        $service = new AuthService() ;

        $result = $service->verifyUserCrendentials($credentials);

        $this->assertFalse($result);

    }

    public function test_shoud_return_empty_user()
    {

        $service = new AuthService() ;

        $result =  $service->getAuthenticatedUser();

        $this->assertNull($result);

    }

}
