<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ComplaintController extends Controller
{

    // show form page
    public function page(){
        return view('home');
    }
    
    // Handle complaint controller
    public function create(Request $request){
        
        request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required',
            'pdf' => 'mimes:pdf|max:10000'
        ]);
       
        
        $id = $request->user()->id;
     
        if($request->hasFile('file')){ 
            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();
            $request->file('file')->storeAs('public/pdf', $file_name);
            
            $complaint = new Complaint([
                "comment" => $request->get('comment'),
                "file_path" => $file_name,
                "user_id" => $id
            ]);

            $complaint->save();
        }else{ 
            $complaint = new Complaint([
                "comment" => $request->get('comment'), 
                "user_id" => $id
            ]);

            $complaint->save();
          
        }
    
        // return redirect()->route('complaints')
        //                 ->with('success','Complaint created successfully.');
        return redirect('/complaints');
    }
  
    // show user specific complaint
    public function show(Request $request){
        // $feedbacks = Complaint::latest()->paginate(5);
        $id = $request->user()->id;
 
        $feedbacks = Complaint::where('user_id', $id)->paginate(5);
        
        // dd($feedbacks);
        return view('complaint',compact('feedbacks'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        
    }

    // show all complaint to admin
    public function showAll(Request $request){ 
        
        $feedbacks = Complaint::latest()->paginate(5);

        return view('complaint', compact('feedbacks'))
                    ->with('i', (request()->input('page', 1) -1) * 5);
    }

    // show single feedback
    public function showOne(Request $request){
         
        $feedback = DB::table('complaints')
                        ->where('id', $request->id)->first();
        return view('showOne', compact('feedback'));
    }

    public function getPdf(Request $request){
        $comp = DB::table('complaints')
                    ->where('id', $request->id)->first();

        $pdf = $comp->file_path;
        
        $pathToFile = (public_path().'/storage/pdf/'.$pdf);
        // dd($pdf) ;
         
        return response()->file($pathToFile);  
    }

    public function editComplaintForm(Request $request){
        $complaint = Complaint::where('id', $request->id)->first();
        return view('updatecomplaint');
    }

}
