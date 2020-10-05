<?php

namespace App\Http\Controllers;

use App\Auth;
use Carbon\Carbon;
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

    public function loadData(Request $request, $id)
    {
        $from = $request->from;
        $to = $request->to;
        $dateNow = Carbon::now()->format('Y-m-d');
        $output ='';
        $activities = new Activity;
        if($from != '' && $to != ''){

            $activities = $activities->with('client')
                                    ->where('office_id', $id)
                                    ->where('approve','<>',0)
                                    ->whereBetween('created_at',[$from, $to])
                                    ->orderBy('created_at', 'desc')
                                    ->get();
        }else{
            $activities = $activities->with('client')
                                    ->where('office_id', $id)
                                    ->where('created_at','like', '%'.$dateNow.'%')
                                    ->orWhere('approve','<>',0)
                                    ->orderBy('created_at', 'desc')
                                    ->get();
        }
        
        $output.='<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr class="text-center">
                <th><i class="fas fa-users    "></i></th>
                <th>Activity</th>
                <th>Date</th>
                <th>Time-in</th>
                <th>Time-out</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>';
        foreach ($activities as $activity) {
            if($activity->tag_id != 0){
                $output .= '<tr class="table-danger">';
            }else{
                $output .= '<tr>';
            }
            $output.='<td width="20%">'.$activity->client->first_name.' '.$activity->client->last_name.'</td>';
            $output.='<td width="20%">'.$activity->activity.'</td>';
            $output.='<td width="10%">'.$activity->created_at->format("m/d/Y").'</td>';
            $output.='<td width="10%">'.date("h:i a", strtotime($activity->created_at )).'</td>';
            if(is_null($activity->time_out)){
                $output.='<td width="5%"> <a href="#" class="badge badge-primary time-out" data-activityId="'.$activity->id.'"><i class="fa fa-fw fa-clock"></i> Set Time-out</a></td>';
            }else{
                $output.='<td width="5%">'.date("h:i a", strtotime($activity->time_out)).'</td>';
            }
            $output.='<td class="text-nowrap pr-1" width="10%">';
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

    //set Time-out

    public function setTimeOut(Request $request)
    {
        $activity_id = $request->id;
        
        $mytime = Carbon::now();
        $mytime->format('H:i:s');

        $activity = Activity::findOrFail($activity_id);
        $activity->update(['time_out' => $mytime]);
       return $activity;
        
    }
    
}
