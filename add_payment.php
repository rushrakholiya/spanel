<?php include_once 'header.php'; ?>
<link href="<?php echo SITE_URL; ?>/css/chosen.css" rel="stylesheet">
 <!-- page content -->
    <div class="right_col" role="main">
        <div class="">                    
            <div class="clearfix"></div>
            	<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                        	<?php  if($_REQUEST && $_REQUEST['alert'] == "success") { ?>
	                        	<div role="alert" class="alert alert-success alert-dismissible fade in">
	                                <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>
	                                </button>
	                                <strong>Insert</strong> sucessfully.
	                            </div>
	                        <?php } ?>

	                        <?php  if($_REQUEST && $_REQUEST['alert'] == "update") { ?>
	                        	<div role="alert" class="alert alert-success alert-dismissible fade in">
	                                <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>
	                                </button>
	                                <strong>Update</strong> sucessfully.
	                            </div>
	                        <?php } ?>
                            <?php 
                                if($_REQUEST['action'] && $_REQUEST['action'] =="delete")
                                {
                                    $paymentid = $_REQUEST['paymentid'];
                                    $stmt = $mysqli->prepare("DELETE FROM payments WHERE id = ?");
                                    $stmt->bind_param('i', $paymentid);
                                    $stmt->execute();     
                                    header("location:".SITE_URL."/view_payment?alert=delete");
                                    die();                                      
                                }
                            ?> 
                            <div class="x_title">
                                <h2>Add Payment</h2>                                
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">   
                                <?php 
                                    if($_REQUEST && isset($_REQUEST['payment_insert'])) { 

                                        $user_id = $_REQUEST['userid'];
                                        $serviceid = $_REQUEST['serviceid'];
                                        $payment_date = $_REQUEST['payment_date'];
                                        $payment_mode = $_REQUEST['payment_mode'];

                                        $mysqli->query("INSERT INTO payments(user_id,service_id,payment_date,payment_mode)
                                        VALUES ('$user_id','$serviceid','$payment_date','$payment_mode')"); 
                                        $paymentid = mysqli_insert_id($mysqli);
                                        header("location:".SITE_URL."/add_payment?paymentid=$paymentid&alert=success");
                                            die();
                                    } else if($_REQUEST && isset($_REQUEST['payment_update'])) { 


                                        $paymentid = $_REQUEST['paymentid'];
                                        $userid = $_REQUEST['userid'];
                                        $serviceid = $_REQUEST['serviceid'];
                                        $payment_date = $_REQUEST['payment_date'];
                                        $paymentmode = $_REQUEST['payment_mode'];

                                        $stmt = $mysqli->prepare("UPDATE payments SET user_id = '$userid', service_id ='$serviceid' , payment_date = '$payment_date',payment_mode = '$paymentmode' WHERE id = '$paymentid'");
                                        $stmt->execute();
                                        header("location:".SITE_URL."/add_payment?paymentid=$paymentid&alert=update");
                                        die();

                                    }
                                ?>     
                                <form id="profile" class="form-horizontal form-label-left" method="post">
                                    <?php 
                                        if($_REQUEST && $_REQUEST['paymentid'] != '')
                                        {                                             
                                            $stmt = $mysqli->prepare("SELECT user_id,service_id,payment_date,payment_mode 
                                                                      FROM payments 
                                                                      WHERE id = ? LIMIT 1");
                                            // Bind "$user_id" to parameter. 
                                            $stmt->bind_param('i', $_REQUEST['paymentid']);
                                            $stmt->execute();   // Execute the prepared query.
                                            $stmt->store_result();
                                            if ($stmt->num_rows == 1) {
                                            // If the user exists get variables from result.
                                                $stmt->bind_result($user_id,$service_id,$payment_date,$payment_mode);
                                                $stmt->fetch();
                                            }
                                        }                                           
                                    ?>
                                	<div class="form-group">                                		
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Corporation Name :
                                        </label>    
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <?php echo get_users($mysqli,$user_id); ?>
                                        </div>
                                    </div>  
                                    <div class="form-group">                                        
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Service :
                                        </label>    
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <?php echo get_services($mysqli,$service_id); ?>
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Payment Date <span class="required">*</span>
                                        </label>     
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="payment_date" name="payment_date" required class="form-control col-md-7 col-xs-12" value="<?php echo $payment_date; ?>">
                                            <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                                        </div>
                                    </div>  

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Payment Mode/Description <span class="required">*</span>
                                        </label>     
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="payment_mode" name="payment_mode" required class="form-control col-md-7 col-xs-12" value="<?php echo $payment_mode; ?>">                                            
                                        </div>
                                    </div> 

                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <?php if($stmt->num_rows) { $name = "payment_update"; } else { $name = "payment_insert"; } ?>
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="submit" class="btn btn-primary">Cancel</button>
                                            <button type="submit" name="<?php echo $name; ?>" class="btn btn-success">Submit</button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php include_once 'footer.php'; ?>
<script type="text/JavaScript" src="js/chosen.jquery.js"></script> 
 <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
 </script>