<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Anniversary;
use Illuminate\Http\Request;

class AnniversaryController extends Controller
{
    //
    public function postRecord(Request $request){

        $validatedData = $request->validate([
            'name' => 'required',
            'phone' => 'required|min:11',
            'email' => 'required',
           
        ]);
    
        $record = new Anniversary();
        $record->user_id = $request->user_id;
        $record->name = $validatedData['name'];
        $record->phone = $validatedData['phone'];
        $record->email = $validatedData['email'];
        $record->birthday = $request['birthday'];
        $record->wedding = $request['wedding'];
    
        $record->save();

        return view('records.view');
    }

    public function showRecord($id){
        $userId = $id; // Assuming you have the user ID stored in the variable $id

        $celebrants = Anniversary::where('user_id', $userId)->get();
        
        return view('records.view', compact('celebrants'));
    }

    public function addRecord(){
        return view('records.add');
    }


    public function editRecord($id){
        $celebrant = Anniversary::where('id', $id)->first();
        return view('records.edit', compact('celebrant'));
    }


    public function deleteRecord($id){
        Anniversary::findOrFail($id)->delete();
        return redirect()->back();
    }


    public function updateRecord(Request $request){

        Anniversary::findOrFail($request->id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'birthday' => $request->birthday,
            'wedding' => $request->wedding,
        ]);

        return view('records.view')->with('success','Celebrant Successfully Updated');
    }
}
