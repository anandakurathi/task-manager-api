<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        // this will take care for validating the user credentials.
        // will not return any response. So we will get user details by querining
        $request->authenticate();

        // get user details from user
        $select = ['id','name','email'];
        $user = User::select($select)->where('email', $request->email)->first();

//        $request->session()->regenerate();

        $token = $user->createToken($request->email);

        return response()->json([
            'message' => 'Successfully logged in!',
            'token' => $token->plainTextToken,
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        $tokenId = \Str::before(request()->bearerToken(), '|');
        $user = $request->user();
        $user->tokens()->where('id', $tokenId)->delete();

        return response()->json([
            'message' => 'Successfully logged out!'
        ]);
    }
}
