<?php

namespace App\Http\Controllers;

use App\Auth;
use App\Activity;
use App\Client;
use App\User;
use App\Office;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);
        $activity->update(['approve' => $request->approve]);  

        $client = Client::where('id', $activity->client_id)
                            ->first();

        if ($request->approve == 1) {
            $status = " Status Approve!";
        }elseif ($request->approve == 2) {
            $status = " Request Declined!";
        }
        return $client->first_name.$status;
    }

    public function loadData($id)
    {
        $output ='';
        $activities = Activity::with('client')
                                ->where('office_id', $id)
                                ->get();
        $output.='<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr class="text-center">
                <th><i class="fas fa-users    "></i></th>
                <th>Activity</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>';
        foreach ($activities as $activity) {
            $output.='<tr><td width="">'.$activity->client->first_name.' '.$activity->client->last_name.'</td>';
            $output.='<td>'.$activity->activity.'</td>';
            $output.='<td>'.$activity->created_at->format("m/d/Y").'</td>';
            $output.='<td>'.date("h:i a", strtotime($activity->created_at )).'</td>';
            $output.='<td class="text-nowrap pr-1">';
            if ($activity->approve == 0) {
                $output.='<a  href="javascript:void(0)" id="approve" class="badge badge-primary approve" data-value="1" data-id="'. $activity->id.'">Accept</a>';
                $output.='<span class="text-secondary">|</span>';
                $output.='<a href="javascript:void(0)" id="approve" class="badge badge-danger approve" data-value="2" data-id="'. $activity->id.'">Decline</a>';
            }elseif($activity->approve == 1){
                $output.='<span class="badge badge-success"><i class="fa fa-check" aria-hidden="true"></i> Approve</span>';
                
            }elseif($activity->approve == 2){
                $output.='<span class="badge badge-danger"><i class="fa fa-times-circle" aria-hidden="true"></i> Declined</span>';
            }
            $output.='</td></tr>';
        }
        $output.='</tbody></table>';

        return $output;
    }

    
}
