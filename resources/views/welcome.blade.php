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
      <link rel="stylesheet" href="scss/styles.css" />
      <title>WorkZen</title>
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
               <a href="{{route ('lecturer.login')}}"><i class="fa fa-user-check"></i> <span class="ml-1">Lecturer Login</span> </a>
            </li>
            <li>
               <a href="{{route ('user.login')}}"><i class="fa fa-user-check"></i> <span class="ml-1">Admin Login</span> </a>
            </li>
         </ul>

         <i class="burger-icon fa fa-bars"></i>
      </nav>

      <section class="landing">
         <div class="dark-overlay">
            <div class="landing-inner">
               <h1 class="x-large">WorkZen</h1>
               <p class="lead">Education is smart enough to change the human mind positively</p>
            </div>
         </div>
      </section>
   </body>
</html>
