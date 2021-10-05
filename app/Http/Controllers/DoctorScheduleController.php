<?php

namespace App\Http\Controllers;

use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Speciality;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class DoctorScheduleController extends Controller
{
    public function doctorScheduleList()
    {
        if(Auth::check()){
            $docSchedule = DB::table('doctor_schedule')
                ->select('doctor_schedule.*', 'doctors.firstname', 'doctors.lastname')
                ->leftJoin('doctors', 'doctor_schedule.doctor_id', '=', 'doctors.id')
                ->where('doctor_schedule.status','=',1)
                ->orderBy('doctor_schedule.id', 'desc')
                ->paginate(3);
            return view('doctorSchedule', compact('docSchedule'));
        }
        return redirect("signin");
    }
  // Pagination
    public function doctorScheduleAjaxPagination(Request $request) {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $entry = $request->get('entry');

            $docSchedule = DB::table('doctor_schedule')
            ->select('doctor_schedule.*', 'doctors.firstname', 'doctors.lastname')
            ->leftJoin('doctors', 'doctor_schedule.doctor_id', '=', 'doctors.id')
            ->where('doctor_schedule.status','=',1)
            ->orWhere('doctors.firstname', 'like', '%' . $query . '%')
            ->orWhere('doctors.lastname', 'like', '%' . $query . '%')
            ->orderBy($sort_by, $sort_type)
            ->paginate($entry);
         
            return view('ajaxData/doctorSchedule_ajax', compact('docSchedule'))->render();
        }
    }
    
    // get doctors
    public function showDoctors() {
        $doctor = DB::select('SELECT id,firstname,lastname FROM doctors WHERE status="active" ORDER BY id DESC');
        return json_encode(array('doctors'=>$doctor));
    }

    // Save Doctor Schedule
    public function doctorScheduleSave(Request $request) {
        $validator = Validator::make($request->all(), [
           'doctor_id' => 'required',
            'schedule_date' => 'required',
            'start_time' =>'required',
            'end_time' => 'required|after_or_equal:start_time', 
            'consulting_time' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        } else {
            $speciality = DoctorSchedule::updateOrCreate(
                ['id' => $request->doctor_schedule_id],
                [
                    'doctor_id' => $request->doctor_id,
                    'schedule_date' => $request->schedule_date,
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time,
                    'consulting_time' => $request->consulting_time,
                    'status' => '1'
                ]
            );
            return response()->json(["message" => "Doctor schedule save successfully!"]);
        }
    }
    // Edit Doctor Schedule
    public function editDoctorSchedule($id)
    {
        $editDocSchedule = DoctorSchedule::find($id);
        return response()->json($editDocSchedule);
    }

    public function destroyDoctorSchedule($id)
    {
        //Speciality::find($id)->delete();
        $speciality = DB::table('doctor_schedule')
              ->where('id', $id)
              ->update(['status' => 0]);
        return response()->json(['success' => 'Doctor schedule deleted successfully.']);
    }
}
