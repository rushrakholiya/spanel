<?php include('header.php'); ?>
 <!-- page content -->
    <div class="right_col" role="main">
        <div class="">                    
            <div class="clearfix"></div>
            	<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Change Password</h2>                                
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">                               
                                <form id="profile" class="form-horizontal form-label-left" method="post">
                                	<?php if($_REQUEST && isset($_REQUEST['pass_submit']) ) { ?>
                                		<?php
                                			$username = $_REQUEST['username'];
                                			$password = $_REQUEST['p'];
                                			$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));	
										    $password = hash('sha512', $password . $random_salt);
                                			$stmt = $mysqli->prepare("UPDATE members SET username = ? , password = ?, salt = ? ");
                                            $stmt->bind_param('sss',$username,$password,$random_salt);
                                            $isRedirect = $stmt->execute();
                                            if($isRedirect)
                                            {
										      header('Location: '.SITE_URL.'/index.php');                      
                                            }
                                		?>
                                	<?php } ?>
                                	<div class="form-group">
                                		<?php 
                                			$username = get_username($mysqli);
                                		?>
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username <span class="required">&nbsp;</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="username" name="username" required class="form-control col-md-7 col-xs-12" value="<?php echo $username; ?>">
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">New Password <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="new-password" name="new_password" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm Password</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="confirm-password" class="form-control col-md-7 col-xs-12" type="text" name="confirm_password">
                                        </div>
                                    </div>
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button type="submit" class="btn btn-primary">Cancel</button>
                                            <button type="submit" name="pass_submit" class="btn btn-success" onclick="return regformhash(this.form,this.form.username,
                                   this.form.new_password,this.form.confirm_password);" >Submit</button>
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