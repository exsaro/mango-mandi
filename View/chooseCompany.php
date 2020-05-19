<?php 
    session_start();
    if(isset($_SESSION['user_id'])){
      //DB Connection
      require "../DataBase/DBConnect.php";
      $dbConnection       = new DBConnect();
      $connected    = $dbConnection->dbConnect();
      $sql = "SELECT * FROM  company_master WHERE status != 'D'";
      $executeQuery   = mysqli_query($connected ,$sql); 
      $getData = [];

      if($executeQuery != '' && $executeQuery->num_rows > 0)
      {
          while($row = mysqli_fetch_assoc($executeQuery)){
              $getData[] = $row ;
          }
      } 
    }
    //Choose Company
    if(isset($_POST['selectCompany']))
    {
      if(isset($_POST['company']) && $_POST['company'] != ''){
          //Login Success
          include "../Common/Common.php";
          $commonData = new Common();

          $_SESSION['company_id']     = $_POST['company']; 
          
          $_SESSION['company_name']   = $commonData->getCompanyName($_POST['company']); 
          
          header("Location:../View/dashboard.php");
      }else{
          header("Location:./chooseCompany.php");
      }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/themes/bootstrap1.min.css">
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
      <form action="chooseCompany.php" method="post" id="adminCompany">
        <div class="modal-body">
          <div class="form-group">
              <select class="custom-select" name="company" onchange="changeTheme(event)" required>
              <option value="">Select Company</option>
              <?php foreach($getData as $key => $value ){ ?> 
                <option value='<?php echo $value['company_id']; ?>' ><?php echo $value['company_name']; ?> </option>
              <?php } ?>
              </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" name="selectCompany" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal-backdrop fade show"></div>

<?php include 'footer.php';?>

</body>
</html>