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

.button{
  border-radius: 20px;
}
    .table-container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    margin-top: 20px;
    margin-bottom: 20px;

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
      background-color: darkcyan;
      font-weight: bold;
      font-size: 1.2em;
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
    /* Footer styling */
.footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px 0;
}

.footer a {
    color: white;
    text-decoration: none;
}

.footer a:hover {
    text-decoration: underline;
}

  </style>
</head>
<body>

  <footer class="footer">
    <form action="{{route('request-logs.index')}}" method="post" enctype="multipart/form-data">
        @csrf <!-- Laravel CSRF Token -->
        <button  class="button" type="submit">Show All the Requests</button>
    </form>
  </footer>
  <div class="table-container">
    <h2 class="title">File Listing</h2>

    <div class="buttons" >
  <form action="{{ route('upload') }}" method="post" enctype="multipart/form-data">
      @csrf <!-- Laravel CSRF Token -->

      <input type="file" id="file" name="file" accept=".txt" style="border: 2px solid;
    border-radius: 25px;">

      <button class="button" type="submit">Upload File</button>
  </form>

</div>
<div  class="table-container">
<form id="file-download-form" method="post" action="{{ route('user.downloadMultiple') }}" style="width:1500px">
  @csrf

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
              <td><a href="{{ route('admin.download', ['filename' => $file->filename]) }}">Download</a></td>


              <td><a href="{{ route('file.report', ['file' => $file]) }}">View File Report</a></td>
              <td class="checkbox-column">
                  <input type="checkbox" name="selectedFiles[]" class="file-checkbox" value="{{ $file->id }}">
              </td>
              <td>{{ $file->status }}</td>
          </tr>
          @endforeach
      </tbody>
  </table>

  <button type="submit" style="margin-top: 10px; border-radius:25px; margin-left:590px">Download Selected Files</button>
</form>


  </div>

<table style="border-radius:25px">
  <thead>
    <tr>
      <th colspan="5">Show users</th>
    </tr>
    <tr>
      <th class="country-column" colspan="1">User Name</th>
      <th class="country-column" colspan="1">email</th>
      <th class="country-column" colspan="1">group</th>

      <th class="vertical-align-middle">add to group1</th>
      <th class="vertical-align-middle">add to group2</th>

    </tr>
  </thead>
  <tbody>
    @foreach ($users_account as $user)
     <tr>
         <td>{{ $user->name }}</td>
         <td>{{ $user->email }}</td>

         <!-- Assuming $user_group is an array where the key is the user_id and the value is a collection of groups -->
         <td>
                    @foreach ($user->groups as $group)
                        <span>{{ $group->id }}</span>{{ $loop->last ? '' : ', ' }}
                    @endforeach
       </td>

         <!-- Additional columns -->
         <td>
         <form method="post" action="{{route('addUserToGroup', ['user_id' => $user->id])}}" >
             @csrf
             <button type="submit" style="border: none; background-color: transparent; color: red; cursor: pointer;">join</button>
         </form>
       </td>
         <td>
           <form method="post" action="{{route('addUserToGroup', ['user_id' => $user->id])}}" >
               @csrf
               <button type="submit" style="border: none; background-color: transparent; color: yellow; cursor: pointer;">join</button>
           </form>
         </td>
     </tr>
  @endforeach

  </tbody>
</table>

</div>

<div class="table-container">

<table style="border-radius:25px">
  <thead>
    <tr>
      <th colspan="5">Show requests</th>
    </tr>
    <tr>
      <th class="country-column" colspan="1">User Name</th>
      <th class="country-column" colspan="1">email</th>
    

      <th class="vertical-align-middle">accept</th>
      <th>Reject</th>
    </tr>
  </thead>
  <tbody>

    @foreach($users as $file)
   <tr>
       <td>{{ $file->name }}</td>
   <td>{{ $file->email }}</td>

   <td>
   <form method="post" action="{{ route('approve', ['userId' => $file->id]) }}" >
       @csrf

       <button type="submit" style="border: none; background-color: transparent; color: red; cursor: pointer;">approve</button>
   </form>
</td>

<td>
<form method="post" action="{{ route('reject', ['userId' => $file->id]) }}" >
    @csrf

    <button type="submit" style="border: none; background-color: transparent; color: red; cursor: pointer;">reject</button>
</form>
</td>
   </tr>
  @endforeach
  </tbody>
</table>

</div>

</body>
</html>
