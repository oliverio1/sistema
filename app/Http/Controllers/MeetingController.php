<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Meeting;
use DB;

class MeetingController extends Controller
{
    public function index() {
        $users = User::get()->pluck('name','id');
        $eventos = Meeting::where('user_id',\Auth::user()->id)->get();
        $prueba = DB::table('meeting_user')->where('meeting_user.user_id',\Auth::user()->id)
            ->join('meetings','meetings.id','meeting_user.meeting_id')->select('meetings.title','meetings.description','meetings.start_date','meetings.end_date')->get();
        $meetings = [];
        foreach($prueba as $meeting) {
            $meetings[] = [
                'title' => $meeting->title,
                'description' => $meeting->description,
                'start' => $meeting->start_date,
                'end' => $meeting->end_date,
            ];
        }
        return view('admin.meetings.index',compact('users','meetings'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'convocated' => 'required'
        ]);
        $meeting = Meeting::create([
            'title'=> $request->title,
            'description'=> $request->description,
            'start_date'=> $request->start_date,
            'end_date'=> $request->end_date,
            'user_id'=> \Auth::user()->id            
        ]);
        $meeting->convocated()->sync($request->convocated);
        return redirect(route('meetings.index'))->with('info','Registro exitoso');
    }
}
