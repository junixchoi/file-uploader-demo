<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">

    <title>Image Uploader</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <h1>Image Uploader</h1>
      </div>
      <div class="row">
        <form enctype="multipart/form-data" id="file-upload-form">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="validatedCustomFile" accept=".jpg, .jpeg, .png, .gif" multiple lang="en">
            <label class="custom-file-label" for="validatedCustomFile"></label>
          </div>
        </form>
      </div>
      <br>
      <div class="row image-uploaded">
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo base_url(); ?>js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function () {
          $(document).on('change', ':file', function () {
              var fileUpload = $(this).get(0);
              var files = fileUpload.files;
              if (files.length != 0) {
                  var data = new FormData();
                  for (var i = 0; i < files.length ; i++) {
                      data.append('file', files[i]);

                      $.ajax({
                      xhr: function () {
                          var xhr = $.ajaxSettings.xhr();
                          xhr.upload.onprogress = function (e) {
                              console.log(Math.floor(e.loaded / e.total * 100) + '%');
                          };
                          return xhr;
                      },
                      contentType: false,
                      processData: false,
                      type: 'POST',
                      data: data,
                      url: '<?php echo base_url(); ?>index.php/uploader/',
                      success: function (response) {
                          console.log(response.data.file_name);
                          if (response.data.file_name != undefined) {
                          	$('.image-uploaded').append('<img src="<?php echo base_url(); ?>upload/temp/' + response.data.file_name + '" class="img-thumbnail col-md-2" style="height:100px;">');
                          }
                      }
                  });
                  }
              }
              $("#file-upload-form")[0].reset();
          });
      });
    </script>
  </body>
</html>