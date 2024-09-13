<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('assets/css/styles.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
<div class="card">
  <div class="card-body">
    @if($message = Session::get('success'))
      <div class="alert alert-success">
         <p>{{$message}}</p>
      </div>
      @else
      <h5 class="card-title">User registration</h5>
    @endif
<form action="{{route('user.register')}}" method="post">
    @csrf
  <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Full name</label>
  <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Full name....">
  <span class="error-danger">
        @error('name')
          {{$message}}
        @enderror
    </span>
  </div>
  <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Email Address</label>
  <input type="text" class="form-control" name="email" value="{{old('email')}}" placeholder="Email....">
  <span class="error-danger">
        @error('email')
          {{$message}}
        @enderror
    </span>
  </div>
  <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Password</label>
  <input type="password" class="form-control" name="password" placeholder="Password....">
  <span class="error-danger">
        @error('password')
          {{$message}}
        @enderror
    </span>
  </div>
  <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Confirm Password</label>
  <input type="password" class="form-control" name="password_confirmation" placeholder="Password....">
  <span class="error-danger">
        @error('password_confirmation')
          {{$message}}
        @enderror
    </span>  
</div>

  <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Date of Birth</label>
  <input type="date" class="form-control" name="dob" value="{{old('dob')}}">
  <span class="error-danger">
        @error('dob')
          {{$message}}
        @enderror
    </span>
  </div>

  <div class="mb-3">
  <label for="exampleFormControlInput1" class="form-label">Gender</label><br>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="gender"  value="M" @if(old('gender') == 'M') checked @endif>
    <label class="form-check-label" for="inlineRadio1">Male</label>
    </div>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="gender"  value="F" @if(old('gender') == 'F') checked @endif>
    <label class="form-check-label" for="inlineRadio1">Female</label>
    </div>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="gender"  value="O" @if(old('gender') == 'O') checked @endif>
    <label class="form-check-label" for="inlineRadio1">Other</label>
    </div>
    <p class="error-danger">
        @error('gender')
          {{$message}}
        @enderror
    </p>
  </div>
  <div class="mb-3">
  <select class="form-select" aria-label="Default select example" id="country" name="country_id">
  <option value="">Select country</option>
  <!-- <option value="1" @if (old("country") == "1") {{ 'selected' }} @endif>One</option>
  <option value="2" @if (old("country") == "2") {{ 'selected' }} @endif>Two</option>
  <option value="3" @if (old("country") == "3") {{ 'selected' }} @endif>Three</option> -->
  </select>
  <span class="error-danger">
        @error('country')
          {{$message}}
        @enderror
    </span>
</div>
<div class="mb-3">
  <select class="form-select" aria-label="Default select example" id="state" name="state_id">
  <option value="">Select state</option>
  <!-- <option value="1" @if (old("state") == "1") {{ 'selected' }} @endif>One</option>
  <option value="2" @if (old("state") == "2") {{ 'selected' }} @endif>Two</option>
  <option value="3" @if (old("state") == "3") {{ 'selected' }} @endif>Three</option> -->
  </select>
  <span class="error-danger">
        @error('state')
          {{$message}}
        @enderror
    </span>
</div>
<div class="mb-3">
  <select class="form-select" aria-label="Default select example" id="city" name="city_id">
  <option value="">Select city</option>
  <!-- <option value="1" @if (old("city") == "1") {{ 'selected' }} @endif>One</option>
  <option value="2" @if (old("city") == "2") {{ 'selected' }} @endif>Two</option>
  <option value="3" @if (old("city") == "3") {{ 'selected' }} @endif>Three</option> -->
  </select>
  <span class="error-danger">
        @error('city')
          {{$message}}
        @enderror
    </span>
</div>
<button type="submit" class="btn btn-primary">Submit</button>
&nbsp;&nbsp;
<a href="{{url('/')}}" style="text-decoration:none;font-size:20px;font-weight:500">Login</a>
</form>
  </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
           $.ajax({
               url:"country",
               success:function(response){
                $.each(response.data,function(index, value) {
                   $('#country').append(`<option value=${value.id}>${value.country_name}</option>`)
                });
              }
               })
       
        $('#country').on("change",function(){
            var country_id = $("#country").val();
            $('#state').html("");
            $('#state').append(`<option value="">Select city</option>`);
            $.ajax({
               method:"GET",
               url:"state",
               data:{id:country_id},
               success:function(response){
                console.log(response);
                $.each(response.data,function(index, value) {
                    $.each(value.getstate,function(index,value){
                       $('#state').append(`<option value=${value.id}>${value.state_name}</option>`)
                    });
                });
               }
           })
        });

        $('#state').on("change",function(){
          const state_id = $("#state").val();
          $('#city').html("");
          $('#city').append(`<option value="">Select city</option>`);
            $.ajax({
               method:"GET",
               url:"city",
               data:{id:state_id},
               success:function(response){
                $.each(response.data,function(index, value) {
                    $.each(value.getcity,function(index,value){
                       $('#city').append(`<option value=${value.id}>${value.city_name}</option>`)
                    });
                });
               }
           })
        });
   
    })
</script>
</body>
</html>