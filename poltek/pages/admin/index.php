<?php
error_reporting(0);
  session_start();
  require_once "config.php";

  if(isset($_POST['login'])){

    $username=$_POST['username'];
    $password=$_POST['password'];

    $sql = mysql_query("Select * from tb_admin where username = '$username' and password = '$password'");
    $row = mysql_fetch_array($sql);

    if($password == $row['password']){
      $_SESSION['admin'] = $row['username'];
      header('Location:home.php');
    }
    else{
      unset($_POST['login']);
      header('Location:index.php?submit=error');
    }
  }
?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Polkesma</title>
    <link rel="icon" type="image/png" href="../../img/logo.png" />
    <!-- Bootstrap Core CSS -->
    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" name = "form" method = "post" action = "index.php">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type = "submit" name = "login" value = "Login" class="btn btn-success">
    <?php 
    if($_GET['submit']=='error'){
        echo '<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-ok"></span> Username atau Password Salah</div>';
    }
    else if($_GET['submit']=='logout'){
        echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok"></span> Anda sudah logout</div>';
        }
    else if($_GET['submit']=='login'){
        echo '<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon-ok"></span> Silahkan Login </div>';
        }
    ?>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- jQuery -->
    <script src="../../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

</body>

</html>
