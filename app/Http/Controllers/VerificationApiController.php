<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerificationApiController extends Controller
{
    public function verify(Request $request, $id, $hash) {

        $user = User::find($id);

        if ($user->hasVerifiedEmail()) {
            return response()->json('Email already verified.');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return response()->json('Email verified successfully.');
    }

    public function resend(Request $request) {

        if ($request->user()->hasVerifiedEmail()) {
            return response()->json('Email already verified.');
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json('Email verification link sent.');
    }
}
