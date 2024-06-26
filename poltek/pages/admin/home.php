<?php
error_reporting(1);
session_start();
if(!isset($_SESSION['admin'])){
  header("location:index.php?submit=login");
}
  require_once "config.php";

  $admin = $_SESSION['admin'];
?>
<!DOCTYPE html>
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
    <link href="../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../css/sb-admin.css" rel="stylesheet">
    <link href="../../css/bootstrap-select.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../../css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../../js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />

    <link href="../../dist/bootstrap-clockpicker.css" rel="stylesheet" />
    <link href="../../dist/bootstrap-clockpicker.min.css" rel="stylesheet" />
    <link href="../../dist/jquery-clockpicker.css" rel="stylesheet" />
    <link href="../../dist/jquery-clockpicker.min.css" rel="stylesheet" />
    <link href="../../src/clockpicker.css" rel="stylesheet" />
    <link href="../../src/standalone.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../css/bootstrap-datetimepicker.css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home.php">Polkesma</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['admin'] ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="index.php?submit=logout"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="home.php"><i class="glyphicon glyphicon-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="glyphicon glyphicon-hdd"></i> Master Data <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li>
                                <a href="home.php?pages=posisi">Posisi Kelas</a>
                            </li>
                            <li>
                                <a href="home.php?pages=master_kelas">Ruang Kelas</a>
                            </li>
                            <li>
                                <a href="home.php?pages=jurusan">Jurusan</a>
                            </li>
                            <li>
                                <a href="home.php?pages=prodi">Prodi</a>
                            </li>
                            <!--<li>
                                <a href="home.php?pages=jam">Jam</a>
                            </li>-->
                            <li>
                                <a href="home.php?pages=tingkat">Tingkat</a>
                            </li>
                            <li>
                                <a href="home.php?pages=matkul">Mata Kuliah</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="home.php?pages=jadwal"><i class="fa fa-fw fa-dashboard"></i> Penjadwalan Reguler</a>
                    </li>
                    <li>
                        <a href="home.php?pages=jadwaltemp"><i class="fa fa-fw fa-dashboard"></i> Penjadwalan Sementara</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <?php include "pages.php"; ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->

    <script src="../../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/bootstrap-select.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../../js/plugins/morris/raphael.min.js"></script>
    <script src="../../js/plugins/morris/morris.min.js"></script>
    <script src="../../js/plugins/morris/morris-data.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="../../js/dataTables/jquery-1.11.3.min.js"></script>
    <script src="../../js/dataTables/jquery.dataTables.js"></script>
    <script src="../../js/dataTables/dataTables.bootstrap.js"></script>
    <script src="../../js/dataTables/dataTables.responsive.js"></script>
    <script src="../../js/dataTables/jquery.dataTables.js"></script>
    <script src="../../js/dataTables/jquery.dataTables.min.js"></script>

    <script src="../../dist/bootstrap-clockpicker.js"></script>
    <script src="../../dist/bootstrap-clockpicker.min.js"></script>
    <script src="../../dist/jquery-clockpicker.js"></script>
    <script src="../../dist/jquery-clockpicker.min.js"></script>
    <script src="../../src/clockpicker.js"></script>
    <script src="../../js/moment-with-locales.js"></script>
    <script src="../../js/bootstrap-datetimepicker.js"></script>
        <script>
            $(document).ready(function () {
                $('#example').dataTable();
            });
        </script>
        <script type="text/javascript">
        $('.clockpicker').clockpicker();
        </script>
        <script>
        $(function() {
            $('#tgl4').datetimepicker({
            locale:'id',
            format:'dddd,DD/MMMM/YYYY'
            });
        });
</script>   

</body>

</html>
