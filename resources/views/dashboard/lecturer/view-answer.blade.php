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
      <title>View Answer</title>
      <style>
            /* Table style */
            table {
            border-collapse: collapse;
            width: 100%;
            font-size: 1rem;
            }

            /* Table header style */
            th {
            background-color: #f2f2f2;
            color: #333;
            font-weight: bold;
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
            }

            /* Table row style */
            tr {
            background-color: #fff;
            border: 1px solid #ddd;
            }

            /* Table row hover style */
            tr:hover {
            background-color: #f5f5f5;
            }

            /* Table cell style */
            td {
            padding: 8px;
            border: 1px solid #ddd;
            }

            /* Alternate row color */
            tr:nth-child(even) {
            background-color: #f2f2f2;
            }
      </style>
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

      <h1 class="large text-primary">View Students Answers</h1>

      <table>
                <tr>
                    <th>
                        Student Name
                    </th>
                    <th>
                        Title
                    </th>
                    <th>
                        Download
                    </th>
                </tr>
                @foreach($data as $answers)
                <tr>
                    <td>
                        {{ $answers->name }}
                    </td>
                    <td>
                        {{ $answers->title }}
                    </td>
                    <td>
                        <a href="/download/{{ $answers->file }}">Download</a>
                    </td>
                </tr>
                @endforeach
        </table>

      </section>

      <footer class="footer">
         <p>Copyright WorkZen - All Rights Reserved</p>
      </footer>
   </body>
</html>
