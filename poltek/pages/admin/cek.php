<?php
session_start();
if(!isset($_SESSION['admin'])){
  header("location:index.php?submit=login");
}
require_once('config.php');
  $posisi = $_GET['posisi'];

  $sql = mysql_query("SELECT a.*, b.* from tb_kelas a
                                                            inner join tb_posisi b on a.id_posisi = b.id_posisi
                                                             where a.id_posisi = '$posisi'
                                                             order by a.nama_kelas");
  echo "<option></option>";
  while ($tampil = mysql_fetch_array($sql)){
  	echo "<option value ='".$tampil['id_kelas']."'>".$tampil['nama_kelas']."</option>";
  }
?>