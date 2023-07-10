<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Anniversary;
use Illuminate\Http\Request;
use App\Jobs\SendNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Queue;
use App\Notifications\CelebrantNotify;
use Illuminate\Support\Facades\Notification;

class AnniversaryController extends Controller
{
    //
    protected $today;
    protected $endDate;
    protected $upcomingBirthdays;
    protected $upcomingWeddings;
    

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

        $msgStatus = array(
            'message' => 'Record Successfully Added',
            'alert-type' => 'success'
        );
        return view('records.view')->with($msgStatus);
    }

    public function showRecord($id){
        $userId = $id; // Assuming you have the user ID stored in the variable $id

        $celebrants = Anniversary::where('user_id', $userId)->get();
        
        return view('records.view', compact('celebrants'));
    }

    public function addRecord(){
        $msgStatus = array(
            'message' => 'You can add new celebrants here. The dates do not have to be exact year. Only the month and day are required to be exact anniversary dates.',
            'alert-type' => 'success'
        );
        return view('records.add')->with($msgStatus);
    }


    public function editRecord($id){
        $celebrant = Anniversary::where('id', $id)->first();
        return view('records.edit', compact('celebrant'));
    }


    public function deleteRecord($id){
        Anniversary::findOrFail($id)->delete();

        $msgStatus = array(
            'message' => 'Record Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($msgStatus);
    }


    public function updateRecord(Request $request){
        $incoming = $request->validate([
            'phone' => 'required',
        ]);
        Anniversary::findOrFail($request->id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'birthday' => $request->birthday,
            'wedding' => $request->wedding,
        ]);

        $msgStatus = array(
            'message' => 'Celebrant Successfully Updated',
            'alert-type' => 'success'
        ); 

        return view('records.view')->with($msgStatus);
    }

    public function upcomingBirthdays()
    {
        
        $user = Auth::user();
        $upcomingBirthdays = $user->anniversary()
            ->whereNotNull('birthday')
            ->whereRaw("DATE_FORMAT(birthday, '%m-%d') BETWEEN '{$this->today->format('m-d')}' AND '{$this->endDate->format('m-d')}'")
            ->orderByRaw("DATE_FORMAT(birthday, '%m-%d') ASC")
            ->get();
$this->upcomingBirthdays = $upcomingBirthdays;

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

            $this->upcomingWeddings = $upcomingWeddings;

        foreach ($upcomingWeddings as $wedding) {
            $wedding->formatted_date = Carbon::parse($wedding->wedding)->format('F jS');
        }
    
         
        return view('records.upcomingWeddings', compact('upcomingWeddings'));
    }
    

   public function sendNotice() {
    $user = Auth::user();
     // Prepare the notification data
     $notificationData = [
        'user' => $user, // Pass the $user object
        'upcomingWeddings' => $this->upcomingWeddings,
    ];

    // Send the notification to the user
   // Notification::send($user, new CelebrantNotify($notificationData));
     // Dispatch the notification to the queue
    dispatch(new SendNotification($user, $notificationData));
    $msgStatus = array(
        'message' => 'Notification sent to your email',
        'alert-type' => 'success'
    ); 
    return redirect()->back()->with($msgStatus);
   }
}
