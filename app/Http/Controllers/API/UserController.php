<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string'],
            ]);

            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'phone' => $request->phone_number,
                'password' => bcrypt($request->password),
            ]);

            $user = User::where('email', $request->email)->first();

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 'User Registered');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error' => $error
            ], 'Authentication Failed', 500);
        }
    }

    public function show(
        Request $request,
        $id
    ) {
        $user = User::findOrFail($id);
        return ResponseFormatter::success($user, 'Data Profile User berhasil di ambil');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
        ]);

        $edit = User::findOrFail($id);
        $edit->name = $request->name;
        $edit->username = $request->username;

        $edit->save();
        return response()->json(['data' => $edit]);
    }
}
