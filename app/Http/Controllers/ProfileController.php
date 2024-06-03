<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\ResetResource;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\FindByNameRequest;
use App\Http\Requests\VerifikasiRequest;
use App\Http\Requests\ResetRequest;
use App\Models\User;
use App\Models\Profile;
use App\Models\Schedule;
use Illuminate\Support\Facades\Hash;
use App\Models\Answer;
use App\Models\Prompt;
use App\Models\Module;
use App\Models\Verifikasi;

class ProfileController extends Controller
{
    public function getProfile()
    {
        $profile = Profile::all();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $profile
        ], 200);
    }

    
    public function findProfile($id)
    {
        $profile = Profile::find($id);
        if (!$profile) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Profile not found'
                ]
            ], 404);
        }
        $prompt = Prompt::all();

        $schedule = Schedule::all();

        $answer = Answer::where('email', $profile['email'])->get();
        
        $collection = collect($answer);
        $multiplied = $collection->map(function ($item) {
            $findmodul = Module::where('nama_module', $item['modul'])->first();
            $item->soal = $findmodul['soal'];
            $item->tipe = $findmodul['tipe'];
            return $item;
        });
        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'profile' => $profile,
            'answer' => $answer,
            'schedule' => $schedule,
            'prompt' => $prompt,
        ], 200);
    }

    public function findProfileByName(FindByNameRequest $request)
    {
        $data = $request->validated();
        $profile = Profile::where('email', $data['email'])->first();
        
        if (!$profile) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Profile not found'
                ]
            ], 404);
        }
        $user = User::where('email', $profile['email'])->first();
        
        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'profile' => $profile,
            'user' => $user,
        ], 200);
    }


    public function updateProfile(ProfileRequest $request, $id)
    {
        $profile = Profile::find($id);
        if (!$profile) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Profile not found'
                ]
            ], 404);
        }
        
        $data = $request->validated();
        $profile->update($data);

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $profile
        ], 200);
    }

    public function verifyProfile(VerifikasiRequest $request, $id)
    {
        $profile = Profile::find($id);
        if (!$profile) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Profile not found'
                ]
            ], 404);
        }
        
        $data = $request->validated();

        $profile->update([
            'email' => $profile['email'],
            'nama' => $profile['nama'],
            'token' => $profile['token'],
            'jenis_kelamin' => $profile['jenis_kelamin'],
            'jabatan' => $profile['jabatan'],
            'perusahaan' => $profile['perusahaan'],
            'mulai' => $data['verified'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'jadwal' => $profile['jadwal'],
        ]);
        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => "SUCCESS",
        ], 200);
    }

    public function deleteUser($id)
    {
        $profile = Profile::find($id);
        if (!$profile) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Profile not found'
                ]
            ], 404);
        }

        $user = User::where('email', $profile['email'])->first();

        $user->delete();
        $profile->delete();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'message' => 'User deleted successfully'
        ], 200);
    }

    public function resetToken(ResetRequest $request, $id)
    {
        $profile = Profile::find($id);
        if (!$profile) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Profile not found'
                ]
            ], 404);
        }

        $user = User::where('email', $profile['email'])->first();
        $data = $request->validated();
        $profile->update([
            'email' => $profile['email'],
            'nama' => $profile['nama'],
            'token' => $data['token'],
            'jenis_kelamin' => $profile['jenis_kelamin'],
            'jabatan' => $profile['jabatan'],
            'perusahaan' => $profile['perusahaan'],
            'tanggal_lahir' => $profile['tanggal_lahir'],
            'jadwal' => $profile['jadwal'],
        ]);

        $user->update([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => Hash::make($data['cookie']),
            'role' => $user['role'],
        ]);

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $profile
        ], 200);
    }
}
