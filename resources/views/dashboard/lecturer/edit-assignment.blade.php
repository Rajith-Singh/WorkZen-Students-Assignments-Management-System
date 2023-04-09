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
      <link rel="stylesheet" href="/../scss/styles2.css" />
      <title>Update Assignment</title>
   </head>

   <body>
      <nav class="navbar bg-dark">
         <h1>
            <a href="#"> <i class="fas fa-school"> </i> WorkZen </a>
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
      <h1 class="large text-primary">Update Assignment</h1>
		<form method="POST" action="/lecturer/updateAssignment">
        {{csrf_field()}}

            <input type="hidden" name="id" value="{{$data->id}}">

            <div class="form-group">
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" value="{{$data->title}}">
                <span style="color:red"> @error('title'){{$message}}@enderror</span><br>
            </div>

            <div class="form-group">
                <label for="description">Description:</label><br>
                <textarea id='editor' name="description"> {{$data->description}}</textarea>
                <span style="color:red"> @error('description'){{$message}}@enderror</span><br>
            </div>

            <div class="form-group">
                <label for="year">Year:</label><br>
                <select name="year" id="year">
                    <option value="1st Year">{{$data->year}}</option>
                    <option value="1st Year">1st Year</option>
                    <option value="2nd Year">2nd Year</option>
                    <option value="3rd Year">3rd Year</option>
                    <option value="4th Year">4th Year</option>
                </select>
                <span style="color:red"> @error('year'){{$message}}@enderror</span><br>
            </div>

            <div class="form-group">
                <label for="semester">Semester:</label><br>
                <select name="semester" id="semester">
                    <option value="1st Semester">{{$data->semester}}</option>
                    <option value="1st Semester">1st Semester</option>
                    <option value="2nd Semester">2nd Semester</option>
                </select>
                <span style="color:red"> @error('semester'){{$message}}@enderror</span><br>
            </div>

            <div class="form-group">
                <label for="deadline">Deadline:</label><br>
                <input type="datetime-local" id="deadline" name="deadline" value="{{$data->deadline}}">
                <span style="color:red"> @error('deadline'){{$message}}@enderror</span><br>
            </div>

            <div class="form-group">
			    <input type="submit" value="Update Assignment" class="btn btn-success">
            </div>
		</form>

      </section>

      <footer class="footer">
         <p>WorkZen - All Rights Reserved</p>
      </footer>

      <script src="/js/ckeditor.js"> </script>
    <script>
        CKEDITOR.replace('editor',
        {
        extraPlugins : 'html5video, videoembed',
        });
    </script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"
        ></script>

   </body>
</html>