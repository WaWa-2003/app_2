<?php

namespace App\Http\Controllers\Applicant;

use App\Models\Applicant\Other;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OtherController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $others = Other::where('user_id', $user_id)->get();

        return view('applicant.index', [
            'others' => $others
        ]);
        // return view('applicant.other.index', [
        //     'others' => $others
        // ]);
    }

    public function create()
    {
        return view('applicant.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id.*' => 'required|exists:users,id',
            'start_date.*' => 'required|date',
            'end_date.*' => 'required|date',
            'position.*' => 'required|string',
            'organization_name.*' => 'required|string',
            'country.*' => 'required|string',
            'type.*' => 'required|string',
        ]);

        foreach ($request->user_id as $index => $userId) {
            Other::create([
                'user_id' => $userId,
                'start_date' => $request->start_date[$index],
                'end_date' => $request->end_date[$index],
                'position' => $request->position[$index],
                'organization_name' => $request->organization_name[$index],
                'country' => $request->country[$index],
                'type' => $request->type[$index],
            ]);
        }

        return redirect()->route('applicant.index')->with('successOther', 'Other record(s) created successfully.');
    }

    public function show($id)
    {
        $user_id = auth()->user()->id;
        $others = Other::where('user_id', $user_id)->get();

        return view('applicant.index', [
            'others' => $others
        ]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, Other $other)
    {
        $validated = $request->validate([
            'user_id.*' => 'required|exists:users,id',
            'start_date.*' => 'required|date',
            'end_date.*' => 'required|date',
            'position.*' => 'required|string',
            'organization_name.*' => 'required|string',
            'country.*' => 'required|string',
            'type.*' => 'required|string',
        ]);

        $user_id = auth()->user()->id;
        $others = Other::where('user_id', $user_id)->get();

        foreach ($others as $other) {
            $other->delete();
        }

        if($request->user_id !== NULL ){
            foreach ($request->user_id as $index => $userId) {
                Other::create([
                    'user_id' => $userId,
                    'start_date' => $request->start_date[$index],
                    'end_date' => $request->end_date[$index],
                    'position' => $request->position[$index],
                    'organization_name' => $request->organization_name[$index],
                    'country' => $request->country[$index],
                    'type' => $request->type[$index],
                ]);
            }
        }
        return redirect()->route('applicant.index')->with('successOther', 'Other record(s) updated successfully.');
    }

    // public function destroy($id)
    // {
    //     $other = Other::findOrFail($id);
    //     $other->delete();
    //     return redirect()->route('others.index')->with('successOther', 'Other record deleted successfully.');
    // }
}
