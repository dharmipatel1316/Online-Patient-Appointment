<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Doctors;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File; 
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class DoctorsController extends Controller
{
    public function doctorsList()
    {
        if(Auth::check()){
            $getDoctor = DB::table('doctors')->where('status','!=', 'delete')->orderBy('id', 'desc')->paginate(3);
            return view('doctors', compact('getDoctor'));
        }
        return redirect("signin")->withSuccess('Opps! You do not have access');
    }
    // Ajax Pagination
    public function doctorAjaxPagination(Request $request) {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $entry = $request->get('entry');

            $getDoctor = DB::table('doctors')
                ->where('status','!=','delete')
                ->orWhere('firstname', 'like', '%' . $query . '%')
                ->orWhere('lastname', 'like', '%' . $query . '%')
                ->orderBy($sort_by, $sort_type)
                ->paginate($entry);    
            
            return view('ajaxData/doctor_ajax', compact('getDoctor'))->render();
        }
    }

    public function doctorInsert(Request $request){
        
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => [
                'required',
                Rule::unique('Doctors', 'email')->ignore($request->doctor_id)
            ],
            'password' => 'required|min:8',
            'birth_date' => 'required',
            'phone' => 'required|numeric|min:10',
            'degree' => 'required',
            'speciality_id' => 'required',
            'address' => 'required',
            /* 'doctor_image' => 'required', */
          /*   'doctor_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', */
        ]); 
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        } else { 
            $doctor = Doctors::updateOrCreate(
                ['id' => $request->doctor_id],
                [
                    'firstname' => strtolower($request->firstname),
                    'lastname' => strtolower($request->lastname),
                    'email' => strtolower($request->email),
                    'password' => Hash::make($request->newPassword),
                    'birth_date' => $request->birth_date,
                    'phone' => $request->phone,
                    'degree' => $request->degree,
                    'speciality_id' => $request->speciality_id,
                    'address' => $request->address,
                    'doctor_image' => $request->upl_doctor_image,
                    'status' => 'active'
                ]
            );
            return response()->json(["message" => "Doctor save successfully!"]);
        }
    }
    public function editDoctor($id){
        $doctorEdit = Doctors::find($id);
        return response()->json($doctorEdit);
    }

    public function deleteDoctor($id){
        $doctors = DB::table('doctors')
        ->where('id', $id)
        ->update(['status' => 'delete']);

        $doctorImg = DB::table('doctors')->select('doctor_image')->where('id', '=', $id)->get();
        if(File::exists(resource_path('images/doctors/').$doctorImg)){
            return response()->json(['success' => "record deleted successfully"]);
            File::delete(resource_path('images/doctors/').$doctorImg);
        }
    }
    public function showDoctors($id){
        $doctors = DB::table('doctors')
                    ->where('id','=',$id)
                    ->get();
        return response()->json($doctors);     
    }

    public function changeStatusDoctor(Request $request){
        $doctorId = $request->doctorId;
        $status = $request->status;

        $doctors = DB::table('doctors')
        ->where('id', $doctorId)
        ->update(['status' => $status]);
        return json_encode($status);
    }

    public function showSpeciality()
    {
        $speciality = DB::select('select * from speciality where status=1');
        return json_encode(array('speciality'=>$speciality));
    }
    public function uplaodDcotorImage(Request $request){
        if ($request->ajax()) { 
            $doctorImage = $request->file('file');
            $date = date("Y-m-dHis");
            $new_name = $date.'.'.$doctorImage->getClientOriginalExtension();
            $doctorImage->move(resource_path('images/doctors'), $new_name);
            return response()->json(["doctorImage" => $new_name]);
        }      
            /* return $request->file->store('public/images'); */
    }
    public function removeDoctorImage(Request $request){
        if ($request->ajax()) {        
            $doctor = resource_path('images/doctors/').$request->get('image');
            $doctorImage = $request->get('image');
            if(File::exists(resource_path('images/doctors/').$doctorImage)){
                File::delete(resource_path('images/doctors/').$doctorImage);
                return response()->json(["doctorImage" => $doctorImage]);
            }
        }
    }
}