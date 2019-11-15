<?php include('header.php'); ?>
<script>window.csvpdf = '<?php echo SITE_URL."/js/datatables/tools/swf/copy_csv_xls_pdf.swf"; ?>' </script>
<!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                            	<?php  if($_REQUEST && $_REQUEST['alert'] == "delete") { ?>
                                    <div role="alert" class="alert alert-error alert-dismissible fade in">
                                        <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>
                                        </button>
                                        <strong>Delete</strong> sucessfully.
                                    </div>
                                <?php } ?>
                                <div class="x_title">
                                    <h2>View Registration</h2>                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th>
                                                    <input type="checkbox" class="tableflat">
                                                </th>
                                                <!--<th>Corporation Name </th>-->
                                                <th>Company Name </th>
                                                <th>Contact Name </th>
                                                <th>City </th>
                                                <!--<th>State </th>
                                                <th>Zip </th>-->
                                                <th>Date</th>
                                                <th class=" no-link last"><span class="nobr">Action</span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        	<?php                                         		
                                                    $stmt = $mysqli->prepare("SELECT DISTINCT `app_registerid`, `corporation_name`, `company_name`, `contact_name`, `address1`, `address2`, `city`, `state`, `zip`, `country`, `phone_no`, `fax`, `fein_number1`, `emailid`, `createdate`,app_register_master.`support_expiry_date`, `createip`, `applicationid`, `currentstatus`, `productid`, `store_id`, `pdb_file_allowed`, `dongal_verification_required`, `fein_number2`, `currentstatus` FROM app_register_master INNER JOIN app_register_service_master ON app_register_master.app_registerid =app_register_service_master.user_id WHERE app_register_service_master.current_status <> 0");
	                                                $stmt->execute();
	                                                $stmt->store_result();                 
	                                                $stmt->bind_result($app_registerid, $corporation_name, $company_name, $registered_person_name,$address_1,$address_2,$city,$state,$zip,$country,$phone,$fax_no,$fein_number_1,$emailID,$createdate,$support_expiry_date,$createip,$applicationid,$currentstatus,$productid,$store_id,$pdb_file_allowed,$dongal_verification_required,$fein_number_2,$currentstatus);
	                                                while ($stmt->fetch()) {
		                                                $dongalStmt = $mysqli->prepare("SELECT dongal_id FROM app_register_dongal_master WHERE app_registerid = '$app_registerid' LIMIT 1");
		                                                $dongalStmt->execute();
		                                                $dongalStmt->store_result();                  
		                                                $dongalStmt->bind_result($dongal_id);
		                                                $dongalStmt->fetch();

                                                    ?>
                                                    <tr class="even pointer">
		                                                <td class="a-center ">
		                                                    <input type="checkbox" class="tableflat">
		                                                </td>
		                                                <!--<td class=" ">< ?php echo $corporation_name; ?> <br /> <?php echo $address_1; ?> </td>-->
		                                                <td class=" "><?php echo $company_name; ?> </td>
		                                                <td class=" "><?php echo $registered_person_name; ?> <i class="success fa fa-long-arrow-up"></i>
		                                                </td>
		                                                <td class=" "><?php echo $city; ?></td>
		                                                <!--<td class=" ">< ?php echo $state; ?></td>
		                                                <td class="a-right a-right ">< ?php echo $zip; ?></td>-->
		                                                <td class="a-right a-right "><?php echo $createdate; ?></td>
		                                                <td class=" last"><a href="javascript:void(0);" data-toggle="modal" data-target=".bs-example-modal-lg-<?php echo $app_registerid; ?>" class="actionbtn1">View</a><a href="<?php echo SITE_URL; ?>/app_register?userid=<?php echo $app_registerid; ?>" class="actionbtn2">Modify</a><a onclick="return confirm('Are you sure?')" href="<?php echo SITE_URL; ?>/app_register?userid=<?php echo $app_registerid; ?>&action=delete" class="deletebtn">Delete</a>
		                                                </td>
		                                            </tr>  
		                                            <div class="modal fade bs-example-modal-lg-<?php echo $app_registerid; ?>" tabindex="-1" role="dialog" aria-hidden="true">
					                                    <div class="modal-dialog modal-lg">
					                                        <div class="modal-content">

					                                            <div class="modal-header">
					                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
					                                                </button>
                                                                    <?php $statusname = array("Inactive","Active","Extended");?>
					                                                <h4 class="modal-title" id="myModalLabel">#<?php echo $app_registerid; ?>-<?php echo$statusname[$currentstatus]; ?></h4>
					                                            </div>
					                                            <div class="modal-body">
					                                                <div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												Corporation Name :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">
                        												<?php echo $corporation_name; ?>
                        												</div>
                    												</div>

                    												
                    												<div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												Company Name :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">
                        												<?php echo $company_name; ?>
                        												</div>
                    												</div>

                    												<div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												Contact Name :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">
                        												<?php echo $registered_person_name; ?>
                        												</div>
                    												</div>

                    												<div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												Address 1 :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">
                        												<?php echo $address_1; ?>
                        												</div>
                    												</div>


                    												<div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												Address 2 :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">
                        												<?php echo $address_2; ?>
                        												</div>
                    												</div>

                    												<div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												City :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">
                        												<?php echo $city; ?>
                        												</div>
                    												</div>

                    												<div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												State :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">
                        												<?php echo $state; ?>
                        												</div>
                    												</div>

                    												<div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												Zip :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">
                        												<?php echo $zip; ?>
                        												</div>
                    												</div>

                    												<div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												Country :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">
                        												<?php echo $country; ?>
                        												</div>
                    												</div>

                    												<div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												Phone No :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">
                        												<?php echo $phone_no; ?>
                        												</div>
                    												</div>

                    												<div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												Fax :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">
                        												<?php echo $fax_no; ?>
                        												</div>
                    												</div>

                    												<div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												Email ID :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">
                        												<?php echo $emailID; ?>
                        												</div>
                    												</div>

                    												<div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												Create Date :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">
                        												<?php echo $createdate; ?>
                        												</div>
                    												</div>

                    												<div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												Create IP :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">
                        												<?php echo $createip; ?>
                        												</div>
                    												</div>

                    												<div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												Product :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">									
                        												<?php echo get_product_name($mysqli,$productid) ? get_product_name($mysqli,$productid) : 
                        												"NONE"; ?>
                        												</div>
                    												</div>

                    												<div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												Fein Number 1 :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">
                        												<?php echo $fein_number_1; ?>
                        												</div>
                    												</div>

                    												<div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												Fein Number 2 :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">
                        												<?php echo $fein_number_2; ?>
                        												</div>
                    												</div>

                    												<div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												Store ID :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">
                        												<?php echo $store_id; ?>
                        												</div>
                    												</div>

                    												<div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												PDB File Allowed :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">
                        												<?php echo $pdb_file_allowed; ?>
                        												</div>
                    												</div>

                    												<div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												Support Expiry Date :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">
                        												<?php echo $support_expiry_date; ?>
                        												</div>
                    												</div>

                    												<div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												Dongal Verification Required :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">
                        												<?php echo $dongal_verification_required; ?>
                        												</div>
                    												</div>

                    												<div class="row">
                        												<div class="col-md-3 col-sm-3 col-xs-3">
                        												Dongal ID :
                        												</div>
                        												<div class="col-md-9 col-sm-9 col-xs-9">
                        												<?php echo $dongal_id ? $dongal_id : "NONE"; ?>
                        												</div>
                    												</div>

                                                                    <?php 
                                                                    $id = $_REQUEST["userid"];
                                                                    $services = $mysqli->prepare("SELECT service_id, user_id, current_status, support_expiry_date FROM app_register_service_master WHERE user_id = '$app_registerid' AND current_status <> 0");
                                                                    $services->execute();
                                                                    $services->store_result();                  
                                                                    $services->bind_result($service_id, $user_id, $current_status, $support_expiry_date);
                                                                ?>                                                               
                                                                <div class="row">
                                                                        <div class="col-md-3 col-sm-3 col-xs-3">Active Services :</div>
                                                                    <div class="col-md-9 col-sm-9 col-xs-9">
                                                                        <?php 
                                                                            while ($services->fetch()) {

                                                                                $html = "<button type='button' class='btn btn-info app-services ".$service_id."'>".get_service_name($mysqli,$service_id)."</button>";
                                                                                echo $html;
                                                                            }
                                                                        ?>
                                                                    </div>
                                                                </div>
					                                            </div>
					                                            <div class="modal-footer">
					                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                         
					                                            </div>

					                                        </div>
					                                    </div>
					                                </div> 
					                            <?php 
				                            	}
					                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- /page content -->
            </div>

        </div>

        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>
    
