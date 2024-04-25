<?php
error_reporting(0);

switch ($_GET['pages']) {

	case 'login':
		include "index.php";
		break;

	case 'dashboard':
		include "dashboard.php";
		break;

	case 'default':
		include "home.php";
		break;

	case 'master_kelas':
		include "master_kelas.php";
		break;

	case 'posisi':
		include 'posisi.php';
		break;

	case 'editposisi':
		include 'editposisi.php';
		break;

	case 'editkelas':
		include 'editkelas.php';
		break;

	case 'jurusan':
		include 'jurusan.php';
		break;

	case 'editjurusan':
		include 'editjurusan.php';
		break;

	case 'prodi':
		include 'prodi.php';
		break;

	case 'editprodi':
		include 'editprodi.php';
		break;

	case 'tingkat':
		include 'tingkat.php';
		break;

	case 'edittingkat':
		include 'edittingkat.php';
		break;

	case 'jam':
		include 'jam.php';
		break;

	case 'matkul':
		include 'matkul.php';
		break;

	case 'editmatkul':
		include 'editmatkul.php';
		break;

	case 'jadwal':
		include 'jadwal.php';
		break;

	case 'editjadwal':
		include 'editjadwal.php';
		break;

	case 'logout':
		include 'logout.php';
		break;

	case 'jam':
		include 'jam.php';
		break;

	case 'editjam':
		include 'editjam.php';
		break;

	case 'jadwaltemp':
		include 'jadwaltemp.php';
		break;

	case 'editjadwaltemp':
		include 'edit_jadwaltemp.php';
		break;

	default:
		include "dashboard.php";
		break;
}
?>