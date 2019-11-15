<?php
if (!function_exists('sec_session_start')) {
    function sec_session_start() {
        $session_name = 'sec_session_id';   // Set a custom session name
        $secure = SECURE;
        // This stops JavaScript being able to access the session id.
        $httponly = true;
        // Forces sessions to only use cookies.
        if (ini_set('session.use_only_cookies', 1) === FALSE) {
            header("Location: error.php?err=Could not initiate a safe session (ini_set)");
            exit();
        }
        // Gets current cookies params.
        $cookieParams = session_get_cookie_params();
        session_set_cookie_params($cookieParams["lifetime"],
            $cookieParams["path"], 
            $cookieParams["domain"], 
            $secure,
            $httponly);
        // Sets the session name to the one set above.
        session_name($session_name);
        if(!isset($_SESSION)){
            session_start();
        }        
        session_regenerate_id(true);    // regenerated the session, delete the old one. 
    }
}
if (!function_exists('login')) {
    function login($username, $password, $mysqli) {
        // Using prepared statements means that SQL injection is not possible. 
        if ($stmt = $mysqli->prepare("SELECT id, username, password, salt 
            FROM members
           WHERE username = ?
            LIMIT 1")) {
            $stmt->bind_param('s', $username);  // Bind "$email" to parameter.
            $stmt->execute();    // Execute the prepared query.
            $stmt->store_result();
            
            // get variables from result.
            $stmt->bind_result($user_id, $username, $db_password, $salt);
            $stmt->fetch();    
            // hash the password with the unique salt.
            $password = hash('sha512', $password);
            $password = hash('sha512', $password . $salt); 
            if ($stmt->num_rows == 1) {

                // If the user exists we check if the account is locked
                // from too many login attempts 
                
                if (checkbrute($user_id, $mysqli) == true) {
                    // Account is locked 
                    // Send an email to user saying their account is locked
                    return false;
                } else {
                    // Check if the password in the database matches
                    // the password the user submitted.
                    if ($db_password == $password) {
                        // Password is correct!
                        // Get the user-agent string of the user.
                        $user_browser = $_SERVER['HTTP_USER_AGENT'];
                        // XSS protection as we might print this value
                        $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                        $_SESSION['user_id'] = $user_id;
                        // XSS protection as we might print this value
                        $username = preg_replace("/[^a-zA-Z0-9_\-]+/", 
                                                                    "", 
                                                                    $username);
                        $_SESSION['username'] = $username;
                        $_SESSION['login_string'] = hash('sha512', 
                                  $password . $user_browser);
                        // Login successful.
                        return true;
                    } else {
                        // Password is not correct
                        // We record this attempt in the database
                        $now = time();
                        $mysqli->query("INSERT INTO login_attempts(user_id, time)
                                        VALUES ('$user_id', '$now')");
                        return false;
                    }
                }
            } else {
                // No user exists.
                return false;
            }
        }
    }
}

if (!function_exists('checkbrute')) {
    function checkbrute($user_id, $mysqli) {
        // Get timestamp of current time 
        $now = time();
     
        // All login attempts are counted from the past 2 hours. 
        $valid_attempts = $now - (2 * 60 * 60);
     
        if ($stmt = $mysqli->prepare("SELECT time 
                                 FROM login_attempts 
                                 WHERE user_id = ? 
                                AND time > '$valid_attempts'")) {
            $stmt->bind_param('i', $user_id);
     
            // Execute the prepared query. 
            $stmt->execute();
            $stmt->store_result();
     
            // If there have been more than 5 failed logins 
            if ($stmt->num_rows > 5) {
                return true;
            } else {
                return false;
            }
        }
    }
}

if (!function_exists('login_check')) {
    function login_check($mysqli) {
        // Check if all session variables are set 
        if (isset($_SESSION['user_id'], 
                            $_SESSION['username'], 
                            $_SESSION['login_string'])) {
     
            $user_id = $_SESSION['user_id'];
            $login_string = $_SESSION['login_string'];
            $username = $_SESSION['username'];
     
            // Get the user-agent string of the user.
            $user_browser = $_SERVER['HTTP_USER_AGENT'];
     
            if ($stmt = $mysqli->prepare("SELECT password 
                                          FROM members 
                                          WHERE id = ? LIMIT 1")) {
                // Bind "$user_id" to parameter. 
                $stmt->bind_param('i', $user_id);
                $stmt->execute();   // Execute the prepared query.
                $stmt->store_result();
     
                if ($stmt->num_rows == 1) {
                    // If the user exists get variables from result.
                    $stmt->bind_result($password);
                    $stmt->fetch();
                    $login_check = hash('sha512', $password . $user_browser);
     
                    if ($login_check == $login_string) {
                        // Logged In!!!! 
                        return true;
                    } else {
                        // Not logged in 
                        return false;
                    }
                } else {
                    // Not logged in 
                    return false;
                }
            } else {
                // Not logged in 
                return false;
            }
        } else {
            // Not logged in 
            return false;
        }
    }
}


if (!function_exists('esc_url')) {
    function esc_url($url) {
     
        if ('' == $url) {
            return $url;
        }
     
        $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
     
        $strip = array('%0d', '%0a', '%0D', '%0A');
        $url = (string) $url;
     
        $count = 1;
        while ($count) {
            $url = str_replace($strip, '', $url, $count);
        }
     
        $url = str_replace(';//', '://', $url);
     
        $url = htmlentities($url);
     
        $url = str_replace('&amp;', '&#038;', $url);
        $url = str_replace("'", '&#039;', $url);
     
        if ($url[0] !== '/') {
            // We're only interested in relative links from $_SERVER['PHP_SELF']
            return '';
        } else {
            return $url;
        }
    }
}
?>
<?php 
if (!function_exists('get_username')) {
    function get_username($mysqli)
    {
        $stmt = $mysqli->prepare("SELECT id, username, password, salt 
        FROM members LIMIT 1");                                        
        $stmt->execute();
        $stmt->store_result();                                          
        $stmt->bind_result($user_id, $username, $db_password, $salt);
        $stmt->fetch();
        return $username;
    }
}
?>
<?php 
if (!function_exists('get_products')) {
    function get_products($mysqli,$productidSelected="")
    {
        $stmt = $mysqli->prepare("SELECT productid,title 
        FROM productmaster");                                        
        $stmt->execute();
        $stmt->store_result();                                          
        $stmt->bind_result($productid,$title);
        $html ="<select name='productid' id='productid' required='' class='form-control'>";
        $html .="<option value='0'>SELECT PRODUCT</option>";
        while ($stmt->fetch()) {
            if($productidSelected == $productid)
            {                
                $html .= "<option value='$productid' selected=selected>$title</option>";
            }
            else
            {
                $html .= "<option value='$productid'>$title</option>";
            }
        }
        $html .="</select>";
        return $html;
    }
}
?>
<?php 
if (!function_exists('get_users')) {
    function get_users($mysqli,$productidSelected="")
    {
        $stmt = $mysqli->prepare("SELECT app_registerid, corporation_name 
                                                FROM app_register_master where currentstatus <> 0");                                        
        $stmt->execute();
        $stmt->store_result();                                          
        $stmt->bind_result($app_registerid,$corporation_name);
        $html ="<select data-placeholder='Choose a user...' class='chosen-select' name='userid' id='userid' required='' class='form-control' style='width:100%;'>";
        $html .="<option value='0'>SELECT USER</option>";
        while ($stmt->fetch()) {
            if($productidSelected == $app_registerid)
            {                
                $html .= "<option value='$app_registerid' selected=selected>$corporation_name</option>";
            }
            else
            {
                $html .= "<option value='$app_registerid'>$corporation_name</option>";
            }
        }
        $html .="</select>";
        return $html;
    }
}
?>
<?php 
if (!function_exists('get_services')) {
    function get_services($mysqli,$productidSelected="")
    {
        $stmt = $mysqli->prepare("SELECT serviceid, title 
                                                FROM servicemaster");                                        
        $stmt->execute();
        $stmt->store_result();                                          
        $stmt->bind_result($app_registerid,$corporation_name);

        $html ="<select data-placeholder='Choose a service...' class='chosen-select form-control' name='serviceid' id='serviceid' required='' class='form-control' style='width:100%;' >";
        $html .="<option value='0'>SELECT SERVICE</option>"; 
        while ($stmt->fetch()) {
            if($productidSelected == $app_registerid)
            {                
                $html .= "<option value='$app_registerid' selected=selected>$corporation_name</option>";
            }
            else
            {
                $html .= "<option value='$app_registerid'>$corporation_name</option>";
            }
        }
        $html .="</select>";
        return $html;
    }
}
?>
<?php 
if (!function_exists('get_site_url')) {
    function get_site_url($mysqli)
    {
        $stmt = $mysqli->prepare("select meta_value from options where meta_key ='site_url'");                                       
        $stmt->execute();
        $stmt->store_result();                                          
        $stmt->bind_result($site_url);
        $stmt->fetch();
        return $site_url;
    }
}
?>
<?php 
if (!function_exists('get_site_name')) {
    function get_site_name($mysqli)
    {

        $stmt = $mysqli->prepare(" select meta_value from options where meta_key ='site_name'");                                        
        $stmt->execute();
        $stmt->store_result();                                          
        $stmt->bind_result($site_name);
        $stmt->fetch();
        return $site_name;
    }
}
?>
<?php 
if (!function_exists('get_product_name')) {
    function get_product_name($mysqli,$productid)
    {
        $stmt = $mysqli->prepare("select title from productmaster where productid ='$productid'");
        $stmt->execute();
        $stmt->store_result();                                          
        $stmt->bind_result($title);
        $stmt->fetch();
        return $title;
    }
}


if (!function_exists('get_corporation_name')) {
    function get_corporation_name($mysqli,$userid)
    {
        $stmt = $mysqli->prepare("select corporation_name from app_register_master where app_registerid ='$userid'");
        $stmt->execute();
        $stmt->store_result();                                          
        $stmt->bind_result($corporation_name);
        $stmt->fetch();
        return $corporation_name;
    }
}

if (!function_exists('get_service_name')) {
    function get_service_name($mysqli,$serviceid)
    {
        $stmt = $mysqli->prepare("select title from servicemaster where serviceid ='$serviceid'");
        $stmt->execute();
        $stmt->store_result();                                          
        $stmt->bind_result($title);
        $stmt->fetch();
        return $title;
    }
}

if (!function_exists('cleanInput')) {
function cleanInput($input) {
 
  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );
 
    $output = preg_replace($search, '', $input);
    return $output;
  }
}

if (!function_exists('sanitize')) {
    function sanitize($input) {
        if (is_array($input)) {
            foreach($input as $var=>$val) {
                $output[$var] = sanitize($val);
            }
        }
        else {
            if (get_magic_quotes_gpc()) {
                $input = stripslashes($input);
            }
            $input  = cleanInput($input);
            $output = mysql_real_escape_string($input);
        }
        return $output;
    }
}

if (!function_exists('finsettingval')) {
    function finsettingval($mysqli,$fName)
    {

        $stmt = $mysqli->prepare("select meta_value from options where meta_key ='$fName'");
        $stmt->execute();
        $stmt->store_result();                                          
        $stmt->bind_result($meta_value);
        $stmt->fetch();
        return $meta_value;      
    }
}

if (!function_exists('isdongalexists')) {
    function isdongalexists($mysqli,$dongal_id,$app_registerid)
    {
        $stmt = $mysqli->prepare("SELECT dongal_id FROM app_register_dongal_master WHERE app_registerid = '$app_registerid' AND dongal_id='$dongal_id' LIMIT 1");
        $stmt->execute();
        $stmt->store_result();                                          
        $stmt->bind_result($dongal_id);
        $stmt->fetch();
        return $dongal_id;      
    }
}

if (!function_exists('alldongal')) {
    function alldongal($mysqli,$app_registerid)
    {

        $services = $mysqli->prepare("SELECT dongal_id FROM app_register_dongal_master WHERE app_registerid = '$app_registerid'");
        $services->execute();
        $services->execute();
        $services->store_result();                  
        $services->bind_result($dongal_id);
        $parametere = array();
        while ($services->fetch()) {
            $dongal_ids[$dongal_id] = $dongal_id;
        }        
        return $dongal_ids;      
    }
}
?>
<?php sec_session_start(); ?>