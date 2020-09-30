<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
</head>

<body>
  <div>
    <h4>Name: {{$request->name}}</h4>
  </div>
  <div>
    <h4>Email: {{$request->email}}</h4>
  </div>
  <div>
    <h4>Subject: {{$request->subject}}</h4>
  </div>
  <div>
    <h4>Message: </h4>
    {{$request->message}}
  </div>
</body>

</html>