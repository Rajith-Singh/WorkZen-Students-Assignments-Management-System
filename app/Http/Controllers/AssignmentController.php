<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Stroage;
use App\Models\Assignment;
use App\Models\Answer;
use DB;

class AssignmentController extends Controller
{
    public function storeAssignment(Request $request) {

        $request->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'year' => 'required',
            'semester' => 'required',
            'deadline' => 'required',
        ]);

        $assignment = new Assignment;

        $assignment->title=$request->title;
        $assignment->description=$request->description;
        $assignment->year=$request->year;
        $assignment->semester=$request->semester;
        $assignment->deadline=$request->deadline;
        $assignment->save();

        return back()->with('msg', 'The assignment was successfully added.');
        //dd($request->all());
    }

    public function viewAssignment($year, $semester) {

        $yr = DB::table('assignments')
        ->select('year')
        ->where('year', '=', $year)
        ->pluck('year')
        ->first(); 

        $sem = DB::table('assignments')
        ->select('semester')
        ->where('semester', '=', $semester)
        ->pluck('semester')
        ->first(); 

        if(($yr == '1st Year') && ($sem == '1st Semester')){
            $data=Assignment::all()->where('year', '=', '1st Year')
                            ->where('semester', '=', '1st Semester');
            return view('dashboard.student.view-assignment')->with('data',$data);
        } else if(($yr == '1st Year') && ($sem == '2nd Semester')){
            $data=Assignment::all()->where('year', '=', '1st Year')
                            ->where('semester', '=', '2nd Semester');
            return view('dashboard.student.view-assignment')->with('data',$data);
        } else if(($yr == '2nd Year') && ($sem == '1st Semester')){
            $data=Assignment::all()->where('year', '=', '2nd Year')
                            ->where('semester', '=', '1st Semester');
            return view('dashboard.student.view-assignment')->with('data',$data);
        } else if(($yr == '2nd Year') && ($sem == '2nd Semester')){
            $data=Assignment::all()->where('year', '=', '2nd Year')
                            ->where('semester', '=', '2nd Semester');
            return view('dashboard.student.view-assignment')->with('data',$data);
        } else if(($yr == '3rd Year') && ($sem == '1st Semester')){
            $data=Assignment::all()->where('year', '=', '3rd Year')
                            ->where('semester', '=', '1st Semester');
            return view('dashboard.student.view-assignment')->with('data',$data);
        } else if(($yr == '3rd Year') && ($sem == '2nd Semester')){
            $data=Assignment::all()->where('year', '=', '3rd Year')
                            ->where('semester', '=', '2nd Semester');
            return view('dashboard.student.view-assignment')->with('data',$data);
        } else if(($yr == '4th Year') && ($sem == '1st Semester')){
            $data=Assignment::all()->where('year', '=', '4th Year')
                            ->where('semester', '=', '1st Semester');
            return view('dashboard.student.view-assignment')->with('data',$data);
        } else {
            $data=Assignment::all()->where('year', '=', '4th Year')
                            ->where('semester', '=', '2nd Semester');
            return view('dashboard.student.view-assignment')->with('data',$data);
        } 
    }

    public function viewRelevantAssignment($id) {
        $data=Assignment::all()->where('id', '=', $id);
        return view('dashboard.student.upload-answer')->with('data',$data);
    }

    public function uploadFile(Request $request){
        if ($request->hasFile('file')) {
            $data=new Answer();
            $file = $request->file('file');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = base_path('public/assets');
            
            try {
                if ($file->move($destinationPath, $filename)) {
                    $data->file = $filename;
                } else {
                    \Log::error('Error moving file: ' . $filename);
                }
            } catch (\Exception $e) {
                \Log::error('Error moving file: ' . $e->getMessage());
            }
        
            $data->description=$request->answer;
            $data->assignment_id=$request->assignment_id;
            $data->student_id=$request->student_id;
        
            $data->save();

        }
        return view('dashboard.student.uploading-status');

    }

    public function show(){
        $data=Answer::join('students','students.id', '=', 'answers.student_id')
                    ->join('assignments','assignments.id', '=', 'answers.assignment_id')
                    ->select('students.name',
                            'assignments.title',
                            'answers.description',
                            'answers.file')
                            ->get();
        return view('dashboard.lecturer.view-answer',compact('data'));
    }

    public function download(Request $request,$file){
        return response()->download(public_path('assets/'.$file));
    }

    public function view($id){
        $data=Answer::find($id);
        return response()->download(public_path('assets/'.$file));
    }

    public function viewReuploadingAssignment($year, $semester) {

        $yr = DB::table('assignments')
        ->select('year')
        ->where('year', '=', $year)
        ->pluck('year')
        ->first(); 

        $sem = DB::table('assignments')
        ->select('semester')
        ->where('semester', '=', $semester)
        ->pluck('semester')
        ->first(); 

        if(($yr == '1st Year') && ($sem == '1st Semester')){
            $data=Assignment::all()->where('year', '=', '1st Year')
                            ->where('semester', '=', '1st Semester');
            return view('dashboard.student.view-reuploading-assignment')->with('data',$data);
        } else if(($yr == '1st Year') && ($sem == '2nd Semester')){
            $data=Assignment::all()->where('year', '=', '1st Year')
                            ->where('semester', '=', '2nd Semester');
            return view('dashboard.student.view-reuploading-assignment')->with('data',$data);
        } else if(($yr == '2nd Year') && ($sem == '1st Semester')){
            $data=Assignment::all()->where('year', '=', '2nd Year')
                            ->where('semester', '=', '1st Semester');
            return view('dashboard.student.view-reuploading-assignment')->with('data',$data);
        } else if(($yr == '2nd Year') && ($sem == '2nd Semester')){
            $data=Assignment::all()->where('year', '=', '2nd Year')
                            ->where('semester', '=', '2nd Semester');
            return view('dashboard.student.view-reuploading-assignment')->with('data',$data);
        } else if(($yr == '3rd Year') && ($sem == '1st Semester')){
            $data=Assignment::all()->where('year', '=', '3rd Year')
                            ->where('semester', '=', '1st Semester');
            return view('dashboard.student.view-reuploading-assignment')->with('data',$data);
        } else if(($yr == '3rd Year') && ($sem == '2nd Semester')){
            $data=Assignment::all()->where('year', '=', '3rd Year')
                            ->where('semester', '=', '2nd Semester');
            return view('dashboard.student.view-reuploading-assignment')->with('data',$data);
        } else if(($yr == '4th Year') && ($sem == '1st Semester')){
            $data=Assignment::all()->where('year', '=', '4th Year')
                            ->where('semester', '=', '1st Semester');
            return view('dashboard.student.view-reuploading-assignment')->with('data',$data);
        } else {
            $data=Assignment::all()->where('year', '=', '4th Year')
                            ->where('semester', '=', '2nd Semester');
            return view('dashboard.student.view-reuploading-assignment')->with('data',$data);
        } 
    }

    public function viewReuploadingRelevantAssignment($id,$std_id) {
        $data=Assignment::all()->where('id', '=', $id);

        return view('dashboard.student.reupload-answer')->with('data',$data);
    }

    public function deleteSubmission($id,$std_id) {
        DB::table('answers')->where('assignment_id',$id)
        ->where('student_id',$std_id)
        ->delete();

        return back()->with('msg', 'Your previous submission was deleted. Now you can Reupload your assignment again');
    }

    public function reuploadFile(Request $request){
        if ($request->hasFile('file')) {
            $data=new Answer();
            $file = $request->file('file');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $destinationPath = base_path('public/assets');
            
            try {
                if ($file->move($destinationPath, $filename)) {
                    $data->file = $filename;
                } else {
                    \Log::error('Error moving file: ' . $filename);
                }
            } catch (\Exception $e) {
                \Log::error('Error moving file: ' . $e->getMessage());
            }
        
            $data->description=$request->answer;
            $data->assignment_id=$request->assignment_id;
            $data->student_id=$request->student_id;
        
            $data->save();

        }
        return back()->with('msg', 'The assignment was successfully uploaded.');

    }

    public function manageAssignment() {
        $data=Assignment::all();

        return view('dashboard.lecturer.manage-assignment',compact('data'));
    }

    public function deleteAssignment($id){
        DB::table('assignments')->where('id',$id)->delete();
        return back()->with('msg', 'The assignment was successfully deleted.');
    }

    public function editAssignment($id){
        $data = DB::table('assignments')->where('id',$id)->first();
        return view('dashboard.lecturer.edit-assignment', compact('data'));
    }


    public function updateAssignment(Request $request) {

        $request->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'year' => 'required',
            'semester' => 'required',
            'deadline' => 'required',
        ]);

        DB::table('assignments')->where('id', $request->id)->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'year'=>$request->year,
            'semester'=>$request->semester,
            'deadline'=>$request->deadline,
        ]);

        return redirect()->to('/lecturer/manage-assignment')->with('message', 'The assignment was successfully updated.');
        //dd($request->all());
    }


}
