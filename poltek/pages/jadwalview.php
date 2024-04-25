<head>
<script src="../js/jquery.js"></script>
</head>
<?php  
  require_once "admin/config.php";
$op = $_GET['op'];

$id_tingkat = $_GET['id_tingkat'];
$hari =$_GET['hari'];
     
?>
<div class="col-md-1"></div>
                <div class="col-md-10" align="center">
                    <!-- Advanced Tables -->
                            <br>
                            <br>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Data Nilai
                        </div>
                        <div class="panel-body">
                                    <?php 
                                        if($op == "ambilnilai"){
                                            $tabel = mysql_query("select a.*, b.nama_tingkat, c.*, d.*, e.*, f.*, g.* from tb_penjadwalan a
                                                                    inner join tb_tingkat b on b.id_tingkat = a.id_tingkat
                                                                    inner join tb_matkul c on c.id_matkul = a.id_matkul
                                                                    inner join tb_kelas d on d.id_kelas = a.id_kelas
                                                                    inner join tb_posisi e on d.id_posisi = e.id_posisi
                                                                    inner join tb_prodi g on b.id_prodi = g.id_prodi
                                                                    inner join tb_jurusan f on g.id_jur = f.id_jur
                                                                    where a.id_tingkat = '".$_GET['id_tingkat']."' and a.hari ='".$_GET['hari']."' order by a.id_jam");
                                                                ?>
                            <div class="table-responsive">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th style="text-align:center">No</th>
                <th style="text-align:center">Jam</th>
                <th style="text-align:center">Nama Mata Kuliah</th>
                <th style="text-align:center">Ruang Kelas</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th style="text-align:center">No</th>
                <th style="text-align:center">Jam</th>
                <th style="text-align:center">Nama Mata Kuliah</th>
                <th style="text-align:center">Ruang Kelas</th>
            </tr>
        </tfoot>
        <?php 
            $no = 1; while($row = mysql_fetch_array($tabel)){ ?>
        <tbody>
                    <tr>
                <td style="text-align:center"><?php echo $no; ?></td>
                <td style="text-align:center"><?php echo $row['id_jam']; ?> - <?php echo $row['id_jamakhir'];?></td>
                <td style="text-align:center"><?php echo $row['nama_matkul']; ?></td>
                <td style="text-align:center"><?php echo $row['posisi']; ?> - <?php echo $row['nama_kelas'];?></td>
            </tr>
            <?php $no++; } ?>
        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<div class="col-md-1"></div>
                                    <?php }?>