<?php
if(!isset($_SESSION['admin'])){
  header("location:index.php?submit=login");
}
  require_once "config.php";

  $admin = $_SESSION['admin'];

  $cari = $_POST['cari'];
    $query = mysql_query("select * from tb_posisi where posisi like '%$cari%'");

    if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus'){
        $posisi = $_GET['posisi'];

        $result = mysql_query("DELETE from tb_posisi where id_posisi = '$id_posisi'");

        echo "<script language = javascript> document.location='home.php?pages=posisi&submit=hapus'; </script>";
        if($result == true){
        }
        else { echo "<script language = javascript> alert('Data Gagal Dihapus'); document.location='home.php?pages=posisi'; </script>"; }
        }

    if(isset($_GET['aksi']) && $_GET['aksi'] == 'tambah'){
        $posisi = $_POST['posisi'];

        $q = mysql_query("SELECT * from tb_posisi where posisi = '$posisi'");
        $cek = mysql_num_rows($q);
        if($cek){
            echo "<script language = javascript> alert ('Maaf, Data yang anda masukkan sudah ada'); document.location='home.php?pages=posisi'; </script>";
        }else{
            mysql_query("INSERT into tb_posisi (posisi) values ('$posisi')");
            
            echo "<script language = javascript> document.location='home.php?pages=posisi&submit=sukses'; </script>";
        }
    }

    if (isset($_GET['aksi']) && $_GET['aksi'] == 'edit'){
        $id_posisi = $_POST['id_posisi'];
        $posisi = $_POST['posisi'];

        mysql_query("UPDATE tb_posisi set posisi = '$posisi' where id_posisi = '$id_posisi'");
       echo "<script language = javascript> document.location='home.php?pages=posisi&submit=berhasil'; </script>";
    } 
?>
<body>
            <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Master Data <small>Data Posisi</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="glyphicon glyphicon-dashboard"></i> &nbsp; <a href="home.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="glyphicon glyphicon-folder-open"></i>&nbsp; Master Data Posisi
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class ="row">
                    <div class="col-md-12">
                        <?php 
                        if($_GET['submit']=='sukses'){
                            echo '<div class="alert alert-success alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <span class="glyphicon glyphicon-ok"></span> Tambah Data Sukses</div>';
                        }elseif ($_GET['submit']=='berhasil') {
                            echo '<div class="alert alert-success alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <span class="glyphicon glyphicon-ok"></span> Ubah Data Sukses</div>';
                        }elseif ($_GET['submit']=='hapus') {
                            echo '<div class="alert alert-success alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <span class="glyphicon glyphicon-ok"></span> Hapus Data Sukses</div>';
                        }
                        ?>
                    </div>
                </div>
                <div class="row">
                <div class="col-sm-12">
                    
                            <div class = "row">
                            <div class ="col-md-4 col-md-4-offset">
                            <form role="form" method="post" action="home.php?pages=posisi&aksi=tambah">
                            <div class="form-group">
                                <input class="form-control" name="posisi" type="text" placeholder="Posisi" required autofocus>
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