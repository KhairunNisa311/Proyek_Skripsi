<?php
include("connect.php");
$get = $_REQUEST['get'];
switch($get){
	case 'kriteria'	: 
		post_kriteria();    
	break;
	case 'alternatif'	: 
		alternatif();    
	break;
}

function post_kriteria(){

	global $con;
	$KodeKriteria = $_REQUEST['KodeKriteria'];
	$NamaKriteria = $_REQUEST['NamaKriteria'];
	$Status = $_REQUEST['status'];
	
	$msg = "";
	
	
	if($KodeKriteria == ""){
		$msg .= "Kode Kriteria ";
	} else if($NamaKriteria == ""){
		$msg .= "Nama Kriteria tidak boleh kosong";
	} else {
		
		if($Status == "edit"){
			$sql="update kriteria set 
			NamaKriteria='$NamaKriteria' 
			where KodeKriteria='$KodeKriteria'";		
		} else {
			$sql="insert into kriteria set
			KodeKriteria='$KodeKriteria',
			NamaKriteria='$NamaKriteria'";							
		}		
			mysqli_query($con,$sql);
	}
	
	if($msg != ""){
		echo json_encode($msg);
	} else {
		echo json_encode("sukses");
	}
	
}

?>