<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Client;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);
        $activity->update(['approve' => $request->approve]);  

        $client = Client::where('id', $activity->client_id)
                            ->first();
        return $client->first_name." status updated!";
    }
}
