<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet" />
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
      <link rel="stylesheet" href="../scss/styles.css" />
      <title>Student Login</title>
   </head>

   <body>
      <nav class="navbar bg-dark">
         <h1>
            <a href="#"> <i class="fas fa-school"> </i> WorkZen </a>
         </h1>

         <ul>
            <li>
               <a href="{{ route('student.login') }}"> <i class="fa fa-user-check"></i> <span class="ml-1">Student Login</span> </a>
            </li>
            <li>
               <a href="{{ route('lecturer.login') }}"><i class="fa fa-user-check"></i> <span class="ml-1">Lecturer Login</span> </a>
            </li>
            <li>
               <a href="{{ route('user.login') }}"><i class="fa fa-user-check"></i> <span class="ml-1">Admin Login</span> </a>
            </li>
         </ul>
         <i class="burger-icon fa fa-bars"></i>
      </nav>

      <section class="container">
        
         <h1 class="large text-primary">Student Login</h1>
         <p class="lead"><i class="fas fa-user"></i> Login to your account</p>

         <form action="{{ route('student.check') }}" method="post" autocomplete="off" class="form">
                @if (Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                @endif

                @if (Session::get('info'))
                    <div class="alert alert-info">
                        {{ Session::get('info') }}
                    </div>
                @endif

        {{csrf_field()}}

        @csrf
            <div class="form-group">
               <input type="email" name="email" placeholder="Enter email address" value="{{ Session::get('verifiedEmail') ? Session::get('verifiedEmail') : old('email') }}">
               <span class="text-danger">@error('email'){{ $message }} @enderror </span>
            </div>
            <div class="form-group">
               <input type="password" name="password" placeholder="Enter password" value="{{ old('password') }}" />
               <span class="text-danger">@error('password'){{ $message }} @enderror </span>
            </div>

            <div>
              <br>
                <a href="{{ route('student.forgot.password.form') }}">Forgot password</a>
                <br>
                <br>
            </div>

            <div class="form-group">
               <input type="submit" value="Login" class="btn btn-primary" />
            </div>
         </form>
      </section>

      <footer class="footer">
         <p>WorkZen - All Rights Reserved</p>
      </footer>
   </body>
</html>
