<?php
  $host = 'localhost';
  $user ='root';
  $pass = '';
  $db = 'polkesma';

  $koneksi = mysql_connect($host, $user, $pass);

  $koneksi_database = mysql_select_db($db);
?>