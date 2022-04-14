$(document).ready(function () {
  $("#train_data").DataTable(
    {
      "lengthMenu": [ 5 ]
    }
  );

  $("#upload_csv").on("click", function() {
    $("#csv").click();
  });

  $("#csv").change(function() {
    $("#submit_file").click();
  });
});