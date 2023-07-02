<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Anniversary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CelebrantNotify;
use Illuminate\Support\Facades\Notification;

class AnniversaryController extends Controller
{
    //
    protected $today;
    protected $endDate;

    public function __construct()
    {
        $this->today = Carbon::today();
        $this->endDate = $this->today->copy()->addDays(30);
    }

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

    public function upcomingBirthdays()
    {
        
        $user = Auth::user();
        $upcomingBirthdays = $user->anniversary()
            ->whereNotNull('birthday')
            ->whereRaw("DATE_FORMAT(birthday, '%m-%d') BETWEEN '{$this->today->format('m-d')}' AND '{$this->endDate->format('m-d')}'")
            ->orderByRaw("DATE_FORMAT(birthday, '%m-%d') ASC")
            ->get();

            foreach ($upcomingBirthdays as $birthday) {
                $birthday->formatted_date = Carbon::parse($birthday->birthday)->format('F jS');
            }
        return view('records.upcomingBirthdays', compact('upcomingBirthdays'));
    }

    public function upcomingWeddings()
    {
        
    
        $user = Auth::user();
        $upcomingWeddings = $user->anniversary()
            ->whereNotNull('wedding')
            ->whereRaw("DATE_FORMAT(wedding, '%m-%d') BETWEEN '{$this->today->format('m-d')}' AND '{$this->endDate->format('m-d')}'")
            ->orderByRaw("DATE_FORMAT(wedding, '%m-%d') ASC")
            ->get();
    
        foreach ($upcomingWeddings as $wedding) {
            $wedding->formatted_date = Carbon::parse($wedding->wedding)->format('F jS');
        }
    
        // Prepare the notification data
        $notificationData = [
            'upcomingWeddings' => $upcomingWeddings,
        ];
    
        // Send the notification to the user
      //  Notification::send($user, new CelebrantNotify($notificationData));
        

        return view('records.upcomingWeddings', compact('upcomingWeddings'));
    }
    

   
}
