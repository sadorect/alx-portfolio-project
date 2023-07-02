@extends('dashboard')

@section('admin')

<div class="page-content">

  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Upcoming</a></li>
      <li class="breadcrumb-item active" aria-current="page">Weddings</li>
    </ol>
  </nav>

  <div class="row">
   
    <div class="col-md-8 col-sm-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <h2 class="card-title">Wedding Anniversaries</h2>

          <div class="table-responsive">
            
            <table id="dataTableExample" class="table table-hover dataTable no-footer" aria-describedby="dataTableExample_info">
              <thead>
                <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 100px;">SL</th><th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 220.172px;">Name</th><th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 207px;">Date</th><th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 94.3438px;">Action</th></tr>
              </thead>
              <tbody>
                @foreach($upcomingWeddings as $key => $wedding)
                <tr>
                  <th> {{$key + 1 }}</th>
                  <td>{{ $wedding->name }}</td>
                  <td>{{ $wedding->formatted_date }}</td>
                  <td>
                    <a href="{{ route('edit.record',$wedding->id) }}" class="btn btn-inverse-warning" title="Edit"> <i data-feather="edit"></i> </a>
             
                    <a href="{{ route('delete.record',$wedding->id) }}" class="btn btn-inverse-danger" id="delete" title="Delete"> <i data-feather="trash-2"></i>  </a>
                   </td> 
                </tr>
                @endforeach
               
              </tbody>
            </table>
          </div>
          
        </div>
      </div>
    </div>
  </div>
  

</div>
@endsection