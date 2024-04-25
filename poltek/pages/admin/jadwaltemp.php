<script src="../../js/jquery.js"></script>
<script type="text/javascript">
var htmlobjek;
$(document).ready(function(){
  $("#posisi").change(function(){
    var posisi = $("#posisi").val();
    $.ajax({
        url: "cek.php",
        data: "posisi="+posisi,
        cache: false,
        success: function(msg){
            $("#kelas").html(msg);
        }
    });
  });
});
</script>
<?php
if(!isset($_SESSION['admin'])){
  header("location:index.php?submit=login");
}
  require_once "config.php";

  $admin = $_SESSION['admin'];

    $query = mysql_query("select a.*, b.*, c.*, d.*, e.*, f.*, g.* from tb_jadwaltemp a
                            inner join tb_tingkat b on b.id_tingkat = a.id_tingkat
                            inner join tb_matkul c on c.id_matkul = a.id_matkul
                            inner join tb_kelas d on d.id_kelas = a.id_kelas
                            inner join tb_posisi e on d.id_posisi = e.id_posisi
                            inner join tb_prodi g on b.id_prodi = g.id_prodi
                            inner join tb_jurusan f on g.id_jur = f.id_jur");

    

    if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus'){
        $id_jtemp = $_GET['id_jtemp'];

        $result = mysql_query("DELETE from tb_jadwaltemp where id_jtemp = '$id_jtemp'");

        echo "<script language = javascript> document.location='home.php?pages=jadwaltemp&submit=hapus'; </script>";
        if($result == true){
        }
        else { echo "<script language = javascript> alert('Data Gagal Dihapus'); document.location='home.php?pages=jadwaltemp'; </script>"; }
        }

    if(isset($_GET['aksi']) && $_GET['aksi'] == 'tambah'){
        $id_kelas = $_POST['kelas'];
        $id_matkul = $_POST['matkul'];
        $id_tingkat = $_POST['tingkat']; 
        $id_jam = $_POST['jam_mulai'];
        $id_jamakhir = $_POST['jam_selesai'];
        $tgl = $_POST['tgl'];

            mysql_query("INSERT into tb_jadwaltemp (tgl_temp, id_matkul, id_kelas, id_tingkat, id_jam, id_jam2) values ('$tgl', '$id_matkul', '$id_kelas', '$id_tingkat', '$id_jam', '$id_jamakhir')");
            
            echo "<script language = javascript> document.location='home.php?pages=jadwaltemp&submit=sukses'; </script>";
        }
    

    if (isset($_GET['aksi']) && $_GET['aksi'] == 'edit'){
        $id_jtemp = $_POST['id_jtemp'];
        $id_kelas = $_POST['kelas'];
        $id_matkul = $_POST['matkul'];
        $id_tingkat = $_POST['tingkat']; 
        $id_jam = $_POST['jam_mulai'];
        $id_jamakhir = $_POST['jam_selesai'];
        $tgl = $_POST['tgl'];

        mysql_query("UPDATE tb_jadwaltemp set id_matkul = '$id_matkul', id_tingkat = '$id_tingkat', id_kelas = '$id_kelas', id_jam = '$id_jam', id_jam2 = '$id_jamakhir', tgl_temp = '$tgl' where id_jtemp = '$id_jtemp'");
       echo "<script language = javascript> document.location='home.php?pages=jadwaltemp&submit=berhasil'; </script>";
    } 
