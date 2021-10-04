<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan config database
include 'config.php';
 
// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];
 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($config,"SELECT * FROM petugas WHERE username='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
	// cek jika user login sebagai admin
	if($data['level']=="Admin"){
 
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "Admin";
		// alihkan ke halaman dashboard admin
		header("location:beranda.php");
 
	// cek jika user login sebagai pegawai
	}else if($data['level']=="Pegawai"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "Pegawai";
		// alihkan ke halaman dashboard pegawai
		header("location:beranda.php");
 
	// cek jika user login sebagai pengurus
	}else{
 
		// alihkan ke halaman login kembali
		echo '<script>alert("Username/Password salah."); document.location="index.html";</script>';
	}	
}else{
	echo '<script>alert("Username/Password salah."); document.location="index.html";</script>';
}
 
?>