<?php
if (isset($_POST['submit'])) {
  $file = $_FILES['csv']['tmp_name'];
} else {
  $file = '';
}

require_once('inc/main.php');
$train = new Train($file);
?>

<!doctype html>
<html lang="en">

<head>
  <title>Johnny's Train</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.0.2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css" />
  <link rel="stylesheet" href="css/styles.css">

</head>

<body>
  <!-- Navigation Start -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid justify-content-center">
      <a class="navbar-brand" href="#">Johnny's Train</a>
      <form class="d-flex" name="train" id="train" method="post" enctype="multipart/form-data">
        <input class="upload" type="file" name="csv" id="csv" style="display: none;" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
        <button type="button" class="btn btn-primary" id="upload_csv">Upload</button>
        <input type="submit" value="uploaded" name="submit" id="submit_file" style="display: none;">
      </form>
    </div>
  </nav>
  <!-- Navigation End -->

  <!-- Table Start -->
  <div class="container">
    <table id="train_data" class="table mt-4">
      <thead>
        <tr>
          <th scope="col">TRAIN_LINE</th>
          <th scope="col">ROUTE_NAME</th>
          <th scope="col">RUN_NUMBER</th>
          <th scope="col">OPERATOR_ID</th>
        </tr>
      </thead>

      <tbody>
        <?php
        $train->display_table();
        ?>
      </tbody>
    </table>
  </div>
  <!-- Table End -->

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
  <script src="js/scripts.js"></script>
</body>

</html>