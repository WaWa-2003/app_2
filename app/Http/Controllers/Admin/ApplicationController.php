<?php

namespace App\Http\Controllers\Admin;

use App\Models\Application\Application;
use App\Models\Application\Note;

use App\Models\User;

use App\Models\Opportunity\Opportunity;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->getApplicationsByStatus();
    }

    public function getApplicationsByStatus($status = null){

        if ($status == "All"){
            $status = null;
        }

        if ($status) {
            $applications = Application::with(['opportunity', 'user'])->where('application_status', $status)->get();
        } else {
            $applications = Application::with(['opportunity', 'user'])->get();
        }
        $groupedApplications = $applications->groupBy('opportunity_id');

        $StatusBar = ['New', 'Prescreen', 'First Interview', 'Second Interview', 'Third Interview', 'Offer', 'Accept', 'Reject', 'Not Suitable'];
        $countsStatusBarArray = [];
        foreach ($StatusBar as $oneStatus) {
            $countsStatusBarArray[$oneStatus] = Application::where('application_status', $oneStatus)->count();
        }

        $countsStatusBarArray['All'] = Application::count();

        return view('admin.application.index', [
            'groupedApplications' => $groupedApplications,
            'applications' => $applications,
            'countsStatusBarArray' => $countsStatusBarArray,
            'opportunity_id' => NULL,
            'status' => $status,
        ]);
    }

    public function getApplicationsByOpportunityByStatus($opportunity_id, $status = null, $applicant_id = null)
    {
        if ($status == "All"){
            $status = null;
        }

        $user = User::Find($applicant_id);

        $query = Application::with(['opportunity', 'user'])->where('opportunity_id', $opportunity_id);

        if ($status) {
            $query->where('application_status', $status);
        }

        $applications = $query->get();

        $StatusBar = ['New', 'Prescreen', 'First Interview', 'Second Interview', 'Third Interview', 'Offer', 'Accept', 'Reject', 'Not Suitable'];
        $countsStatusBarArray = [];
        foreach ($StatusBar as $oneStatus) {
            $countsStatusBarArray[$oneStatus] = Application::where('opportunity_id', $opportunity_id)
                                          ->where('application_status', $oneStatus)
                                          ->count();
        }
        $countsStatusBarArray['All'] = Application::where('opportunity_id', $opportunity_id)->count();

        if ($status == null){
            $status = "All";
        }

        return view('admin.application.show', [
            'applications' => $applications,
            'opportunity_id' => $opportunity_id,
            'user' => $user,
            'countsStatusBarArray' => $countsStatusBarArray,
            'status' => $status,
            'applicant_id' => $applicant_id,
        ]);
    }

    public function show($opportunity_id)
    {
        return $this->getApplicationsByOpportunityByStatus($opportunity_id);
    }


    public function applicantDetail($opportunity_id, $status, $applicant_id)
    {
        return $this->getApplicationsByOpportunityByStatus($opportunity_id, $status, $applicant_id);
    }

    public function noteStore(Request $request, $opportunity_id, $status, $applicant_id)
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
        return redirect()->back()->with('messageNote', 'Note added successfully.');
        // return $this->applicantDetail($opportunity_id, $status, $applicant_id)->with('messageNote', 'Note added successfully.');
    }

    public function noteUpdate(Request $request, $id)
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

        return redirect()->route('application.opportunity.applicant')->with('messageNote', 'Note updated successfully.');
    }

    public function noteDestroy($id)
    {
        $note->delete();

        return redirect()->route('application.opportunity.applicant')->with('messageNote', 'Note deleted successfully.');
    }

}
