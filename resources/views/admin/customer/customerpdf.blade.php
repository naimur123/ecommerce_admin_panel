<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="card-header">
        <div class="row">
         <div class="col-8">
          <h4>Customer</h4>
         </div>
        </div>
    </div>
    
    <br>
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th> Email</th>
            <th> Phone</th>
            <th > Email verified at</th>
            <th > Social id</th>
            <th>Account create time</th>
            <th>Account update time</th>
        </tr>
        <?php $i = 1 ?>
        @foreach($users as $user)
        <tr class="text-center">
            <th>{{ $i++ }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email ?? "N/A" }}</td>
            <td>{{ $user->phone ?? "N/A" }}</td>
            <td>{{ $user->email_verified_at ?? "N/A" }}</td>
            <td>{{ $user->social_id ?? "N/A" }}</td>
            <td>{{ $user->created_at ?? "N/A" }}</td>
            <td>{{ $user->updated_at ?? "N/A" }}</td>
          </tr>
        @endforeach
    </table>
    
</body>
</html>
