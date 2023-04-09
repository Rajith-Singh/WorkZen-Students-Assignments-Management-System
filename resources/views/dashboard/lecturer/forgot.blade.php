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
      <link rel="stylesheet" href="/../scss/styles.css" />
      <title>Fogot Password</title>
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
        
         <h1 class="large text-primary">Fogot Password</h1>
         <p class="lead"><i class="fas fa-user"></i> Enter your email address and we will send you a link to reset your password.</p>

         <form action="{{ route('lecturer.forgot.password.link') }}" method="post" autocomplete="off" class="form">
                @if (Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                @endif
                @if (Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
        {{csrf_field()}}

        @csrf
            <div class="form-group">
               <input type="email" name="email" placeholder="Enter email address" value="{{ old('email') }}">
               <span class="text-danger">@error('email'){{ $message }} @enderror </span>
            </div>

            <br>
            <div class="form-group mt-2">
                <button type="submit" class="btn btn-primary">Send Reset Password Link</button>
            </div>

            <br>
                <a href="{{ route('lecturer.login') }}">Login</a>
            </form>
      </section>

      <footer class="footer">
         <p>WorkZen - All Rights Reserved</p>
      </footer>
   </body>
</html>
