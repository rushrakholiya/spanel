<?php
include('header.php');
?>
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
                                    <h2>Nesletter</h2>                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                                        <thead>
                                            <tr class="headings">
                                                <th class="tickcol">
                                                    <input type="checkbox" class="tableflat">
                                                </th>
                                                <th>Product Title</th>
                                                <th class=" no-link last actioncol"><span class="nobr">Action</span>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        <?php 
                                            $stmt = $mysqli->prepare("SELECT id, title,mail_template FROM newsletters");                                        
                                            $stmt->execute();
                                            $stmt->store_result();                                          
                                            $stmt->bind_result($newsletterid,$title,$mail_template);
                                            while ($stmt->fetch()) { 
                                        ?> 
                                        <tr class="even pointer">
                                            <td class="a-center ">
                                                <input type="checkbox" class="tableflat">
                                            </td>
                                            <td class=" "><?php echo $title; ?> </td>
                                            <td class="last"><a href="<?php echo SITE_URL; ?>/add_newsletter?newsletterid=<?php echo $newsletterid; ?>" class="actionbtn1">Modify</a> <a onclick="return confirm('Are you sure?')" href="<?php echo SITE_URL; ?>/add_newsletter?newsletterid=<?php echo $newsletterid; ?>&action=delete" class="deletebtn">Delete</a>
                                            </td>
                                        </tr>  
                                        <?php } ?>                
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