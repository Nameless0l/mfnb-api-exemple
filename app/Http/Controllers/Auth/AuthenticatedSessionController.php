<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\StylisteResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        if (auth()->user()->is_stylist) {
            return response()->json([
                // 'user'=>auth()->user(),
                'user' =>new StylisteResource(auth()->user()->styliste),
                'token' => auth()->user()->createToken('auth_token')->plainTextToken
            ]);
        }
        return response()->json([
            'user'=>auth()->user(),
            'token' => auth()->user()->createToken('auth_token')->plainTextToken
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
