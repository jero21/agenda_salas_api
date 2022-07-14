<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use JWTAuth;
use DB;

class AuthenticateController extends Controller
{
  
  public function login(Request $request)
  {
    if ($request->username === null || $request->password === null) {
      return response()->json(['error' => 'invalid_credentials'], 500);
    }
    $conex = ldap_connect('172.18.1.7', '389') or die ("No ha sido posible conectarse al servidor"); 
    if (ldap_set_option($conex, LDAP_OPT_PROTOCOL_VERSION, 3)){ 
      ldap_set_option($conex, LDAP_OPT_REFERRALS, 0);
    }else{
      return response()->json(['error' => 'Error de conexión de protocolo '], 500);
    } 
    if ($conex){
      $usuario = $request->username.'@minpublico.cl';
      $r=@ldap_bind($conex, $usuario, $request->password);
      if ($r) {
        // Se busca al usuario por username
        $cuenta = User::where('username', '=', $request->username)
                  ->first();
       try {
    // attempt to verify the credentials and create a token for the user
        if ($cuenta != null) {
          $token = JWTAuth::fromUser($cuenta, ['exp' => Carbon::now()->addDays(7)->timestamp]);
        } else {
          return response()->json(['error' => 'invalid_credentials'], 500); // 401 Invalid credentials
        }
      } catch (JWTException $e) {
        // something went wrong whilst attempting to encode the token
        return response()->json(['error' => 'could_not_create_token'], 500);
      }
      // all good so return the token
      return response()->json(compact('token'));
    } else {
      return response()->json(['error' => 'invalid_credentials'], 500); // 401 Invalid credentials
    }
      ldap_close($conex);
    } else {
      return response()->json(['error' => 'No ha sido posible conectarse al servidor'], 500);
    }
  }

  public function getAuthUser()
  {
    try {
      if (! $user = JWTAuth::parseToken()->authenticate()) {
        return response()->json(['user_not_found'], 404);
      }
    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
      return response()->json(['token_expired'], $e->getStatusCode());
    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
      return response()->json(['token_invalid'], $e->getStatusCode());
    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
      return response()->json(['token_absent'], $e->getStatusCode());
    }

    // the token is valid and we have found the user via the sub claim
    $user = User::where('id', $user->id)->first();
    return $user;
  }

}