?>
<body>
            <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Master Data <small>Data Penjadwalan Sementara</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="glyphicon glyphicon-dashboard"></i> &nbsp; <a href="home.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="glyphicon glyphicon-folder-open"></i>&nbsp; Master Data Penjadwalan Sementara
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
                            <form role="form" method="post" action="home.php?pages=jadwaltemp&aksi=tambah">
                            <div class="form-group">
                                <select class="selectpicker" id="posisi" name="posisi" data-live-search="true" title="Posisi Ruang Kelas">
                                <?php
                                    $sqll = mysql_query("SELECT * from tb_kelas inner join tb_posisi on tb_posisi.id_posisi = tb_kelas.id_kelas"); 
                                    while ($datal = mysql_fetch_array($sqll)){
                                        echo "<option value = '".$datal['id_posisi']."'>".$datal['posisi']."</option>";
                                    }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select id="kelas" name="kelas" class="selectpicker" data-live-search="true" title="Nama Ruang Kelas" onchange="document.getElementById('prd_name').value = prdName[this.value]" autofocus>
                                <?php
                                    $sqla = mysql_query("SELECT a.*, b.* from tb_kelas a
                                                            inner join tb_posisi b on a.id_posisi = b.id_posisi
                                                            order by a.nama_kelas"); 
                                    $jsArray = "var prdName = new Array();";
                                    echo "<option></option>";
                                    while ($datam = mysql_fetch_array($sqla)){
                                        echo "<option value = '".$datam['id_kelas']."'>".$datam['nama_kelas']."</option>";
                                        $jsArray .= "prdName['" . $datam['id_kelas'] . "'] = '" . addslashes($datam['kapasitas']) . "';";
                                    }
                                ?>
                              </select>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="prd_name" name="kapasitas" type="text" placeholder="Kapasitas Ruang Kelas" title="Kapasitas Ruang Kelas" readonly="true">
                                <script type="text/javascript">  
                                    <?php echo $jsArray; ?>  
                                </script>
                            </div>
                            <div class="form-group">
                                <select id="tingkat" name="tingkat" class="selectpicker" data-live-search="true" title="Pilih Tingkatan" autofocus>
                                <?php
                                    $sqla = mysql_query("SELECT a.*, b.*, c.* FROM tb_tingkat a
                                                        inner join tb_prodi b on a.id_prodi = b.id_prodi
                                                        inner join tb_jurusan c on b.id_jur = c.id_jur"); 
                                    echo "<option></option>";
                                    while ($datam = mysql_fetch_array($sqla)){ ?>
                                        <option value = "<?php echo $datam['id_tingkat'];?>"><?php echo $datam['kode_jur'];?> - <?php echo $datam['nama_prodi'];?> - <?php echo $datam['nama_tingkat'];?></option>
                                <?php    }
                                ?>
                              </select>
                            </div>
                            <div class="form-group">
                                <select id="matkul" name="matkul" class="selectpicker" data-live-search="true" title="Nama Mata Kuliah" autofocus>
                                <?php
                                    $sqla = mysql_query("select * from tb_matkul"); 
                                    echo "<option></option>";
                                    while ($datam = mysql_fetch_array($sqla)){
                                        echo "<option value = '".$datam['id_matkul']."'>".$datam['nama_matkul']."</option>";
                                    }
                                ?>
                              </select>
                            </div>
                            <div class="form-group">
                                <div class="input-group clockpicker" data-autoclose="true">
                                   <input type="text" name="jam_mulai" class="form-control" value="Jam Mulai" title="Jam Mulai">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group clockpicker" data-autoclose="true">
                                   <input type="text" name="jam_selesai" class="form-control" value="Jam Selesai" title="Jam Mulai">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group date" id="tgl4">
                                    <input type="text" class="form-control" placeholder="Tanggal" name="tgl" value="" />  
                                    <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
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
                             Data Moving Class
                        </div>
                         <div class="panel-body">
                            <div class="table-responsive">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Posisi Kelas</th>
                <th>Tingkatan</th>
                <th>Nama Mata Kuliah</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Aksi</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>Posisi Kelas</th>
                <th>Tingkatan</th>
                <th>Nama Mata Kuliah</th>
                <th>Tanggal</th>
                <th>Jam</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    
        <tbody>
            <?php while($row = mysql_fetch_array($query)){ ?>
            <tr>
                <td><?php echo $row['posisi']; ?> - <?php echo $row['nama_kelas']; ?> (<?php echo $row['kapasitas']; ?>)</td>
                <td><?php echo $row['kode_jur'];?> - <?php echo $row['nama_prodi'];?> - <?php echo $row['nama_tingkat'];?></td>
                <td><?php echo $row['nama_matkul']; ?></td>
                <td><?php echo $row['tgl_temp']; ?></td>
                <td><?php echo $row['id_jam']; ?> ~ <?php echo $row['id_jam2'];?></td>
                <td style ="text-align:center"><a href = "home.php?pages=editjadwaltemp&id_jtemp=<?php echo $row['id_jtemp']?>"><i class = "glyphicon glyphicon-edit" title="Ubah Data"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href = "home.php?pages=jadwaltemp&id_jtemp=<?php echo $row['id_jtemp']?>&aksi=hapus" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i class = "glyphicon glyphicon-trash" title="Hapus Data"></i></a></td>
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
    <script src="../../js/moment-with-locales.js"></script>
    <script src="../../js/bootstrap-datetimepicker.js"></script>
        <script>
            $(document).ready(function () {
                $('#example').dataTable();
            });
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