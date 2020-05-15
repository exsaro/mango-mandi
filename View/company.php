<?php 
    include 'header.php';
    $companyListData = $commonModel->getData('company_master','list','','');

    $i = 1;
?>
    <div class="container-fluid">
        <div class="row">
            <?php include 'sidebar.php';?>
            <div class="col-md-9 mt-5 ml-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h1><?php echo $lang['welcome_company']; ?></h1>
                    <a href="addCompany.php" class="btn btn-primary"><?php echo $lang['add_company'];?></a>
                </div>
                

                <table class="table table-hover" id="data-table">
                    <thead>
                        <tr>
                            <th><?php echo $lang['s_no'];?></th>
                            <th><?php echo $lang['company_name'];?></th>
                            <th><?php echo $lang['address'];?></th>
                            <th><?php echo $lang['city'];?></th>
                            <th><?php echo $lang['state'];?></th>
                            <th><?php echo $lang['country'];?></th>
                            <th><?php echo $lang['pincode'];?></th>
                            <th class="text-right"><?php echo $lang['action'];?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($companyListData as $key => $value ){  ?> 
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $value['company_name'] ?></td>
                                <td><?php echo $value['company_address'] ?></td>
                                <td><?php echo $value['city'] ?></td>
                                <td><?php echo $value['state'] ?></td>
                                <td><?php echo $value['country'] ?></td>
                                <td><?php echo $value['pincode'] ?></td>
                                <td class="text-right">
                                    <ul class="nav justify-content-end">
                                        <li class="mr-3"><a title='<?php echo $lang['edit'] ?>' href='addCompany.php?id=<?php echo $value['company_id'] ?>'><span class="material-icons">edit</span></a></li>
                                        <li><a href='../Model/CommonModel.php?dId=<?php echo $value['company_id'] ?>&tb=c_m' title='<?php echo $lang['delete'] ?>' ><span class="material-icons">delete</span></a></li>
                                    </ul>
                                </td>
                            </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include 'footer.php';?>