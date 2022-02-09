<div>
<?php
include('../inc/config/config.php');
$o_id=$_SESSION['order_id'];
 $stqr=mysqli_query($conn,"SELECT * FROM `orders` where order_id=$o_id");
 $starr= mysqli_fetch_array($stqr);
                        if($starr['chef_update']==0){
                            echo '<div class="col-md-6">
                                <p class="btn btn-primary btn-sm">
                                    <span class="fas fa-eye"></span> Waiting for confirmation by chef
                                </p>
                            </div>';
                        }
                        else if($starr['chef_update']==1){
                            echo '<div class="col-md-6">
                                <p class="btn btn-primary btn-sm">
                                    <span class="fas fa-eye"></span>Your order is Accepted
                                </p>
                            </div>';
                        }
                        else if($starr['chef_update']==2){
                            echo '<div class="col-md-6">
                                <p class="btn btn-primary btn-sm">
                                    <span class="fas fa-eye"></span>Your food is being cooked
                                </p>
                            </div>';
                        }else if($starr['chef_update']==3){
                            echo '<div class="col-md-6">
                                <p class="btn btn-success btn-sm">
                                    <span class="fas fa-eye"></span>On your way
                                </p>
                            </div>';
                        }
                        else if($starr['chef_update']==4){
                            echo '<div class="col-md-6">
                                <p class="btn btn-danger btn-sm">
                                    <span class="fas fa-eye"></span>Rejected
                                </p>
                            </div>';
                        }
                        ?>
</div>
