<?php
if(!isset($_SESSION['admin'])){
  header("location:index.php?submit=login");
}
  require_once "config.php";

  $admin = $_SESSION['admin'];

  $cari = $_POST['cari'];
    $query = mysql_query("select * from tb_jam");

    $id_jam = $_GET['id_jam'];
    $s = mysql_query("SELECT * from tb_jam where id_jam = '$id_jam' ");
    $data = mysql_fetch_array($s);
?>
<body>
            <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Master Data <small>Data Jam</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="glyphicon glyphicon-dashboard"></i>  &nbsp;<a href="home.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="glyphicon glyphicon-folder-open"></i> &nbsp;Master Data Jam
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
                            <form role="form" method="post" action="home.php?pages=jam&aksi=edit">
                            <div class="form-group">
                                <div class="input-group clockpicker" data-autoclose="true">
                                    <input type="hidden" name="id_jam" value="<?php echo $data['id_jam'];?>">
                                   <input type="text" name="jam_mulai" class="form-control" value="<?php echo $data['jam'];?>" title="Jam Mulai">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group clockpicker" data-autoclose="true">
                                   <input type="text" name="jam_selesai" class="form-control" value="<?php echo $data['jam2'];?>" title="Jam Selesai">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
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
                             Data Jam
                        </div>
                         <div class="panel-body">
                            <div class="table-responsive">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Jam</th>
                <th>Aksi</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>No</th>
                <th>Jam</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    
        <tbody>
            <?php $no = 1; while($row = mysql_fetch_array($query)){ ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $row['jam']; ?> - <?php echo $row['jam2'];?></td>
                <td style ="text-align:center"><a href = "home.php?pages=editjam&id_jam=<?php echo $row['id_jam']?>"><i class = "glyphicon glyphicon-edit" title="Ubah Data"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href = "home.php?pages=jam&id_jam=<?php echo $row['id_jam']?>&aksi=hapus" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i class = "glyphicon glyphicon-trash" title="Hapus Data"></i></a></td>
            </tr>
            <?php $no++; } ?>
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
        <script>
            $(document).ready(function () {
                $('#clockpicker').clockpicker();
            });
        </script>
</body>
</html>