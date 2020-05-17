<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body class="modal-open">
    
    
    <!-- Modal -->
<div class="modal fade show" id="exampleModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="padding-right: 17px; display: block;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Choose Company</h5>
        </button>
      </div>
      <form action="">
      <div class="modal-body">
        
            <div class="form-group">
                <select class="custom-select">
                <option selected="">Select Company</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
                </select>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal-backdrop fade show"></div>
    <!-- Jquery  -->
    <script src="../js/jquery/jquery-3.3.1.min.js"></script>
    <!-- Validation Plug-in -->
    <script src="../js/Validation/jquery.validate.min.js"></script>
    <!--External Js  -->
    <script src="../js/script/login.js"></script>
    
</body>
</html>