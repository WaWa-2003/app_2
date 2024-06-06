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
        $applications = Application::with(['opportunity', 'user'])->get();
        $groupedApplications = $applications->groupBy('opportunity_id');

        return view('admin.application.index', [
            'groupedApplications' => $groupedApplications,
            'applications' => $applications
        ]);
    }


    private function getApplicationsByStatus($opportunity_id, $status = null, $user = null)
    {
        $query = Application::with(['opportunity', 'user'])->where('opportunity_id', $opportunity_id);

        if ($status) {
            $query->where('application_status', $status);
        }

        $applications = $query->get();

        return view('admin.application.show', [
            'applications' => $applications,
            'opportunity_id' => $opportunity_id,
            'user' => $user,
        ]);
    }

    public function show($opportunity_id)
    {
        return $this->getApplicationsByStatus($opportunity_id);
    }

    public function showAll($opportunity_id)
    {
        return $this->getApplicationsByStatus($opportunity_id);
    }

    public function showNew($opportunity_id)
    {
        return $this->getApplicationsByStatus($opportunity_id, 'New');
    }

    public function showPrescreen($opportunity_id)
    {
        return $this->getApplicationsByStatus($opportunity_id, 'Prescreen');
    }

    public function showFirstInterview($opportunity_id)
    {
        return $this->getApplicationsByStatus($opportunity_id, 'First Interview');
    }

    public function showSecondInterview($opportunity_id)
    {
        return $this->getApplicationsByStatus($opportunity_id, 'Second Interview');
    }

    public function showThirdInterview($opportunity_id)
    {
        return $this->getApplicationsByStatus($opportunity_id, 'Third Interview');
    }

    public function showOffer($opportunity_id)
    {
        return $this->getApplicationsByStatus($opportunity_id, 'Offer');
    }

    public function showAccept($opportunity_id)
    {
        return $this->getApplicationsByStatus($opportunity_id, 'Accept');
    }

    public function showReject($opportunity_id)
    {
        return $this->getApplicationsByStatus($opportunity_id, 'Reject');
    }

    public function showNotSuitable($opportunity_id)
    {
        return $this->getApplicationsByStatus($opportunity_id, 'Not Suitable');
    }


    public function applicantDetail($application_id,$opportunity_id,$user_id)
    {
        $user = User::findOrFail($user_id);

        $application = Application::findOrFail($application_id);

        $application_status = $application->application_status;

        switch ($application_status) {
            case 'New':
                $applications = Application::with(['opportunity', 'user'])
                            ->where([
                                ['opportunity_id', $opportunity_id],
                                ['application_status', 'New']
                            ])->get();
            case 'Prescreen':
                $applications = Application::with(['opportunity', 'user'])
                            ->where([
                                ['opportunity_id', $opportunity_id],
                                ['application_status', 'Prescreen']
                            ])->get();
            case 'First Interview':
                $applications = Application::with(['opportunity', 'user'])
                            ->where([
                                ['opportunity_id', $opportunity_id],
                                ['application_status', 'First Interview']
                            ])->get();
            case 'Second Interview':
                $applications = Application::with(['opportunity', 'user'])
                            ->where([
                                ['opportunity_id', $opportunity_id],
                                ['application_status', 'Second Interview']
                            ])->get();
            case 'Third Interview':
                $applications = Application::with(['opportunity', 'user'])
                            ->where([
                                ['opportunity_id', $opportunity_id],
                                ['application_status', 'Third Interview']
                            ])->get();
            case 'Offer':
                $applications = Application::with(['opportunity', 'user'])
                            ->where([
                                ['opportunity_id', $opportunity_id],
                                ['application_status', 'Offer']
                            ])->get();
            case 'Accept':
                $applications = Application::with(['opportunity', 'user'])
                            ->where([
                                ['opportunity_id', $opportunity_id],
                                ['application_status', 'Accept']
                            ])->get();
            case 'Reject':
                $applications = Application::with(['opportunity', 'user'])
                            ->where([
                                ['opportunity_id', $opportunity_id],
                                ['application_status', 'Reject']
                            ])->get();
            case 'Not Suitable':
                $applications = Application::with(['opportunity', 'user'])
                            ->where([
                                ['opportunity_id', $opportunity_id],
                                ['application_status', 'Not Suitable']
                            ])->get();
            default:
                $applications = Application::with(['opportunity', 'user'])
                            ->where([
                                ['opportunity_id', $opportunity_id],
                            ])->get();
        }

        return view('admin.application.show', [
            'applications' => $applications,
            'opportunity_id' => $opportunity_id,
            'user' => $user,
        ]);
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
