<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Laravel 8 Admin Auth - laravelcode.com</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
.login-form {
    width: 340px;
    margin: 50px auto;
  	font-size: 15px;
}
.login-form form {
    margin-bottom: 15px;
    background: #f7f7f7;
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    padding: 30px;
}
.login-form h2 {
    margin: 0 0 15px;
}
.form-control, .btn {
    min-height: 38px;
    border-radius: 2px;
}
.btn {        
    font-size: 15px;
    font-weight: bold;
}
.font-red-mint{
    color:red;
}
</style>
</head>
<body>
<div class="login-form">
    <form action="{{ route('adminRegisterPost') }}" method="post">
    	{!! csrf_field() !!}
        <h2 class="text-center">Registration Form</h2>
        @if(\Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ \Session::get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        @endif
        {{ \Session::forget('success') }}
        @if(\Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ \Session::get('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        @endif  

        <div class="form-group">
            <select name="usertype" class="form-control" required="required">
                <option value="">Select User Type</option>
                <option <?php if (old('usertype') == 'trainer'){ echo 'selected="selected"'; } 
                ?> value="trainer">Trainer</option>
                <option <?php if (old('usertype') == 'client'){ echo 'selected="selected"'; } 
                ?> value="client">Client</option>
            </select>
            
            @if ($errors->has('usertype'))
            <span class="help-block font-red-mint">
                <strong>{{ $errors->first('usertype') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Full Name" required="required" value="{{ old('name') ?? '' }}">
            @if ($errors->has('name'))
            <span class="help-block font-red-mint">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <input type="text" class="form-control" name="phone" placeholder="Phone Number" required="required" value="{{ old('phone') ?? '' }}">
            @if ($errors->has('phone'))
            <span class="help-block font-red-mint">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
            @endif
        </div>
        

        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" required="required" value="{{ old('email') ?? '' }}">
            @if ($errors->has('email'))
            <span class="help-block font-red-mint">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required="required">
            @if ($errors->has('password'))
            <span class="help-block font-red-mint">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <input type="password" class="form-control" name="ConfirmPassword" placeholder="Confirm Password" required="required">
            @if ($errors->has('ConfirmPassword'))
            <span class="help-block font-red-mint">
                <strong>{{ $errors->first('ConfirmPassword') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div>  
        <p>Already have an account? <a href="{{ route('adminLogin') }}">Login here.</a></p>    
    </form>
</div>
</body>
</html>