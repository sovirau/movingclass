<?php
if(!isset($_SESSION['admin'])){
  header("location:index.php?submit=login");
}
  require_once "config.php";

  $admin = $_SESSION['admin'];

    $query = mysql_query("select * from tb_matkul");

    $id_matkul = $_GET['id_matkul'];
    $s = mysql_query("SELECT * from tb_matkul where id_matkul = '$id_matkul' ");
    $data = mysql_fetch_array($s);
    
?>
<body>
            <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Master Data <small>Data Matkul</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="glyphicon glyphicon-dashboard"></i> &nbsp; <a href="home.php">Dashboard</a>
                            </li>
                            <li>
                                <i class="glyphicon glyphicon-folder-open"></i> &nbsp; <a href="home.php?pages=posisi">Master Data Mata Kuliah</a>
                            </li>
                            <li class="active">
                                <i class="glyphicon glyphicon-pencil"></i>&nbsp; Edit Data Mata Kuliah
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                <div class="col-sm-12">
                    
                            <div class = "row">
                            <div class ="col-md-4 col-md-4-offset">
                            <form role="form" method="post" action="home.php?pages=matkul&aksi=edit">
                                <input type="hidden" name="id_matkul" value="<?php echo $data['id_matkul'];?>">
                            <div class="form-group">
                                <input class="form-control" name="nama_matkul" type="text" placeholder="Mata Kuliah" value="<?php echo $data['nama_matkul'];?>" required autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="kode_matkul" type="text" placeholder="Kode Mata Kuliah" value="<?php echo $data['kode_matkul'];?>" required autofocus>
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
                             Data Mata Kuliah
                        </div>
                         <div class="panel-body">
                            <div class="table-responsive">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Mata Kuliah</th>
                <th>Kode</th>
                <th>Aksi</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>Mata Kuliah</th>
                <th>Kode</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    
        <tbody>
            <?php while($row = mysql_fetch_array($query)){ ?>
            <tr>
                <td><?php echo $row['nama_matkul']; ?></td>
                <td><?php echo $row['kode_matkul']; ?></td>
                <td style ="text-align:center"><a href = "home.php?pages=editmatkul&id_matkul=<?php echo $row['id_matkul']?>"><i class = "glyphicon glyphicon-edit" title="Ubah Data"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href = "home.php?pages=matkul&id_matkul=<?php echo $row['id_matkul']?>&aksi=hapus" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i class = "glyphicon glyphicon-trash" title="Hapus Data"></i></a></td>
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