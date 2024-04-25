<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Polkesma</title>
    <link rel="icon" type="image/png" href="../img/logo.png" />

    <!-- Bootstrap core CSS -->
    <script src="../js/jquery.js" type="text/JavaScript"></script>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js" type="text/JavaScript"></script>
    <link href="../css/bootstrap-select.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap-datetimepicker.css"/>

    <!-- Custom fonts for this template -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="../css/landing-page.min.css" rel="stylesheet">
    <link href="../js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
    <!--JS REGular-->
    <script type="text/javascript">
    var htmlobjek;
    $(document).ready(function(){
    //ajax dropdown
    $("#hari").change(function(){
        var id_tingkat = $("#id_tingkat").val();
        var hari = $("#hari").val();
        $.ajax({
            type: "GET",
            url: "jadwalview.php",
            data: "op=ambilnilai&id_tingkat="+id_tingkat+"&hari="+hari,
            success: function(html){
                $("#jadwal").html(html);
        }
        });
      });
    });
    </script><!--end js regular-->

    <!--js jadwal temp-->
     <script type="text/javascript">
    var htmlobjek;
    $(document).ready(function(){
    //ajax dropdown
    $("#hari").change(function(){
        var id_tingkat2 = $("#id_tingkat2").val();
        var hari2 = $("#hari2").val();
        $.ajax({
            type: "GET",
            url: "jadwaltemp_view.php",
            data: "op=ambilnilai2&hari2="+hari2+"&id_tingkat2="+id_tingkat2,
            success: function(html){
                $("#jadwal2").html(html);
        }
        });
      });
    });
    </script><!--end js jadwal temp-->
    <?php
    require_once "admin/config.php";
    ?>
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-light bg-light static-top">
      <div class="container">
        <a class="navbar-brand" href="#"><img src="../img/img_not_available.png" width="150px" height="31px"></a><h2 style="height: 31px;"> Moving Class</h2>
      </div>
    </nav>

    <!-- Masthead -->
    
      <div class="container">
              <div class="row">
              <div class="col-md-12">
            <!--TANGGAL-->
            <div class="row">
                <?php 
                    function tanggal_indo($tanggal, $cetak_hari = false){
                        $hari = array (
                            1 => 'Senin',
                            'Selasa',
                            'Rabu',
                            'Kamis',
                            'Jumat',
                            'Sabtu',
                            'Minggu');
                        $bulan = array(
                            1 => 'Januari',
                            'Februari',
                            'Maret',
                            'April',
                            'Mei',
                            'Juni',
                            'Juli',
                            'Agustus',
                            'September',
                            'Oktober',
                            'November',
                            'Desember');
                        $split = explode('/', $tanggal);
                        $tgl_indo = $split[2] . '/' . $bulan[ (int)$split[1] ] . '/' . $split[0];

                        if($cetak_hari){
                            $num = date('N', strtotime($tanggal));
                            return $hari[$num] . ',' . $tgl_indo;
                        }
                        return $tgl_indo;
                    }
                    $showdate = tanggal_indo(date('Y/m/d'), true);
                    ?>
                    <b> <label name = "hari2" ><?php echo $showdate; ?></label> </b>
                <!--end of TANGGAL-->
            <div class="panel with-nav-tabs panel-info">
                <div class="panel-heading">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#regular" data-toggle="tab">Jadwal Reguler</a></li>
                      <li><a href="#temp" data-toggle="tab">Jadwal Sementara</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                    <!--REGULAR-->
                    <div id="regular" class="tab-pane fade in active">
                       <div class="row">
                        <div class="col-4 col-md-4"><!--ID REGULAR START-->
                        <label for="exampleInputEmail1">Pilih Tingkat</label>
                        <div class="form-group">
                        <select class="form-control"  id = "id_tingkat" name="id_tingkat" title="PRODI - TINGKAT" autofocus="true" required="true">
                                <?php
                                    $sqll = mysql_query("SELECT * from tb_tingkat
                                                        inner join tb_prodi on tb_prodi.id_prodi = tb_tingkat.id_prodi
                                                        inner join tb_jurusan on tb_prodi.id_jur = tb_jurusan.id_jur"); 
                                    echo "<option>Prodi - Tingkat</option>"; 
                                    while ($datal = mysql_fetch_array($sqll)){ ?>
                                        <option value = "<?php echo $datal['id_tingkat'];?>"> <?php echo $datal['nama_jur'];?> - <?php echo $datal['nama_prodi'];?> - <?php echo $datal['nama_tingkat'];?></option>
                                  <?php  }
                                ?>
                        </select>
                        </div></div>
                    <div class="col-4 col-md-4">
                        <label for="exampleInputEmail1">Pilih Hari</label>
                            <select  class="form-control"  id = "hari" name="hari" title="Pilih Hari" autofocus="true" required="true">
                                <option>Hari</option>
                                <option>Senin</option>
                                <option>Selasa</option>
                                <option>Rabu</option>
                                <option>Kamis</option>
                                <option>Jumat</option>
                            </select>
                    </div><!--END OF ID:REGULAR-->
                    <div class="row">
                    <div class="col-4 col-md-10">
                    <div id ="jadwal"></div></div>
                    </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                   
                   <!--TEMPORARY-->
                    <div id="temp" class="tab-pane fade">
                       <div class="row"><div class="col-4 col-md-4"><!--ID TEMP START-->
                        <label for="exampleInputEmail1">Pilih Tingkat</label>
                        <div class="form-group">
                        <select class="form-control"  id = "id_tingkat2" name="id_tingkat2" title="PRODI - TINGKAT" autofocus="true" required="true">
                                <?php
                                    $sqll = mysql_query("SELECT * from tb_tingkat
                                                        inner join tb_prodi on tb_prodi.id_prodi = tb_tingkat.id_prodi
                                                        inner join tb_jurusan on tb_prodi.id_jur = tb_jurusan.id_jur"); 
                                    echo "<option>Prodi - Tingkat</option>"; 
                                    while ($datal = mysql_fetch_array($sqll)){ ?>
                                        <option value = "<?php echo $datal['id_tingkat'];?>"> <?php echo $datal['nama_jur'];?> - <?php echo $datal['nama_prodi'];?> - <?php echo $datal['nama_tingkat'];?></option>
                                  <?php  }
                                ?>
                        </select>
                        </div></div>

                        <div class="col-4 col-md-4">
                        <label for="exampleInputEmail1">Pilih Hari</label>
                        <div class="form-group">
                                <div class="input-group date" id="hari2">
                                    <input type="text" class="form-control" placeholder="Tanggal" name="tgl" value="" />  
                                    <span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                    <div class="col-4 col-md-10">
                    <div id ="jadwal2"></div></div>
                    </div>
                        <!--END OF ID:TEMp-->
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
    <!-- Icons Grid -->
    

    <!-- Footer -->


    <!-- Bootstrap core JavaScript -->
    <script src="../js/jquery.js"></script>
    <script src="../js/dataTables/jquery-1.11.3.min.js"></script>
    <script src="../js/dataTables/jquery.dataTables.js"></script>
    <script src="../js/dataTables/dataTables.bootstrap.js"></script>
    <script src="../js/dataTables/dataTables.responsive.js"></script>
    <script src="../js/dataTables/jquery.dataTables.js"></script>
    <script src="../js/dataTables/jquery.dataTables.min.js"></script>
    <script src="../js/bootstrap-datetimepicker.js"></script>
    <script src="../js/moment-with-locales.js"></script>
        <script>
            $(document).ready(function () {
                $('#example').dataTable();
            });
        </script>
        <script>
        $(function() {
            $('#hari2').datetimepicker({
            locale:'id',
            format:'dddd,DD/MMMM/YYYY'
            });
        });
</script>   
  </body>

</html>