<?php include('footer.php'); ?>
<script>
	$(document).ready(function () {
        $('input.tableflat').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    });
</script>	
<script src="js/custom.js"></script>
<script src="js/datatables/js/jquery.dataTables.js"></script>
        <script src="js/datatables/tools/js/dataTables.tableTools.js"></script>
        <script>
            $(document).ready(function () {
                $('input.tableflat').iCheck({
                    checkboxClass: 'icheckbox_flat-green',
                    radioClass: 'iradio_flat-green'
                });
            });

            var asInitVals = new Array();
            $(document).ready(function () {
                var oTable = $('#example').dataTable({
                    "oLanguage": {
                        "sSearch": "Search all columns:"
                    },
                    "aoColumnDefs": [
                        {
                            'bSortable': false,
                            'aTargets': [0]
                        } //disables sorting for column one
        			],
        			'iDisplayLength': 10,
                    "sPaginationType": "full_numbers",
                    "dom": 'T<"clear">lfrtip',
                    "tableTools": { "sSwfPath": csvpdf }
                    });
                $("tfoot input").keyup(function () {
                    /* Filter on the column based on the index of this element's parent <th> */
                    oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
                });
                $("tfoot input").each(function (i) {
                    asInitVals[i] = this.value;
                });
                $("tfoot input").focus(function () {
                    if (this.className == "search_init") {
                        this.className = "";
                        this.value = "";
                    }
                });
                $("tfoot input").blur(function (i) {
                    if (this.value == "") {
                        this.className = "search_init";
                        this.value = asInitVals[$("tfoot input").index(this)];
                    }
                });
            });
        </script>