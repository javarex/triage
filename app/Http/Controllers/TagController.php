<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Activity;

use Illuminate\Http\Request;

class TagController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'date'    => 'required',
                'time_from'  => 'required',
                'time_to'  =>  'required',
            ]);
        } catch (\Throwable $th) {
            return redirect('admin')->with('errorRequired','Tags rejected. All field required');
        }

        $tags = Tag::create($request->all());

        $activityTag = Activity::where('office_id', $request->office_id)
                                ->whereDate('created_at',$request->date)
                                ->whereTime('created_at','>=', $request->time_from)
                                ->whereTime('created_at','<=', $request->time_to)
                                ->get();
        
        foreach ($activityTag as $activity) {
            $activityUpdate = Activity::findOrFail($activity->id);
            $activityUpdate->update(['tag_id' => $tags->id]);
        }
        return redirect('admin')->with('successTag','new tag created successfully!');
    }
}