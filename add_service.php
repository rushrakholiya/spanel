<?php include_once 'header.php'; ?>
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

                            <div class="x_title">
                                <h2>Add Service</h2>                                
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content"> 
                            	<?php if($_REQUEST['service_title'] && $_REQUEST['service_title'] != "" && isset($_REQUEST['insert'])) { ?>
                            		<?php 
                            			$title = $_REQUEST['service_title'];
                            			$mysqli->query("INSERT INTO servicemaster(title)
                                    	VALUES ('$title')"); 
                                    	$serviceid = mysqli_insert_id($mysqli);
                                    	header("location:".SITE_URL."/add_service?serviceid=$serviceid&alert=success");
                                            die(); 
                                    ?> 
                            	<?php } else if($_REQUEST['service_title'] && $_REQUEST['service_title'] != "" && isset($_REQUEST['update'])) {
                            		$serviceid = $_REQUEST['serviceid'];
                                	$stmt = $mysqli->prepare("UPDATE servicemaster SET title = ?
									   WHERE serviceid = ?");
									$stmt->bind_param('si', $_REQUEST['service_title'],$serviceid
									   );
									$stmt->execute();
									header("location:".SITE_URL."/add_service?serviceid=$serviceid&alert=update");
                                    die();
								} ?> 
								<?php 
									if($_REQUEST['action'] && $_REQUEST['action'] =="delete")
									{
										$serviceid = $_REQUEST['serviceid'];
										$stmt = $mysqli->prepare("DELETE FROM servicemaster WHERE serviceid = ?");
										$stmt->bind_param('i', $serviceid);
										$stmt->execute();     
										header("location:".SITE_URL."/view_service?alert=delete");
										die();	                            		
									}
								?>                             
                                <form id="profile" class="form-horizontal form-label-left" method="post">
                                	<div class="form-group">                                		
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Service Title <span class="required">*</span>
                                        </label>     
                                        <?php 
	                                        if($_REQUEST && $_REQUEST['serviceid'] != '')
	                                        { 
	                                        	$stmt = $mysqli->prepare("SELECT title 
									                                      FROM servicemaster 
									                                      WHERE serviceid = ? LIMIT 1");
									            // Bind "$user_id" to parameter. 
									            $stmt->bind_param('i', $_REQUEST['serviceid']);
									            $stmt->execute();   // Execute the prepared query.
									            $stmt->store_result();
								            	if ($stmt->num_rows == 1) {
							                	// If the user exists get variables from result.
							                		$stmt->bind_result($title);
							                		$stmt->fetch();
							                	}
	                                        }	                                        
                                        ?>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="service_title" name="service_title" required class="form-control col-md-7 col-xs-12" value="<?php echo $title; ?>">
                                        </div>
                                    </div>                                    
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="submit" class="btn btn-primary">Cancel</button>
                                            <button type="submit" name="<?php echo $stmt->num_rows ? 'update' : 'insert'; ?>" class="btn btn-success">Submit</button>
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