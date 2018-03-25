<!DOCTYPE html>
<html lang="en">
<head>
  <title>L5Lab</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2></h2>
    
    <form action="upload_submit.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="records">Upload:</label>
          <input type="file" name="records" class="form-control" id="records" accept="application/csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>

</div>

</body>
</html>

