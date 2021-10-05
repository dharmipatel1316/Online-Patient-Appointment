<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Speciality;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SpecialityController extends Controller
{
    public function index()
    {
        if(Auth::check()){
            $getSpeciality = DB::table('speciality')->orderBy('id', 'desc')->paginate(3);
            return view('speciality', compact('getSpeciality'));
        }
        return redirect("signin");
    }
  // Pagination
    public function show(Request $request) {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $entry = $request->get('entry');

            $getSpeciality = DB::table('speciality')
                ->orWhere('name', 'like', '%' . $query . '%')
                ->orderBy($sort_by, $sort_type)
                ->paginate($entry);
            return view('ajaxData/speciality_ajax', compact('getSpeciality'))->render();
            
        }
    }
    public function store(Request $request)
     {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        } else {
            $speciality = Speciality::updateOrCreate(
                ['id' => $request->speciality_id],
                [
                    'name' => $request->name,
                    'description' => $request->description,
                    'status' => '1'
                ]
            );
            return response()->json(["message" => "Speciality save successfully!"]);
        }
    }
  
    public function edit($id)
    {
        $speciality = Speciality::find($id);
        return response()->json($speciality);
    }

    public function destroy($id)
    {
        //Speciality::find($id)->delete();
        $speciality = DB::table('speciality')
              ->where('id', $id)
              ->update(['status' => 0]);
        return response()->json(['success' => 'Speciality deleted successfully.']);
    }
}
