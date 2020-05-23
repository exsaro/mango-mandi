<?php
  
    $farmerListData = $commonModel->getData('farmer_master','list','','');
    $i = 1;
?>

<table class="table table-hover" id="data-table">
                    <thead>
                        <tr>
                            <th>S NO</th>
                            <th>Farmer Name</th>
                            <th>Farmer Code</th>
                            <th>Village</th>
                            <th>Address</th>
                            <th>District</th>
                            <th>State</th>
                            <th>Country</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($farmerListData as $key => $value ){  ?> 
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $value['farmer_name']; ?></td>
                            <td><?php echo $value['farmer_code']; ?></td>
                            <td><?php echo $value['farmer_city']; ?></td>
                            <td><?php echo $value['farmer_address']; ?></td>
                            <td><?php echo $value['farmer_district']; ?></td>
                            <td><?php echo $value['farmer_state']; ?></td>
                            <td><?php echo $value['farmer_country']; ?></td>
                            <td class="text-right">
                                <ul class="nav justify-content-end">
                                    <li class="mr-3"><a title='<?php echo $lang['edit']; ?>' href='addFarmer.php?id=<?php echo $value['farmer_id'] ?>'><span class="material-icons">edit</span></a></li>
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
                                <a href="../Model/CommonModel.php?dId=<?php echo $value['farmer_id'] ?>&tb=f_m" class="btn btn-primary">Delete</a>
                            </div>
                            </div>
                        </div>
                        </div>
                    <?php $i++; } ?>    
                    </tbody>
                </table>