<?php

namespace App\Http\Controllers\Application;

use App\Models\Application\Note;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::all();
        return view('admin.application.index', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'application_id' => 'required|exists:applications,id',
            'applicant_id' => 'required|exists:users,id',
            'commenter_id' => 'required|exists:users,id',
            'step' => 'required|string|max:255',
            'rating' => 'required|string|max:255',
            'note' => 'required|string|max:1000',
        ]);

        Note::create($request->all());

        return redirect()->route('admin.application.index')->with('success', 'Note created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'application_id' => 'required|exists:applications,id',
            'applicant_id' => 'required|exists:users,id',
            'commenter_id' => 'required|exists:users,id',
            'step' => 'required|string|max:255',
            'rating' => 'required|string|max:255',
            'note' => 'required|string|max:1000',
        ]);

        $note->update($request->all());

        return redirect()->route('admin.application.index')->with('success', 'Note updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note->delete();

        return redirect()->route('admin.application.index')->with('success', 'Note deleted successfully.');
    }
}
