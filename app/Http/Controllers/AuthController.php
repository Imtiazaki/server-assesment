<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Http\Resources\ProfileResource;
use App\Models\User;
use App\Models\Profile;
use App\Models\Answer;
use App\Models\Module;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    // register a new user method
    public function register(RegisterRequest $request) {

        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);

        $profile = Profile::create([
            'email' => $data['email'],
            'nama' => $data['name'],
            'token' => $data['password'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'jabatan' => $data['jabatan'],
            'perusahaan' => $data['perusahaan'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'jadwal' => $data['jadwal'],
        ]);

        $jadwal = Schedule::where('id', $data['jadwal'])->first();

        $string = $jadwal['jenis_modul'];

        $listmodul = explode(', ', $string);

        foreach ($listmodul as $modul) {
            $findmodul = Module::find($modul);
            if ($findmodul) {
                $answer = Answer::create([
                    'email' => $data['email'],
                    'nama' => $data['name'],
                    'modul' => $findmodul['nama_module'],
                    'tanggal' => null,
                    'token' => null,
                    'mulai' => " ",
                    'selesai' => " ",
                    'jawaban' => " ",
                ]);
            }
        }
        
        return response()->json([
            'user' => new UserResource($user),
            'profile' => new ProfileResource($profile),
            'strings' => $string,
            'list' => $listmodul,
        ]);
    }



    // login a user method
    public function login(LoginRequest $request) {
        $data = $request->validated();

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'Email or password is incorrect!'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        $cookie = cookie('token', $token, 60 * 12); // 1 day

        return response()->json([
            'user' => new UserResource($user),
        ])->withCookie($cookie);
    }

    // logout a user method
    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        $cookie = cookie()->forget('token');

        return response()->json([
            'message' => 'Logged out successfully!'
        ])->withCookie($cookie);
    }

    // get the authenticated user method
    public function user(Request $request) {
        return new UserResource($request->user());
    }
}