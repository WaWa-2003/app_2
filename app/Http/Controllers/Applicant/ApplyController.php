<?php

namespace App\Http\Controllers\Applicant;

use App\Models\Application;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApplyController extends Controller
{
    public function apply(Request $request)
    {
        $user_id = auth()->user()->id; // can also use $request->user_id;
        $opportunity_id = $request->opportunity_id;

        Application::Create([
            'user_id' => $user_id,
            'opportunity_id' => $opportunity_id,
        ]);

        return redirect()->route('opportunity.show',$opportunity_id)
                         ->with('messageApply', 'Your application is sent.');
    }
}
