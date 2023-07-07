<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends ApiController
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Los datos suministrados son incorrectos'], 401);
        }

        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'data' => $user,
        ]);

    }

    public function logout(Request $request)
    {
        error_log("test logout");
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function me()
    {
        return response()->json(Auth::user());
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        // $user->confirmation_token = sha1($request->email . time());

        $user->save();
        // $baseUrl = "https://netafimdatabase.com";
        // $baseUrl = "https://netafimdatabase.com";
        // $token = $user->confirmation_token;
        // $expiration = now()->addMinutes(60);
        // $route = 'verification.verify';
        // $url = "$baseUrl/verificacion/$token";

        // // Envío del correo de verificación
        // Mail::send('emails.verify', ['url' => $url], function ($message) use ($user) {
        //     $message->to($user->email);
        //     $message->subject('Verificación de cuenta');
        // });
        return response()->json(['message' => "Hola, $user->name tu registro fue completado"], 201);
    }
    public function updatePassword(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->password = bcrypt($request->password);
        $user->save();
        return response()->json(['message' => 'Contraseña actualizada de forma correcta'], 200);
    }

    public function verify(Request $request, $token)
    {
        $user = User::where('confirmation_token', $token)->first();

        if (!$user) {
            return response()->json(['error' => 'token invalido'], 422);
        }

        $user->confirmation_token = null;
        $user->email_verified_at = now();
        $user->save();

        return response()->json(['message' => 'Account verified successfully'], 200);
    }

    public function confirmAccount(Request $request, $token)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if (!$user->hasVerifiedEmail()) {
            if ($user->markEmailAsVerified()) {
                return response()->json(['message' => 'Account confirmed successfully']);
            }
        }

        return response()->json(['message' => 'Account has already been verified']);
    }

    // public function sendResetLinkEmail(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()], 422);
    //     }
    //     $status = Password::sendResetLink($request->only('email'));
    //     if ($status === Password::RESET_LINK_SENT) {
    //         return response()->json(['message' => 'Password reset link sent to your email']);
    //     }
    //     return response()->json(['error' => 'Unable to send password reset link'], 422);
    // }

    public function sendResetLinkEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'Correo electrónico no encontrado.'], 422);
        }

        $token = Str::random(40);

        // $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->confirmation_token = $token; // Generar un nuevo token
            $user->save();
        }

        $baseUrl = "https://netafimdatabase.com";
        $url = "$baseUrl/reset-password/$token";

        Mail::send('emails.verify', ['url' => $url], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Restablecimiento de contraseña');
        });

        return response()->json(['message' => 'Enlace para restablecer contraseña enviado a tu correo electrónico.']);
    }

    public function resetPassword(Request $request, $token)
    {
        // actualizar contraseña desde el correo
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed',
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $user = User::where("confirmation_token", $token)->first();
        error_log($user);
        if (!$user) {
            return response()->json(['error' => 'Token invalido'], 422);
        }
        // Actualizar la contraseña y eliminar el token de confirmación
        $user->password = Hash::make($request->password);
        $user->confirmation_token = null;
        $user->save();
        return response()->json(['message' => 'Restablecimiento de contraseña exitoso.']);

    }
}
