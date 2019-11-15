<?php 

if (version_compare(PHP_VERSION, "5.4.0", ">="))
{
ob_start(null, 0, PHP_OUTPUT_HANDLER_STDFLAGS ^ PHP_OUTPUT_HANDLER_REMOVABLE);
}
else
{
ob_start(null, 0, false);
}
?>
<?php     
    include('db_connect.php');
    include('function.php');         
    define("SITE_URL", get_site_url($mysqli)); 
    define("SITE_NAME", get_site_name($mysqli));
?>
<?php if(login_check($mysqli) !== true): ?>
<?php header('Location: '.SITE_URL.'/index.php'); ?>
<?php endif; ?>
<?php
    function currentPageURL() {
        $curpageURL = 'http';
        if ($_SERVER["HTTPS"] == "on") {
            $curpageURL.= "s";
        }
        $curpageURL.= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $curpageURL.= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } 
        else {
            $curpageURL.= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
        return $curpageURL;
    }    
?>