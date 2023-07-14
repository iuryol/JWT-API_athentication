<?php
namespace App\Http\Services;
class AuthService 
{
    

public function verifyUserCrendentials(Array $credentials)
{
    return auth('api')->attempt($credentials);

}

public function getAuthenticatedUser()
{
    return auth('api')->user();
}

}