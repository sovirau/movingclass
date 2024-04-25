<head>
    <link href="../../js/dataTables/dataTables.bootstrap.css" rel="stylesheet" /></head>
<?php
if(!isset($_SESSION['admin'])){
  header("location:index.php?submit=login");
}
  require_once "config.php";

  $admin = $_SESSION['admin'];

  
  $cari = $_POST['cari'];
    $query = mysql_query("select * from tb_posisi where posisi like '%$cari%'");

  $id_posisi = $_GET['id_posisi'];
  $s = mysql_query("SELECT * from tb_posisi where id_posisi = '$id_posisi' ");
  $data = mysql_fetch_array($s);
?>
<body>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Master <small>Posisi</small></h1>
                    <ol class="breadcrumb">
                            <li>
                                <i class="glyphicon glyphicon-dashboard"></i> &nbsp; <a href="home.php"> Dashboard</a>
                            </li>
                            <li>
                                <i class="glyphicon glyphicon-folder-open"></i> &nbsp; <a href="home.php?pages=posisi">Master Data Posisi</a>
                            </li>
                            <li class="active">
                                <i class="glyphicon glyphicon-pencil"></i>&nbsp; Edit Data Posisi
                            </li>
                        </ol>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-lg-5">
                    
                            <div class = "row">
                            <div class ="col-md-6 col-md-6-offset">
                            <form role="form" method="post" action="home.php?pages=posisi&aksi=edit">
                                <input type="hidden" name="id_posisi" value="<?php echo $data['id_posisi'];?>">
                            <div class="form-group">
                                <input class="form-control" name="posisi" type="text" placeholder="Posisi" value = "<?php echo $data['posisi'] ?>" required autofocus>
                            </div>
                            <input type="submit" name="submit" value="Simpan" class="btn btn-success">
                            <input type="reset" name="reset" value="Reset" class="btn btn-danger">
                            </form>
                            </div>
                            </div>
                </div></div>
                <br><br>
                <div class="row">
                <div class="col-sm-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Data Posisi/Gedung
                        </div>
                         <div class="panel-body">
                            <div class="table-responsive">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Posisi</th>
                <th>Aksi</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>Posisi</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    
        <tbody>
            <?php while($row = mysql_fetch_array($query)){ ?>
            <tr>
                <td><?php echo $row['posisi']; ?></td>
                <td style ="text-align:center"><a href = "home.php?pages=editposisi&id_posisi=<?php echo $row['id_posisi']?>"><i class = "glyphicon glyphicon-edit" title="Ubah Data"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href = "home.php?pages=posisi&id_posisi=<?php echo $row['id_posisi']?>&aksi=hapus" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i class = "glyphicon glyphicon-trash" title="Hapus Data"></i></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div> 
            <!-- jQuery -->
    <!-- DATA TABLE SCRIPTS -->
    <script src="../../js/dataTables/jquery-1.11.3.min.js"></script>
    <script src="../../js/dataTables/jquery.dataTables.js"></script>
    <script src="../../js/dataTables/dataTables.bootstrap.js"></script>
    <script src="../../js/dataTables/dataTables.responsive.js"></script>
    <script src="../../js/dataTables/jquery.dataTables.js"></script>
    <script src="../../js/dataTables/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#example').dataTable();
            });
        </script>       
</body>
</html>