<?php 
    ob_start();
    include_once 'db_connect.php';
    include_once 'function.php';
    define("SITE_URL", get_site_url($mysqli)); 
    define("SITE_NAME", get_site_name($mysqli));  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo SITE_NAME; ?></title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/icheck/flat/green.css" rel="stylesheet">


    <script src="js/jquery.min.js"></script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#F7F7F7;">
    
    <div class="">
        <a class="hiddenanchor" id="toregister"></a>
        <a class="hiddenanchor" id="tologin"></a>

        <div id="wrapper">
            <div id="login" class="animate form">
                <section class="login_content">
                    <?php 
                    if (isset($_POST['username'], $_POST['p'])) {
                        $username = $_POST['username'];
                        $password = $_POST['p']; // The hashed password.
                     
                        if (login($username, $password, $mysqli) == true) {
                            // Login success 
                            header('Location: '.SITE_URL.'/view_register');
                        } else {
                            // Login failed 
                            header('Location: '.SITE_URL.'/index.php?error=1');
                        }
                    } 
                    ?>
                    <form action="" method="post">
                        <h1>Login</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" required="" name="username" />
                        </div>
                        <div>
                            <input type="password" class="form-control" name="p" placeholder="Password" required="" />
                        </div>
                        <div>
                            <input type="submit" value="Log in" class="btn btn-default submit" />                            
                        </div>
                        <div class="clearfix"></div>    
                        <?php if(isset($_REQUEST['error']) && $_REQUEST['error'] == "1"): ?>
                            <div class="alert alert-danger">
                              Username or Password is wrong
                            </div>
                        <?php endif; ?>                    
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
            <div id="register" class="animate form">
                <section class="login_content">
                    <form>
                        <h1>Create Account</h1>
                        <div>
                            <input type="text" class="form-control" placeholder="Username" required="" />
                        </div>
                        <div>
                            <input type="email" class="form-control" placeholder="Email" required="" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" required="" />
                        </div>
                        <div>
                            <a class="btn btn-default submit" href="index.html">Submit</a>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">

                            <p class="change_link">Already a member ?
                                <a href="#tologin" class="to_register"> Log in </a>
                            </p>
                            <div class="clearfix"></div>
                            
                        </div>
                    </form>
                    <!-- form -->
                </section>
                <!-- content -->
            </div>
        </div>
    </div>

</body>

</html>
<?php ob_flush(); ?>