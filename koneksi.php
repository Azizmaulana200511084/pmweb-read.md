<?php 
class database{

	var $host = "localhost";
	var $username = "root";
	var $password = "";
	var $database = "paksupri";
	var $koneksi = "";
	function __construct(){
		$this->koneksi = mysqli_connect($this->host, $this->username, $this->password,$this->database);
		if (mysqli_connect_errno()){
			echo "Koneksi database gagal : " . mysqli_connect_error();
		}
	}

	function tampil_steam()
	{
		$data = mysqli_query($this->koneksi,"SELECT*FROM steam
		INNER JOIN kendaraan
		ON kendaraan.id_kendaraan = steam.id_kendaraan");
		while($row = mysqli_fetch_array($data)){
			$hasil[] = $row;
		}
		return $hasil;
	}

	function tambah_steam($nama_steam,$id_kendaraan,$tekanan_uap,$kapasitas_uap,$tanggal_pemeriksaan)
	{
		mysqli_query($this->koneksi,"insert into steam values ('','$nama_steam','$id_kendaraan','$tekanan_uap','$kapasitas_uap','$tanggal_pemeriksaan')");
	}

	function get_steam($id)
	{
		$query = mysqli_query($this->koneksi,"select * from steam where id='$id'");
		return $query->fetch_array();
	}

	function update_steam($nama_steam,$id_kendaraan,$tekanan_uap,$kapasitas_uap,$tanggal_pemeriksaan,$id)
	{
		$query = mysqli_query($this->koneksi,"update steam set nama_steam='$nama_steam', id_kendaraan='$id_kendaraan', tekanan_uap='$tekanan_uap', kapasitas_uap='$kapasitas_uap', tanggal_pemeriksaan='$tanggal_pemeriksaan' where id='$id'");
	}

	function delete_steam($id)
	{
		$query = mysqli_query($this->koneksi,"delete from steam where id='$id'");
		return $query;
	}

	function tampil_kendaraan()
	{
		$data = mysqli_query($this->koneksi,"SELECT*FROM kendaraan");
		while($row = mysqli_fetch_array($data)){
			$hasil[] = $row;
		}
		return $hasil;
	}

	function tambah_kendaraan($nama_kendaraan,$jenis_kendaraan,$tahun_pembuatan,$nomor_plat)
	{
		mysqli_query($this->koneksi,"insert into kendaraan values ('','$nama_kendaraan','$jenis_kendaraan','$tahun_pembuatan','$nomor_plat')");
	}
	function get_kendaraan($id_kendaraan)
	{
		$query = mysqli_query($this->koneksi,"select * from kendaraan where id_kendaraan='$id_kendaraan'");
		return $query->fetch_array();
	}

	function update_kendaraan($nama_kendaraan,$jenis_kendaraan,$tahun_pembuatan,$nomor_plat,$id_kendaraan)
	{
		$query = mysqli_query($this->koneksi,"update kendaraan set nama_kendaraan='$nama_kendaraan', jenis_kendaraan='$jenis_kendaraan', tahun_pembuatan='$tahun_pembuatan', nomor_plat='$nomor_plat' where id_kendaraan='$id_kendaraan'");
		
	}

	function delete_kendaraan($id_kendaraan)
	{
		$query = mysqli_query($this->koneksi,"delete from kendaraan where id_kendaraan='$id_kendaraan'");
		return $query;
	}
}
