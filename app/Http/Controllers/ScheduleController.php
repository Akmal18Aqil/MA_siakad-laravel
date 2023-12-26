<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    //index
    public function index()
    {
        $schedules = Schedule::paginate(10);
        return view('pages.schedule.index', compact('schedules'));
    }

    //show
    public function show($id)
    {
        $schedule = Schedule::find($id);
        return view('pages.schedule.show', compact('schedule'));
    }

    //create qrcode
    public function createQrcode(Schedule $schedule)
    {
        $code = $schedule->kode_absensi;
        return view('pages.schedule.qrcode', compact('code'))->with('schedule', $schedule);
    }

    // //generate qrcode
    public function generateQrcode(Request $request, Schedule $schedule)
    {
        $request->validate([
            'code' => 'required',
        ]);
        $schedule->update([
            'kode_absensi' => $request->code,
        ]);
        $code = $request->code;
        return view('pages.schedule.show-qrcode', compact('code'));
    }

    //create
    public function create()
    {
        return view('pages.schedule.create');
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'lecturer_id' => 'required',
            'semester' => 'required',
            'tahun_akademik' => 'required',
            'sks' => 'required',
            'kode_matakuliah' => 'required',
            'deskripsi' => 'required',
        ]);

        $schedule = new Schedule;
        $schedule->title = $request->get('title');
        $schedule->lecturer_id = $request->get('lecturer_id');
        $schedule->semester = $request->get('semester');
        $schedule->tahun_akademik = $request->get('tahun_akademik');
        $schedule->sks = $request->get('sks');
        $schedule->kode_matakuliah = $request->get('kode_matakuliah');
        $schedule->deskripsi = $request->get('deskripsi');
        $schedule->save();

        return redirect()->route('schedule.index')->with('success', 'Schedule has been created successfully.');
    }
}