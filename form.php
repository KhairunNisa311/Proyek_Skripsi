<?php

include("connect.php");
$get = $_REQUEST['get'];

switch($get){
	case 'kriteria'	: 
		kriteria_form();    
	break;
	case 'alternatif'	: 
		alternatif_form();    
	break;
}

function kriteria_form(){	
	global $con;
	$key=($_REQUEST['key']=="")?"":$_REQUEST['key'];
	
	$qry = mysqli_query($con,"select KodeKriteria,NamaKriteria from kriteria where KodeKriteria = '$key'");
	$row = mysqli_fetch_array($qry);
	
	$value = ($key=="")?["","",""]:[$row['KodeKriteria'],$row['NamaKriteria'],"disabled"];
	$input = "KodeKriteria_NamaKriteria";
	
	$data = '';		
	$data .= '<div class="col-12 col-sm-5">';						
	$data .= '<div class="card border">';			
	$data .= '<div class="card-header">';
	$data .= '<h5>FORM KRITERIA</h5>';
	
	$data .= '</div>';			
	$data .= '<div class="card-body">';
	$data .= '<form>';
	$data .= '<div class="form-group">';
	$data .= '<label for="exampleFormControlInput1">Kode Kriteria</label>';
	$data .= '<input type="text" autocomplete="off" class="form-control border border-secondary" '.$value[2].' value="'.$value[0].'" id="KodeKriteria">';
	$data .= '</div>';

	$data .= '<div class="form-group">';
	$data .= '<label for="exampleFormControlInput1">Nama Kriteria</label>';
	$data .= '<input type="text" autocomplete="off" class="form-control border border-secondary" value="'.$value[1].'" id="NamaKriteria">';
	$data .= '</div>';					
	$data .= '</form>';
	$data .= '</div>';						
	$data .= '<div class="card-footer bg-white">';
	$data .= '<a type="button" class="btn btn-success mx-sm-1" href="javascript:_submit(\''.$input.'\');">Submit</a>';
	$data .= '<a type="button" class="btn btn-primary mx-sm-1" href="javascript:_cancel();">Cancel</a>';
	$data .= '</div>';			
	$data .= '</div>';
	$data .= '<div class="alert alert-danger mt-2" role="alert" id="_error">';
	$data .= '</div>';		
	$data .= '</div>';
	
	echo json_encode($data);		
}

function alternatif_form(){	
	$data = '';		
	$data .= '<div class="col-12 col-sm-5">';						
	$data .= '<div class="card border border-secondary">';			
	$data .= '<div class="card-header bg-dark text-white">';
	$data .= '<h5>FORM ALTERNATIF</h5>';
	
	$data .= '</div>';			
	$data .= '<div class="card-body">';
	$data .= '<form>';
	$data .= '<div class="form-group">';
	$data .= '<label for="exampleFormControlInput1">Kode Alternatif</label>';
	$data .= '<input type="text" class="form-control border border-secondary" id="Kode">';
	$data .= '</div>';

	$data .= '<div class="form-group">';
	$data .= '<label for="exampleFormControlInput1">Nama Alternatif</label>';
	$data .= '<input type="text" class="form-control border border-secondary" id="Alternatif">';
	$data .= '</div>';					
	$data .= '</form>';
	$data .= '</div>';						
	$data .= '<div class="card-footer">';
	$data .= '<button type="button" class="btn btn-success mx-sm-1 btn-submit">Submit</button>';
	$data .= '<a type="button" class="btn btn-primary mx-sm-1" href="javascript:_cancel();">Cancel</a>';
	$data .= '</div>';			
	$data .= '</div>';			
	$data .= '</div>';	
	
	echo json_encode($data);		
}

?>