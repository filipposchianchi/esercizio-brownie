<html lang="en">
<head>
  <title></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
      @if (count($errors) > 0)
      <div class="alert alert-danger">
        Errors while uploading<br>
      </div>
      @endif

        @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div> 
        @endif

    <h3>Upload</h3>
    <form method="post" action="{{route('form.create')}}" enctype="multipart/form-data">
    {{csrf_field()}}

        <label for="">Carica immagine/i:</label>
        <div class="input-group control-group" >
          <input type="file" name="filename[]" class="form-control" multiple>
        </div>
        
        <button type="submit" class="btn btn-primary" style="margin-top:10px">Upload</button>

  </form>        
  </div>

</body>
</html>