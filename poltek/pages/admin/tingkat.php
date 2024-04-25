<?php
if(!isset($_SESSION['admin'])){
  header("location:index.php?submit=login");
}
  require_once "config.php";

  $admin = $_SESSION['admin'];

  $cari = $_POST['cari'];
    $query = mysql_query("select * from tb_tingkat 
        inner join tb_prodi on tb_tingkat.id_prodi = tb_prodi.id_prodi 
        inner join tb_jurusan on tb_jurusan.id_jur = tb_prodi.id_jur ");

    if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus'){
        $id_tingkat = $_GET['id_tingkat'];

        $result = mysql_query("DELETE from tb_tingkat where id_tingkat = '$id_tingkat'");

        echo "<script language = javascript> document.location='home.php?pages=tingkat&submit=hapus'; </script>";
        if($result == true){
        }
        else { echo "<script language = javascript> alert('Data Gagal Dihapus'); document.location='home.php?pages=tingkat'; </script>"; }
        }

    if(isset($_GET['aksi']) && $_GET['aksi'] == 'tambah'){
        $id_prodi = $_POST['id_prodi'];
        $nama_tingkat = $_POST['nama_tingkat'];
        $jumlah = $_POST['jumlah'];

        $q = mysql_query("SELECT * from tb_tingkat where id_prodi = '$id_prodi' and nama_tingkat = '$nama_tingkat'");
        $cek = mysql_num_rows($q);
        if($cek){
            echo "<script language = javascript> alert ('Maaf, Data yang anda masukkan sudah ada'); document.location='home.php?pages=tingkat'; </script>";
        }else{
            mysql_query("INSERT into tb_tingkat (id_prodi, nama_tingkat, jumlah_mhs) values ('$id_prodi', '$nama_tingkat', '$jumlah')");
            
            echo "<script language = javascript> document.location='home.php?pages=tingkat&submit=sukses'; </script>";
        }
    }

    if (isset($_GET['aksi']) && $_GET['aksi'] == 'edit'){
        $id_tingkat = $_POST['id_tingkat'];
        $nama_tingkat = $_POST['nama_tingkat'];
        $id_prodi = $_POST['id_prodi'];
        $jumlah = $_POST['jumlah'];

        mysql_query("UPDATE tb_tingkat set nama_tingkat = '$nama_tingkat', jumlah_mhs = '$jumlah' where id_tingkat = '$id_tingkat'");
       echo "<script language = javascript> document.location='home.php?pages=tingkat&submit=berhasil'; </script>";
    } 
?>
<body>
            <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Master Data <small>Data Tingkat</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="glyphicon glyphicon-dashboard"></i>  &nbsp;<a href="home.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="glyphicon glyphicon-folder-open"></i> &nbsp;Master Data Tingkat
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
                            <form role="form" method="post" action="home.php?pages=tingkat&aksi=tambah"><div class="form-group">
                                <select class="selectpicker" name="id_prodi" data-live-search="true" title="Prodi">
                                <?php
                                    $sqll = mysql_query("SELECT a.*, b.* from tb_prodi a inner join tb_jurusan b on a.id_jur = b.id_jur"); 
                                    while ($datal = mysql_fetch_array($sqll)){ ?>
                                        <option value = "<?php echo $datal['id_prodi'];?>"> <?php echo $datal['nama_jur'];?> - <?php echo $datal['nama_prodi'];?></option>
                                <?php    }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="nama_tingkat" type="text" placeholder="Nama Tingkat" required autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="jumlah" type="number" placeholder="Jumlah Mahasiswa" required autofocus>
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
                             Data Tingkat
                        </div>
                         <div class="panel-body">
                            <div class="table-responsive">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nama Prodi</th>
                <th>Tingkat</th>
                <th>Jumlah Mahasiswa</th>
                <th>Aksi</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>Nama Prodi</th>
                <th>Tingkat</th>
                <th>Jumlah Mahasiswa</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    
        <tbody>
            <?php while($row = mysql_fetch_array($query)){ ?>
            <tr>
                <td><?php echo $row['nama_jur']; ?> - <?php echo $row['nama_prodi']; ?></td>
                <td><?php echo $row['nama_tingkat']; ?></td>
                <td><?php echo $row['jumlah_mhs']; ?></td>
                <td style ="text-align:center"><a href = "home.php?pages=edittingkat&id_tingkat=<?php echo $row['id_tingkat']?>"><i class = "glyphicon glyphicon-edit" title="Ubah Data"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href = "home.php?pages=tingkat&id_tingkat=<?php echo $row['id_tingkat']?>&aksi=hapus" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i class = "glyphicon glyphicon-trash" title="Hapus Data"></i></a></td>
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