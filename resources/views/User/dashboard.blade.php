
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>File Listing</title>
  <style>
    /* CSS styles for the table container */
    body, html {
      height: 100%;
      margin: 0;
    }

    .table-container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    /* CSS styles for the table */
    table {
      border-collapse: separate;
      width: 70%;
      border-spacing: 0;
      border-radius: 10px;
      overflow: hidden;
      margin: auto;
      font-family: "Montserrat", sans-serif;
      background-color: #333;
    }

    th, td {
      padding: 10px;
      text-align: center;
      border-bottom: 1px solid #555;
      color: #fff;
    }

    th {

      font-weight: bold;
      font-size: 1.2em;
      width:1500px;
      background-color: darkcyan;
    }

    .country-column {
      width: 37%;
      text-align: center;
    }

    .vertical-align-middle {
      vertical-align: middle;
    }

    tbody tr:hover {
      background-color: #030a12;
      cursor: pointer;
    }

    tbody tr:hover td {
      color: #fff;
    }

    /* CSS styles for the title */
    .title {
      text-align: center;
      color: #fff;
      font-size: 1.8em;
      font-family: "Montserrat", sans-serif; /* Use the same font family as the table */
      font-weight: bold;
      margin-top: 20px;
      margin-bottom: 20px;
    }

    /* Delete button hover effect */
    td button:hover {
      color: #ff0000; /* Red color on hover */
    }

    /* Responsive styles */
    @media only screen and (max-width: 768px) {
      .table-container {
        padding: 20px;
      }
    }
  </style>
</head>
<body>
  <div class="table-container">
    <h2 class="title">File Listing</h2>

    <div class="buttons">
  <form action="{{ route('user.upload') }}" method="post" enctype="multipart/form-data">
      @csrf <!-- Laravel CSRF Token -->


      <input style="border:2px solid; border-radius:25px" type="file" id="file" name="file" accept=".txt">

      <button  style="border-radius:25px;" type="submit">Upload File</button>
  </form>
</div>
<form id="file-download-form" method="post" action="{{ route('user.downloadMultiple') }}" style="padding:30px">
  @csrf <!-- Include CSRF token for security -->

  <table style="border-radius:25px">
      <thead>
          <tr>
              <th colspan="5">Show Files</th>
          </tr>
          <tr>
              <th class="country-column" colspan="1">File Name</th>
              <th class="vertical-align-middle">Download</th>

              <th class="vertical-align-middle">Report</th>
              <th class="vertical-align-middle">Select</th>
              <th class="vertical-align-middle">file status</th>
          </tr>
      </thead>
      <tbody>
          @foreach($files as $file)
          <tr>
              <td>{{ $file->filename }}</td>
              <td><a href="{{ route('download', ['filename' => $file->filename]) }}">Download</a></td>


              <td><a href="{{ route('file.report', ['file' => $file]) }}">View File Report</a></td>
              <td class="checkbox-column">
                  <input type="checkbox" name="selectedFiles[]" class="file-checkbox" value="{{ $file->id }}">
              </td>
                <td>{{ $file->status }}</td>
          </tr>
          @endforeach
      </tbody>
  </table>

  <button  type="submit" style="margin-top: 10px; border-radius:25px; margin-left:250px; padding-top:5px; padding-bottom:5px;">Download Selected Files</button>
</form>


  </div>
  <script>
   // JavaScript to handle the "Select All" checkbox functionality
   document.getElementById('select-all').addEventListener('change', function() {
     var checkboxes = document.getElementsByClassName('file-checkbox');
     for (var i = 0; i < checkboxes.length; i++) {
       checkboxes[i].checked = this.checked;
     }
   });

   // JavaScript to handle the "Download Selected" button functionality
   document.getElementById('download-selected').addEventListener('click', function() {
       var checkboxes = document.getElementsByClassName('file-checkbox');
       for (var i = 0; i < checkboxes.length; i++) {
         if (checkboxes[i].checked) {
           // Trigger download for the selected file
           window.open("{{ route('user.downloadMultiple', ['filename' => ':filename']) }}".replace(':filename', checkboxes[i].value), "_blank");
         }
       }
     });
   </script>
</body>
</html>
