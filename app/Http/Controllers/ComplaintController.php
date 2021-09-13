<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
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
            $request->file('file')->store('pdf', 'public');
            
            $complaint = new Complaint([
                "comment" => $request->get('comment'),
                "file_path" =>  $request->file('file')->getClientOriginalName(),
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

        $feedbacks =  DB::table('complaints')
                            ->where('user_id', $id)->get();
        // dd($feedbacks);
        return view('complaint',compact('feedbacks'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        
    }

    // show all complaint to admin
    public function showAll(Request $request){
        $feedbacks = DB::table('complaints')
                            ->get();
        return view('complaint', compact('feedbacks'))
                    ->with('i', (request()->input('page', 1) -1) * 5);
    }

    // show single feedback
    public function showOne(Request $request){
         
        $feedback = DB::table('complaints')
                        ->where('id', $request->id)->first();
        dd($feedback);                        
        return view('singlefeedback');
    }

}
