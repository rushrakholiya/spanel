<?php include('header.php'); ?> 
	<!-- page content -->
    <div class="right_col" role="main">
        <div class="">                    
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Mail Template<small>Newsletter</small></h2>                                
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                            	<?php                                                                      
                                    if($_REQUEST['descr'] && $_REQUEST['descr'] != '' && $_REQUEST['descr_ins_up'] == "")
                                    {
                                        $meta_key = "message";
                                        $meta_value = $_REQUEST['descr'];           
                                        $mysqli->query("INSERT INTO options (meta_key,meta_value)VALUES ('".$meta_key."','".$meta_value."')");        
                                    }
                                    else if($_REQUEST['descr'] && $_REQUEST['descr'] != '' && $_REQUEST['descr_ins_up'] != "")
                                    {
                                        $meta_key = "message";
                                        $meta_value = $_REQUEST['descr'];
                                        $settingsUpdate = $mysqli->prepare("UPDATE options SET `meta_value` = '$meta_value' WHERE meta_key ='$meta_key'");
                                        $settingsUpdate->execute();                                        
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
                                            $mailtemp_content = $mysqli->prepare("SELECT meta_value FROM options WHERE meta_key ='message'");
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
<?php include('footer.php'); ?>