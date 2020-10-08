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
            $from = Carbon::parse($from)->startOfDay();
            $to = Carbon::parse($to)->endOfDay();
            $activities = $activities->with('client')
                                    ->where('office_id', $id)
                                    ->where('approve','<>',0)
                                    ->whereBetween('created_at',[$from, $to])
                                    ->orderBy('created_at', 'desc')
                                    ->get();
        }else{
            $activities_delete = $activities->with('client')
                                    ->whereDate('created_at','<',$dateNow)
                                    ->where('approve', 0)
                                    ->where('office_id', $id)
                                    ->orderBy('created_at', 'desc')
                                    ->get();
                                    
            foreach ($activities_delete as $delete) {
                $delete_unattended = Activity::find($delete->id);
                $delete_unattended->delete();
            }
            
            $activities = $activities->with('client')
                                    ->where('office_id', $id)
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        }
        
        
        $output.='<table id="example" class="table table-striped table-bordered dt-responsive nowrap text-warning" style="width:100%">
        <thead>
            <tr class="text-center">
                <th>Code</th>
                <th><i class="fas fa-users    "></i></th>
                <th>User type</th>
                <th>Activity</th>
                <th>Date</th>
                <th>Time-in</th>
                <th>Time-out</th>
            </tr>
        </thead>
        <tbody>';

        
        foreach ($activities as $activity) {
            $clientType = Client::with('user')
                                ->where('id',$activity->client_id)
                                ->first();
            if($activity->tag_id != 0){
                $output .= '<tr class="table-danger">';
            }else{
                $output .= '<tr>';
            }

            $output.='<td width="10%" class="text-center">'.$clientType->user->username.'</td>';
            
                if($activity->approve == 0)
                {
                    $output.='<td width="10%">'.$activity->client->first_name.' '.$activity->client->last_name.' <span class="badge badge-success">New</span></td>';
                }else{
                    $output.='<td width="10%">'.$activity->client->first_name.' '.$activity->client->last_name.'</td>';
                }
            $output.='<td width="10%" class="text-center">'.$clientType->user->type.'</td>';
            $output.='<td width="10%">'.$activity->activity.'</td>';
            $output.='<td width="10%">'.$activity->created_at->format("m/d/Y").'</td>';
            
            if(is_null($activity->time_in)){
                $output.='<td width="10%"><a href="#" class="badge badge-primary time-in" data-activityId="'.$activity->id.'"><i class="fa fa-fw fa-clock"></i> Set Time-in</a></td>';
            }else{
                $output.='<td width="5%">'.date("h:i a", strtotime($activity->time_in)).'</td>';
            }

            if(is_null($activity->time_out)){
                if ($activity->approve == 0) {
                    $output.='<td width="5%"> --:--</td>';
                }else{

                    $output.='<td width="5%"> <a href="#" class="badge badge-danger time-out" data-activityId="'.$activity->id.'"><i class="fa fa-fw fa-clock"></i> Set Time-out</a></td>';
                }
            }else{
                $output.='<td width="5%">'.date("h:i a", strtotime($activity->time_out)).'</td>';
            }
            
            
            $output.='</tr>';
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

    //set Time-in

    public function setTimeIn(Request $request)
    {
        $activity_id = $request->id;
        
        $mytime = Carbon::now();
        $mytime->format('H:i:s');

        $activity = Activity::findOrFail($activity_id);
        $activity->update([
            'time_in' => $mytime,
            'approve' => 1
        ]);
       return $activity;
        
    }
    
}
