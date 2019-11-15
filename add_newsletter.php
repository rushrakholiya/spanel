<?php include('header.php'); ?> 
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

                            <?php  if($_REQUEST && $_REQUEST['alert'] == "mail_sent") { ?>
                                <div role="alert" class="alert alert-success alert-dismissible fade in">
                                    <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span>
                                    </button>
                                    <strong>Mail Sent to all</strong> sucessfully.
                                </div>
                            <?php } ?>

                            <div class="x_title">
                                <h2>Mail Template<small>Newsletter</small></h2>                                
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                            	<?php  
                                   
                                    if(isset($_REQUEST['send_mail_all']))
                                    {
                                        $newsletterid = $_REQUEST['mail_template_id'];
                                        $mailtemp_content = $mysqli->prepare("SELECT title,mail_template FROM newsletters WHERE id ='$newsletterid'");
                                        $mailtemp_content->execute();
                                        $mailtemp_content->store_result();                  
                                        $mailtemp_content->bind_result($title,$mail_template);
                                        $mailtemp_content->fetch();

                                        $stmt = $mysqli->prepare("SELECT emailid FROM app_register_master");                                        
                                        $stmt->execute();
                                        $stmt->store_result();                                          
                                        $stmt->bind_result($emailid);               
                                        $subject = $title;
                                        $meta_value = $mail_template;
                                        $cleanedFrom = "mike@jmscpos.com";
                                        $filename ="newsletter_log.txt";
                                        $headers = "From: " . $cleanedFrom . "\r\n";
                                        $headers .= "Reply-To: ". strip_tags($cleanedFrom) . "\r\n";
                                        $headers .= "MIME-Version: 1.0\r\n";
                                        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                        while ($stmt->fetch()) { 
                                            $to = $emailid;
                                            if($to != ""):
                                                if (mail($to, $subject, $meta_value, $headers)) {
                                                  $str = "#".$to."-"."Mail sent for ".$subject;
                                                } else {
                                                  $str = "#".$to."-"."Mail not sent for ".$subject;
                                                }   

                                                $fd = fopen($filename, "a");   
                                                fwrite($fd, $str . "\n");
                                                fclose($fd);
                                            endif;
                                        }
                                         header("location:".SITE_URL."/add_newsletter?newsletterid=$newsletterid&alert=mail_sent");
                                            die(); 

                                    } 
                                    if($_REQUEST['descr'] && $_REQUEST['descr'] != '' && isset($_REQUEST['insert']))
                                    {
                                        $title = $_REQUEST['title'];
                                        $meta_value = $_REQUEST['descr'];           
                                        $mysqli->query("INSERT INTO newsletters
                                         (title,mail_template)VALUES ('".$title."','".$meta_value."')");
                                         $newsletterid = mysqli_insert_id($mysqli);
                                        header("location:".SITE_URL."/add_newsletter?newsletterid=$newsletterid&alert=success");
                                            die();        
                                    }
                                    else if($_REQUEST['descr'] && $_REQUEST['descr'] != '' && isset($_REQUEST['update']))
                                    {
                                        $newsletterid = $_REQUEST['newsletterid'];
                                        $title = $_REQUEST['title'];
                                        $meta_value = $_REQUEST['descr'];
                                        $settingsUpdate = $mysqli->prepare("UPDATE newsletters SET `title` = '$title',`mail_template` = '$meta_value' WHERE id ='$newsletterid'");
                                        $settingsUpdate->execute();
                                        header("location:".SITE_URL."/add_newsletter?newsletterid=$newsletterid&alert=update");
                                        die();                                        
                                    }
                                ?>
                                <?php 
                                    if($_REQUEST['action'] && $_REQUEST['action'] =="delete")
                                    {
                                        $newsletterid = $_REQUEST['newsletterid'];
                                        $stmt = $mysqli->prepare("DELETE FROM newsletters WHERE id = ?");
                                        $stmt->bind_param('i', $newsletterid);
                                        $stmt->execute();     
                                        header("location:".SITE_URL."/view_newsletter?alert=delete");
                                        die();                                      
                                    }
                                ?>    
                                <form action="" method="post" class="form-horizontal form-label-left">
                                <div id="alerts"></div>
                                <?php 
                                    $newsletterid = $_REQUEST['newsletterid'];
                                    $mailtemp_content = $mysqli->prepare("SELECT id,title,mail_template FROM newsletters WHERE id ='$newsletterid'");
                                        $mailtemp_content->execute();
                                        $mailtemp_content->store_result();                  
                                        $mailtemp_content->bind_result($id,$title,$mail_template);
                                        $mailtemp_content->fetch();
                                ?>  
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Newsletter Title <span class="required">*</span>
                                        </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="title" name="title" required class="form-control col-md-7 col-xs-12" value="<?php echo strip_tags($title); ?>">
                                    </div>
                                </div>
                                <div class="form-group">         
                                    <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">
                                        <div class="btn-group">
                                            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa icon-font"></i><b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                            </ul>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="icon-text-height"></i>&nbsp;<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a data-edit="fontSize 5"><p style="font-size:17px">Huge</p></a>
                                                </li>
                                                <li><a data-edit="fontSize 3"><p style="font-size:14px">Normal</p></a>
                                                </li>
                                                <li><a data-edit="fontSize 1"><p style="font-size:11px">Small</p></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="icon-bold"></i></a>
                                            <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="icon-italic"></i></a>
                                            <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="icon-strikethrough"></i></a>
                                            <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="icon-underline"></i></a>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="icon-list-ul"></i></a>
                                            <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="icon-list-ol"></i></a>
                                            <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="icon-indent-left"></i></a>
                                            <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="icon-indent-right"></i></a>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="icon-align-left"></i></a>
                                            <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="icon-align-center"></i></a>
                                            <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="icon-align-right"></i></a>
                                            <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="icon-align-justify"></i></a>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="icon-link"></i></a>
                                            <div class="dropdown-menu input-append">
                                                <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
                                                <button class="btn" type="button">Add</button>
                                            </div>
                                            <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="icon-cut"></i></a>

                                        </div>

                                        <div class="btn-group">
                                            <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="icon-picture"></i></a>
                                            <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="icon-undo"></i></a>
                                            <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="icon-repeat"></i></a>
                                        </div>
                                    </div>

                                    <div id="editor">
                                        <?php                                            
                                            echo $mail_template;
                                        ?>
                                    </div>
                                    <textarea name="descr" id="descr" style="display:none;"></textarea>
                                    <input type="hidden" name="descr_ins_up" id="descr_ins_up" value="<?php echo strip_tags($meta_value); ?>" />
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
                                        <button type="submit" name="<?php echo $mailtemp_content->num_rows ? 'update' : 'insert'; ?>" class="xcxc btn btn-success">Submit</button>
                                        <?php if($mailtemp_content->num_rows) { 
                                        ?>
                                        <button type="submit" name="send_mail_all" class="xcxc btn btn-success">Send Mail</button>
                                        <input type="hidden" name="mail_template_id" id="mail_template_id" value="<?php echo $id; ?>" />
                                        <?php
                                        } ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                     </div>
                </div>
            </div>
        </div>
	</div>
<?php include('footer.php'); ?>