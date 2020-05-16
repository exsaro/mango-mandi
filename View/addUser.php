<?php 
    include 'header.php';
    $title      = 'Add User';
    $editData   = [];
    $submitType = 'store';

    if(isset($_GET['id'])){
        $title      = 'Edit User';
        $userEditData = $commonModel->getData('user_master','edit',$_GET['id'],'user_id');
        $editData   = isset($userEditData[0]) ?  $userEditData[0] : [] ;
        $submitType = 'update';
    }
    
    $id          = isset($editData['user_id'])    ? $editData['user_id']      : '';
    $userName    = isset($editData['user_name'])  ? $editData['user_name']   : '';
    $password    = isset($editData['user_password'])   ? $editData['user_password']      : '';
    $status      = (isset($editData['status']) && $editData['status'] == 'IA')? 'IA': 'A';
?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="row justify-content-center">
                
                    <div class="col-md-10">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1><?php echo $title; ?></h1>
                    <a href="user.php" class="btn btn-secondary">Back</a>
                </div>
                <form action="../Model/UserMaster.php" method="post" autocomplete="off">
                    <input type="hidden" name="editId" value='<?php echo $id; ?>' />
                    <div class="card">
                    <div class="card-body">
                                <div class="form-group">
                                    <div class="d-flex align-items-center mb-2">
                                        <label class="mb-0" for="">User Name</label>
                                        <div class="custom-control custom-switch ml-4">
                                            <input type="checkbox" name="status" class="custom-control-input" id="customSwitch1" value='A'  <?php echo $status=='A'? 'checked' :''; ?> >
                                            <label class="custom-control-label" for="customSwitch1">Status</label>
                                        </div>
                                        </div>
                                        <input type="text" class="form-control" name="user_name" placeholder="Username" minlength=3 maxlength=100  value='<?php echo $userName; ?>' required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" class="form-control" name="user_password" placeholder="Password"  value='<?php echo $password; ?>' required minlength=3 maxlength=100 autocomplete="new-password">
                                </div>
                                
                                <div class="form-group text-right"><button  type="submit" name='<?php echo $submitType; ?>' class="btn btn-primary">Submit</button></div>
                                
                            </div>
                            
                        
                    </div>
                </div> 
                </form>  
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>

<?php include 'footer.php';?>