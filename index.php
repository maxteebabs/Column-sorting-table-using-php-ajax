<?php 
  include('model/Record.php');
  $records = new Record();
  $records->findAll();
  // var_dump ($records);exit;
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>L5Lab</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
    a.sort{
      text-decoration: none;
    }
  </style>
  <script type="text/javascript" src="js/main.js"></script>
</head>
<body>

<div class="container">
  <h2></h2>
  <p><a href="upload.php" class="btn btn-primary">Upload Records</a></p>



  <form>
      <div class="form-group">
          <label for="records">Search By:</label>
          <select name="record_header" class="" id="record_header">
              <option value="firstName">FirstName</option>
              <option value="lastName">Last Name</option>
              <option value="email">Email</option>
              <option value="phone">Phone</option>
              <option value="company">Company</option>
          </select>
           <label for="field">Field:</label>
          <input type="text" name="field" id="field">
          <button type="button" class="btn btn-default" id="search">Search </button>

        </div>
        <input type="hidden" id="page" name="page" value="1">
  </form>
<ul class="pagination">
      <li><a href="#" data-page="prev" class="paginate">Previous</a></li>
      <li><a href="#" data-page="next" class="paginate">Next</a></li>
  </ul>
  <table class="table table-striped table-condensed table-responsive">
    <thead>
      <tr>
        <th>First Name <a class="sort" href="javascript:void(0);" data-table="firstName" data-type="desc">V</a></th>
        <th>Last Name <a class="sort" href="javascript:void(0);" data-table="lastName" data-type="desc">V</a></th>
        <th>Email Address <a class="sort" href="javascript:void(0);" data-table="email" data-type="desc">V</a></th>
        <th>Phone Numbers <a class="sort" href="javascript:void(0);" data-table="phone" data-type="desc">V</a></th>
        <th>Company <a class="sort"  href="javascript:void(0);" data-table="company" data-type="desc">V</a></th>
        <th>*</th>
      </tr>
    </thead>
    <tbody id="records">
  
    </tbody>
  </table>

  <ul class="pagination">
      <li><a href="#" data-page="prev" class="paginate">Previous</a></li>
      <li><a href="#" data-page="next" class="paginate">Next</a></li>
  </ul>
</div>

</body>
</html>

