<?php

namespace App\Http\Controllers\Admin;

use App\Models\Application;

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

    private function getApplicationsByOpportunityByStatus($opportunity_id, $status = null, $applicant_id = null)
    {
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

        return view('admin.application.show', [
            'applications' => $applications,
            'opportunity_id' => $opportunity_id,
            'user' => $user,
            'countsStatusBarArray' => $countsStatusBarArray,
        ]);
    }

    public function show($opportunity_id)
    {
        return $this->getApplicationsByOpportunityByStatus($opportunity_id);
    }

    public function showAll($opportunity_id)
    {
        return $this->getApplicationsByOpportunityByStatus($opportunity_id);
    }

    public function showNew($opportunity_id)
    {
        return $this->getApplicationsByOpportunityByStatus($opportunity_id, 'New');
    }

    public function showPrescreen($opportunity_id)
    {
        return $this->getApplicationsByOpportunityByStatus($opportunity_id, 'Prescreen');
    }

    public function showFirstInterview($opportunity_id)
    {
        return $this->getApplicationsByOpportunityByStatus($opportunity_id, 'First Interview');
    }

    public function showSecondInterview($opportunity_id)
    {
        return $this->getApplicationsByOpportunityByStatus($opportunity_id, 'Second Interview');
    }

    public function showThirdInterview($opportunity_id)
    {
        return $this->getApplicationsByOpportunityByStatus($opportunity_id, 'Third Interview');
    }

    public function showOffer($opportunity_id)
    {
        return $this->getApplicationsByOpportunityByStatus($opportunity_id, 'Offer');
    }

    public function showAccept($opportunity_id)
    {
        return $this->getApplicationsByOpportunityByStatus($opportunity_id, 'Accept');
    }

    public function showReject($opportunity_id)
    {
        return $this->getApplicationsByOpportunityByStatus($opportunity_id, 'Reject');
    }

    public function showNotSuitable($opportunity_id)
    {
        return $this->getApplicationsByOpportunityByStatus($opportunity_id, 'Not Suitable');
    }


    public function applicantDetail($opportunity_id, $status, $applicant_id)
    {
        return $this->getApplicationsByOpportunityByStatus($opportunity_id, $status, $applicant_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
