<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
</head>
<body>
<div class="card">
  <div class="card-body">
  @if($message = Session::get('msg'))
      <div class="alert alert-danger">
         <p>{{$message}}</p>
      </div>
      @else
      <h5 class="card-title">User Login</h5>
    @endif
<form action="{{route('user.login')}}" method="post">
    @csrf
  <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email Address</label>
  <input type="text" class="form-control" name="email" placeholder="Email....">
  </div>
  <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Password</label>
  <input type="password" class="form-control" name="password" placeholder="Password....">
  </div>
<a href=""><button type="submit" class="btn btn-primary">Login</button></a>
<span style="color:blue">If account not created?</span> <a href="{{route('user.register')}}">Register</a>
</form>
  </div>
</div>
</body>
</html>