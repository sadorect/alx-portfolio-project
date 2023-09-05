@extends('dashboard')

@section('admin')

<div class="page-content">

  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">User</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
  </nav>

  <div class="row">
   

    @php
$userid = Auth::user()->id;
$birthday = \App\Models\Anniversary::where('user_id', $userid)->where('birthday', '!=', NULL)->count();
$wedding = \App\Models\Anniversary::where('user_id', $userid)->where('wedding', '!=', NULL)->count();
@endphp




    <div class="col-md-6 grid-margin items-center mx-auto">
      <div class="card bg-info">
        <div class="card-body mx-auto ">

          <h3 class="card-title">Birthday Records</h3>


          <div class="col-lg-4 col-md-4 col-sm-12 info-block mx-auto">
            <div class="info-block-one">
                <div class="inner-box">
                   
                    <h4>{{$birthday}}</h4>
                    
                </div>
            </div>
        </div>
        </div>
      </div>
    </div>


    <div class="col-md-6 grid-margin items-center mx-auto ">
      <div class="card bg-danger text-white">
        <div class="card-body mx-auto">

          <h3 class="card-title font-bold">Wedding Records</h3>


          <div class="col-lg-4 col-md-4 col-sm-12 info-block mx-auto">
            <div class="info-block-one">
                <div class="inner-box">
                    
                    <h4>{{$wedding}}</h4>
                    
                </div>
            </div>
        </div>
        </div>
      </div>
    </div>
  </div>
  





  <div class="row">
   

    @php
 $today = \Carbon\Carbon::today();
        $endDate = $today->copy()->addDays(31);

        $user = Auth::user();
        $upcomingWeddings = $user->anniversary()
            ->whereNotNull('wedding')
            ->whereRaw("DATE_FORMAT(wedding, '%m-%d') BETWEEN '{$today->format('m-d')}' AND '{$endDate->format('m-d')}'")
            ->orderByRaw("DATE_FORMAT(wedding, '%m-%d')")
            ->count();

       $upcomingBirthdays = $user->anniversary()
            ->whereNotNull('birthday')
            ->whereRaw("DATE_FORMAT(birthday, '%m-%d') BETWEEN '{$today->format('m-d')}' AND '{$endDate->format('m-d')}'")
            ->orderByRaw("DATE_FORMAT(birthday, '%m-%d')")
            ->count();

    $currentMonthWedding = $user->anniversary()
    ->whereNotNull('wedding')
    ->whereMonth('wedding', $today->month)
   // ->whereDay('wedding', $this->today->day)
    ->orderBy('wedding')
    ->count();

    $currentMonthBirthday = $user->anniversary()
    ->whereNotNull('birthday')
    ->whereMonth('birthday', $today->month)
   // ->whereDay('birthday', $this->today->day)
    ->orderBy('birthday')
    ->count();
@endphp




    <div class="col-md-6 grid-margin items-center mx-auto ">
      <div class="card bg-warning">
        <div class="card-body mx-auto">

          <h3 class="card-title">Upcoming Birthdays</h3>
              <span class="mb-4 p-4">Next 31 Days</span>


          <div class="col-lg-4 col-md-4 col-sm-12 info-block mx-auto">
            <div class="info-block-one">
                <div class="inner-box">
                  <a href="{{route('upcoming.birthdays')}}"> 
                    <h4>{{$upcomingBirthdays}}</h4></a>
                    
                </div>
            </div>
        </div>
        </div>
      </div>
    </div>


        <div class="col-md-6 grid-margin items-center mx-auto ">
          <div class="card bg-primary text-white">
            <div class="card-body mx-auto">

              <h3 class="card-title">Upcoming Weddings</h3>
              <span class="mb-4 p-4">Next 31 Days</span>

              <div class="col-lg-4 col-md-4 col-sm-12 info-block mx-auto">
                <div class="info-block-one">
                    <div class="inner-box text-white">
                      <a href="{{route('upcoming.weddings')}}"> 
                        <h4 class="text-white">{{$upcomingWeddings}}</h4></a>
                        
                    </div>
                </div>
            </div>
            </div>
          </div>
        </div>

        
        <div class="col-md-6 grid-margin items-center mx-auto ">
          <div class="card bg-black text-white">
            <div class="card-body mx-auto">
    
              <h3 class="card-title">This Month Birthdays</h3>
                  <span class="mb-4 p-4">{{date('F')}}</span>
    
    
              <div class="col-lg-4 col-md-4 col-sm-12 info-block mx-auto">
                <div class="info-block-one">
                    <div class="inner-box">
                       
                       <a href="{{route('upcoming.birthdays')}}"> <h4>{{$currentMonthBirthday}}</h4></a>
                        
                    </div>
                </div>
            </div>
            </div>
          </div>
        </div>
        

        <div class="col-md-6 grid-margin items-center mx-auto ">
          <div class="card bg-brown text-black">
            <div class="card-body mx-auto">
              
              <h3 class="card-title">This Month Weddings</h3>
              <span class="mb-4 p-4">{{date('F')}}</span>
    
              <div class="col-lg-4 col-md-4 col-sm-12 info-block mx-auto">
                <div class="info-block-one">
                    <div class="inner-box">
                      <a href="{{route('upcoming.weddings')}}">  
                        <h4>{{$currentMonthWedding}}</h4></a>
                        
                    </div>
                </div>
            </div>
            </div>
          </div>
        </div>

  </div>



</div>
@endsection