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
      <link rel="stylesheet" href="/../scss/styles3.css" />
      <link rel="stylesheet" href="/../scss/styles.css" />
      <title>Reupload Assignment</title>
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
               <a href="#" title="Dashboard"><i class="fa fa-bell"></i> <span class="hide-sm ml-1">Notices</span></a>
            </li>
            <li>
                <a href="#"> <i class="fa fa-id-badge"></i> <span class="ml-1">My Account</span> </a>
             </li>
            <li>
               <a href="viewAssignment/{{ Auth::guard('student')->user()->year }}/{{ Auth::guard('student')->user()->semester }}" title="Dashboard"><i class="fas fa-user"></i> <span class="hide-sm ml-1">Assignment</span></a>
            </li>
            <li>
            <a href="{{ route('student.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt"></i>
                  <span class="hide-sm">Logout</span>
               </a>
               <form action="{{ route('student.logout') }}" method="post" class="d-none" id="logout-form">@csrf</form>
            </li>
         </ul>
         <i class="burger-icon fa fa-bars"></i>

      </nav>

      <section class="container">
         <h1 class="large text-primary">Reupload Assignment</h1>
         <p class="lead"><i class="fas fa-User"></i> Hi {{ Auth::guard('student')->user()->name }}. Welcome to the WorkZen</p>

         <table>
            @foreach($data as $assignment)
                <tr>
                  <td colspan="2"> <center> <a href="/student/deleteSubmission/{{$assignment->id}}/{{ Auth::guard('student')->user()->id }}" class="btn btn-danger"> Delete your Previous Submission before adding New Submission </a> </center> </th>
                  <br>
                  @if(session('msg'))
                     <div class="alert alert-danger">{{session('msg')}} </div>
                  @endif
                </tr>
                <tr>
                    <th>
                        {{$assignment->title}}
                    </th>
                </tr>
                <tr>
                    <td>
                        {!!$assignment->description!!}
                    </td>
                </tr>
        </table>


        <form method="post" action="/submission" enctype="multipart/form-data" class="dropzone" id="my-dropzone">
			@csrf
			<input type="text" id="title" name="title" value="{{ Auth::guard('student')->user()->name }}_{{ Auth::guard('student')->user()->email }}" readonly>
			<input type="hidden" name="assignment_id" value="{{ $assignment->id }}" readonly>
			<input type="hidden" name="student_id" value="{{ Auth::guard('student')->user()->id }}" readonly>

			<label for="description">Description:</label>
            <textarea id='editor' name="description"></textarea>

			<div class="fallback">
				<input type="file" name="file" />
			</div>
            @endforeach
	</div>

      </section>

    <section class="container">
            <input type="submit" value="ReUpload Assignment" id="submit" class="btn btn-info" disabled>
            </form>
        </div>
    </section>
      

      <footer class="footer">
         <p>Copyright WorkZen - All Rights Reserved</p>
      </footer>
   </body>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"></script>
	<script>
		Dropzone.autoDiscover = false;

		var myDropzone = new Dropzone("#my-dropzone", {
			url: "/submission",
			paramName: "file",
			maxFilesize: 50, // in MB
			acceptedFiles: ".pdf,.doc,.docx,.jpg,.png,.zip",
			parallelUploads: 1,
			addRemoveLinks: true,
			autoProcessQueue: false,
			dictDefaultMessage: "Drag and drop your file here or click to select a file",
			dictFallbackMessage: "Your browser does not support drag and drop file upload.",
			dictFallbackText: "Please use the fallback form below to upload your files like in the olden days.",
			dictFileTooBig: "File is too big. Max file size is 100MB.",
			dictInvalidFileType: "You can't upload files of this type.",
			dictCancelUpload: "Cancel",
			dictCancelUploadConfirmation: "Are you sure you want to cancel this upload?",
			dictRemoveFile: "Remove",
			dictMaxFilesExceeded: "You can only upload 20 files at a time.",
			init: function () {
				var submitButton = document.querySelector("#submit");
				var myDropzone = this;
				submitButton.addEventListener("click", function () {
					myDropzone.processQueue();
				});
				this.on("addedfile", function () {
					submitButton.disabled = false;
				});
				this.on("removedfile", function () {
					if (myDropzone.files.length < 1) {
						submitButton.disabled = true;
					}
				});
			}
		});
	</script>

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

</html>
