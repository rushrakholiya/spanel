<?php include('header.php'); ?> 
<!-- page content -->
    <div class="right_col" role="main">
        <div class="">                    
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Mail Template<small>Notifications</small></h2>                                
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <?php                                                                      
                                    if($_REQUEST['descr'] && $_REQUEST['descr'] != '' && $_REQUEST['descr_ins_up'] == "")
                                    {
                                        $meta_key = "mail_template";
                                        $meta_value = $mysqli->real_escape_string($_REQUEST['descr']);
                                        $mysqli->query("INSERT INTO options (meta_key,meta_value)VALUES ('".$meta_key."','".$meta_value."')");       
                                    }
                                    else if($_REQUEST['descr'] && $_REQUEST['descr'] != '' && $_REQUEST['descr_ins_up'] != "")
                                    {
                                        $meta_key = "mail_template";
                                        $meta_value = $mysqli->real_escape_string($_REQUEST['descr']);
                                        $settingsUpdate = $mysqli->prepare("UPDATE options SET `meta_value` = '$meta_value' WHERE meta_key ='$meta_key'");
                                        $settingsUpdate->execute();                                        
                                    }


                                    if($_REQUEST['one_month_expiration_message'] && $_REQUEST['one_month_expiration_message'] != '' && $_REQUEST['one_month_expiration_message_ins_up'] == "")
                                    {
                                        $meta_key = "one_month_expiration_message";
                                        $meta_value = $mysqli->real_escape_string($_REQUEST['one_month_expiration_message']);
                                        $mysqli->query("INSERT INTO options (meta_key,meta_value)VALUES ('".$meta_key."','".$meta_value."')");
                                    }
                                    else if($_REQUEST['one_month_expiration_message'] && $_REQUEST['one_month_expiration_message'] != '' && $_REQUEST['one_month_expiration_message_ins_up'] != "")
                                    {
                                        $meta_key = "one_month_expiration_message";
                                        $meta_value = $mysqli->real_escape_string($_REQUEST['one_month_expiration_message']);
                                        $settingsUpdate = $mysqli->prepare("UPDATE options SET `meta_value` = '$meta_value' WHERE meta_key ='$meta_key'");
                                        $settingsUpdate->execute(); 
                                    }

                                    if($_REQUEST['one_week_expiration_message'] && $_REQUEST['one_week_expiration_message'] != '' && $_REQUEST['one_week_expiration_message_ins_up'] == "")
                                    {
                                        $meta_key = "one_week_expiration_message";
                                        $meta_value = $mysqli->real_escape_string($_REQUEST['one_week_expiration_message']);
                                        $mysqli->query("INSERT INTO options (meta_key,meta_value)VALUES ('".$meta_key."','".$meta_value."')");
                                    }
                                    else if($_REQUEST['one_week_expiration_message'] && $_REQUEST['one_week_expiration_message'] != '' && $_REQUEST['one_week_expiration_message_ins_up'] != "")
                                    {
                                        $meta_key = "one_week_expiration_message";
                                        $meta_value = $mysqli->real_escape_string($_REQUEST['one_week_expiration_message']);
                                        $settingsUpdate = $mysqli->prepare("UPDATE options SET `meta_value` = '$meta_value' WHERE meta_key ='$meta_key'");
                                        $settingsUpdate->execute(); 
                                    }

                                    if($_REQUEST['one_day_expiration_message'] && $_REQUEST['one_day_expiration_message'] != '' && $_REQUEST['one_day_expiration_message_ins_up'] == "")
                                    {
                                        $meta_key = "one_day_expiration_message";
                                        $meta_value = $mysqli->real_escape_string($_REQUEST['one_day_expiration_message']);
                                        $mysqli->query("INSERT INTO options (meta_key,meta_value)VALUES ('".$meta_key."','".$meta_value."')");
                                    }
                                    else if($_REQUEST['one_day_expiration_message'] && $_REQUEST['one_day_expiration_message'] != '' && $_REQUEST['one_day_expiration_message_ins_up'] != "")
                                    {
                                        $meta_key = "one_day_expiration_message";
                                        $meta_value = $mysqli->real_escape_string($_REQUEST['one_day_expiration_message']);
                                        $settingsUpdate = $mysqli->prepare("UPDATE options SET `meta_value` = '$meta_value' WHERE meta_key ='$meta_key'");
                                        $settingsUpdate->execute(); 
                                    }

                                    if($_REQUEST['site_name'] && $_REQUEST['site_name'] != '' && $_REQUEST['site_name_ins_up'] == "")
                                    {
                                        $meta_key = "site_name";
                                        $meta_value = $mysqli->real_escape_string($_REQUEST['site_name']);
                                        $mysqli->query("INSERT INTO options (meta_key,meta_value)VALUES ('".$meta_key."','".$meta_value."')");
                                    }
                                    else if($_REQUEST['site_name'] && $_REQUEST['site_name'] != '' && $_REQUEST['site_name_ins_up'] != "")
                                    {
                                        $meta_key = "site_name";
                                        $meta_value = $mysqli->real_escape_string($_REQUEST['site_name']);
                                        $settingsUpdate = $mysqli->prepare("UPDATE options SET `meta_value` = '$meta_value' WHERE meta_key ='$meta_key'");
                                        $settingsUpdate->execute(); 
                                    }

                                    if($_REQUEST['site_url'] && $_REQUEST['site_url'] != '' && $_REQUEST['site_url_ins_up'] == "")
                                    {
                                        $meta_key = "site_url";
                                        $meta_value = $mysqli->real_escape_string($_REQUEST['site_url']);
                                        $mysqli->query("INSERT INTO options (meta_key,meta_value)VALUES ('".$meta_key."','".$meta_value."')");      
                                    }
                                    else if($_REQUEST['site_url'] && $_REQUEST['site_url'] != '' && $_REQUEST['site_url_ins_up'] != "")                                    
                                    {
                                        $meta_key = "site_url";
                                        $meta_value = $mysqli->real_escape_string($_REQUEST['site_url']);
                                        $settingsUpdate = $mysqli->prepare("UPDATE options SET `meta_value` = '$meta_value' WHERE meta_key ='$meta_key'");
                                        $settingsUpdate->execute(); 
                                    }

                                    if($_REQUEST['ftp_password'] && $_REQUEST['ftp_password'] != '' && $_REQUEST['ftp_password_ins_up'] == "")
                                    {
                                        $meta_key = "ftp_password";
                                        $meta_value = $mysqli->real_escape_string($_REQUEST['ftp_password']);
                                        $mysqli->query("INSERT INTO options (meta_key,meta_value)VALUES ('".$meta_key."','".$meta_value."')");      
                                    }
                                    else if($_REQUEST['ftp_password'] && $_REQUEST['ftp_password'] != '' && $_REQUEST['ftp_password_ins_up'] != "")                                    
                                    {
                                        $meta_key = "ftp_password";
                                        $meta_value = $mysqli->real_escape_string($_REQUEST['ftp_password']);
                                        $settingsUpdate = $mysqli->prepare("UPDATE options SET `meta_value` = '$meta_value' WHERE meta_key ='$meta_key'");
                                        $settingsUpdate->execute(); 
                                    }
                                    if($_REQUEST['ftp_username'] && $_REQUEST['ftp_username'] != '' && $_REQUEST['ftp_username_ins_up'] == "")
                                    {
                                        $meta_key = "ftp_username";
                                        $meta_value = $mysqli->real_escape_string($_REQUEST['ftp_username']);
                                        $mysqli->query("INSERT INTO options (meta_key,meta_value)VALUES ('".$meta_key."','".$meta_value."')");      
                                    }
                                    else if($_REQUEST['ftp_username'] && $_REQUEST['ftp_username'] != '' && $_REQUEST['ftp_username_ins_up'] != "")                                    
                                    {
                                        $meta_key = "ftp_username";
                                        $meta_value = $mysqli->real_escape_string($_REQUEST['ftp_username']);
                                        $settingsUpdate = $mysqli->prepare("UPDATE options SET `meta_value` = '$meta_value' WHERE meta_key ='$meta_key'");
                                        $settingsUpdate->execute(); 
                                    }
                                    if($_REQUEST['ftp_url'] && $_REQUEST['ftp_url'] != '' && $_REQUEST['ftp_url_ins_up'] == "")
                                    {
                                        $meta_key = "ftp_url";
                                        $meta_value = $mysqli->real_escape_string($_REQUEST['ftp_url']);
                                        $mysqli->query("INSERT INTO options (meta_key,meta_value)VALUES ('".$meta_key."','".$meta_value."')");      
                                    }
                                    else if($_REQUEST['ftp_url'] && $_REQUEST['ftp_url'] != '' && $_REQUEST['ftp_url_ins_up'] != "")                                    
                                    {
                                        $meta_key = "ftp_url";
                                        $meta_value = $mysqli->real_escape_string($_REQUEST['ftp_url']);
                                        $settingsUpdate = $mysqli->prepare("UPDATE options SET `meta_value` = '$meta_value' WHERE meta_key ='$meta_key'");
                                        $settingsUpdate->execute(); 
                                    }
                                    if($sqlInsert)
                                    {
                                        ?>
                                        <div class="alert alert-success">
                                          <strong>Successfully</strong> inserted.
                                        </div>
                                        <?php
                                    }
                                    if($sqlUpdate)
                                    {
                                        ?>
                                        <div class="alert alert-success">
                                          <strong>Update</strong> successfully.
                                        </div>
                                        <?php
                                    }
                                
                                ?>
                                <form action="" method="post" class="form-horizontal form-label-left">
                                <div id="alerts"></div>
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
                                            $mailtemp_content = $mysqli->prepare("SELECT meta_value FROM options WHERE meta_key ='mail_template'");
                                            $mailtemp_content->execute();
                                            $mailtemp_content->store_result();                  
                                            $mailtemp_content->bind_result($meta_value);
                                            $mailtemp_content->fetch();
                                            echo $meta_value;
                                        ?>
                                    </div>
                                    <textarea name="descr" id="descr" style="display:none;"></textarea>
                                    <input type="hidden" name="descr_ins_up" id="descr_ins_up" value="<?php echo strip_tags($meta_value); ?>" />
                                </div>
                                <div class="ln_solid"></div>
                                
                                <div class="form-group">
                                    <label class="text-left col-md-2 col-sm-2 col-xs-12" for="one_month_expiration_message_ins_up">One Month Expiration Message
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <?php                                             
                                            $one_month_expiration_message = $mysqli->prepare("SELECT meta_value FROM options WHERE meta_key ='one_month_expiration_message'");
                                            $one_month_expiration_message->execute();
                                            $one_month_expiration_message->store_result();                  
                                            $one_month_expiration_message->bind_result($one_month_expiration_message);
                                            $one_month_expiration_message->fetch();                    
                                        ?>
                                        <input type="text" id="one_month_expiration_message_ins_up" name="one_month_expiration_message" value="<?php echo $one_month_expiration_message; ?>" required class="form-control col-md-12 col-xs-12">
                                        <input type="hidden" name="one_month_expiration_message_ins_up" id="one_month_expiration_message_ins_up" value="<?php echo $one_month_expiration_message; ?>" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="text-left col-md-2 col-sm-2 col-xs-12" for="site_name">One Week Expiration Message
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <?php                                             
                                            $one_week_expiration_message = $mysqli->prepare("SELECT meta_value FROM options WHERE meta_key ='one_week_expiration_message'");
                                            $one_week_expiration_message->execute();
                                            $one_week_expiration_message->store_result();                  
                                            $one_week_expiration_message->bind_result($one_week_expiration_message);
                                            $one_week_expiration_message->fetch();                    
                                        ?>
                                        <input type="text" id="one_week_expiration_message" name="one_week_expiration_message" value="<?php echo $one_week_expiration_message; ?>" required class="form-control col-md-12 col-xs-12">
                                        <input type="hidden" name="one_week_expiration_message_ins_up" id="one_week_expiration_message_ins_up" value="<?php echo $one_week_expiration_message; ?>" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="text-left col-md-2 col-sm-2 col-xs-12" for="site_name">One Day Expiration Message
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <?php                                             
                                            $one_day_expiration_message = $mysqli->prepare("SELECT meta_value FROM options WHERE meta_key ='one_day_expiration_message'");
                                            $one_day_expiration_message->execute();
                                            $one_day_expiration_message->store_result();                  
                                            $one_day_expiration_message->bind_result($one_day_expiration_message);
                                            $one_day_expiration_message->fetch();                    
                                        ?>
                                        <input type="text" id="site_name" name="one_day_expiration_message" value="<?php echo $one_day_expiration_message; ?>" required class="form-control col-md-12 col-xs-12">
                                        <input type="hidden" name="one_day_expiration_message_ins_up" id="one_day_expiration_message_ins_up" value="<?php echo $one_day_expiration_message; ?>" />
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="text-left col-md-2 col-sm-2 col-xs-12" for="site_name">Site Name 
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <?php 
                                            $sitename_content = $mysqli->prepare("SELECT meta_value FROM options WHERE meta_key ='site_name'");
                                            $sitename_content->execute();
                                            $sitename_content->store_result();                  
                                            $sitename_content->bind_result($meta_value);
                                            $sitename_content->fetch();                     
                                        ?>
                                        <input type="text" id="site_name" name="site_name" value="<?php echo $meta_value; ?>" required class="form-control col-md-12 col-xs-12">
                                        <input type="hidden" name="site_name_ins_up" id="site_name_ins_up" value="<?php echo $meta_value; ?>" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="text-left col-md-2 col-sm-2 col-xs-12" for="site_url">Site URL 
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <?php 
                                            $siteurl_content = $mysqli->prepare("SELECT meta_value FROM options WHERE meta_key ='site_url'");
                                            $siteurl_content->execute();
                                            $siteurl_content->store_result();                  
                                            $siteurl_content->bind_result($meta_value);
                                            $siteurl_content->fetch();
                                        ?>                                        
                                        <input type="text" id="site_url" name="site_url" required class="form-control col-md-12 col-xs-12" value="<?php echo $meta_value; ?>">
                                        <input type="hidden" name="site_url_ins_up" id="site_url_ins_up" value="<?php echo $meta_value; ?>" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="text-left col-md-2 col-sm-2 col-xs-12" for="ftp_password">Customer updates download FTP password  
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <?php 
                                            $siteurl_content = $mysqli->prepare("SELECT meta_value FROM options WHERE meta_key ='ftp_password'");
                                            $siteurl_content->execute();
                                            $siteurl_content->store_result();                  
                                            $siteurl_content->bind_result($meta_value);
                                            $siteurl_content->fetch();
                                        ?>                                        
                                        <input type="text" id="ftp_password" name="ftp_password" required class="form-control col-md-12 col-xs-12" value="<?php echo $meta_value; ?>">
                                        <input type="hidden" name="ftp_password_ins_up" id="ftp_password_ins_up" value="<?php echo $meta_value; ?>" />
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="text-left col-md-2 col-sm-2 col-xs-12" for="ftp_password">Customer updates download FTP user name  
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <?php 
                                            $siteurl_content = $mysqli->prepare("SELECT meta_value FROM options WHERE meta_key ='ftp_username'");
                                            $siteurl_content->execute();
                                            $siteurl_content->store_result();                  
                                            $siteurl_content->bind_result($meta_value);
                                            $siteurl_content->fetch();
                                        ?>                                        
                                        <input type="text" id="ftp_username" name="ftp_username" required class="form-control col-md-12 col-xs-12" value="<?php echo $meta_value; ?>">
                                        <input type="hidden" name="ftp_username_ins_up" id="ftp_username_ins_up" value="<?php echo $meta_value; ?>" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="text-left col-md-2 col-sm-2 col-xs-12" for="ftp_url">Customer updates download FTP URL  
                                    </label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <?php 
                                            $siteurl_content = $mysqli->prepare("SELECT meta_value FROM options WHERE meta_key ='ftp_url'");
                                            $siteurl_content->execute();
                                            $siteurl_content->store_result();                  
                                            $siteurl_content->bind_result($meta_value);
                                            $siteurl_content->fetch();
                                        ?>                                        
                                        <input type="text" id="ftp_url" name="ftp_url" required class="form-control col-md-12 col-xs-12" value="<?php echo $meta_value; ?>">
                                        <input type="hidden" name="ftp_url_ins_up" id="ftp_url_ins_up" value="<?php echo $meta_value; ?>" />
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
                                        <input type="submit" name="submit" class="xcxc btn btn-default" value="Submit" />
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <!-- page conent -->
<?php
include('footer.php');
?>