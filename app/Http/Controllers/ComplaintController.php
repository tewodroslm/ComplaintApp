<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;

class ComplaintController extends Controller
{
    
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
  
    public function show(){
        // $feedbacks = Complaint::latest()->paginate(5);
        // return view('complaint',compact('feedbacks'))
        //     ->with('i', (request()->input('page', 1) - 1) * 5);
        return view('complaint');
    }

}
