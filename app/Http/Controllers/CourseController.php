<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\ActivityRequest;
use App\Http\Requests\ModuleRequest;
use App\Http\Requests\EverythingRequest;
use App\Http\Requests\ScheduleRequest;
use App\Http\Requests\ScoringRequest;
use App\Http\Resources\ScoringResource;
use App\Http\Resources\ModulResource;
use App\Http\Resources\ScheduleResource;
use App\Http\Resources\ActivityResource;
use App\Models\Course;
use App\Models\Activity;
use App\Models\Module;
use App\Models\Answer;
use App\Models\Schedule;
use App\Models\Scoring;
use App\Models\Profile;


class CourseController extends Controller
{
    public function getEverything(EverythingRequest $request)
    
    {
        $data = $request->validated();
        $module = array();
        $profile = Profile::where('email', $data['email'])->first();

        $jadwal = Schedule::where('id', $profile['jadwal'])->first();

        $string = $jadwal['jenis_modul'];

        $listmodul = explode(', ', $string);

        foreach ($listmodul as $modul) {
            $findmodul = Module::find($modul);
            if ($findmodul) {
                array_push($module, $findmodul);
            }
        }

        $answer = Answer::where('email', $data['email'])->get();
        $schedule = Schedule::where('id', $profile['jadwal'])->first();
        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => [
                'modul' => $module,
                'profile' => $profile,
                'schedule' => $schedule,
                'answer' => $answer,
            ],
        ], 200);
    }

    


    public function getModule()
    {
        $module = Module::all();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $module
        ], 200);
    }

    public function getSchedule()
    {
        $schedule = Schedule::all();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $schedule
        ], 200);
    }

/*     public function courseRegister(CourseRequest $request) {

        $data = $request->validated();



        $check = ProblemAnalysis::where('email', $data['email'])->first();

        if (!$check) {
            $course = ProblemAnalysis::create([
                'nama' => $data['nama'],
                'email' => $data['email'],
                'tanggal_test' => $data['tanggal_test'],
                'mulai' => 0,
                'selesai' => 0,
            ]);
    
            $activity = Activity::create([
                'email' => $data['email'],
                'nama' => $data['nama'],
                'module' => $data['module'],
                'sudah_mulai' => false,
                'sudah_selesai' => false,
            ]);
    
            $answer = JawabanProblemAnalysis::create([
                'nama' => $data['nama'],
                'email' => $data['email'],
                'jawaban' => "",
            ]);
            return response()->json([
                'course' => new ProblemAnalysisResource($course),
                'activity' => new ActivityResource($activity),
                'jawaban' => new AnswerProblemAnalysisResource($answer),
                ]);
        } else {
            return response()->json([
                'message' => 'Email already exists',
            ], 409);
        }

    } */

    public function createModule(ModuleRequest $request) {

        $data = $request->validated();

        $module = Module::create([
            'nama_module' => $data['nama_module'],
            'tipe' => $data['tipe'],
            'waktu_mengerjakan' => $data['waktu_mengerjakan'],
            'soal' => $data['soal'],
            'link' => $data['link'],
        ]);


        return response()->json([
            'module' => new ModulResource($module),
        ]);
    }
    public function createSchedule(ScheduleRequest $request) {

        $data = $request->validated();

        $schedule = Schedule::create([
            'kursus' => $data['kursus'],
            'peserta' => $data['peserta'],
            'keterangan' => $data['keterangan'],
            'jenis_modul' => $data['jenis_modul'],
            'tanggal_mulai' => $data['tanggal_mulai'],
            'tanggal_selesai' => $data['tanggal_selesai'],
        ]);


        return response()->json([
            'jadwal' => new ScheduleResource($schedule),
        ]);
    }

    public function deleteModule($id)
    {
        $modul = Module::find($id);
        if (!$modul) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Module not found'
                ]
            ], 404);
        }

        $modul->delete();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'message' => 'Module deleted successfully'
        ], 200);
    }

    public function deleteSchedule($id)
    {
        $schedule = Schedule::find($id);
        if (!$schedule) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Schedule not found'
                ]
            ], 404);
        }

        $schedule->delete();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'message' => 'Schedule deleted successfully'
        ], 200);
    }

    public function findModule($id)
    {
        $module = Module::find($id);
        if (!$module) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Module not found'
                ]
            ], 404);
        }
        
        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $module
        ], 200);
    }

    public function findSchedule($id)
    {
        $schedule = Schedule::find($id);
        if (!$schedule) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Schedule not found'
                ]
            ], 404);
        }
        
        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $schedule
        ], 200);
    }

    public function updateModule(ModuleRequest $request, $id)
    {
        $module = Module::find($id);
        if (!$module) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Module not found'
                ]
            ], 404);
        }
        
        $data = $request->validated();
        $module->update($data);

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $module
        ], 200);
    }

    public function updateSchedule(ScheduleRequest $request, $id)
    {
        $schedule = Schedule::find($id);
        if (!$schedule) {
            return response()->json([
                'code' => 404,
                'status' => 'Not Found',
                'errors' => [
                    'message' => 'Schedule not found'
                ]
            ], 404);
        }
        
        $data = $request->validated();
        $schedule->update($data);

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $module
        ], 200);
    }

    public function createScoring(ScoringRequest $request) {

        $data = $request->validated();

        $modul = Module::find($id);

        $scoring= Scoring::create([
            'modul' => $modul['nama_module'],
            'idModul' => $data['idModul'],
            'metode_penilaian' => $data['metode_penilaian'],
        ]);


        return response()->json([
            'scoring' => $scoring
        ]);
    }
}

