<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    // Login
    public function login(Request $request){

        try{
            $email = $request->input('email');
            $password = $request->input('password');
            $attempt = Auth::attempt(['email' => $email, 'password' => $password]);

            if($attempt){
                /** @var User $user */

                $user = Auth::user();
                $token = $user->createToken('app')->accessToken;

                // Get menu for user
                $menu=Menu::get();
                $submenu=\DB::table('sousmenu')->join('menu','sousmenu.parent_id','=','menu.id')
                    ->select('sousmenu.id','name_sous_menu','route_sous_menu', 'level_sous_menu', 'parent_id','icone_sous_menu', 'etat_sous_menu')->get();
               $test = [
                   'user' => $user,
                   'menu'
               ];
                return response([
                    'success' => true,
                    'message' => 'success',
                    'token'   => $token,
                    'user'    => $user,
                    'menu'    => $menu,
                    'submenu'  => $submenu
                ]);
            }

        }catch (\Exception $exception){
            return response([
                'success' => false,
                'message' => $exception->getMessage()
            ], 401);
        }

        return response([
            'success' => false,
            'message' => 'Invalid username/password'
        ], 401);
    }

    public function user(){
        return Auth::user();
    }

    public function register(Request $request){
        try{

            $user = User::create([
                'first_name'=> $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email'     => $request->input('email'),
                'password'  => Hash::make($request->input('password'))
            ]);

            return response([
                'success' => true,
                'data' => $user
            ]);

        }catch (\Exception $exception){
            return response([
                'success' => false,
                'message' => $exception->getMessage()
            ], 401);
        }


    }
}
