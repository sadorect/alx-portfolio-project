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
    /**
     * Initialize global variables for use across all functions
     */
    protected $thisMonth;
    protected $today;
    protected $endDate;
    protected $upcomingBirthdays;
    protected $upcomingWeddings;
    

    public function __construct()
    {
        $this->today = Carbon::today();
        $this->endDate = $this->today->copy()->addDays(30);
       
    }

    /**
     * Store celebrants records with proper validation.
     */
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
        //return to the list view ( with success notification ) after successful record addition
        return view('records.view')->with($msgStatus);
    }

/**
 * Display paginated list of celebrants fir the authenticated user
 */
    public function showRecord($id){
        $userId = $id; // Assuming you have the user ID stored in the variable $id

        $celebrants = Anniversary::where('user_id', $userId)->get();
        
        return view('records.view', compact('celebrants'));
    }

    /**
     * Add New celebrant
     */
    public function addRecord(){
        $msgStatus = array(
            'message' => 'You can add new celebrants here. The dates do not have to be exact year. Only the month and day are required to be exact anniversary dates.',
            'alert-type' => 'success'
        );
        return view('records.add')->with($msgStatus);
    }

/**
 * Edit celebrants records
 */
    public function editRecord($id){
        $celebrant = Anniversary::where('id', $id)->first();
        return view('records.edit', compact('celebrant'));
    }

/**
 * Delete celebrants records
 */
    public function deleteRecord($id){
        Anniversary::findOrFail($id)->delete();

        $msgStatus = array(
            'message' => 'Record Successfully Deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($msgStatus);
    }

/**
 * update celebrant's records
 */
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
        /**
         * Query the database for upcoming birthday celebrants for the authenticated user
         * Date range is within a 30-day interval. Can be modified as required
         */
        
        $user = Auth::user();
        $upcomingBirthdays = $user->anniversary()
            ->whereNotNull('birthday')
            ->whereRaw("DATE_FORMAT(birthday, '%m-%d') BETWEEN '{$this->today->format('m-d')}' AND '{$this->endDate->format('m-d')}'")
            ->orderByRaw("DATE_FORMAT(birthday, '%m-%d') ASC")
            ->get();
        $this->upcomingBirthdays = $upcomingBirthdays;

        // Fetch records for the current month
            $currentMonthBirthday = $user->anniversary()
                            ->whereNotNull('birthday')
                            ->whereMonth('birthday', $this->today->month)
                           // ->whereDay('birthday', $this->today->day)
                            ->orderBy('birthday')
                            ->get();

            // Fetch records for the current week
            $currentWeekBirthday = $user->anniversary()
            ->whereNotNull('birthday')
            ->whereBetween('birthday', [
                $this->today->startOfWeek(), // Start of the current week
                $this->today->endOfWeek()   // End of the current week
            ])
            ->orderByRaw("DATE_FORMAT(birthday, '%m-%d') ASC")
            ->get();

            foreach ($currentMonthBirthday as $monthBirthday) {
                $monthBirthday->formatted_date = Carbon::parse($monthBirthday->monthBirthday)->format('F jS');
            }

            foreach ($currentWeekBirthday as $weekBirthday) {
                $weekBirthday->formatted_date = Carbon::parse($weekBirthday->weekBirthday)->format('F jS');
            }

            foreach ($upcomingBirthdays as $birthday) {
                $birthday->formatted_date = Carbon::parse($birthday->birthday)->format('F jS');
            }


        return view('records.upcomingBirthdays', compact('upcomingBirthdays', 'currentMonthBirthday', 'currentWeekBirthday'));
    }

    public function upcomingWeddings()
    {
        /**
         * Query the database for upcoming wedding celebrants for the authenticated user
         * Date range is within a 30-day interval. Can be modified as required
         */
    // Fetch records for the current month
    $user = Auth::user();
    $currentMonthWedding = $user->anniversary()
    ->whereNotNull('wedding')
    ->whereMonth('wedding', $this->today->month)
   // ->whereDay('wedding', $this->today->day)
    ->orderBy('wedding')
    ->get();

    foreach ($currentMonthWedding as $monthWedding) {
        $monthWedding->formatted_date = Carbon::parse($monthWedding->monthWedding)->format('F jS');
    }

    /* foreach ($currentWeekWedding as $weekWedding) {
        $weekWedding->formatted_date = Carbon::parse($weekWedding->weekWedding)->format('F jS');
    } */
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
    
         
        return view('records.upcomingWeddings', compact('upcomingWeddings', 'currentMonthWedding'));
    }// End Upcoming weddings Method


    public function currentMonthWedding(){
        $user = Auth::user();
        $today = $this->today;

        // Fetch records for the current month
        $currentMonthWeddings = $user->anniversary()
            ->whereNotNull('wedding')
            ->whereMonth('wedding', '=', $today->month)
            ->orderBy('wedding')
            ->get();

        // Fetch records for the current week
        $currentWeekWeddings = $user->anniversary()
            ->whereNotNull('wedding')
            ->whereBetween('wedding', [
                $today->startOfWeek(), // Start of the current week
                $today->endOfWeek()   // End of the current week
            ])
            ->orderBy('wedding')
            ->get();

        $this->upcomingWeddings = [
            'currentMonth' => $currentMonthWeddings,
            'currentWeek' => $currentWeekWeddings
        ];

        foreach ($currentMonthWeddings as $wedding) {
            $wedding->formatted_date = Carbon::parse($wedding->wedding)->format('F jS');
        }

        foreach ($currentWeekWeddings as $wedding) {
            $wedding->formatted_date = Carbon::parse($wedding->wedding)->format('F jS');
        }

    }



    public function currentMonthBirthday(){
        $user = Auth::user();
        $today = $this->today;

        // Fetch records for the current month
        $currentMonthBirthdays = $user->anniversary()
            ->whereNotNull('birthday')
            ->whereMonth('birthday', '=', $today->month)
            ->orderBy('birthday')
            ->get();

        // Fetch records for the current week
        $currentWeekBirthdays = $user->anniversary()
            ->whereNotNull('birthday')
            ->whereBetween('birthday', [
                $today->startOfWeek(), // Start of the current week
                $today->endOfWeek()   // End of the current week
            ])
            ->orderBy('birthday')
            ->get();

        $this->upcomingBirthdays = [
            'currentMonth' => $currentMonthBirthdays,
            'currentWeek' => $currentWeekBirthdays
        ];

        foreach ($currentMonthBirthdays as $birthday) {
            $birthday->formatted_date = Carbon::parse($birthday->birthday)->format('F jS');
        }

        foreach ($currentWeekBirthdays as $birthday) {
            $birthday->formatted_date = Carbon::parse($birthday->birthday)->format('F jS');
        }

    }
    /**
     * Prepare notification data to be sent to the email notification template along with the authenticated user
     */

   public function sendNotice() {
    $user = Auth::user();
     // Prepare the notification data
     $notificationData = [
        'user' => $user, // Pass the $user object
        'upcomingWeddings' => $this->upcomingWeddings,
    ];

    
     // Dispatch the notification to the queue
    dispatch(new SendNotification($user, $notificationData));
    $msgStatus = array(
        'message' => 'Notification sent to your email',
        'alert-type' => 'success'
    ); 
    return redirect()->back()->with($msgStatus);
   }
}
