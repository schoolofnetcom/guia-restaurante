<?php

namespace App\Http\Controllers\Api\V1;

use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
    public function me(Request $request)
    {
        $user = User::where('id', $request->user()->id)
            ->with(['restaurant'])
            ->first();
        return response()->json($user);
    }

    public function register(Request $request)
    {
        $data = $request->all();

        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = app('hash')->make($data['password']);
        $user->save();

        return response()->json(['status' => 'success']);
    }

    public function changePassword(Request $request)
    {
        $rules = [
            'password' => 'required|min:6',
            'password_confirmation' => 'same:password'
        ];

        $this->validate($request, $rules);

        $user = User::where('id', $request->user()->id)
            ->with(['restaurant'])
            ->first();
        
        $data = [
            'password' => $request->input('password')
        ];

        $user->update($data);
        return response()->json($user);
    }

    public function ediProfile(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email'
        ];

        $this->validate($request, $rules);

        $user = User::where('id', $request->user()->id)
            ->with(['restaurant'])
            ->first();
        
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];
        
        $user->update($data);
        return response()->json($user);
    }

    public function logout()
    {
        if (\Auth::check()) {
            \Auth::user()->oauthAccessToken()->delete();
        }

        return response()->json(['status' => 'success']);
    }
}
