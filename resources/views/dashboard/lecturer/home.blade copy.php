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
      <link rel="stylesheet" href="../scss/styles.css" />
      <title>Dashboard</title>
   </head>

   <body>
      <nav class="navbar bg-dark">
         <h1>
            <a href="#"> <i class="fas fa-school"> </i> WorkZen </a> </i>
         </h1>

         <ul>
            <li>
               <a href="#"> <i class="fa fa-id-badge"></i> <span class="ml-1">My Account</span> </a>
            </li>
            <li>
               <a href="/lecturer/add-assignment" title="Assignment"><i class="fas fa-tasks"></i> <span class="hide-sm ml-1">Assignments</span></a>
            </li>
            <li>
               <a href="#" title="Dashboard"><i class="fa fa-bell"></i> <span class="hide-sm ml-1">Notices</span></a>
            </li>
            <li>
               <a href="{{ route('lecturer.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt"></i>
                  <span class="hide-sm">Logout</span>
               </a>
               <form action="{{ route('lecturer.logout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
            </li>
         </ul>
         <i class="burger-icon fa fa-bars"></i>
      </nav>

      <section class="container">
         <h1 class="large text-primary">Dashboard</h1>
         <p class="lead"><i class="fas fa-User"></i> Welcome {{ Auth::guard('lecturer')->user()->name }} </p>
         <div class="dash-buttons">
            <a href="#" class="btn"> <i class="fas fa-user-circle text-primary"></i> Edit Profile </a>
            <a href="#" class="btn"> <i class="fab fa-black-tie text-primary"></i> Add Experience </a>
            <a href="#" class="btn"> <i class="fas fa-graduation-cap text-primary"></i> Add Education </a>
            <a href="#" class="btn"> <i class="fas fa-book-open text-primary"></i> Add Notice </a>
            <a href="/lecturer/add-assignment" class="btn"> <i class="fas fa-book text-primary"></i> Create Assignments </a>
         </div>

         <h2 class="my-2">Experience Credentials</h2>
         <table class="table">
            <thead>
               <tr>
                  <th>Company</th>
                  <th class="hide-sm">Title</th>
                  <th class="hide-sm">Years</th>
                  <th></th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>Microsoft</td>
                  <td class="hide-sm">Senior Software Engineer</td>
                  <td class="hide-sm">Jan 2015 - Current</td>
                  <td><button class="btn btn-success">Update</button></td>
                  <td><button class="btn btn-danger">Delete</button></td>
               </tr>

               <tr>
                  <td>Google</td>
                  <td class="hide-sm">Senior Software Engineer</td>
                  <td class="hide-sm">Jan 2011 - 2014</td>
                  <td><button class="btn btn-success">Update</button></td>
                  <td><button class="btn btn-danger">Delete</button></td>
               </tr>
            </tbody>
         </table>

         <h2 class="my-2">Education Credentials</h2>
         <table class="table">
            <thead>
               <tr>
                  <th>School</th>
                  <th class="hide-sm">Degree</th>
                  <th class="hide-sm">Years</th>
                  <th></th>
                  <th></th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>University of California</td>
                  <td class="hide-sm">Bsc(hons) in Information Technology Specialized in Software Engineering</td>
                  <td class="hide-sm">June 2006 - June 2010</td>
                  <td><button class="btn btn-success">Update</button></td>
                  <td><button class="btn btn-danger">Delete</button></td>
               </tr>
            </tbody>
         </table>

         <div class="my-2">
            <button class="btn btn-danger" href="{{ route('lecturer.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="fas fa-user-minus"></i> Logout </button>
            <form action="{{ route('lecturer.logout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
         </div>
      </section>

      <footer class="footer">
         <p>Copyright WorkZen - All Rights Reserved</p>
      </footer>
   </body>
</html>
