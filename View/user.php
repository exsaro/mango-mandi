<?php 
    include 'header.php';
    $userListData = $commonModel->getData('user_master','list','','');
    $userTypeData = $commonModel->getData('user_type_master','list','','');
    $userTpe=[];
    foreach($userTypeData as $key => $value ){
        $userTpe[$value['user_type_id']] = $value['user_type_name'];
    }

    $i = 1;
?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1>Welcome User</h1>
                    <?php if($_SESSION['user_type_id'] == 1){ ?> <a href="addUser.php" class="btn btn-primary">Add User</a><?php } ?>
                </div>
                

                <table class="table table-hover" id="data-table">
                    <thead>
                        <tr>
                            <th>S NO</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>User Type</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($userListData as $key => $value ){  ?> 
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $value['user_name']; ?></td>
                                <td><?php echo $value['user_password']; ?></td>
                                <td><?php echo $userTpe[$value['user_type_id']] ; ?></td>
                                <td class="text-right">
                                    <ul class="nav justify-content-end">
                                        <li class="mr-3"><a title='<?php echo $lang['edit']; ?>' href='addUser.php?id=<?php echo $value['user_id'] ?>'><span class="material-icons">edit</span></a></li>
                                        <li><a id="delete" href='#delete<?php echo $i ?>' data-toggle="modal" title='<?php echo $lang['delete'] ?>' ><span class="material-icons">delete</span></a></li>
                                    </ul>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id='delete<?php echo $i ?>' tabindex="-1" role="dialog" aria-labelledby="delete1ModalModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="delete1ModalModalLabel">Delete</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Do you want to Delete the Record.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <a href="../Model/CommonModel.php?dId=<?php echo $value['user_id'] ?>&tb=u_m" class="btn btn-primary">Delete</a>
                                </div>
                                </div>
                            </div>
                            </div>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include 'footer.php';?>