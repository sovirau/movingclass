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

    $query = mysql_query("select a.*, b.*, c.*, d.*, e.*, f.*, g.* from tb_penjadwalan a
                            inner join tb_tingkat b on b.id_tingkat = a.id_tingkat
                            inner join tb_matkul c on c.id_matkul = a.id_matkul
                            inner join tb_kelas d on d.id_kelas = a.id_kelas
                            inner join tb_posisi e on d.id_posisi = e.id_posisi
                            inner join tb_prodi g on b.id_prodi = g.id_prodi
                            inner join tb_jurusan f on g.id_jur = f.id_jur");

    $id_trans = $_POST['id_trans'];

    if(isset($_GET['aksi']) && $_GET['aksi'] == 'hapus'){
        $id_trans = $_GET['id_trans'];

        $result = mysql_query("DELETE from tb_penjadwalan where id_trans = '$id_trans'");

        echo "<script language = javascript> document.location='home.php?pages=jadwal&submit=hapus'; </script>";
        if($result == true){
        }
        else { echo "<script language = javascript> alert('Data Gagal Dihapus'); document.location='home.php?pages=jadwal'; </script>"; }
        }

    if(isset($_GET['aksi']) && $_GET['aksi'] == 'tambah'){
        $id_kelas = $_POST['kelas'];
        $id_matkul = $_POST['matkul'];
        $id_tingkat = $_POST['tingkat'];
        $id_jam = $_POST['jam_mulai'];
        $id_jamakhir = $_POST['jam_selesai'];
        $hari = $_POST['hari'];

        $q = mysql_query("SELECT * from tb_penjadwalan where hari = '$hari' or id_jam = '$jam_mulai' or id_jamakhir = '$jam_selesai'");
        $cek = mysql_num_rows($q);
        if($cek){
            echo "<script language = javascript> alert ('Maaf, Data yang anda masukkan sudah ada atau kelas bertabrakan'); document.location='home.php?pages=jadwal'; </script>";
        }else{
            mysql_query("INSERT into tb_penjadwalan (id_kelas, id_tingkat, id_matkul, id_jam, id_jamakhir, hari) values ('$id_kelas', '$id_tingkat', '$id_matkul', '$id_jam', '$id_jamakhir', '$hari')");
            
            echo "<script language = javascript> document.location='home.php?pages=jadwal&submit=sukses'; </script>";
        }
    }

    if (isset($_GET['aksi']) && $_GET['aksi'] == 'edit'){
        $id_trans = $_POST['id_trans'];
        $id_kelas = $_POST['kelas'];
        $id_matkul = $_POST['matkul'];
        $id_tingkat = $_POST['tingkat'];
        $id_jam = $_POST['jam_mulai'];
        $id_jamakhir = $_POST['jam_selesai'];
        $hari = $_POST['hari'];

        mysql_query("UPDATE tb_penjadwalan set id_kelas = '$id_kelas', id_tingkat = '$id_tingkat', id_matkul = '$id_matkul', id_jam = '$id_jam', id_jamakhir = '$id_jamakhir', hari = '$hari' where id_trans = '$id_trans'");
       echo "<script language = javascript> document.location='home.php?pages=jadwal&submit=berhasil'; </script>";
    } 
?>
<body>
            <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Master Data <small>Data Penjadwalan</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="glyphicon glyphicon-dashboard"></i> &nbsp; <a href="home.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="glyphicon glyphicon-folder-open"></i>&nbsp; Master Data Penjadwalan
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
                            <form role="form" method="post" action="home.php?pages=jadwal&aksi=tambah">
                            <div class="form-group">
                                <select class="selectpicker" id="posisi" name="posisi" data-live-search="true" title="Posisi Ruang Kelas">
                                <?php
                                    $sqll = mysql_query("SELECT * from tb_posisi"); 
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
                                <select id="hari" name="hari" class="selectpicker" data-live-search="true" title="Pilih Hari" autofocus>
                                <option>Senin</option>
                                <option>Selasa</option>
                                <option>Rabu</option>
                                <option>Kamis</option>
                                <option>Jumat</option>
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
                <th>Nama Kelas</th>
                <th>Kapasitas Kelas</th>
                <th>Tingkatan</th>
                <th>Nama Mata Kuliah</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Aksi</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>Posisi Kelas</th>
                <th>Nama Kelas</th>
                <th>Kapasitas Kelas</th>
                <th>Tingkatan</th>
                <th>Nama Mata Kuliah</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    
        <tbody>
            <?php while($row = mysql_fetch_array($query)){ ?>
            <tr>
                <td><?php echo $row['posisi']; ?></td>
                <td><?php echo $row['nama_kelas']; ?></td>
                <td><?php echo $row['kapasitas']; ?></td>
                <td><?php echo $row['kode_jur'];?> - <?php echo $row['nama_prodi'];?> - <?php echo $row['nama_tingkat'];?></td>
                <td><?php echo $row['nama_matkul']; ?></td>
                <td><?php echo $row['hari']; ?></td>
                <td><?php echo $row['id_jam']; ?> ~ <?php echo $row['id_jamakhir'];?></td>
                <td style ="text-align:center"><a href = "home.php?pages=editjadwal&id_trans=<?php echo $row['id_trans']?>"><i class = "glyphicon glyphicon-edit" title="Ubah Data"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href = "home.php?pages=jadwal&id_trans=<?php echo $row['id_trans']?>&aksi=hapus" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i class = "glyphicon glyphicon-trash" title="Hapus Data"></i></a></td>
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