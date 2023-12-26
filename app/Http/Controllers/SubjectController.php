<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    //index
    public function index()
    {
        $subjects = Subject::paginate(10);
        return view('pages.subject.index', compact('subjects'));
    }

    //create
    public function create()
    {
        return view('pages.subject.create');
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

        $subject = new Subject;
        $subject->title = $request->get('title');
        $subject->lecturer_id = $request->get('lecturer_id');
        $subject->semester = $request->get('semester');
        $subject->tahun_akademik = $request->get('tahun_akademik');
        $subject->sks = $request->get('sks');
        $subject->kode_matakuliah = $request->get('kode_matakuliah');
        $subject->deskripsi = $request->get('deskripsi');
        $subject->save();

        return redirect()->route('subject.index')->with('success', 'Subject has been created successfully.');
    }

    //show
    public function show($id)
    {
        // $subject = Subject::find($id);
        // return view('pages.subject.show', compact('subject'));
    }

    //edit
    public function edit($id)
    {
        $subject = Subject::find($id);
        return view('pages.subject.edit', compact('subject'));
    }

    //update
    public function update(Request $request, $id)
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

        $subject = Subject::find($id);
        $subject->title = $request->get('title');
        $subject->lecturer_id = $request->get('lecturer_id');
        $subject->semester = $request->get('semester');
        $subject->tahun_akademik = $request->get('tahun_akademik');
        $subject->sks = $request->get('sks');
        $subject->kode_matakuliah = $request->get('kode_matakuliah');
        $subject->deskripsi = $request->get('deskripsi');
        $subject->save();

        return redirect()->route('subject.index')->with('success', 'Subject has been updated successfully.');
    }

    //destroy
    public function destroy($id)
    {
        $subject = Subject::find($id);
        $subject->delete();

        return redirect()->route('subject.index')->with('success', 'Subject has been deleted successfully.');
    }
}
