@extends('dashboard')

@section('admin')

<div class="page-content">

  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Forms</a></li>
      <li class="breadcrumb-item active" aria-current="page">Basic Elements</li>
    </ol>
  </nav>

  <div class="row">
   
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <h6 class="card-title">Anniversary Record</h6>

          <form method="POST" action="{{route('post.record')}}"  class="forms-sample">
            @csrf
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}" class="form-control" id="exampleInputUsername2" placeholder="Name">
            <div class="row mb-3">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Name</label>
              <div class="col-sm-9">
                <input type="text" name="name" class="form-control" id="exampleInputUsername2" placeholder="Name">
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-9">
                <input type="email" name="email" class="form-control" id="exampleInputEmail2" autocomplete="off" placeholder="Email">
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
              <div class="col-sm-9">
                <input type="number" name="phone" class="form-control" id="exampleInputMobile" placeholder="Mobile number">
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Birthdate</label>
              <div class="col-sm-9">
                <input type="date" name="birthday" class="form-control" id="exampleInputPassword2" autocomplete="off" placeholder="Birthdate">
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Wedding Date</label>
              <div class="col-sm-9">
                <input type="date" name="wedding" class="form-control" id="exampleInputPassword2" autocomplete="off" placeholder="Wedding anniversary">
              </div>
            </div>
            <div class="form-check mb-3">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">
                Remember me
              </label>
            </div>
            <button type="submit" class="btn btn-primary me-2">Submit</button>
            <button class="btn btn-secondary">Cancel</button>
          </form>

        </div>
      </div>
    </div>
  </div>
  

</div>
@endsection