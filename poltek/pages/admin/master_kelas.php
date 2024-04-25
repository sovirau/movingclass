<?php
error_reporting(1);
  session_start();

  if(!isset($_SESSION['admin'])){
  header("location:index.php?submit=login");
}

  require_once "config.php";

  $cari = $_POST['cari'];
    $query = mysql_query("SELECT a.id_kelas, a.nama_kelas, b.posisi, a.kapasitas from tb_kelas a
                            inner join tb_posisi b on a.id_posisi = b.id_posisi
                            where a.nama_kelas like '%$cari%' or b.posisi like '%$cari%' or a.kapasitas like '%$cari%' order by a.nama_kelas");

    if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus'){
        $id_kelas = $_GET['id_kelas'];

        $sqldel = mysql_query("DELETE from tb_kelas where id_kelas = '$id_kelas'");

        echo "<script language = javascript> document.location='home.php?pages=master_kelas&submit=hapus'; </script>";
        if($sqldel == true){
        }
        else { echo "<script language = javascript> alert('Data Gagal Dihapus'); document.location='home.php?pages=master_kelas'; </script>"; }
     }

    if(isset($_GET['aksi']) && $_GET['aksi'] == 'tambah'){
        $nama_kelas = $_POST['nama_kelas'];
        $id_posisi = $_POST['posisi'];
        $kapasitas = $_POST['kapasitas'];
        
            mysql_query("INSERT into tb_kelas (nama_kelas, id_posisi, kapasitas) values ('$nama_kelas', '$id_posisi', '$kapasitas')");
            
            echo "<script> document.location = 'home.php?pages=master_kelas&submit=sukses'; </script>";
        
     }


    if(isset($_GET['aksi']) && $_GET['aksi'] == 'edit'){
        $id_kelas = $_POST['id_kelas'];
        $nama_kelas = $_POST['nama_kelas'];
        $id_posisi = $_POST['posisi'];
        $kapasitas = $_POST['kapasitas'];

        $sqlup = mysql_query("UPDATE tb_kelas set nama_kelas = '$nama_kelas', id_posisi = '$id_posisi', kapasitas = '$kapasitas' where id_kelas = '$id_kelas'");
               
        echo "<script> document.location='home.php?pages=master_kelas&submit=berhasil'; </script>";
     }

?>
<body>
            <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Master Data <small>Data Kelas</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="glyphicon glyphicon-dashboard"></i> &nbsp; <a href="home.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="glyphicon glyphicon-folder-open"></i>&nbsp; Master Data Kelas
                            </li>
                        </ol>
                    </div>
            </div>
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
                        }elseif ($_GET['submit']=='gagal') {
                            echo '<div class="alert alert-danger alert-dismissable" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-fw fa-times"></i> Data Sudah Ada!</div>';
                        }
                        ?>
                    </div>
                </div>
            <div class="row">
                <div class="col-lg-6">
                    
                            <div class = "row">
                            <div class ="col-md-6 col-md-6-offset">
                            <form role="form" method="post" action="home.php?pages=master_kelas&aksi=tambah">
                            <div class="form-group" >
                                <input class="form-control" name="nama_kelas" type="text" placeholder="Nama Kelas" required autofocus>
                            </div>
                            <div class="form-group">
                                <select class="selectpicker" name="posisi" data-live-search="true" title="Posisi">
                                <?php
                                    $sqll = mysql_query("SELECT * from tb_posisi"); 
                                    while ($datal = mysql_fetch_array($sqll)){
                                        echo "<option value = '".$datal['id_posisi']."'>".$datal['posisi']."</option>";
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="kapasitas" type="number" placeholder="Kapasitas" required autofocus>
                            </div>
                            <input type="submit" name="submit" value="Simpan" class="btn btn-success">
                            <input type="reset" name="reset" value="Reset" class="btn btn-danger">
                            </form>
                            </div>
                            </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                            <br>
                            <br>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Data Kelas
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nama Kelas</th>
                <th>Posisi</th>
                <th>Kapasitas</th>
                <th>Aksi</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>Nama Kelas</th>
                <th>Posisi</th>
                <th>Kapasitas</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    
        <tbody>
            <?php while($row = mysql_fetch_array($query)){ ?>
            <tr>
                <td><?php echo $row['nama_kelas']; ?></td>
                <td><?php echo $row['posisi']; ?></td>
                <td><?php echo $row['kapasitas']; ?></td>
                <td style ="text-align:center"><a href = "home.php?pages=editkelas&id_kelas=<?php echo $row['id_kelas']?>"><i class = "glyphicon glyphicon-edit" title="Ubah Data"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href = "home.php?pages=master_kelas&id_kelas=<?php echo $row['id_kelas']?>&aksi=hapus" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i class = "glyphicon glyphicon-trash" title="Hapus Data"></i></a></td>
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