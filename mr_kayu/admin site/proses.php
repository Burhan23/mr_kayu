<?php 
include 'db_conn.php';
include 'function.php';
$db = new database();
$specify = new Specify();
$upgrade = new Upgrade();
$list = new ListBayar();
$mou = new MOU();
$detail_bayar = new Detail();
 
$aksi = $_GET['aksi'];
if($aksi == "tambah"){
 	$db->input($_POST['username'],$_POST['nama_lengkap'],$_POST['password'],$_POST['NIK']);
 	header("location:index.php");
} elseif($aksi == "update"){
 	$db->update($_POST['id'],$_POST['username'],$_POST['nama_lengkap'],$_POST['password']);
 	header("location:index.php");
} elseif($aksi == "hapus"){ 	
	$db->hapus($_GET['id']);
   	header("location:index.php");
} elseif($aksi == "bukti"){

} elseif($aksi == "isi"){
	$detail = $specify->dataUser($_GET['username']);;
	if ($_REQUEST['jumlah'] < 1010000){
		foreach ($detail as $akun){
			$jumlah_dana = (int)$_REQUEST['jumlah'] - 5000;
			$dana = $akun['dana'] + $jumlah_dana;
			$topup->giveThisUserDana($_REQUEST['username'],$dana);
			$topup->removeThisRow($_REQUEST['id']);
			header("location: approval_topup.php");
		}
	}
	elseif ($_REQUEST['jumlah'] >= 1010000){
		foreach ($detail as $akun){
			$jumlah_dana = (int)$_REQUEST['jumlah'] - 10000;
			$dana = $akun['dana'] + $jumlah_dana;
			$topup->giveThisUserDana($_REQUEST['username'],$dana);
			$topup->removeThisRow($_REQUEST['id']);
			header("location: approval_topup.php");
		}
	}
} elseif($aksi == "tolak"){
	$topup->removeThisRow($_REQUEST['id']);
   	header("location:approval_topup.php");

} elseif ($aksi == "valid"){
	$upgrade->checkForValidation($_REQUEST['id_users'],$_REQUEST['npwp'],$_REQUEST['nik'],$_REQUEST['no_rekening'],$_REQUEST['deskripsi']);
	$upgrade->removeThisRow($_REQUEST['id']);
	header("location:approval_upgrade.php");
} elseif ($aksi == "invalid") {
	$upgrade->removeThisRow($_REQUEST['id']);
	header("location:approval_upgrade.php");
} elseif ($aksi == "kirim") {
	if (($_FILES['bukti']['name']!="")){
		$target_dir = "../detail_bayar/";
		$file = $_FILES['bukti']['name'];
		$path = pathinfo($file);
		$filename = $path['filename'];
		$ext = $path['extension'];
		$movefile = "Detail_".$_REQUEST['status']."_".$_REQUEST['id_bayar']."_".$_REQUEST['id_invest'].".".$ext;
		$temp_name = $_FILES['bukti']['tmp_name'];
		$path_filename_ext = $target_dir.$movefile;
		if (file_exists($path_filename_ext)) {
			echo "Sorry, file already exists.";
		}else{
			move_uploaded_file($temp_name,$path_filename_ext);
			echo "Congratulations! File Uploaded Successfully.";
		}
	}
	$list->kirimKeUser($_REQUEST['id_invest'],$_REQUEST['id_bayar']);
	$detail_bayar->uploadBuktiPembayaran($_REQUEST['id_invest'],$movefile,$_REQUEST['status'],$_REQUEST['admin']);
	header("location:approval_bayar.php");
} elseif ($aksi == "kembalikan") {
	if (($_FILES['bukti']['name']!="")){
		$target_dir = "../detail_bayar/";
		$file = $_FILES['bukti']['name'];
		$path = pathinfo($file);
		$filename = $path['filename'];
		$ext = $path['extension'];
		$movefile = "Detail_".$_REQUEST['status']."_".$_REQUEST['id_bayar']."_".$_REQUEST['id_invest'].".".$ext;
		$temp_name = $_FILES['bukti']['tmp_name'];
		$path_filename_ext = $target_dir.$movefile;
		if (file_exists($path_filename_ext)) {
			echo "Sorry, file already exists.";
		}else{
			move_uploaded_file($temp_name,$path_filename_ext);
			echo "Congratulations! File Uploaded Successfully.";
		}
	}
	$list->kembalikanKeUser($_REQUEST['id_invest'],$_REQUEST['id_bayar']);
	$detail_bayar->uploadBuktiPembayaran($_REQUEST['id_invest'],$movefile,$_REQUEST['status'],$_REQUEST['admin']);
	header("location:approval_pengembalian.php");
} elseif ($aksi == "mou") {
	if (($_FILES['mou']['name']!="")){
		// Where the file is going to be stored
			$target_dir = "../MOU/";
			$file = $_FILES['mou']['name'];
			$path = pathinfo($file);
			$filename = $path['filename'];
			$x = explode('.', $file);
			$ekstensi = strtolower(end($x));
			$ext = $path['extension'];
			$movefile = $filename."_".$_REQUEST['id']."_".$_REQUEST['investor'].".".$ext;
			$temp_name = $_FILES['mou']['tmp_name'];
			$path_filename_ext = $target_dir.$movefile;
		
		// Check if file already exists
			if (file_exists($path_filename_ext)) {
				echo "Sorry, file already exists.";
			}else{
				move_uploaded_file($temp_name,$path_filename_ext);
				echo "Congratulations! File Uploaded Successfully.";
			}
			$mou->kirimMOU($_REQUEST['id'],$movefile);
			 header("location:list_mou.php");
		}
} elseif ($aksi == 'mou_valid') {
	$mou->setujuiMOU($_REQUEST['id']);
	header("location:list_mou.php");
} elseif ($aksi == 'mou_invalid'){
	if ($_REQUEST['opsi'] == 'p') {
		$mou->invalidPengrajin($_REQUEST['id']);
		header("location:list_mou.php");
	} elseif ($_REQUEST['opsi'] == 'i') {
		$mou->invalidInvestor($_REQUEST['id']);
		header("location:list_mou.php");
	} elseif ($_REQUEST['opsi'] == 'ip') {
		$docx = 'SURAT_PERJANJIAN_INVESTASI.docx';
		$mou->invalidKeduanya($_REQUEST['id'],$docx);
		header("location:list_mou.php");
	}
}
?>
