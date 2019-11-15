<?php include('header.php'); ?>
            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">                    
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>App Registration <small><?php echo SITE_NAME; ?></small></h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">                                    
                                    <?php        

                                        if($_REQUEST && isset($_REQUEST['app_registration_insert'])) {

                                            $corporation_name = $mysqli->real_escape_string($_REQUEST['corporation-name']);
                                            $company_name = $mysqli->real_escape_string($_REQUEST['company-name']);
                                            $registered_person_name = $mysqli->real_escape_string($_REQUEST['registered-person-name']);
                                            $address_1 = $mysqli->real_escape_string($_REQUEST['address-1']);
                                            $address_2 = $mysqli->real_escape_string($_REQUEST['address-2']);
                                            $city = $mysqli->real_escape_string($_REQUEST['city']);
                                            $state = $mysqli->real_escape_string($_REQUEST['state']);
                                            $zip = $mysqli->real_escape_string($_REQUEST['zip']);
                                            $country = $mysqli->real_escape_string($_REQUEST['country']);
                                            $phone = $mysqli->real_escape_string($_REQUEST['phone']);
                                            $fax_no = $mysqli->real_escape_string($_REQUEST['fax-no']);
                                            $fein_number_1 = $mysqli->real_escape_string($_REQUEST['fein_number1']);
                                            $fein_number_2 = $mysqli->real_escape_string($_REQUEST['fein_number2']);
                                            $email = $mysqli->real_escape_string($_REQUEST['email']);

                                            $createdate = date('Y-m-d');
                                            $support_expiry_date = date('Y-m-d',strtotime('+1 years'));

                                            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                                                $createip = $_SERVER['HTTP_CLIENT_IP'];
                                            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                                                $createip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                            } else {
                                                $createip = $_SERVER['REMOTE_ADDR'];
                                            }

                                            $applicationid = "null";
                                            $currentstatus = $_REQUEST['current_status'];
                                            $productid = $_REQUEST['productid'];
                                            $store_id = $_REQUEST['store_id'];
                                            $pdb_file_allowed = $_REQUEST['pdb_file_allowed'];
                                            $dongal_verification_required = $_REQUEST['dongal_verification_required'];
                                           
                                            $mysqli->query("INSERT INTO app_register_master (corporation_name,company_name,contact_name,address1,address2,city,state,zip,country,phone_no,fax,emailid,createdate,createip,applicationid,currentstatus,productid,support_expiry_date,store_id,pdb_file_allowed,dongal_verification_required,fein_number1,fein_number2)VALUES ('".$corporation_name."','".$company_name."','".$registered_person_name."','".$address_1."','".$address_2."','".$city."','".$state."','".$zip."','".$country."','".$phone."','".$fax_no."','".$email."', '".$createdate."' ,'".$createip."','".$applicationid."' ,".$currentstatus.",".$productid.", '".$support_expiry_date."' ,'".$store_id."','".$pdb_file_allowed."','".$dongal_verification_required."','".$fein_number_1."','".$fein_number_2."')"); 
                                            $newuserid = mysqli_insert_id($mysqli);

                                            if($_REQUEST['dongal_id'] && $_REQUEST['dongal_id'] != "")
                                            {
                                                
                                                $dongal_id = explode(",",$_REQUEST['dongal_id']);

                                                foreach($dongal_id as $d_id)
                                                {
                                                    if(isdongalexists($mysqli,$d_id,$app_registerid) == $d_id)
                                                    {  
                                                        $dongalids = $mysqli->prepare("UPDATE app_register_dongal_master SET dongal_id = '".$d_id."' 
                                                            WHERE app_registerid = '$newuserid'");
                                                       $dongalids->execute();
                                                    }
                                                    else
                                                    {                
                                                        $mysqli->query("INSERT INTO app_register_dongal_master ( dongal_id ,app_registerid ) values ('" . $d_id ."',$newuserid)");
                                                    }
                                                } 
                                            }

                                            for($i =0; $i<count($_REQUEST['service']); $i++)
                                            {                                                
                                                $mysqli->query("INSERT INTO app_register_service_master (service_id,user_id,current_status,support_expiry_date) VALUES ('".$_REQUEST['service'][$i]."',$newuserid,'".$_REQUEST['service_status'][$i]."','".$_REQUEST['service_expirydate'][$i]."')"); 
                                            }
                                            
                                            header("location:".SITE_URL."/app_register?userid=$newuserid&alert=success");
                                            die();                                            
                                        }
                                        if($_REQUEST && isset($_REQUEST['app_registration_update'])) { 
                                                                              
                                            $corporation_name = $mysqli->real_escape_string($_REQUEST['corporation-name']);
                                            $company_name = $mysqli->real_escape_string($_REQUEST['company-name']);
                                            $registered_person_name = $mysqli->real_escape_string($_REQUEST['registered-person-name']);
                                            $address_1 = $mysqli->real_escape_string($_REQUEST['address-1']);
                                            $address_2 = $mysqli->real_escape_string($_REQUEST['address-2']);
                                            $city = $mysqli->real_escape_string($_REQUEST['city']);
                                            $state = $mysqli->real_escape_string($_REQUEST['state']);
                                            $zip = $mysqli->real_escape_string($_REQUEST['zip']);
                                            $country = $mysqli->real_escape_string($_REQUEST['country']);
                                            $phone = $mysqli->real_escape_string($_REQUEST['phone']);
                                            $fax_no = $mysqli->real_escape_string($_REQUEST['fax-no']);
                                            $fein_number_1 = $mysqli->real_escape_string($_REQUEST['fein_number1']);
                                            $fein_number_2 = $mysqli->real_escape_string($_REQUEST['fein_number2']);
                                            $email = $mysqli->real_escape_string($_REQUEST['email']);

                                            $createdate = date('Y-m-d');
                                            $support_expiry_date = date('Y-m-d',strtotime('+1 years'));

                                            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                                                $createip = $_SERVER['HTTP_CLIENT_IP'];
                                            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                                                $createip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                                            } else {
                                                $createip = $_SERVER['REMOTE_ADDR'];
                                            }

                                            $applicationid = "null";
                                            $currentstatus = $_REQUEST['current_status'];
                                            $productid = $_REQUEST['productid'];
                                            $store_id = $_REQUEST['store_id'];;
                                            $pdb_file_allowed =$_REQUEST['pdb_file_allowed'];
                                            $dongal_verification_required = $_REQUEST['dongal_verification_required']; 

                                            if($_REQUEST["userid"] && $_REQUEST["userid"])
                                            {
                                                $app_registerid = $_REQUEST['userid'];
                                            }
                                            else if($_REQUEST["userid_mod"] && $_REQUEST["userid_mod"])
                                            {
                                                $app_registerid = $_REQUEST['userid_mod'];
                                            }

                                            $stmt = $mysqli->prepare("UPDATE app_register_master SET corporation_name='$corporation_name',company_name='$company_name',contact_name='$registered_person_name',address1='$address_1',address2='$address_2',city='$city',state='$state',zip='$zip',country='$country',phone_no='$phone',fax='$fax_no',emailid='$email',createdate='$createdate',createip='$createip',applicationid='$applicationid',currentstatus='$currentstatus',productid='$productid',support_expiry_date = '$support_expiry_date',store_id = '$store_id',pdb_file_allowed = '$pdb_file_allowed',dongal_verification_required = '$dongal_verification_required',fein_number1 = '$fein_number_1',fein_number2 = '$fein_number_2' WHERE app_registerid ='$app_registerid'");                                            
                                            $stmt->execute();   

                                            if(isset($_REQUEST['dongal_id']))
                                            {                                                
                                                $alldongalIds = alldongal($mysqli,$app_registerid);
                                                $dongal_id = explode(",",$_REQUEST['dongal_id']);
                                                
                                                foreach($dongal_id as $d_id)
                                                {

                                                    if(isdongalexists($mysqli,$d_id,$app_registerid) == $d_id)
                                                    {                                                          
                                                        $dongalids = $mysqli->prepare("UPDATE app_register_dongal_master SET dongal_id = '".$d_id."' 
                                                            WHERE dongal_id = '".$d_id."' AND app_registerid = '$app_registerid'");
                                                        $dongalids->execute();
                                                    }
                                                    else
                                                    {     
                                                          
                                                        
                                                        $mysqli->query("INSERT ignore INTO app_register_dongal_master ( dongal_id ,app_registerid ) values ('" . $d_id ."',$app_registerid)");
                                                    }
                                                    unset($alldongalIds[$d_id]);
                                                }                                                
                                                if(count($alldongalIds) > 0)
                                                {         
                                                    //$dongal_ids = implode($alldongalIds, ",");                    
                                                    foreach($alldongalIds as $donID)
                                                    {
                                                        if(ctype_digit($donID))
                                                        {
                                                            $dongals = $mysqli->prepare("DELETE FROM app_register_dongal_master WHERE dongal_id = ".$donID." AND app_registerid = '$app_registerid'");
                                                            $dongals->execute();
                                                        }
                                                        else
                                                        {
                                                            $dongals = $mysqli->prepare("DELETE FROM app_register_dongal_master WHERE dongal_id = '$donID' AND app_registerid = '$app_registerid'");
                                                            $dongals->execute();
                                                        } 
                                                    }                    
                                                }
                                                
                                                                                             
                                            }


                                            if($_REQUEST['service'] && $_REQUEST['service'] != "")
                                            {
                                                //print "<pre>"; print_r($_REQUEST); print "</pre>"; exit;
                                                if($_REQUEST["userid"] && $_REQUEST["userid"])
                                                {
                                                    $id = $_REQUEST["userid"];
                                                }
                                                else if($_REQUEST["userid_mod"] && $_REQUEST["userid_mod"])
                                                {
                                                    $id = $_REQUEST["userid_mod"];
                                                }
                                                $services = $mysqli->prepare("SELECT service_id FROM app_register_service_master WHERE user_id = '$id'");
                                                $services->execute();
                                                $services->store_result();                  
                                                $services->bind_result($service_id);
                                                $parametere = array();
                                                while ($services->fetch()) {
                                                    $parametere[] = $service_id;
                                                }
                                                for($i =0; $i<count($_REQUEST['service']); $i++)
                                                {         
                                                    $service_id = $_REQUEST["service"][$i];
                                                    if($service_id && in_array($service_id, $parametere)!= "")
                                                    {                    
                                                         
                                                        $service_current_status = $_REQUEST['service_status'][$i];       
                                                        $service_expiry_date = $_REQUEST['service_expirydate'][$i];
                                                        $number_of_user = $_REQUEST['number_of_user'][$i];                
                                                        $mysqli->query("UPDATE app_register_service_master SET service_id = '$service_id',user_id = '$id',current_status = '$service_current_status',support_expiry_date = '$service_expiry_date',number_of_user='$number_of_user' WHERE user_id = '$id' AND service_id = '$service_id'" );
                                                    }
                                                    else
                                                    {
                                                        $mysqli->query("INSERT INTO app_register_service_master (service_id,user_id,current_status,support_expiry_date,number_of_user) VALUES ('".$_REQUEST['service'][$i]."',$id,'".$_REQUEST['service_status'][$i]."','".$_REQUEST['service_expirydate'][$i]."','".$_REQUEST['number_of_user'][$i]."')");
                                                    } 
                                                } 
                                            }
                                            header("location:".SITE_URL."/app_register.php?userid=".$app_registerid."&alert=update");
                                            die();                                            
                                        } 
                                    ?>  


                                    <?php 
                                        if($_REQUEST['action'] && $_REQUEST['action'] =="pdelete")
                                        {
                                            $userid = $_REQUEST['userid'];
                                            $service_id  = $_REQUEST["serviceid"];
                                            $currentstatus = 0;                                            
                                            $stmt = $mysqli->prepare("DELETE FROM app_register_service_master WHERE user_id = '$userid' AND service_id = '$service_id'");   
                                            
                                            $stmt->execute();     
                                            header("location:".SITE_URL."/view_register?alert=delete");
                                            die();                                      
                                        }
                                    ?>  

                                    <?php 
                                        if($_REQUEST['action'] && $_REQUEST['action'] =="delete")
                                        {
                                            $userid = $_REQUEST['userid'];
                                            $currentstatus = 0;                             
                                            $stmt = $mysqli->prepare("DELETE FROM  app_register_master WHERE app_registerid = '$userid'");
                                            $stmt->execute();     
                                            header("location:".SITE_URL."/view_register?alert=delete");
                                            die();                                      
                                        }
                                    ?>                                   
                                    <form id="app_registration" data-parsley-validate class="form-horizontal form-label-left" action="" method="post">
                                        <?php 

                                            if($_REQUEST && $_REQUEST['alert'] == "success")
                                            {            
                                                ?>
                                                <div role="alert" class="alert alert-success alert-dismissible fade in">
                                                    <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>
                                                    </button>
                                                    <strong>Insert</strong> sucessfully.
                                                </div>
                                                <?php
                                            }

                                            if($_REQUEST && $_REQUEST['alert'] == "update")
                                            {            
                                                ?>

                                                <div role="alert" class="alert alert-success alert-dismissible fade in">
                                                    <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>
                                                    </button>
                                                    <strong>Update</strong> sucessfully.
                                                </div>
                                                <?php
                                            }

                                            if($_REQUEST && $_REQUEST['userid'] != '')
                                            {
                                                $id = $_REQUEST['userid'];   

                                                $stmt = $mysqli->prepare("SELECT `app_registerid`, `corporation_name`, `company_name`, `contact_name`, `address1`, `address2`, `city`, `state`, `zip`, `country`, `phone_no`, `fax`, `fein_number1`, `emailid`, `createdate`,app_register_master.`support_expiry_date`, `createip`, `applicationid`, `currentstatus`, `productid`, `store_id`, `pdb_file_allowed`, `dongal_verification_required`, `fein_number2` FROM app_register_master INNER JOIN app_register_service_master ON app_register_master.app_registerid =app_register_service_master.user_id WHERE app_register_service_master.current_status && app_registerid = '$id'");
                                                $stmt->execute();
                                                $stmt->store_result();                 
                                                $stmt->bind_result($app_registerid, $corporation_name, $company_name, $registered_person_name,$address_1,$address_2,$city,$state,$zip,$country,$phone,$fax_no,$fein_number_1,$emailID,$createdate,$support_expiry_date,$createip,$applicationid,$currentstatus,$productid,$store_id,$pdb_file_allowed,$dongal_verification_required,$fein_number_2);
                                                $stmt->fetch();
                                                $dongalStmt = $mysqli->prepare("SELECT dongal_id FROM app_register_dongal_master WHERE app_registerid = '$id'");
                                                $dongalStmt->execute();
                                                $dongalStmt->store_result();                  
                                                $dongalStmt->bind_result($dongal_id);  
                                                while ($dongalStmt->fetch()) {
                                                    $dongal_id_arr[] = $dongal_id;
                                                }  
                                                $dongal_id = implode($dongal_id_arr, ",");
                                                                             
                                            }

                                            if($_REQUEST && $_REQUEST['userid_mod'] != '')
                                            {
                                                $id = $_REQUEST['userid_mod']; 
                                                $stmt = $mysqli->prepare("SELECT `app_registerid`, `corporation_name`, `company_name`, `contact_name`, `address1`, `address2`, `city`, `state`, `zip`, `country`, `phone_no`, `fax`, `fein_number1`, `emailid`, `createdate`,app_register_master.`support_expiry_date`, `createip`, `applicationid`, `currentstatus`, `productid`, `store_id`, `pdb_file_allowed`, `dongal_verification_required`, `fein_number2` FROM app_register_master WHERE  app_registerid = '$id'");
                                                $stmt->execute();
                                                $stmt->store_result();                 
                                                $stmt->bind_result($app_registerid, $corporation_name, $company_name, $registered_person_name,$address_1,$address_2,$city,$state,$zip,$country,$phone,$fax_no,$fein_number_1,$emailID,$createdate,$support_expiry_date,$createip,$applicationid,$currentstatus,$productid,$store_id,$pdb_file_allowed,$dongal_verification_required,$fein_number_2);
                                                $stmt->fetch();

                                                $dongalStmt = $mysqli->prepare("SELECT dongal_id FROM app_register_dongal_master WHERE app_registerid = '$id' LIMIT 1");
                                                $dongalStmt->execute();
                                                $dongalStmt->store_result();                  
                                                $dongalStmt->bind_result($dongal_id);
                                                $dongalStmt->fetch();                              
                                            }
                                        ?>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="corporation-name">Corporation Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="corporation-name" name="corporation-name" required="required" value="<?php echo $corporation_name; ?>" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="company-name">Company Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="company-name" value="<?php echo $company_name; ?>" name="company-name" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>  
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="registered-person-name">Registered Person Name <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="registered-person-name" name="registered-person-name" value="<?php echo $registered_person_name; ?>" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address-1">Address1 <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="address-1" value="<?php echo $address_1; ?>" name="address-1" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="address-2">Address2 <span class="required">&nbsp;</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="address-2" value="<?php echo $address_2; ?>" name="address-2" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>   
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city">City <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="city" name="city" value="<?php echo $city; ?>"required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>  
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="state">State <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="state" value="<?php echo $state; ?>" name="state" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>  
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="zip">Zip <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="zip" value="<?php echo $zip; ?>" name="zip" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="country">Country <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="country" value="<?php echo $country; ?>" name="country" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>   
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Phone Number</label>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <input type="text" value="<?php echo $phone; ?>" id="phone" class="form-control" data-inputmask="'mask' : '(999) 999-9999'" name="phone">
                                                <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                                            </div>
                                        </div>  
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fax-no">Fax No <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" value="<?php echo $fax_no; ?>" id="fax-no" name="fax-no" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div> 
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Fein Number 1[36#]</label>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <input type="text" id="fein-number" value="<?php echo $fein_number_1; ?>" class="form-control" data-inputmask="'mask' : '99-999[999999]'" name="fein_number1">
                                                <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                            </div>
                                        </div> 

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Fein Number 2[36#]</label>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <input type="text" id="fein-number-2" value="<?php echo $fein_number_2; ?>" class="form-control" data-inputmask="'mask' : '99-999[999999]'" name="fein_number2">
                                                <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                            </div>
                                        </div> 

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Store ID</label>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <input type="text" id="store-id" value="<?php echo $store_id; ?>" class="form-control" name="store_id">
                                                
                                            </div>
                                        </div> 

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-3">PDB File Allowed</label>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <select required="" class="form-control" id="pdb-file-allowed" data-parsley-id="8069" name="pdb_file_allowed">
                                                    <option <?php if($pdb_file_allowed == 1) { echo "selected=selected"; } ?> value="1">Yes</option>
                                                    <option value="0" <?php if($pdb_file_allowed == 0) { echo "selected=selected"; } ?>>No</option>                
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Dongal Verification Required</label>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                
                                                <select required="" class="form-control" id="dongal_verification_required" data-parsley-id="8069" name="dongal_verification_required">
                                                    <option <?php if($dongal_verification_required == 1) { echo "selected=selected"; } ?> value="1">Yes</option>
                                                    <option value="0" <?php if($dongal_verification_required == 0) { echo "selected=selected"; } ?>>No</option>                
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-3">Dongal ID</label>
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <textarea placeholder="xxxx, xxxx" value="" rows="3" class="form-control" name="dongal_id"><?php echo $dongal_id; ?></textarea>
                                                <small>enter multiple separated by comma(.)</small>
                                            </div>                                            
                                            
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fax-no">Product <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <?php echo get_products($mysqli,$productid); ?>
                                            </div>
                                        </div>

                                        <?php 
                                            $where = "user_id = '$id'";
                                            if($_REQUEST["userid"] && $_REQUEST["userid"] !="")
                                            {
                                                $id = $_REQUEST["userid"];
                                                $where = "user_id = '$id' AND current_status <> 0";
                                            }     
                                            else if($_REQUEST["userid_mod"] && $_REQUEST["userid_mod"])
                                            {
                                                $id = $_REQUEST["userid_mod"];
                                                $where = "user_id = '$id'";
                                            }
                                           
                                            $services = $mysqli->prepare("SELECT service_id, user_id, current_status, support_expiry_date,number_of_user FROM app_register_service_master WHERE ".$where);
                                            

                                            $services->execute();
                                            $services->store_result();                  
                                            $services->bind_result($service_id, $user_id, $current_status, $support_expiry_date,$number_of_user);
                                        ?>
                                        <?php if($services->num_rows > 0 ) { $style="display:block"; } else { $style="display:none"; }?>
                                        <div class="form-group services" style="<?php echo $style; ?>">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"> <?php if($_REQUEST["userid"] && $_REQUEST["userid"] !="")
                                            { ?> Active Services : <?php } else { ?> Inactive Services : <?php } ?>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12 active-services">
                                                <?php 
                                                    while ($services->fetch()) {

                                                        $html = "<button id='".get_service_name($mysqli,$service_id)."' type='button' class='btn btn-info app-services ".get_service_name($mysqli,$service_id)."'>".get_service_name($mysqli,$service_id)."</button>";
                                                        $html .="<input id='service_".get_service_name($mysqli,$service_id)."' type='hidden' name='service[]' value=".$service_id." />";
                                                        $html .="<input id='service_status_".get_service_name($mysqli,$service_id)."' type='hidden' name='service_status[]' value=".$current_status." />";
                                                        $html .="<input id='service_expirydate_".get_service_name($mysqli,$service_id)."' type='hidden' name='service_expirydate[]' value=".$support_expiry_date." />";
                                                        $html .="<input id='service_number_user_".get_service_name($mysqli,$service_id)."' type='hidden' name='number_of_user[]' value=".$number_of_user." />";
                                                        echo $html;
                                                    }
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                            <button  type="button" class="btn btn-app" id="add_service">
                                                <i class="fa fa-plus-square"></i>Service
                                            </button>
                                            </div>
                                        </div>

                                        <div class="service-module" style="display:none;">

                                            <div class="form-group">                                        
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Service :
                                                </label>    
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <?php echo get_services($mysqli,$service_id); ?>
                                                </div>
                                            </div> 

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Current Status</label>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <select required="" class="form-control" id="current_status" data-parsley-id="8069" name="current_status">
                                                        <option <?php if($currentstatus == 1) { echo "selected=selected"; } ?> value="1">Active</option>
                                                        <option value="0" <?php if($currentstatus == 0) { echo "selected=selected"; } ?>>Inactive</option>
                                                        <option value="2" <?php if($currentstatus == 2) { echo "selected=selected"; } ?>>Extended</option>                
                                                    </select>
                                                </div>                                            
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Support Expiry Date</label>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <input type="text" id="support-expire-date" value="<?php echo $support_expiry_date; ?>" class="form-control" name="support-expire-date">
                                                    <span class="fa fa-calendar form-control-feedback right" aria-hidden="true"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-3">Number of Users</label>
                                                <div class="col-md-6 col-sm-6 col-xs-6">
                                                    <input type="text" id="support-number-users" value="<?php echo $number_of_user; ?>" class="form-control" name="support-number-users" onkeypress="return isNumber(event)">
                                                    <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                    <button type="button" id="save_service" class="btn btn-default">Save</button>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fax-no">Email Address <span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="email" value="<?php echo $emailID; ?>" id="email"  name="email" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>                  
                                        <!-- <div class="form-group">                                           
                                            <label class="col-md-9 col-sm-9 col-xs-9 col-md-offset-3">
                                                <div class="icheckbox_flat-green checked" style="position: relative;"><input type="checkbox" class="flat terms-check" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins></div> I agree to terms and conditions of JMSC Software.
                                            </label>
                                        </div> -->
                                        <div class="ln_solid"></div>                                        
                                        <div class="form-group">
                                        <?php if($stmt->num_rows) { $name = "app_registration_update"; } else { $name = "app_registration_insert"; } ?>
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                                <button type="submit" class="btn btn-primary">Cancel</button>
                                                <button type="submit" id="app_reg" class="btn btn-success" name="<?php echo $name; ?>">Submit</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>                                                       
                </div>
            </div>
            <!-- /page content -->  
<?php include('footer.php'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#add_service").click(function(){
            
            $(".service-module").slideToggle();
            
        });

        $("body").on("click",".app-services",function(){
            
            console.log($("#service_"+$(this).attr("id")).val());
            $("#serviceid").val($("#service_"+$(this).attr("id")).val());
            $("#current_status").val($("#service_status_"+$(this).attr("id")).val());
            $("#support-expire-date").val($("#service_expirydate_"+$(this).attr("id")).val());
            $("#support-number-users").val($("#service_number_user_"+$(this).attr("id")).val());

            $(".service-module").slideDown();

        });

        $("#save_service").click(function(){

            if($("#serviceid").val() == 0)
            {
                alert("please select service");
                return false;
            }
            if($("#support-expire-date").val() == "")
            {
                alert("please add support expiry date");
                return false;
            }

            var servicename = $("#serviceid option:selected").text();

            if($(".active-services button").hasClass(servicename) && $("#serviceid").val() != 0)
            {
                var html = "<button type='button' id='"+servicename+"' class='btn btn-info app-services "+ servicename+"'>"+servicename+"</button>";
                $("#service_"+servicename).val($("#serviceid").val());
                $("#service_status_"+servicename).val($("#current_status").val());
                $("#service_expirydate_"+servicename).val($("#support-expire-date").val());
                $("#service_number_user_"+servicename).val($("#support-number-users").val());
            }
            else
            {
                var html = "<button type='button' id='"+servicename+"' class='btn btn-info app-services "+ servicename+"'>"+servicename+"</button>";
                html +="<input type='hidden' id='service_"+servicename+"' name='service[]' value="+$("#serviceid").val()+" />";
                html +="<input type='hidden' id='service_status_"+servicename+"' name='service_status[]' value="+$("#current_status").val()+" />";
                html +="<input type='hidden' id='service_expirydate_"+servicename+"' name='service_expirydate[]' value="+$("#support-expire-date").val()+" />";
                html +="<input type='hidden' id='service_number_user_"+servicename+"' name='number_of_user[]' value="+$("#support-number-users").val()+" />";
                $(".active-services").append(html);
            }
            $(".services").show();
            $(".service-module").slideUp();
        });
    });
function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>