@extends('admin.layouts.app')
@section('content')

 <!-- Main content -->
 <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Your Profile</h3>

              </div>


              <form method="post" action="{{ route('Admin-Profile-Store') }}" enctype="multipart/form-data">
              {!! csrf_field() !!}

                <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputName">Full Name</label>
                    <input type="text" required name="name" class="form-control" id="exampleInputName" placeholder="Enter Full Name" value="{{ old('name') ?? $userDetails->name ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="exampleInputPhone">Phone</label>
                    <input type="text" required name="phone" class="form-control" id="exampleInputPhone" placeholder="Enter Phone" value="{{ old('phone') ?? $userDetails->phone ?? ''}}">
                </div>

                 <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" required name="email" class="form-control" id="exampleInputEmail" placeholder="Enter email"  value="{{ old('email') ?? $userDetails->email ?? '' }}">
                </div>

                <div class="form-group">
                    <label for="exampleInputuserpic">Update Your profile image</label>
                    <input type="file" name="user_pic" class="form-control" id="exampleInputuserpic">
                </div>


                <span style="color:red;">Leave blank(if you does not want to change password)</span>
                  <div class="form-group">
                    <label for="exampleInputPassword">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword" placeholder="Password">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword">Confirm Password</label>
                    <input type="password" name="ConfirmPassword" class="form-control" id="exampleInputPassword" placeholder="Password">
                  </div>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>

                @if(session()->has('profilesuccess'))
                <div style="color:green; text-align: center;">
                {{ session()->get('profilesuccess') }}
                </div>
                @endif
                 
                @if ($errors->any())
                <div style="color:red; text-align: center;">
                <ul style="list-style-type:none;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
                </div>
                @endif 

              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection