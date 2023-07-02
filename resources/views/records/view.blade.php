@extends('dashboard')
@section('admin')

<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Tables</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Table</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title"><a href="{{route('add.record')}}" ><button type="button" class="btn btn-primary">Add Celebrant</button></a></h6>
       
        <div class="table-responsive">
          <div id="dataTableExample_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
            
          <div class="row">
            <div class="col-sm-12 object-contained">
             <table id="dataTableExample" class="table table-hover dataTable no-footer" aria-describedby="dataTableExample_info">
              <thead>
                <tr><th class="sorting sorting_asc" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 271.875px;">SL</th>
                  <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 420.172px;">Name</th>
                  <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 207px;">Phone</th>
                  <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 94.3438px;">Email</th>
                  <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" style="width: 207px;">Birthday</th>
                  <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 94.3438px;">Wedding</th>
                  <th class="sorting" tabindex="0" aria-controls="dataTableExample" rowspan="1" colspan="1" aria-label="Age: activate to sort column ascending" style="width: 94.3438px;">Action</th>
                </tr>
              </thead>




            <tbody>
            @php
                
            
          $celebrants = \App\Models\Anniversary::where('user_id', Auth::user()->id)->get()
          @endphp 

         @foreach ($celebrants as $key => $item)
             
        
              
            <tr class="odd">
                <td class="sorting_1">{{$key + 1}}</td>
                <td>{{$item->name}}</td>
                <td>{{$item->phone}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->birthday}}</td>
                <td>{{$item->wedding}}</td>
                <td>
                  <a href="{{ route('edit.record',$item->id) }}" class="btn btn-inverse-warning" title="Edit"> <i data-feather="edit"></i> </a>
           
                  <a href="{{ route('delete.record',$item->id) }}" class="btn btn-inverse-danger" id="delete" title="Delete"> <i data-feather="trash-2"></i>  </a>
                                   </td> 
              </tr>
              @endforeach
              </tbody>
          </table></div></div>
        
        </div>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection