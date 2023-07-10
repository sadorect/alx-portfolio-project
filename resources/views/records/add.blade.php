@extends('dashboard')

@section('admin')

<div class="page-content">

  <nav class="page-breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Add</a></li>
      <li class="breadcrumb-item active" aria-current="page">Celebrant</li>
    </ol>
  </nav>

  <div class="row">
   
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <h6 class="card-title">ADD NEW CELEBRANT</h6>

          <form method="POST" action="{{route('post.record')}}"  class="forms-sample">
            @csrf
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}" class="form-control" id="exampleInputUsername2" placeholder="Name">
            <div class="row mb-3">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Name</label>
              <div class="col-sm-9">
                <input type="text" name="name" class="form-control" id="exampleInputUsername2" value="{{old('name')}}" placeholder="Name">
                @error('name')
                <span class="alert alert-danger">{{$message}}</span>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
              <div class="col-sm-9">
                <input type="email" name="email" class="form-control" id="exampleInputEmail2" value="{{old('email')}}"  autocomplete="off" placeholder="Email">
                @error('email')
                <span class="alert alert-danger">{{$message}}</span>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
              <div class="col-sm-9">
                <input type="number" name="phone" class="form-control" id="exampleInputMobile" value="{{old('phone')}}"  placeholder="Mobile number">
                @error('phone')
                <span class="alert alert-danger">{{$message}}</span>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Birthdate</label>
              <div class="col-sm-9">
                <input type="date" name="birthday" class="form-control" id="exampleInputPassword2" value="{{old('birthday')}}"  autocomplete="off" placeholder="Birthdate">
                @error('birthday')
                <span class="alert alert-danger">{{$message}}</span>
                @enderror
              </div>
            </div>
            <div class="row mb-3">
              <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Wedding Date</label>
              <div class="col-sm-9">
                <input type="date" name="wedding" class="form-control" id="exampleInputPassword2" value="{{old('wedding')}}"  autocomplete="off" placeholder="Wedding anniversary">
                @error('wedding')
                <span class="alert alert-danger">{{$message}}</span>
                @enderror
              </div>
            </div>
            <div class="form-check mb-3">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">
                Remember me
              </label>
            </div>
            <button type="submit" class="btn btn-primary me-2">Submit</button>
            <button type="reset" onclick="goBack()" class="btn btn-secondary">Cancel</button>
          </form>

        </div>
      </div>
    </div>
  </div>
  <script>
    function goBack() {
      // Redirect to the previous page
      window.history.back();
    }
  </script>

</div>
@endsection