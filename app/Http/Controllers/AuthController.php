<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Views
    public function index()
    {
        return view('admin.pages.auth.login');
    }

    public function forgot()
    {
        return view('admin.pages.auth.forgot');
    }

    public function resetForm(Request $request)
    {
        $token = $request->token;
        $email = $request->email;

        return view('admin.pages.auth.reset', compact('token', 'email'));
    }

    // Logics
    public function get_connected(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
            'remember' => ['nullable'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $remember = $request->has('remember');

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            return response()->json([
                'status' => true,
                'redirect' => route('dashboard.analytics'),
            ]);
        }

        return response()->json([
            'status' => false,
            'errors' => ['Identifiants Invalides'],
        ], 422);
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();
        $token = Str::random(60);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => Hash::make($token),
                'created_at' => now(),
            ]
        );

        $user->notify((new ResetPasswordNotification($token))->delay(now()->addSeconds(5)));

        return response()->json([
            'status' => true,
            'message' => 'Un email a été envoyé pour réinitialiser votre mot de passe.',
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $record = DB::table('password_reset_tokens')->where('email', $request->email)->first();

        if (! $record || ! Hash::check($request->token, $record->token)) {
            return response()->json([
                'status' => false,
                'errors' => ['Token invalide ou expiré.'],
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return response()->json([
            'status' => true,
            'message' => 'Mot de passe réinitialisé avec succès.',
        ]);
    }

    public function get_logged_out()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }
}
