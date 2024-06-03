<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Http\Requests\StartTestRequest;
use App\Http\Requests\AnswerRequest;
use App\Http\Requests\AutoSaveAnswerRequest;
use App\Http\Requests\PromptRequest;
use App\Models\Module;
use App\Models\Prompt;
use App\Models\ProfileResult;

class TestController extends Controller
{
    public function startTest(StartTestRequest $request, $id)
    {
        $answer = Answer::find($id);

        if (!$answer) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Profile not found'
                ]
            ], 404);
        }

        $data = $request->validated();
        $answer->update([
            'email' => $answer['email'],
            'nama' => $answer['nama'],
            'modul' => $answer['modul'],
            'tanggal' => $data['tanggal'],
            'token' => $answer['token'],
            'mulai' => $data['mulai'],
            'selesai' => $answer['selesai'],
            'jawaban' => $answer['jawaban'],
        ]);
    }

    public function getAllAnswers()
    {
        $answer = Answer::all();

        $answered = Answer::where('tanggal','!=', null)->get();
        $collection = collect($answered);
 
        $multiplied = $collection->map(function ($item) {
            $findmodul = Module::where('nama_module', $item['modul'])->first();
            $findprofile = ProfileResult::where('email', $item['email'])->first();
            $item->soal = $findmodul['soal'];
            $item->profile = $findprofile;
            $item->tipe = $findmodul['tipe'];
            return $item;
        });
 
        $multiplied->all();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => [ 
                'answers' => $answered,
            ]
        ], 200);
    }

    public function getAnswer($id)
    {
        $answer = Answer::find($id);

        if (!$answer) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Profile not found'
                ]
            ], 404);
        }
 
        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $answer
        ], 200);
    }

    public function submitAnswer(AnswerRequest $request, $id)
    {
        $answer = Answer::find($id);
        if (!$answer) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Schedule not found'
                ]
            ], 404);
        }
        
        $data = $request->validated();
        $answer->update([
            'email' => $answer['email'],
            'nama' => $answer['nama'],
            'modul' => $answer['modul'],
            'tanggal' => $answer['tanggal'],
            'token' => $answer['token'],
            'mulai' => $answer['mulai'],
            'selesai' => $data['selesai'],
            'jawaban' => $data['jawaban'],
        ]);

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $answer
        ], 200);
    }

    public function autoSaveAnswer(AutoSaveAnswerRequest $request, $id)
    {
        $answer = Answer::find($id);
        if (!$answer) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Answer not found'
                ]
            ], 404);
        }
        
        $data = $request->validated();
        $answer->update([
            'email' => $answer['email'],
            'nama' => $answer['nama'],
            'modul' => $answer['modul'],
            'tanggal' => $answer['tanggal'],
            'token' => $answer['token'],
            'mulai' => $answer['mulai'],
            'selesai' => $answer['selesai'],
            'jawaban' => $data['jawaban'],
        ]);

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $answer
        ], 200);
    }


    public function getPrompt()
    {
        $prompt = Prompt::all();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => [ 
                'prompts' => $prompt,
            ]
        ], 200);
    }
    
    public function createPrompt(PromptRequest $request) {

        $data = $request->validated();

        $prompt = Prompt::create([
            'nama' => $data['nama'],
            'keterangan' => $data['keterangan'],
            'isiprompt' => $data['isiprompt'],
        ]);


        return response()->json([
            'prompt' => $prompt,
        ]);
    }

    public function updateprompt(PromptRequest $request, $id)
    {
        $prompt = Prompt::find($id);
        if (!$prompt) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Prompt not found'
                ]
            ], 404);
        }
        
        $data = $request->validated();
        $prompt->update($data);

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $prompt
        ], 200);
    }

    public function deletePrompt($id)
    {
        $prompt = Prompt::find($id);
        if (!$prompt) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Prompt not found'
                ]
            ], 404);
        }

        $prompt->delete();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'message' => 'Prompt deleted successfully'
        ], 200);
    }
}
