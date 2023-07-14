<?php

namespace Tests\Feature;

use Tests\TestCase;

class GetAuthenticatedUserTest extends TestCase
{   
    public function test_shoud_return_role_and_id_from_user_with_valid_token()
    {
        $credentials = [
            'email' => 'bwayne@bat.com',
            'password' => 'batsecret'
        ];

        $valid_token = $this->json('POST', '/api/auth/login',$credentials)->decodeResponseJson();
       
        $reponse = $this->withHeader('Authorization', 'Bearer '.$valid_token['token'])
                        ->json('GET', '/api/auth/authorize');

        $reponse->assertStatus(202);
        $reponse->assertJsonStructure(['user_id','role']);
    }

    public function test_shoud_not_return_role_and_id_from_user_with_valid_token()
    {
        $reponse = $this->withHeader('Authorization', 'Bearer '.'invalid_token')
                        ->json('GET', '/api/auth/authorize');

        $reponse->assertStatus(401);

    }


}
