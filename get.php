<?php
include("connect.php");
$get = $_REQUEST['get'];
switch($get){
	case 'listrecord'	: 
		listrecord();    
	break;	
	
	case 'form'	: 
		form();    
	break;	

	case 'crud'	: 
		crud();    
	break;
	
	case 'pembobotan'	: 
		pembobotan();    
	break;	

	case 'nilai'	: 
		nilai();    
	break;

	case 'fahp'	: 
		fahp();    
	break;
	
	case 'rangking'	: 
		rangking();    
	break;	
}


function rangking(){
	//error_reporting( error_reporting() & ~E_NOTICE );
	error_reporting(0);
	$get_kriteria = getdata("kriteria");		
	
	$check = checknilai('1');
	$strarr = $check;
	
	$data = '';
	$data .= '<div class="col-12 col-sm-12">';
	$j = array();
	$t = array();
	$jlh = array();
	$k = array(); 
	$prior = array();
	$xttl = array();
	$ujl = array();
	$ujl2 = array();
	$xx = array();
	$yy = array();
	$bobot_ = array();

/*
	$data .='<div class="table-responsive mb-3">';
	$data .='<table class="table table-sm">';
	$data .='<thead>';
	$data .= "<tr>";
	$data .= "<th class='text-center border bg-white text-dark' colspan='2'> ".strtoupper("List Daftar Kriteria")."</th>";     
	$data .= "</tr>"; 	    
	$data .= "<tr>";
	$data .= "<th class='bg-success border text-center text-light' width='10%'>Kode</th>";
	$data .= "<th class='bg-success border text-left text-light'>&nbsp; Nama Kriteria</th>";
	$data .= "</tr>"; 	    	    
	
	for($i = 0; $i < count($get_kriteria); $i++){
		$data .= "<tr>"; 
		$data .= "<td class='border text-center'>".$get_kriteria[$i]."</td>";	
		$data .= "<td class='border text-left'> &nbsp; ".getnama('kriteria',$get_kriteria[$i])."</td>";	
		$data .= "</tr>"; 
	}
	$data .='</thead>';
	$data .='<body>';
	
	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>';
*/

	/*
	$nkriteries['C1'] = [1,0.25,3,0.5,3];
	$nkriteries['C2'] = [4,1,2,3,5];
	$nkriteries['C3'] = [0.333333333,0.5,1,3,6];
	$nkriteries['C4'] = [2,0.333333333,0.333333333,1,2];
	$nkriteries['C5'] = [0.333333333,0.2,0.166666667,0.5,1];
	*/
/*
	$data .='<div class="table-responsive mb-3 mt-3">';
	$data .='<table class="table table-sm">';
	$data .='<thead>';
	$data .= "<tr>";
	$data .= "<th class='border' rowspan='2'>&nbsp;</th>"; 
	$data .= "<th class='text-center border bg-white text-dark' colspan='".(count($get_kriteria))."'> ".strtoupper("Inputan Nilai Perbandingan Antar Kriteria")."</th>";     
	$data .= "</tr>"; 	    
	$data .= "<tr>"; 	    
	
	for($i = 0; $i < count($get_kriteria); $i++){	
		$data .= "<th class='bg-light border text-center text-muted'>".$get_kriteria[$i]."</th>";	
	}
	$data .= "</tr>";    
	$data .='</thead>';
	$data .='<body>';
	*/
	foreach($strarr as $i => $v){
		//$data .= "<tr>"; 
		//$data .= "<th class='bg-light text-center text-muted border' width='10%'>".$i."</th>";		
		$nl = 0;
		$mx = 0;
		for($x = 0; $x < count($get_kriteria); $x++){
			//$data .= "<td class='border text-center'>".$nkriteries[$i][$mx]."</td>";
			//$data .= "<td class='border text-center'>".$strarr[$i][$x]['nilai']."</td>";
			$mx++;
		}
		
		//$data .= "</tr>"; 
	} 
/*
	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>';



	$data .='<div class="table-responsive mb-3">';
	$data .='<table class="table table-sm">';
	$data .='<thead>';
	$data .= "<tr>";
	$data .= "<th class='border border' rowspan='3' width='10%'></th>"; 
	$data .= "<th class='text-center bg-white text-dark border' colspan='".((count($get_kriteria)+3)*3)."'>".strtoupper("Konversi Nilai Perbandingan Antar Kriteria Ke Matriks Berpasangan Fuzzy")."</th>";
	$data .= "</tr>";  
	$data .= "<tr>";
	
*/
	for($i = 0; $i < count($get_kriteria); $i++){
		//$data .= "<th class='bg-light text-center text-muted border' colspan='3'>".$get_kriteria[$i]."</th>"; 
		$j[] = $get_kriteria[$i];
		$jlh[$get_kriteria[$i]]['jumlah']=0;
		$prior[$get_kriteria[$i]]['jumlah']=0;
		$k[$get_kriteria[$i]]['jumlah']=0;	
		$bobot_[$get_kriteria[$i]]['jumlah']=0;
		$bobot_[$get_kriteria[$i]]['bagi']=0;
		$bobot_[$get_kriteria[$i]]['total']=0;
		$xttl[$get_kriteria[$i]]['l']=0;
		$xttl[$get_kriteria[$i]]['m']=0;
		$xttl[$get_kriteria[$i]]['u']=0;
		$xx[$get_kriteria[$i]]['l'] = 1;
		$xx[$get_kriteria[$i]]['m'] = 1;
		$xx[$get_kriteria[$i]]['u'] = 1;
	}  
	/*
	$data .= "</tr>";  
	$data .= "<tr>"; 
	
	for($i = 0; $i < count($get_kriteria); $i++){
		$data .= "<th class='bg-secondary text-light text-center border'>l</th>"; 
		$data .= "<th class='bg-secondary text-light text-center border'>m</th>"; 
		$data .= "<th class='bg-secondary text-light border text-center'>u</th>"; 
	} 
	
	$data .= "</tr>";
	*/
	$iu = array();
	$lmu = array("l","m","u");
	
	$ky = 0;
	//$data .='</thead>';
	
	//$data .='<tbody>';

	
	foreach($strarr as $i => $v){	
		//$data .= "<tr><th class='text-center bg-light text-muted border'>".$i."</th>";	
		$t = 0;
		
		for($x = 0; $x < count($get_kriteria); $x++){
			
			if($strarr[$i][$x]['nilai']==0){
				$w = explode("-",$iu[$i][$j[$t]]);
				$b = explode("-",$iu[$j[$t]][$j[$t]]);
				$m = ($b[2]/$w[2])."-".($b[1]/$w[1])."-".($b[0]/$w[0]);
			} else {
				$qp = msf($strarr[$i][$x]['nilai'],"skalafuzzy");
				$iu[$j[$t]][$i] = $qp; 
				$m = $iu[$j[$t]][$i];
			}
			
			$n = explode("-",$m);
			
			for($r = 0; $r < count($n);$r++){
				$ppo = round($n[$r],3);
				//$data .= "<td class='text-center border'>".$ppo." </td>";
				$xttl[$j[$t]][$lmu[$r]] += $ppo;
				$yttl[$i][$lmu[$r]][] = $ppo;
				$xx[$j[$t]][$lmu[$r]] += $ppo;
			}		  
			$t++;	  
		}
		//$data .= "</tr>";
		$ky++;
	}  
/*
	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>'; 
	
	$data .='<div class="table-responsive mb-3">';
	$data .='<table class="table table-sm">';
	$data .='<thead>';
	$data .= "<tr>";
	$data .= "<th rowspan='3' class='border' width='10%'>&nbsp;</th>";	
	$data .= "<th class='text-center bg-white text-dark border' colspan='".((count($get_kriteria)+1)*3)."'>".strtoupper("Mean Geometri Untuk Masing - Masing Kriteria")."</th></tr>";  
	$data .= "<tr>";
	
	
	foreach($yttl as $i =>$v){	
		$data .= "<th class='border text-center text-muted bg-light' colspan='3'>".$i."</th>";		
	}  
	$data .= "</tr>"; 
	$data .= "<tr>";
	*/
	
	foreach($yttl as $i =>$v){	
	
		foreach($v as $p =>$o){			
			//$data .= "<th class='text-center bg-secondary text-light border'>".$p."</th>";
			$ujl[$i][$p] = 1;
			$ujl2[$i][$p] = 0;
		}
		
	}
	/*
	$data .= "</tr>";
	$data .='</thead>';
	$data .='<body>';
	*/
	$e = 0;

	foreach($yttl as $i =>$v){
		//$data .= "<tr>";
		//$data .= "<th class='bg-light text-center text-muted border'>".$i."</th>";
		
		$ky = 0;
		foreach($yttl as $ii =>$vv){	  	  
			
			
			foreach($v as $p =>$o){
				//$mkp = ($ky == $e)?" style='background-color:#85929E;color:white'":"";
				$bb = $yttl[$ii][$p][$e];
				//$data .= "<td class='text-center border'>".$yttl[$ii][$p][$e]." </td>";
				$ujl[$ii][$p]*=$bb;
				$ujl2[$ii][$p]+=$bb;
				
			}
			$ky++;
		}	
		//$data .= "</tr>"; 
		$e++;  
	}

	foreach($ujl2 as $i => $v){
		foreach($v as $a => $b){ 
			$xy[$i][$a] =  round($ujl2[$i][$a],3);
		}
	}     

	for($i = 0;$i<count($lmu);$i++){  
		$yy[$lmu[$i]]['jumlah']=0;
	}

	$jj = array();	
	foreach($xy as $i => $v){  
		$jj[$i]['total'] = 0;

		foreach($v as $ii => $vv){  
			$yy[$ii]['jumlah'] += $xy[$i][$ii];
			$fuzzyahp[$i][] = $xy[$i][$ii];		  
		}	
	}

	$f = 2;
	foreach($yy as $i => $v){
		$ll = $yy[$i]['jumlah'];
		$jm[$f] = $ll;
		$f--;
	}    
	$ghj = array();
	
	for($i = 0;$i<count($lmu);$i++){  
		$ghj[$lmu[$i]]['jumlah'] = 0;
	}

	$hh = array();
	foreach($xy as $i => $v){  
		$oo = 0;				
		foreach($v as $ii => $vv){
			$op = $xy[$i][$ii]*(1/$jm[$oo]);
			$op = round($op,3);
			$oo++;
			$ghj[$ii]['jumlah'] += $op;
			$jj[$i]['total'] += $op;
			$hh[$i][$oo] = $op;
			$mk = round($jj[$i]['total'],3);
			$fuzzyahp[$i][] = $op;
		}
	}

	$no=0;
	$kju = 0;
	foreach($jj as $i => $v){  
		unset($kll); 
		$kll = array();		
		foreach($jj as $ii => $vv){
			unset($c1); 
			unset($c2);
			$c1 = array();
			$c2 = array();	  			
			if($i != $ii){				
				if($jj[$i]['total']>$jj[$ii]['total']){		  
					$kll[] = 1;
				} else {
			
					sort($hh[$ii]);				
					foreach($hh[$ii] as $mm){
						$c1[] = round($mm,3);
					}	
		  
					rsort($hh[$i]);				
					foreach($hh[$i] as $mm){
						$c2[] = round($mm,3);
					}		  
					$cc = ($c1[0]-$c2[0])/(($c2[1]-$c2[0])-($c1[1]-$c1[0]));
					$mkl = round($cc,3);
					$kll[] = $mkl;		  
				}
			}
	  
		}
	
		unset($pi); 
		$pi = array();

		if($no>1){
			$kil = $no-1;		
			for($lp=0;$lp<$kil;$lp++){
				$pi[] = 0;
			}	  	  		
			
			for($r = $kil; $r<count($kll); $r++){
				$pi[] = $kll[$r];
			}	  
		} else {
			$pi = $kll;
		}

		$mo = implode(",",$pi);
		$min = min($pi);
		$fuzzyahp2[$i]['bobot_vector'] = $mo;
		$nbv[$i]['jumlah'] = $min;
		$kju +=$min;
		$no++;
	}

	//$data .= "</tr>";
	$jkp['min'] = 0;
	$jkp['nilai'] = 0;
	$bobot = array();
	
	foreach($nbv as $i => $v){  
		$jkp['min'] += $nbv[$i]['jumlah'];
		$w = ($nbv[$i]['jumlah'] / $kju);
		$w = round($w,3);
		$jkp['nilai'] += $w;
		$bobot[]['w'] = $w;
		$fuzzyahp2[$i]['normalisasi_min'] = $nbv[$i]['jumlah'];
		$fuzzyahp2[$i]['normalisasi_nilai'] = $w;
	} 
/*
	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>'; 

	$data .='<div class="table-responsive mb-3 mt-0">';
	$data .='<table class="table table-sm">';
	$data .='<thead>'; 
*/
	$title = array(
		"Fuzzy Tringular Number" => array("l","m","u"),
		"Sintesis Fuzzy" => array("l","m","u"),
		"Bobot Vector" => array("Nilai"),
		"Normalisasi" => array("Min","Nilai"),
	);

	$colspan = array("colspan = '3'", "colspan = '3'", "colspan = '1'", "colspan = '2'");
	//$data .= "<tr>";
	//$data .= "<td class='border' rowspan='2' width='10%'>&nbsp;</td>";		
	$h = 0;
	$mmi = (95/4)."%";
	foreach($title as $i => $v){
		//$data .= "<th class='text-center border bg-white text-dark' width='".$mmi."' ".$colspan[$h].">".strtoupper($i)."</th>";    
		$h++;
	}	
	//$data .= "</tr>";  
	//$data .= "<tr>";
	
	$mkkp = 0;
	$arr_total = array();
	foreach($title as $i => $v){
		$h = 0;
		
		foreach($v as $ii => $vv){
			$arr_total [$mkkp]['total']= 0;
			//$data .= "<th class='border-left text-center bg-secondary text-light'>".$title[$i][$h]." </th>"; 
			$h++;
			$mkkp++;
		}
	}	
	/*
	$data .= "</tr>";	
	$data .='</thead>'; 
	$data .='<body>'; 
	*/
	foreach($fuzzyahp as $i => $v){
		//$data .= "<tr>";
		//$data .= "<th class='text-center bg-light border text-muted'>".$i." </th>"; 
		
		
		for($p = 0; $p < count($v); $p++){
			//$bg = ($p < 3)?'':'style="background-color:#F5F5DC"';
			//$data .= "<td class='text-center border'>".$fuzzyahp[$i][$p]." </td>";
			$arr_total [$p]['total'] += $fuzzyahp[$i][$p];
		}
		/*
		$data .= "<td class='text-center border'> ".$fuzzyahp2[$i]['bobot_vector']." </td>"; 
		$data .= "<td class='text-center border'> ".$fuzzyahp2[$i]['normalisasi_min']." </td>"; 
		$data .= "<td class='text-center border'> ".$fuzzyahp2[$i]['normalisasi_nilai']." </td>"; 
		$data .= "</tr>";
		*/
	}
	
	//$data .= "<tr class='bg-white text-muted'>";
	//$data .= "<th class='text-center border'>Total</th>";
	/*
	for($i = 0 ;$i < 3; $i++){
		$data .= "<th class='text-center border'>".$arr_total [$i]['total']." </th>";
	}
	$data .= "</tr>";
	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>';  
	
		*/
	$check = checknilai('2');
	$strarr = $check;
/*
	$data .='<div class="table-responsive mb-3 mt-4">';
	$data .='<table class="table table-sm">';
	$data .='<thead>';
	$data .= "<tr>";
	$data .= "<th class='text-center border bg-white text-dark' colspan='2'> ".strtoupper("List Daftar Alternatif")."</th>";     
	$data .= "</tr>"; 	    
	$data .= "<tr>";
	$data .= "<th class='bg-success border text-center text-light' width='10%'>Kode</th>";
	$data .= "<th class='bg-success border text-left text-light'>&nbsp; Nama Alternatif</th>";
	$data .= "</tr>"; 	    	    
	
	foreach($strarr as $i => $v){
		$data .= "<tr>"; 
		$data .= "<td class='border text-center'>".$i."</td>";	
		$data .= "<td class='border text-left'> &nbsp; ".getnama('alternatif',$i)."</td>";	
		$data .= "</tr>"; 
	}
	$data .='</thead>';
	$data .='<body>';
	
	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>';

	$data .='<div class="table-responsive mb-3 mt-3">';
	$data .='<table class="table table-sm">';
	$data .='<thead>';
	$data .= "<tr>";
	$data .= "<th class='border' rowspan='2'>&nbsp;</th>"; 
	$data .= "<th class='text-center border bg-white text-dark' colspan='".(count($get_kriteria)+2)."'> ".strtoupper("Inputan Nilai Bobot Kriteria Dari Masing-Masing Alternatif")."</th>";     
	$data .= "</tr>"; 	    
	$data .= "<tr>"; 	    
	
	for($i = 0; $i < count($get_kriteria); $i++){	
		$data .= "<th class='bg-light border text-center text-muted'>".$get_kriteria[$i]."</th>";	
	}
	$data .= "</tr>";    
	$data .='</thead>';
	$data .='<body>';
	*/
	foreach($strarr as $i => $v){
		//$data .= "<tr>"; 
		//$data .= "<th class='bg-light text-center text-muted border' width='10%'>".$i."</th>";		
		$nl = 0;
		for($x = 0; $x < count($get_kriteria); $x++){
			$ml = round($strarr[$i][$x]['nilai'],2);
			$ml = bobotnama($ml);
			//$data .= "<td class='border text-center'>".$ml."</td>";
			$nl += $km;
		}
				
		//$data .= "</tr>"; 
	} 
/*
	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>';

	$data .='<div class="table-responsive mb-3 mt-3">';
	$data .='<table class="table table-sm">';
	$data .='<thead>';
	$data .= "<tr>";
	$data .= "<th class='border' rowspan='2'>&nbsp;</th>"; 
	$data .= "<th class='text-center border bg-white text-dark' colspan='".(count($get_kriteria)+2)."'> ".strtoupper("Konversi Nilai Bobot Kriteria Dari Masing-Masing Alternatif")."</th>";     
	$data .= "</tr>"; 	    
	$data .= "<tr>"; 	    
	
	for($i = 0; $i < count($get_kriteria); $i++){	
		$data .= "<th class='bg-light border text-center text-muted'>".$get_kriteria[$i]."</th>";	
	}	
	$data .= "</tr>";    
	$data .='</thead>';
	$data .='<body>';
	*/
	foreach($strarr as $i => $v){
		//$data .= "<tr>"; 
	//	$data .= "<th class='bg-light text-center text-muted border' width='10%'>".$i."</th>";		
		$nl = 0;
		for($x = 0; $x < count($get_kriteria); $x++){
			//$data .= "<td class='border text-center'>".$strarr[$i][$x]['nilai']."</td>";
		}			
		//$data .= "</tr>"; 
	} 
/*
	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>';
	
	$data .='<div class="table-responsive mb-3 mt-3">';
	$data .='<table class="table table-sm">';
	$data .='<thead>';
	$data .= "<tr>";
	$data .= "<th class='border' rowspan='2' width='10%'>&nbsp;</th>"; 
	$data .= "<th class='text-center border bg-white text-dark' colspan='".(count($get_kriteria)+2)."'> ".strtoupper("Perhitungan Bobot Nilai Kriteria Dari Masing-Masing Alternatif")."</th>";     
	$data .= "</tr>"; 	    
	$data .= "<tr>"; 	    
	
	for($i = 0; $i < count($get_kriteria); $i++){	
		$data .= "<th class='bg-light border text-center text-muted'>".$get_kriteria[$i]."</th>";	
	}
	$data .= "<th class='bg-light text-center border'>Nilai</th>";	
	$data .= "</tr>";    
	$data .='</thead>';
	$data .='<body>';
	*/
	foreach($strarr as $i => $v){
		//$data .= "<tr>"; 
		//$data .= "<th class='bg-light text-center text-muted border'>".$i."</th>";		
		$nl = 0;
		for($x = 0; $x < count($get_kriteria); $x++){
			$km = ($bobot[$x]['w'] * $strarr[$i][$x]['nilai']);
			//$data .= "<td class='border text-center'>".$km."</td>";
			$nl += $km;
		}
		
		$ranking[$i]['ranking'] = $nl;
		//$data .= "<td class='border text-center'>".$nl." </td>";		
		//$data .= "</tr>"; 
	} 
/*
	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>';
*/

	$data .='<div class="table-responsive mb-3 mt-3">';
	$data .='<table class="table table-sm">';
	$data .='<thead>';
	$data .= "<tr><th class='text-center bg-white border text-dark' colspan='3'> ".strtoupper("Urutan Ranking Alternatif")."</th></tr>";       
	$data .= "<tr>"; 
	$data .= "<th width='10%' class='text-center bg-light text-muted border'>Kode</th>";     
	$data .= "<th class='text-left bg-light border text-muted'>&nbsp; Alternatif</th>";     
	$data .= "<th class='text-center bg-light border text-muted'>Nilai</th>";
	$data .= "</tr>";
	$data .='</thead>';
	$data .='<body">';	

	arsort($ranking);
	foreach($ranking as $i => $v){
		$data .= "<tr>"; 
		$data .= "<td class='text-center border'>".$i."</td>";
		$data .= "<td class='text-left border'>&nbsp; ".getnama('alternatif',$i)."</td>";
		$data .= "<td class='text-center border' width='10%'>".$ranking[$i]['ranking']." </td>";
		$data .= "</tr>";
	}

	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>';
	$data .= '<div class="text-center">';
	$data .= '<button onclick="printTable()" class="btn btn-primary mt-3">Cetak</button>';
	$data .= '</div>';

	$data .= '<script>
	function printTable() {
    var printContents = document.querySelector(".table-responsive").innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
	}
	</script>';
	
	echo  json_encode($data);
}


function fahp(){
	//error_reporting( error_reporting() & ~E_NOTICE );
	error_reporting(0);
	$get_kriteria = getdata("kriteria");		
	
	$check = checknilai('1');
	$strarr = $check;
	
	$data = '';
	$data .= '<div class="col-12 col-sm-12">';
	$j = array();
	$t = array();
	$jlh = array();
	$k = array(); 
	$prior = array();
	$xttl = array();
	$ujl = array();
	$ujl2 = array();
	$xx = array();
	$yy = array();
	$bobot_ = array();


	$data .='<div class="table-responsive mb-3">';
	$data .='<table class="table table-sm">';
	$data .='<thead>';
	$data .= "<tr>";
	$data .= "<th class='text-center border bg-white text-dark' colspan='2'> ".strtoupper("List Daftar Kriteria")."</th>";     
	$data .= "</tr>"; 	    
	$data .= "<tr>";
	$data .= "<th class='bg-success border text-center text-light' width='10%'>Kode</th>";
	$data .= "<th class='bg-success border text-left text-light'>&nbsp; Nama Kriteria</th>";
	$data .= "</tr>"; 	    	    
	
	for($i = 0; $i < count($get_kriteria); $i++){
		$data .= "<tr>"; 
		$data .= "<td class='border text-center'>".$get_kriteria[$i]."</td>";	
		$data .= "<td class='border text-left'> &nbsp; ".getnama('kriteria',$get_kriteria[$i])."</td>";	
		$data .= "</tr>"; 
	}
	$data .='</thead>';
	$data .='<body>';
	
	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>';


	/*
	$nkriteries['C1'] = [1,0.25,3,0.5,3];
	$nkriteries['C2'] = [4,1,2,3,5];
	$nkriteries['C3'] = [0.333333333,0.5,1,3,6];
	$nkriteries['C4'] = [2,0.333333333,0.333333333,1,2];
	$nkriteries['C5'] = [0.333333333,0.2,0.166666667,0.5,1];
	*/

	$data .='<div class="table-responsive mb-3 mt-3">';
	$data .='<table class="table table-sm">';
	$data .='<thead>';
	$data .= "<tr>";
	$data .= "<th class='border' rowspan='2'>&nbsp;</th>"; 
	$data .= "<th class='text-center border bg-white text-dark' colspan='".(count($get_kriteria))."'> ".strtoupper("Inputan Nilai Perbandingan Antar Kriteria")."</th>";     
	$data .= "</tr>"; 	    
	$data .= "<tr>"; 	    
	
	for($i = 0; $i < count($get_kriteria); $i++){	
		$data .= "<th class='bg-light border text-center text-muted'>".$get_kriteria[$i]."</th>";	
	}
	$data .= "</tr>";    
	$data .='</thead>';
	$data .='<body>';
	
	foreach($strarr as $i => $v){
		$data .= "<tr>"; 
		$data .= "<th class='bg-light text-center text-muted border' width='10%'>".$i."</th>";		
		$nl = 0;
		$mx = 0;
		for($x = 0; $x < count($get_kriteria); $x++){
			//$data .= "<td class='border text-center'>".$nkriteries[$i][$mx]."</td>";
			$data .= "<td class='border text-center'>".$strarr[$i][$x]['nilai']."</td>";
			$mx++;
		}
		
		$data .= "</tr>"; 
	} 

	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>';



	$data .='<div class="table-responsive mb-3">';
	$data .='<table class="table table-sm">';
	$data .='<thead>';
	$data .= "<tr>";
	$data .= "<th class='border border' rowspan='3' width='10%'></th>"; 
	$data .= "<th class='text-center bg-white text-dark border' colspan='".((count($get_kriteria)+3)*3)."'>".strtoupper("Konversi Nilai Perbandingan Antar Kriteria Ke Matriks Berpasangan Fuzzy")."</th>";
	$data .= "</tr>";  
	$data .= "<tr>";
	

	for($i = 0; $i < count($get_kriteria); $i++){
		$data .= "<th class='bg-light text-center text-muted border' colspan='3'>".$get_kriteria[$i]."</th>"; 
		$j[] = $get_kriteria[$i];
		$jlh[$get_kriteria[$i]]['jumlah']=0;
		$prior[$get_kriteria[$i]]['jumlah']=0;
		$k[$get_kriteria[$i]]['jumlah']=0;	
		$bobot_[$get_kriteria[$i]]['jumlah']=0;
		$bobot_[$get_kriteria[$i]]['bagi']=0;
		$bobot_[$get_kriteria[$i]]['total']=0;
		$xttl[$get_kriteria[$i]]['l']=0;
		$xttl[$get_kriteria[$i]]['m']=0;
		$xttl[$get_kriteria[$i]]['u']=0;
		$xx[$get_kriteria[$i]]['l'] = 1;
		$xx[$get_kriteria[$i]]['m'] = 1;
		$xx[$get_kriteria[$i]]['u'] = 1;
	}  
	
	$data .= "</tr>";  
	$data .= "<tr>"; 
	
	for($i = 0; $i < count($get_kriteria); $i++){
		$data .= "<th class='bg-secondary text-light text-center border'>l</th>"; 
		$data .= "<th class='bg-secondary text-light text-center border'>m</th>"; 
		$data .= "<th class='bg-secondary text-light border text-center'>u</th>"; 
	} 
	
	$data .= "</tr>";
	
	$iu = array();
	$lmu = array("l","m","u");
	
	$ky = 0;
	$data .='</thead>';
	
	$data .='<tbody>';

	
	foreach($strarr as $i => $v){	
		$data .= "<tr><th class='text-center bg-light text-muted border'>".$i."</th>";	
		$t = 0;
		
		for($x = 0; $x < count($get_kriteria); $x++){
			
			if($strarr[$i][$x]['nilai']==0){
				$w = explode("-",$iu[$i][$j[$t]]);
				$b = explode("-",$iu[$j[$t]][$j[$t]]);
				$m = ($b[2]/$w[2])."-".($b[1]/$w[1])."-".($b[0]/$w[0]);
			} else {
				$qp = msf($strarr[$i][$x]['nilai'],"skalafuzzy");
				$iu[$j[$t]][$i] = $qp; 
				$m = $iu[$j[$t]][$i];
			}
			
			$n = explode("-",$m);
			
			for($r = 0; $r < count($n);$r++){
				$ppo = round($n[$r],3);
				$data .= "<td class='text-center border'>".$ppo." </td>";
				$xttl[$j[$t]][$lmu[$r]] += $ppo;
				$yttl[$i][$lmu[$r]][] = $ppo;
				$xx[$j[$t]][$lmu[$r]] += $ppo;
			}		  
			$t++;	  
		}
		$data .= "</tr>";
		$ky++;
	}  

	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>'; 
	
	$data .='<div class="table-responsive mb-3">';
	$data .='<table class="table table-sm">';
	$data .='<thead>';
	$data .= "<tr>";
	$data .= "<th rowspan='3' class='border' width='10%'>&nbsp;</th>";	
	$data .= "<th class='text-center bg-white text-dark border' colspan='".((count($get_kriteria)+1)*3)."'>".strtoupper("Mean Geometri Untuk Masing - Masing Kriteria")."</th></tr>";  
	$data .= "<tr>";
	
	
	foreach($yttl as $i =>$v){	
		$data .= "<th class='border text-center text-muted bg-light' colspan='3'>".$i."</th>";		
	}  
	$data .= "</tr>"; 
	$data .= "<tr>";
	
	
	foreach($yttl as $i =>$v){	
	
		foreach($v as $p =>$o){			
			$data .= "<th class='text-center bg-secondary text-light border'>".$p."</th>";
			$ujl[$i][$p] = 1;
			$ujl2[$i][$p] = 0;
		}
		
	}
	$data .= "</tr>";
	$data .='</thead>';
	$data .='<body>';
	$e = 0;

	foreach($yttl as $i =>$v){
		$data .= "<tr>";
		$data .= "<th class='bg-light text-center text-muted border'>".$i."</th>";
		
		$ky = 0;
		foreach($yttl as $ii =>$vv){	  	  
			
			
			foreach($v as $p =>$o){
				//$mkp = ($ky == $e)?" style='background-color:#85929E;color:white'":"";
				$bb = $yttl[$ii][$p][$e];
				$data .= "<td class='text-center border'>".$yttl[$ii][$p][$e]." </td>";
				$ujl[$ii][$p]*=$bb;
				$ujl2[$ii][$p]+=$bb;
				
			}
			$ky++;
		}	
		$data .= "</tr>"; 
		$e++;  
	}

	foreach($ujl2 as $i => $v){
		foreach($v as $a => $b){ 
			$xy[$i][$a] =  round($ujl2[$i][$a],3);
		}
	}     

	for($i = 0;$i<count($lmu);$i++){  
		$yy[$lmu[$i]]['jumlah']=0;
	}

	$jj = array();	
	foreach($xy as $i => $v){  
		$jj[$i]['total'] = 0;

		foreach($v as $ii => $vv){  
			$yy[$ii]['jumlah'] += $xy[$i][$ii];
			$fuzzyahp[$i][] = $xy[$i][$ii];		  
		}	
	}

	$f = 2;
	foreach($yy as $i => $v){
		$ll = $yy[$i]['jumlah'];
		$jm[$f] = $ll;
		$f--;
	}    
	$ghj = array();
	
	for($i = 0;$i<count($lmu);$i++){  
		$ghj[$lmu[$i]]['jumlah'] = 0;
	}

	$hh = array();
	foreach($xy as $i => $v){  
		$oo = 0;				
		foreach($v as $ii => $vv){
			$op = $xy[$i][$ii]*(1/$jm[$oo]);
			$op = round($op,3);
			$oo++;
			$ghj[$ii]['jumlah'] += $op;
			$jj[$i]['total'] += $op;
			$hh[$i][$oo] = $op;
			$mk = round($jj[$i]['total'],3);
			$fuzzyahp[$i][] = $op;
		}
	}

	$no=0;
	$kju = 0;
	foreach($jj as $i => $v){  
		unset($kll); 
		$kll = array();		
		foreach($jj as $ii => $vv){
			unset($c1); 
			unset($c2);
			$c1 = array();
			$c2 = array();	  			
			if($i != $ii){				
				if($jj[$i]['total']>$jj[$ii]['total']){		  
					$kll[] = 1;
				} else {
			
					sort($hh[$ii]);				
					foreach($hh[$ii] as $mm){
						$c1[] = round($mm,3);
					}	
		  
					rsort($hh[$i]);				
					foreach($hh[$i] as $mm){
						$c2[] = round($mm,3);
					}		  
					$cc = ($c1[0]-$c2[0])/(($c2[1]-$c2[0])-($c1[1]-$c1[0]));
					$mkl = round($cc,3);
					$kll[] = $mkl;		  
				}
			}
	  
		}
	
		unset($pi); 
		$pi = array();

		if($no>1){
			$kil = $no-1;		
			for($lp=0;$lp<$kil;$lp++){
				$pi[] = 0;
			}	  	  		
			
			for($r = $kil; $r<count($kll); $r++){
				$pi[] = $kll[$r];
			}	  
		} else {
			$pi = $kll;
		}

		$mo = implode(",",$pi);
		$min = min($pi);
		$fuzzyahp2[$i]['bobot_vector'] = $mo;
		$nbv[$i]['jumlah'] = $min;
		$kju +=$min;
		$no++;
	}

	$data .= "</tr>";
	$jkp['min'] = 0;
	$jkp['nilai'] = 0;
	$bobot = array();
	
	foreach($nbv as $i => $v){  
		$jkp['min'] += $nbv[$i]['jumlah'];
		$w = ($nbv[$i]['jumlah'] / $kju);
		$w = round($w,3);
		$jkp['nilai'] += $w;
		$bobot[]['w'] = $w;
		$fuzzyahp2[$i]['normalisasi_min'] = $nbv[$i]['jumlah'];
		$fuzzyahp2[$i]['normalisasi_nilai'] = $w;
	} 

	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>'; 

	$data .='<div class="table-responsive mb-3 mt-0">';
	$data .='<table class="table table-sm">';
	$data .='<thead>'; 

	$title = array(
		"Fuzzy Tringular Number" => array("l","m","u"),
		"Sintesis Fuzzy" => array("l","m","u"),
		"Bobot Vector" => array("Nilai"),
		"Normalisasi" => array("Min","Nilai"),
	);

	$colspan = array("colspan = '3'", "colspan = '3'", "colspan = '1'", "colspan = '2'");
	$data .= "<tr>";
	$data .= "<td class='border' rowspan='2' width='10%'>&nbsp;</td>";		
	$h = 0;
	$mmi = (95/4)."%";
	foreach($title as $i => $v){
		$data .= "<th class='text-center border bg-white text-dark' width='".$mmi."' ".$colspan[$h].">".strtoupper($i)."</th>";    
		$h++;
	}	
	$data .= "</tr>";  
	$data .= "<tr>";
	
	$mkkp = 0;
	$arr_total = array();
	foreach($title as $i => $v){
		$h = 0;
		
		foreach($v as $ii => $vv){
			$arr_total [$mkkp]['total']= 0;
			$data .= "<th class='border-left text-center bg-secondary text-light'>".$title[$i][$h]." </th>"; 
			$h++;
			$mkkp++;
		}
	}	
	$data .= "</tr>";	
	$data .='</thead>'; 
	$data .='<body>'; 
	foreach($fuzzyahp as $i => $v){
		$data .= "<tr>";
		$data .= "<th class='text-center bg-light border text-muted'>".$i." </th>"; 
		
		
		for($p = 0; $p < count($v); $p++){
			//$bg = ($p < 3)?'':'style="background-color:#F5F5DC"';
			$data .= "<td class='text-center border'>".$fuzzyahp[$i][$p]." </td>";
			$arr_total [$p]['total'] += $fuzzyahp[$i][$p];
		}
		$data .= "<td class='text-center border'> ".$fuzzyahp2[$i]['bobot_vector']." </td>"; 
		$data .= "<td class='text-center border'> ".$fuzzyahp2[$i]['normalisasi_min']." </td>"; 
		$data .= "<td class='text-center border'> ".$fuzzyahp2[$i]['normalisasi_nilai']." </td>"; 
		$data .= "</tr>";
	}
	
	$data .= "<tr class='bg-white text-muted'>";
	$data .= "<th class='text-center border'>Total</th>";
	for($i = 0 ;$i < 3; $i++){
		$data .= "<th class='text-center border'>".$arr_total [$i]['total']." </th>";
	}
	$data .= "</tr>";
	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>';  
	
		
	$check = checknilai('2');
	$strarr = $check;

	$data .='<div class="table-responsive mb-3 mt-4">';
	$data .='<table class="table table-sm">';
	$data .='<thead>';
	$data .= "<tr>";
	$data .= "<th class='text-center border bg-white text-dark' colspan='2'> ".strtoupper("List Daftar Alternatif")."</th>";     
	$data .= "</tr>"; 	    
	$data .= "<tr>";
	$data .= "<th class='bg-success border text-center text-light' width='10%'>Kode</th>";
	$data .= "<th class='bg-success border text-left text-light'>&nbsp; Nama Alternatif</th>";
	$data .= "</tr>"; 	    	    
	
	foreach($strarr as $i => $v){
		$data .= "<tr>"; 
		$data .= "<td class='border text-center'>".$i."</td>";	
		$data .= "<td class='border text-left'> &nbsp; ".getnama('alternatif',$i)."</td>";	
		$data .= "</tr>"; 
	}
	$data .='</thead>';
	$data .='<body>';
	
	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>';

	$data .='<div class="table-responsive mb-3 mt-3">';
	$data .='<table class="table table-sm">';
	$data .='<thead>';
	$data .= "<tr>";
	$data .= "<th class='border' rowspan='2'>&nbsp;</th>"; 
	$data .= "<th class='text-center border bg-white text-dark' colspan='".(count($get_kriteria)+2)."'> ".strtoupper("Inputan Nilai Bobot Kriteria Dari Masing-Masing Alternatif")."</th>";     
	$data .= "</tr>"; 	    
	$data .= "<tr>"; 	    
	
	for($i = 0; $i < count($get_kriteria); $i++){	
		$data .= "<th class='bg-light border text-center text-muted'>".$get_kriteria[$i]."</th>";	
	}
	$data .= "</tr>";    
	$data .='</thead>';
	$data .='<body>';
	
	foreach($strarr as $i => $v){
		$data .= "<tr>"; 
		$data .= "<th class='bg-light text-center text-muted border' width='10%'>".$i."</th>";		
		$nl = 0;
		for($x = 0; $x < count($get_kriteria); $x++){
			$ml = round($strarr[$i][$x]['nilai'],2);
			$ml = bobotnama($ml);
			$data .= "<td class='border text-center'>".$ml."</td>";
			$nl += $km;
		}
				
		$data .= "</tr>"; 
	} 

	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>';

	$data .='<div class="table-responsive mb-3 mt-3">';
	$data .='<table class="table table-sm">';
	$data .='<thead>';
	$data .= "<tr>";
	$data .= "<th class='border' rowspan='2'>&nbsp;</th>"; 
	$data .= "<th class='text-center border bg-white text-dark' colspan='".(count($get_kriteria)+2)."'> ".strtoupper("Konversi Nilai Bobot Kriteria Dari Masing-Masing Alternatif")."</th>";     
	$data .= "</tr>"; 	    
	$data .= "<tr>"; 	    
	
	for($i = 0; $i < count($get_kriteria); $i++){	
		$data .= "<th class='bg-light border text-center text-muted'>".$get_kriteria[$i]."</th>";	
	}	
	$data .= "</tr>";    
	$data .='</thead>';
	$data .='<body>';
	
	foreach($strarr as $i => $v){
		$data .= "<tr>"; 
		$data .= "<th class='bg-light text-center text-muted border' width='10%'>".$i."</th>";		
		$nl = 0;
		for($x = 0; $x < count($get_kriteria); $x++){
			$data .= "<td class='border text-center'>".$strarr[$i][$x]['nilai']."</td>";
		}			
		$data .= "</tr>"; 
	} 

	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>';
	
	$data .='<div class="table-responsive mb-3 mt-3">';
	$data .='<table class="table table-sm">';
	$data .='<thead>';
	$data .= "<tr>";
	$data .= "<th class='border' rowspan='2' width='10%'>&nbsp;</th>"; 
	$data .= "<th class='text-center border bg-white text-dark' colspan='".(count($get_kriteria)+2)."'> ".strtoupper("Perhitungan Bobot Nilai Kriteria Dari Masing-Masing Alternatif")."</th>";     
	$data .= "</tr>"; 	    
	$data .= "<tr>"; 	    
	
	for($i = 0; $i < count($get_kriteria); $i++){	
		$data .= "<th class='bg-light border text-center text-muted'>".$get_kriteria[$i]."</th>";	
	}
	$data .= "<th class='bg-light text-center border'>Nilai</th>";	
	$data .= "</tr>";    
	$data .='</thead>';
	$data .='<body>';
	
	foreach($strarr as $i => $v){
		$data .= "<tr>"; 
		$data .= "<th class='bg-light text-center text-muted border'>".$i."</th>";		
		$nl = 0;
		for($x = 0; $x < count($get_kriteria); $x++){
			$km = ($bobot[$x]['w'] * $strarr[$i][$x]['nilai']);
			$data .= "<td class='border text-center'>".$km."</td>";
			$nl += $km;
		}
		
		$ranking[$i]['ranking'] = $nl;
		$data .= "<td class='border text-center'>".$nl." </td>";		
		$data .= "</tr>"; 
	} 

	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>';
/*
	$data .='<div class="table-responsive mb-3 mt-3">';
	$data .='<table class="table table-sm">';
	$data .='<thead>';
	$data .= "<tr><th class='text-center bg-white border text-dark' colspan='3'> ".strtoupper("Urutan Ranking Alternatif")."</th></tr>";       
	$data .= "<tr>"; 
	$data .= "<th width='10%' class='text-center bg-light text-muted border'>Kode</th>";     
	$data .= "<th class='text-left bg-light border text-muted'>&nbsp; Alternatif</th>";     
	$data .= "<th class='text-center bg-light border text-muted'>Nilai</th>";
	$data .= "</tr>";
	$data .='</thead>';
	$data .='<body">';	

	arsort($ranking);
	foreach($ranking as $i => $v){
		$data .= "<tr>"; 
		$data .= "<td class='text-center border'>".$i."</td>";
		$data .= "<td class='text-left border'>&nbsp; ".getnama('alternatif',$i)."</td>";
		$data .= "<td class='text-center border' width='10%'>".$ranking[$i]['ranking']." </td>";
		$data .= "</tr>";
	}

	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>';
	$data .='</div>';
	*/
	echo  json_encode($data);
}

function fahp_(){

	global $con;  
	
	$dt = array();
	$dt2 = array();
	$data = '';	
	
	$a = mysqli_query($con,"select nilaiperbandingan from nilai where id='1'");  
	$aa = mysqli_fetch_array($a);
	$key_kri = $aa['nilaiperbandingan'];
	$data .= $key_kri;
	$key_kri = explode("XXXX",$key_kri);
	$jlhk = count($key_kri)-1;  
	  
	for($i = 0; $i < $jlhk; $i++){
		$r = explode("__",$key_kri[$i]);	 
		$rr = explode("X",$r[1]);	
		$dt[$r[0]]['kriteria'] = $r[0];		
		
		for($c = 0;$c<count($rr); $c++){
			$dt2[$r[0]][$c]['nilai'] = $rr[$c];
		}	
	}


	$j = array();
	$t = array();
	$jlh = array();
	$k = array(); 
	$prior = array();
	$xttl = array();
	$ujl = array();
	$ujl2 = array();
	$xx = array();
	$yy = array();
	$bobot_ = array();

	$data .= "<table class='tbl1' width='100%'>";
	$data .= "<tr><th align='center' colspan='".((count($key_kri)+1)*3)."' style='border:0;color:white;background-color:grey;padding:0.1%;padding-left:0%'><strong>Matriks Perbandingan Kriteria</strong></th></tr>";
	$data .= "<tr><td align='center' style='border:0px;background-color:silver' rowspan='2'>&nbsp;</td>";  


	foreach($dt2 as $i => $v){
		$data .= "<th align='center' width='7%' colspan='3'>".$i."</th>"; 
		$j[] = $dt[$i]['kriteria'];
		$jlh[$i]['jumlah']=0;
		$prior[$i]['jumlah']=0;
		$k[$i]['jumlah']=0;	
		$bobot_[$i]['jumlah']=0;
		$bobot_[$i]['bagi']=0;
		$bobot_[$i]['total']=0;
		$xttl[$i]['l']=0;
		$xttl[$i]['m']=0;
		$xttl[$i]['u']=0;
		$xx[$i]['l'] = 1;
		$xx[$i]['m'] = 1;
		$xx[$i]['u'] = 1;
	}  
	$data .= "</tr>";  
	$data .= "<tr style='background-color:#E6E6FA'>";
	
	foreach($dt2 as $i => $v){	 
		$data .= "<td align='center'>l</td>"; 
		$data .= "<td align='center'>m</td>"; 
		$data .= "<td align='center'>u</td>"; 

	} 
	$data .= "</tr>";

	$iu = array();
	$lmu = array("l","m","u");
	
	foreach($dt2 as $i => $v){	
		$data .= "<tr><th align='center' width='3%'>".$i."</th>";	
		$t = 0;
		
		foreach($v as $x => $y){
			if($dt2[$i][$x]['nilai']==0){
				$w = explode("-",$iu[$i][$j[$t]]);
				$b = explode("-",$iu[$j[$t]][$j[$t]]);
				$m = ($b[2]/$w[2])."-".($b[1]/$w[1])."-".($b[0]/$w[0]);
			} else {
				$qp = msf($dt2[$i][$x]['nilai'],"skalafuzzy");
				$iu[$j[$t]][$i] = $qp; 
				$m = $iu[$j[$t]][$i];
			}
	  
			$n = explode("-",$m);
			
			for($r = 0; $r < count($n);$r++){
				$ppo = round($n[$r],3);
				$data .= "<td align='center'>".$ppo."</td>";
				$xttl[$j[$t]][$lmu[$r]] += $ppo;
				$yttl[$i][$lmu[$r]][] = $ppo;
				$xx[$j[$t]][$lmu[$r]] += $ppo;
			}
		  
			$t++;	  
		}
		$data .= "</tr>";		
	}  

	$data .= "</table><br>"; 
	
	$data .= "<table class='tbl1' width='100%'>";
	$data .= "<tr><th align='center' colspan='".((count($key_kri)+1)*3)."' style='border:0;color:white;background-color:grey;padding:0.2%;padding-left:0%'><strong>Mean Geometri</strong></th></tr>";  
	$data .= "<tr>";
	$data .= "<th align='center' style='border:0px;background-color:silver' rowspan='2'>&nbsp;</th>";	
	
	foreach($yttl as $i =>$v){	
		$data .= "<th align='center' colspan='3'>".$i."</th>";		
	}  
	$data .= "</tr>"; 
	$data .= "<tr>";
	
	foreach($yttl as $i =>$v){		
		foreach($v as $p =>$o){
			$data .= "<td align='center' style='background-color:#E6E6FA'>".$p."</td>";
			$ujl[$i][$p] = 1;
			$ujl2[$i][$p] = 0;
		}		
	}
	
	$data .= "</tr>";
	$e = 0;
	
	foreach($yttl as $i =>$v){
		$data .= "<tr>";
		$data .= "<th align='center'>".$i."</th>";
		
		foreach($yttl as $ii =>$vv){	  	  
			foreach($v as $p =>$o){
				$bb = $yttl[$ii][$p][$e];
				$data .= "<td align='center'>".$yttl[$ii][$p][$e]."</td>";
				$ujl[$ii][$p]*=$bb;
				$ujl2[$ii][$p]+=$bb;
			}
		}	
		$data .= "</tr>"; 
		$e++;  
	}

	foreach($ujl2 as $i => $v){
		foreach($v as $a => $b){ 
			$xy[$i][$a] =  round($ujl2[$i][$a],3);
		}
	}     

	$data .= "</table><br>";   
	
	$data .= "<table class='tbl1' width='100%'>";  
	$data .= "<tr>";
	$data .= "<td style='border:0px' align='left'>";
	$data .= "<table class='tbl1' width='99%'>";
	$data .= "<tr><th align='center' colspan='".((count($key_kri)+1)*3)."' style='border:0;color:white;background-color:grey;padding:1%;padding-left:0%'><strong>Fuzzy Tringular Number</strong></th></tr>";    
	$data .= "<tr>"; 
	$data .= "<th align='center' style='border:0px;background-color:silver' width='13%'>&nbsp;</th>";
	
	for($i = 0;$i<count($lmu);$i++){  
		$data .= "<th align='center'>".$lmu[$i]."</th>";  
		$yy[$lmu[$i]]['jumlah']=0;
	}
	
	$data .= "</tr>";
	$jj = array();
	
	foreach($xy as $i => $v){  
		$data .= "<tr>";
		$data .= "<th align='center'>".$i."</th>";
		$jj[$i]['total'] = 0;
		
		foreach($v as $ii => $vv){  
			$data .= "<td align='center'>".$xy[$i][$ii]."</td>";
			$yy[$ii]['jumlah'] +=$xy[$i][$ii];
		  
		}
		$data .= "</tr>";	
	}

	$f = 2;
	
	foreach($yy as $i => $v){
		$ll = $yy[$i]['jumlah'];
		$jm[$f] = $ll;
		$f--;
	}    

	$data .= "</table>";  
	$data .= "</td>";
	$data .= "<td style='border:0px' align='center'>";  
	$data .= "<table class='tbl1' width='99%'>";
	$data .= "<tr><th align='center' colspan='".(count($jm)+2)."' style='border:0;color:white;background-color:grey;padding:1%;padding-left:0%'><strong> Sintesis Fuzzy </strong></th></tr>";    
	$data .= "<tr>";
	$data .= "<th align='center' style='border:0px;background-color:silver' width='13%'>&nbsp;</th>";  

	$ghj = array();
	
	for($i = 0;$i<count($lmu);$i++){  
		$data .= "<th align='center'>".$lmu[$i]."</th>";
		$ghj[$lmu[$i]]['jumlah'] = 0;
	}
	
	$data .= "<td align='center' style='border:0px'>&nbsp;</td>";
	$data .= "</tr>";
	$hh = array();
	
	foreach($xy as $i => $v){  
		$data .= "<tr>";
		$data .= "<th align='center'>".$i."</th>"; 
		$oo = 0;		
		
		foreach($v as $ii => $vv){
			$op = $xy[$i][$ii]*(1/$jm[$oo]);
			$op = round($op,3);
			$data .= "<td align='center'>".$op."</td>";     	 
			$oo++;
			$ghj[$ii]['jumlah'] += $op;
			$jj[$i]['total'] += $op;
			$hh[$i][$oo] = $op;
			$mk = round($jj[$i]['total'],3);
		}
		$data .= "</tr>";	
	}

	$data .= "</table>";  
	$data .= "</td>";  
	$data .= "<td style='border:0px' align='center'>";  
	$data .= "<table class='tbl1' width='99%'>";
	$data .= "<tr><th align='center' colspan='2' style='border:0;color:white;background-color:grey;padding:1%;padding-left:0%'><strong> Bobot Vector </strong></th></tr>";    
	$data .= "<tr>";
	$data .= "<th align='center' style='border:0px;background-color:silver' width='20%'>&nbsp;</th>";  
	$data .= "<th align='center' style='border:0px'>Nilai</th>";
	$data .= "</tr>";
	$no=0;
	$kju = 0;
	
	foreach($jj as $i => $v){  
		$data .= "<tr>";
		$data .= "<th align='center'>".$i."</th>";
		unset($kll); 
		$kll = array();
		
		foreach($jj as $ii => $vv){
			unset($c1); 
			unset($c2);
			$c1 = array();
			$c2 = array();	  
			
			if($i != $ii){
				if($jj[$i]['total']>$jj[$ii]['total']){		  
					$kll[] = 1;
				} else {							
					sort($hh[$ii]);
					foreach($hh[$ii] as $mm){
						$c1[] = round($mm,3);
					}			  
					rsort($hh[$i]);
				
					foreach($hh[$i] as $mm){
						$c2[] = round($mm,3);
					}		  				
					$cc = ($c1[0]-$c2[0])/(($c2[1]-$c2[0])-($c1[1]-$c1[0]));
					$mkl = round($cc,3);
					$kll[] = $mkl;		  
				}
			}
	  
		}
		
		unset($pi); 
		$pi = array();
		
		if($no>1){
			$kil = $no-1;
			for($lp=0;$lp<$kil;$lp++){
				$pi[] = 0;
			}	  	  
			for($r = $kil; $r<count($kll); $r++){
				$pi[] = $kll[$r];
			}	  
		} else {
			$pi = $kll;
		}

		$mo = implode(",",$pi);
		$min = min($pi);
		$data .= "<td align='center'>".$mo."</td>";
		$nbv[$i]['jumlah'] = $min;
		$kju +=$min;
		$data .= "</tr>";
		$no++;
	}

	$data .= "</table>";  
	$data .= "</td>";    

	$data .= "<td style='border:0px' align='right'>";  
	$data .= "<table class='tbl1' width='99%'>";
	$data .= "<tr><th align='center' colspan='3' style='border:0;color:white;background-color:grey;padding:1%;padding-left:0%'><strong> Normalisasi </strong></th></tr>";    
	$data .= "<tr>";
	$data .= "<th align='center' style='border:0px;background-color:silver' width='25%'>-&nbsp;</th>";   
	$data .= "<th align='center'>Min</th>";   
	$data .= "<th align='center'>Nilai</th>";   
	$data .= "</tr>";

	$jkp['min'] = 0;
	$jkp['nilai'] = 0;
	$bobot = array();
	
	foreach($nbv as $i => $v){  
		$data .= "<tr>";
		$data .= "<th align='center'>".$i."</th>";
		$data .= "<td align='center'>".$nbv[$i]['jumlah']."</td>";
		$jkp['min'] += $nbv[$i]['jumlah'];
		$w = ($nbv[$i]['jumlah'] / $kju);
		$w = round($w,3);
		$jkp['nilai'] += $w;
		$data .= "<td align='center'>".$w."</td>";
		$data .= "</tr>";
		$bobot[$i]['w'] = $w;
	} 

	$data .= "</table>";  
	$data .= "</td>";     
	$data .= "</tr>";
	$data .= "</table><br>"; 


	$a = mysqli_query($con,"select nilaiperbandingan from nilai where id='2'");  
	$aa = mysqli_fetch_array($a);
	
	$key_alt = $aa['nilaiperbandingan'];
	$data .= $key_alt;
	$key_alt = explode("XXXX",$key_alt);
	
	$jlhk = count($key_alt)-1;      
	$alternatif = array();  
	$arkriteria = array();


	for($i = 0; $i < $jlhk; $i++){
		$split_alt = explode("_",$key_alt[$i]);	
		$alternatif[$split_alt[0]][$split_alt[1]]['nilai'] = $split_alt[2];
		$a_k[$split_alt[1]]['kriteria'] = $split_alt[1];		
	}  

	$ml = count($a_k);

	$data .= "<table class='tbl1' width='99%'>";
	$data .= "<tr><th align='center' colspan='".($ml+2)."' style='border:0;color:white;background-color:grey;padding:0.3%'><strong> Bobot Kriteria dengan Alternatif </strong></th></tr>";     
	$data .= "<tr>"; 
	$data .= "<td style='border:0px;background-color:silver'>&nbsp;</td>";      
	
	foreach($a_k as $i => $v){	
		$data .= "<th>".$a_k[$i]['kriteria']."</th>";	
	}

	$data .= "<th>Nilai</th>";	
	$data .= "</tr>"; 
	
	foreach($alternatif as $i => $v){
		$data .= "<tr>"; 
		$data .= "<th>".$i."</th>";
		$nl = 0;
		
		for($u = 0; $u < 5; $u++){
			
			//$km = ($bobot[$o]['w'] * $alternatif[$i][$o]['nilai']);
			$data .= "<td align='center'>".$bobot[$u]['w']."</td>";	
			//$nl += $km;
			
		}
		
		$ranking[$i]['ranking'] = $nl;
		$data .= "<td align='center'>".$nl."</td>";	
		
		$data .= "</tr>"; 
	} 
	
	$data .= "</table><br>"; 
/*	
	$data .= "<table class='tbl1' width='99%'>";
	$data .= "<tr><th align='center' colspan='3' style='border:0;color:white;background-color:grey;padding:0.3%'><strong> Perangkingan </strong></th></tr>";     
	$data .= "<tr>"; 
	$data .= "<th>Kode</th>";     
	$data .= "<th align='left'>&nbsp; Alternatif</th>";     
	$data .= "<th>Nilai</th>";
	$data .= "</tr>";

	arsort($ranking);
	
	foreach($ranking as $i => $v){
		$data .= "<tr>"; 
		$data .= "<td align='center' width='10%'>".$i."</td>";
		$data .= "<td>&nbsp; ".getnama('alternatif',$i)."</td>";
		$data .= "<td align='center' width='10%'>".$ranking[$i]['ranking']."</td>";
		$data .= "</tr>";
	}

	$data .= "</table><br>"; 
	*/
	echo json_encode($data);
	
}


function msf($x,$y){
  $skala = array();
 
 
 
  $skala = array(
	"1"=>array(
	"skalafuzzy"=>"1-1-1",
	"skalainvrs"=>"1-1-1"),	
	"2"=>array(
	"skalafuzzy"=>"0.5-1-1.5",
	"skalainvrs"=>"1.5-1-2"),	
	"3"=>array(
	"skalafuzzy"=>"1-1.5-2",
	"skalainvrs"=>"0.5-1.5-1"),		
	"4"=>array(
	"skalafuzzy"=>"1.5-2-2.5",
	"skalainvrs"=>"2.5-0.5-1.5"),			
	"5"=>array(
	"skalafuzzy"=>"2-2.5-3",
	"skalainvrs"=>"0.333-2.5-0.5"),		
	"6"=>array(
	"skalafuzzy"=>"2.5-3-3.5",
	"skalainvrs"=>"0.285-0.333-2.5"),			
	"7"=>array(
	"skalafuzzy"=>"3-3.5-4",
	"skalainvrs"=>"0.25-0.285-0.333"),		
	"8"=>array(
	"skalafuzzy"=>"3.5-4-4.5",
	"skalainvrs"=>"0.222-0.25-0.285"),	
	"9"=>array(
	"skalafuzzy"=>"4-4.5-4.5",
	"skalainvrs"=>"0.222-0.222-0.25"));
 
   /*
  $skala = array(
	"1"=>array(
	"skalafuzzy"=>"1-1-1",
	"skalainvrs"=>"1-1-1"),	
	"3"=>array(
	"skalafuzzy"=>"1-1.5-2",
	"skalainvrs"=>"1/2-2/3-1"),	
	"5"=>array(
	"skalafuzzy"=>"2-2.5-3",
	"skalainvrs"=>"1/3-2/5-1/2"),	
	"7"=>array(
	"skalafuzzy"=>"3-3.5-4",
	"skalainvrs"=>"1/4-2/7-1/3"),		
	"9"=>array(
	"skalafuzzy"=>"4-4.5-4.5",
	"skalainvrs"=>"2/9-2/9-1/4"));  
   */
   

   
  return $skala[$x][$y];
  
}


function checknilai($t){
	global $con;
	$arr1 = array();
	$arr2 = array();  

	$a = mysqli_query($con,"select nilaiperbandingan from nilai where id='$t'");  
	$aa = mysqli_fetch_array($a);
	$strnilai = $aa['nilaiperbandingan'];
	$strnilai = explode("XXXX",$strnilai);
	$jlhk = count($strnilai)-1;  
	  
	for($i = 0; $i < $jlhk; $i++){
		$r = explode("__",$strnilai[$i]);	 
		$rr = explode("X",$r[1]);	
		$arr1[$r[0]][$arrn['kriteria'][0]] = $r[0];	
		
		for($c = 0;$c<count($rr); $c++){
			$arr2[$r[0]][$c]['nilai'] = $rr[$c];
		}
	}
	//$arr = array();
	//$arr = [$arr1,$arr2];
	
	return $arr2;
}


function getnama($module,$id){
	global $con;
	$field = ucfirst($module);	
	$qry = mysqli_query($con,"select Nama$field 
	from ".$module." where Kode$field='$id'");	
	$row = mysqli_fetch_array($qry);		
	return $row["Nama$field"];
}


function getdata($module){
	global $con;
	$field = ucfirst($module);	
	$qry = mysqli_query($con,"select Kode$field,Nama$field 
	from ".$module." order by Nomor asc");		
	while($row = mysqli_fetch_array($qry)){
		$arrdata[] = $row["Kode$field"];
	}	
	return $arrdata;
}


function getrecord($module){
	global $con;
	$field = ucfirst($module);	
	$qry = mysqli_query($con,"select Kode$field,Nama$field 
	from ".$module." order by Nomor asc");		
	while($row = mysqli_fetch_array($qry)){
		$arrdata[] = $row["Kode$field"];
	}	
	return $arrdata;	
}

function pembobotan(){
	//error_reporting( error_reporting() & ~E_NOTICE );
	error_reporting(0);
	$tbl = array_map('getrecord', ["kriteria","alternatif"]);	
	$val = array_map('checknilai', ["1","2"]);
	
	$data = '';			
	$data .= '<div class="col-12 col-sm-12">';
	$data .= '<div class="table-responsive mb-1">';
	$data .= '<table class="table table-sm">';
	$data .= '<thead>';	

	
	$data .= "<tr>";
	$data .= "<th colspan='".count($tbl[0])."' class='text-center border-0 bg-secondary text-light'>List Daftar Kriteria</th>";
	$data .= "</tr>";
	$data .= "<tr>";
	$data .= "<th width='10%' class='text-center border-right bg-light text-secondary'>Kode</th>";
	$data .= "<th class='text-left bg-light text-secondary'>Nama Kriteria</th>";
	$data .= "</tr>";  
	$data .= "</thead>";		
	$data .= '<body>';	
	$strkey = "";
	
	for($i = 0; $i < count($tbl[0]); $i++){
		$data .='<tr>';
		$data .='<td class="text-center border border-left-0">'.$tbl[0][$i].'</td>';
		$data .='<td class="text-left border border-right-0">&nbsp;'.getnama("kriteria",$tbl[0][$i]).'</td>';
		$data .='</tr>';
		$simbol = ($i != (count($tbl[0])-1))?"_":"";		
		$strkey .= $tbl[0][$i].$simbol;
	}
	
	$data .= '</body>';
	$data .= "</table>";
	$data .='</div>';
	

	$data .= '<div class="table-responsive mb-1">';
	$data .= '<table class="table table-sm">';
	$data .= '<thead>';
	$data .= "<tr>";
	$data .= "<th colspan='".(count($tbl[0])+1)."' class='text-center border bg-secondary text-light'>Perbandingan Nilai Antar Kriteria</th>";
	$data .= "</tr>";	
	$data .= "<tr>";
	$data .= "<th class='text-center border-0 bg-white'>&nbsp;</th>";
	
	for($x = 0;$x < count($tbl[0]); $x++){
		$data .= "<th class='text-center border-left bg-light text-secondary'>".$tbl[0][$x]."</th>";
	}
	$data .= "</tr>";  
	$data .= "</thead>";	
	

	$c = 0;
	$d = 0;
	$o = 0;
	$nkriteries['C1'] = [1,4,3,2,3];
	$nkriteries['C2'] = [0,1,2,3,5];
	$nkriteries['C3'] = [0,0,1,3,6];
	$nkriteries['C4'] = [0,0,0,1,2];
	$nkriteries['C5'] = [0,0,0,0,1];
	//$dataq ="";

	for($x = 0;$x < count($tbl[0]); $x++){
		$data .="<tr><th class='bg-light text-secondary border-right border-bottom text-center' width='10%'>".$tbl[0][$x]."</th>";		
		$no = 1;	
		$mx = 0;	
		for($y = 0; $y < count($tbl[0]); $y++){
			$nnm = (empty($val[0][$tbl[0][$x]][$y]['nilai']))?['...','']:[$val[0][$tbl[0][$x]][$y]['nilai'],$val[0][$tbl[0][$x]][$y]['nilai']];			
			
			if($y >= $c){		
				if($tbl[0][$x]!=$tbl[0][$y]){		
					$cmb = '';
					$cmb .= '<select id="X_'.$tbl[0][$x].'_'.$y.'" class="bg-light border text-center" style="display:none">';
					$cmb .= '<option value="'.$nnm[1].'">'.$nnm[0].'</option>';						
					
					for($w = 1; $w <= 9; $w+=1){
						if($w != $nnm[0]){
							$cmb .= '<option value="'.$w.'">'.$w.'</option>';		
						}
					}
					
					$cmb .= '</select>';			
					$data .=$cmb;
					$d++;
				} else {
					$data .="<input disabled type='hidden' id='X_".$tbl[0][$x]."_".$y."' class='text-center' value='1' size='1%'>";
				}	
			} else {
				$o++;
				//$data .="<td class='border-left border-bottom text-center'>";
				$data .="<input type='hidden' disabled id='X_".$tbl[0][$x]."_".$y."' value='0' class='text-center' size='1%'>";
				//$data .="</td>";		
			}
			
			$data .="<td class='border-left border-bottom text-center'>";
			$data .=$nkriteries[$tbl[0][$x]][$mx];
			$data .="</td>";	
					
			$no++;
			$mx++;

		}
		
		$c++;
		$data .="</tr>";	
	}	
	
	$data .= '</body>';
	$data .= "</table>";
	$data .='</div>';

	$data .= '<div class="table-responsive mb-1">';
	$data .= '<table class="table table-sm">';
	$data .= '<thead>';
	$data .= "<tr>";
	$data .= "<th colspan='2' class='text-center border-0 bg-secondary text-light'>List Daftar Alternatif</th>";
	$data .= "</tr>";
	$data .= "<tr>";
	$data .= "<th width='10%' class='text-center border-right bg-light text-secondary'>Kode</th>";
	$data .= "<th class='text-left bg-light text-secondary'>Nama Alternatif</th>";
	$data .= "</tr>";  
	$data .= "</thead>";
	
	$arrdata = "";
	$data .= '<body>';
	$strkey .= "MB";
	for($i = 0; $i < count($tbl[1]); $i++){
		$data .='<tr>';
		$data .='<td class="text-center border border-left-0">'.$tbl[1][$i].'</td>';
		$data .='<td class="text-left border border-right-0">&nbsp;'.getnama("alternatif",$tbl[1][$i]).'</td>';
		$data .='</tr>';
		$simbol = ($i != (count($tbl[1])-1))?"_":"";		
		$strkey .= $tbl[1][$i].$simbol;		
	}
	
	$data .= '</body>';
	$data .= "</table>";
	$data .='</div>';

	$bobot = array();
	$bobot['1.00'] = "Tidak Diperluka"; 
	$bobot['2.00'] = "Sangat Baik"; 
	$bobot['3.00'] = "Baik";
	$bobot['4.00'] = "Cukup Baik";
	$bobot['5.00'] = "Kurang";
	//$get_kriteria = getdata("kriteria");


	$data .= '<div class="table-responsive mb-1">';
	$data .= '<table class="table table-sm">';
	$data .= '<thead>';
	$data .= "<tr>";
	$data .= "<th colspan='2' class='text-center border-0 bg-secondary text-light'>Bobot Nilai Kriteria</th>";
	$data .= "</tr>";
	$data .= "<tr>";
	$data .= "<th width='10%' class='text-center border-right bg-light text-secondary'>Bobot</th>";
	$data .= "<th class='text-left bg-light text-secondary'>Keterangan Bobot Nilai</th>";
	$data .= "</tr>";  
	$data .= "</thead>";
	$data .= '<body>';
	
	foreach($bobot as $i => $v){
		$data .='<tr>';
		$data .='<td class="text-center border border-left-0">'.$i.'</td>';
		$data .='<td class="text-left border border-right-0">&nbsp;'.$bobot[$i].'</td>';
		$data .='</tr>';		
	}
	
	$data .= '</body>';
	$data .= "</table>";
	$data .='</div>';
	
	$data .= '<div class="table-responsive mb-3">';
	$data .= '<table class="table table-sm">';
	$data .= '<thead>';
	$data .= "<tr>";
	$data .= "<th colspan='".(count($tbl[0])+1)."' class='text-center border bg-secondary text-light'>Input Bobot Nilai Kriteria Untuk Masing Masing Alternatif</th>";
	$data .= "</tr>"; 
	$data .= "<tr>";
	$data .= "<th class='text-center border-0 bg-white text-white' width='10%'> &nbsp;</th>";		
	
	for($x = 0;$x < count($tbl[0]); $x++){
		$data .= "<th class='text-center border-left bg-light text-secondary'>".getnama("kriteria",$tbl[0][$x])."</th>";
	}
	$data .= "</tr>";  
	$data .= "</thead>";	
	$arr2 = "";
	$check = "";
	$c = 0;
	$d = 0;
	$o = 0;	
	for($x = 0;$x < count($tbl[1]); $x++){
		$data .="<tr><th class='bg-light text-secondary border-right border-bottom text-left'>".getnama('alternatif',$tbl[1][$x])."</th>";				
		for($y = 0;$y < count($tbl[0]); $y++){									
			$nnm = (empty($val[1][$tbl[1][$x]][$y]['nilai']))?['...','']:[$bobot[$val[1][$tbl[1][$x]][$y]['nilai']],$val[1][$tbl[1][$x]][$y]['nilai']];			
			$cmb = '';
			$cmb .= '<select id="X_'.$tbl[1][$x].'_'.$y.'" class="bg-light border text-dark text-center">';
			$cmb .= '<option value="'.$nnm[1].'">'.$nnm[0].'</option>';											
			foreach($bobot as $b => $j){
				if($b != $nnm[1]){
					$cmb .= '<option value="'.$b.'">'.$bobot[$b].'</option>';		
				}
			}
			$cmb .= '</select>';			
			$data .="<td class='border-left border-bottom text-center'>".$cmb."</td>";			
		}
		$data .="</tr>";	
	}	
	
	$data .= '</body>';
	$data .= "</table>";
	$data .='</div>';
	$data .='</div>';
	
	$data .= '<div class="col-11 text-center col-sm-9 errorinput">';
	$data .='</div>';
	$data .= '<div class="col-8 text-center col-sm-4">';
	$jlh_idx = (count($tbl[0])-1);
	$data .= '<a class="btn btn-danger btn-block" href="javascript:_post(\''.$strkey.'\',\''.$jlh_idx.'\');">Lakukan Proses Perangkingan</a>';
	$data .='</div>';
	
	echo json_encode($data);
}

function checkid($id){
	global $con;
	$qry = "select id from nilai where id='$id'";
	$sql = mysqli_query($con,$qry);
	$num = mysqli_num_rows($sql);
	
	if($num > 0){
		$row = mysqli_fetch_array($sql);
		$rec = $row["id"];
	} else {
		$rec = "empty";
	}
	
	return $rec;
}


function removerecord($id,$str){
	global $con;
	$sql = "delete from nilai where id='$id'";	
	$sql = mysqli_query($con, $sql);
	insertrecord($id,$str);
	return "successfull";
}

function insertrecord($id,$str){
	global $con;
	$sql = "insert into nilai set id = '$id', nilaiperbandingan='$str'";		
	$sql = mysqli_query($con, $sql);
	return "successfull";
}

function nilai(){
	error_reporting( error_reporting() & ~E_NOTICE );
	
	$strnilai = $_REQUEST['strnilai'];
	
	$strnilai = explode("LFC",$strnilai);
	$x = (count($strnilai)-1);
	
	$id = 1;
	for($i = 0; $i < $x; $i++){
		$c = checkid($id);
		if($c == "empty"){
			insertrecord($id,$strnilai[$i]);
		} else {
			removerecord($id,$strnilai[$i]);			
		}
		$id++;
	}	
	
	echo json_encode("successfull");
}


function bobotnama($key){
	
	$idx = str_replace(".","",$key);
	$bobot['1'] = "Tidak Diperluka"; 
	$bobot['2'] = "Sangat Baik"; 
	$bobot['3'] = "Baik";
	$bobot['4'] = "Cukup Baik";
	$bobot['5'] = "Kurang";
	
	return $bobot[$idx];
}

function getkriteria(){
	global $con;
	$q1=mysqli_query($con,"select KodeKriteria,NamaKriteria 
	from kriteria order by Nomor asc");
	
	while($row=mysqli_fetch_array($q1)){	
		$kodearr[] = $row["KodeKriteria"];
	}	
	
	return $kodearr;
}

function pembobotan_(){
	error_reporting( error_reporting() & ~E_NOTICE );
	global $con;
	$key = $_REQUEST['key'];
	$arrn['pembobotan_1'] = ["kriteria","1",1,9,1];
	$arrn['pembobotan_2'] = ["alternatif","2",0,1,0.25];
	$module = $arrn[$key][0];
	$field = ucfirst($module);		
	
	$getkriteria = getkriteria();
	$ktr_arr = count($getkriteria);	
	
	$data = '';	
	
	$dt = array();
	$dt2 = array();  

	$a = mysqli_query($con,"select nilaiperbandingan from nilai where id='".$arrn[$key][1]."'");  
	$aa = mysqli_fetch_array($a);
	$strnilai = $aa['nilaiperbandingan'];
	$strnilai = explode("XXXX",$strnilai);
	$jlhk = count($strnilai)-1;  
	  
	for($i = 0; $i < $jlhk; $i++){
		$r = explode("__",$strnilai[$i]);	 
		$rr = explode("X",$r[1]);	
		$dt[$r[0]][$arrn[$key][0]] = $r[0];	
		
		for($c = 0;$c<count($rr); $c++){
			$dt2[$r[0]][$c]['nilai'] = $rr[$c];
		}
	}	
	
	
	$data .= '<div class="col-12 col-sm-12">';
	$data .= '<div class="table-responsive mb-1">';
	$data .= '<table class="table table-sm">';
	$data .= '<thead>';
	$data .= "<tr>";
	$data .= "<th width='10%' class='text-center border-right bg-secondary text-light'>Kode</th>";
	$data .= "<th class='text-left bg-secondary text-light'>Nama ".$field."</th>";
	$data .= "</tr>";  
	$data .= '</thead>';
	
	$q1=mysqli_query($con,"select Kode$field,Nama$field 
	from ".$module." order by Nomor asc");

	$no=1;
	$g = "";
	$data .= '<body>';
	while($row=mysqli_fetch_array($q1)){
		$data .='<tr>';
		$data .='<td class="text-center border border-left-0">'.$row["Kode$field"].'</td>';
		$data .='<td class="text-left border border-right-0">&nbsp;'.$row["Nama$field"].'</td>';
		$data .='</tr>';
		
		$kode[] = $row["Kode$field"];
		$nama[] = $row["Nama$field"];
		$p = ($no > 1)?'_':'';
		$g .= $p.$row["Kode$field"];
		$no++;
	}
	$data .= '</body>';
	$data .= "</table>";
	$data .='</div>';
	


	
	$data .= '<div class="table-responsive mb-1 mt-0">';
	$data .= '<table class="table table-sm">';
	$data .= '<thead>';
	$data .= "<tr>";
	$data .= "<td class='border-top-0 border-right'>";
	$data .= '&nbsp;';
	$data .= "</td>";  
	
	for($x = 0;$x < count($getkriteria);$x++){
		$data .="<th class='bg-secondary text-light text-center border-left'>".$getkriteria[$x]."</th>";
	}  
	$data .="</tr>";
	$data .='</thead>';
	$data .='<tbody>';
	$c = 0;
	$d = 0;
	$o = 0;
  
   
	for($x = 0;$x < count($kode); $x++){
		$data .="<tr><th class='bg-secondary text-light border-right text-center'>".$kode[$x]."</th>";
		$no = 1;		
		for($y = 0; $y < count($getkriteria); $y++){
			$nnm = (empty($dt2[$kode[$x]][$y]['nilai']))?['......','']:[$dt2[$kode[$x]][$y]['nilai'],$dt2[$kode[$x]][$y]['nilai']];
			if($arrn[$key][0]=="kriteria"){				
				if($y >= $c){		
					if($kode[$x]!=$kode[$y]){		
						$cmb = '';
						$cmb .= '<select id="X_'.$getkriteria[$x].'_'.$y.'" class="bg-light text-center">';
						$cmb .= '<option value="'.$nnm[1].'">'.$nnm[0].'</option>';						
						
						for($w = $arrn[$key][2]; $w <= $arrn[$key][3]; $w+=$arrn[$key][4]){
							if($w != $nnm[0]){
								$cmb .= '<option value="'.$w.'">'.$w.'</option>';		
							}
						}
						$cmb .= '</select>';			
						$data .="<td class='border-left border-bottom text-center'> ".$cmb."</td>";
						$d++;
					} else {
						$data .="<td class='border-left border-bottom text-center'><input disabled type='text' id='X_".$getkriteria[$x]."_".$y."' class='text-center' value='1' size='1%'></td>";
					}	
				} else {
					$o++;
					$data .="<td class='border-right border-bottom text-center'>";
					$data .="<input type='text' disabled id='X_".$getkriteria[$x]."_".$y."' size='1%' value='0' class='text-center' size='1%'>";
					$data .="</td>";		
				}
				$no++;
			} else {												
				$cmb = '';
				$cmb .= '<select id="X_'.$kode[$x].'_'.$y.'" class="bg-light text-center">';
				$cmb .= '<option value="'.$nnm[1].'">'.$nnm[0].'</option>';				
				for($w = $arrn[$key][2]; $w <= $arrn[$key][3]; $w+=$arrn[$key][4]){
					//if($w != $nnm[0]){
						$cmb .= '<option value="'.$w.'">'.bobotnama($w).'</option>';		
					//}
				}
				$cmb .= '</select>';			
				$data .="<td class='border-left border-bottom text-center'> ".$cmb."</td>";								
			}
		}
		$c++;
		$data .="</tr>";	
	}

	$d--;
	$data .= "<tr>";
	$data .= "<td class='errorinput text-danger text-center p-2 border-0' colspan='".(count($kode)+1)."'>";
	$data .= "<td>";
	$data .= "</tr>";	
	$data .= "<tr>";
	$data .= "<td colspan='".(count($kode)+1)."' class='text-center border-0'>";
	$data .= "<input type='text' id='str' value='".$g."'>";
	$data .= '<a class="btn btn-outline-primary" href="javascript:_post(\''.$o.'\',\''.$arrn[$key][1].'\');">Posting Nilai Perbandingan '.$field.'</a>';
	$data .= "</td></tr>";	
	$data .= "</tbody>";
	$data .= "</table>";
	$data .= "</div>";		
	$data .= "</div>";
	
	echo json_encode($data);
}



function crud(){
	error_reporting( error_reporting() & ~E_NOTICE );
	global $con;
	$module = $_REQUEST['module'];
	$field = ucfirst($module);	
	$Nama = $_REQUEST["Nama$field"];
	$Kode = $_REQUEST["Kode$field"];	
	$Status = $_REQUEST['status'];
		
	if($Status == "edit"){		
		$sql = "update ".$module." set 
		Nama$field='$Nama' 
		where Kode$field = '$Kode'";				
	} else if($Status == "add") {		
		$qry = mysqli_query($con,"select (max(Nomor)+1) as Nomor from ".$module."");
		$qry = mysqli_fetch_array($qry);		
		$Nomor = $qry['Nomor'];
		
		$sql = "insert into ".$module." set
		Kode$field='$Kode',
		Nama$field='$Nama',
		Nomor='$Nomor'";							
	} else {
		$sql = "delete from ".$module." where Kode$field='$Kode'";
	}		
	mysqli_query($con,$sql);	
	
	echo json_encode("successfull");
}


function form(){
	global $con;
	
	$id['kriteria'] = "C";
	$id['alternatif'] = "A";
	
	$key = ($_REQUEST['key']=="")?"":$_REQUEST['key'];
	$module = $_REQUEST['module'];
	$field = ucfirst($module);		
	
	if($key == ""){	
		$qry = mysqli_query($con,"select (max(Nomor)+1) as Nomor from ".$module."");
		$qry = mysqli_fetch_array($qry);		
		$Kode = $id[$module].$qry['Nomor'];
		$Nama = "";		
	} else {
		$qry = mysqli_query($con,"select Kode$field,Nama$field from ".$module." where Kode$field = '$key'");
		$qry = mysqli_fetch_array($qry);		
		$Kode = $qry["Kode$field"];
		$Nama = $qry["Nama$field"];
	}
		
	$input = "Kode".$field."_Nama".$field;	
	
	$data = '';		
	$data .= '<div class="col-12 col-sm-5">';						
	$data .= '<div class="card border">';			
	$data .= '<div class="card-header">';
	$data .= '<h5>FORM '.strtoupper($module).'</h5>';
	
	$data .= '</div>';			
	$data .= '<div class="card-body">';
	$data .= '<form>';
	$data .= '<div class="form-group">';
	$data .= '<label for="exampleFormControlInput1">Kode '.$field.'</label>';
	$data .= '<input type="text" autocomplete="off" class="form-control border border-secondary" disabled="true" value="'.$Kode.'" id="Kode'.$field.'">';
	$data .= '</div>';

	$data .= '<div class="form-group">';
	$data .= '<label for="exampleFormControlInput1">Nama '.$field.'</label>';
	$data .= '<input type="text" autocomplete="off" class="form-control border border-secondary" value="'.$Nama.'" id="Nama'.$field.'">';
	$data .= '</div>';					
	$data .= '</form>';
	$data .= '</div>';						
	$data .= '<div class="card-footer bg-white">';
	$data .= '<a type="button" class="btn btn-danger mx-sm-1" href="javascript:_cancel();"><i class="fa fa-arrow-left"></i> Back </a>';
	$data .= '<a type="button" class="btn btn-success mx-sm-1" href="javascript:_submit(\''.$input.'\');"><i class="fa fa-send"></i> Submit</a>';
	
	$data .= '</div>';			
	$data .= '</div>';		
	$data .= '</div>';
	
	echo json_encode($data);
}

function listrecord(){	
	global $con;
	$key=(empty($_REQUEST['key']))?"":$_REQUEST['key'];
	$module = $_REQUEST['module'];
	$field = ucfirst($module);
	
	$data = '';	
	$data .='<div class="col-12 col-sm-12">';
	$data .='<div class="table-responsive mb-3 mt-3">';
	$data .='<table class="table table-sm">';
	$data .='<thead>';
	$data .='<tr>';
	$data .='<th width="14%" class="text-center bg-secondary text-light border border-left-0">Kode</th>';
	$data .='<th class="text-left bg-secondary text-light border border-right-0">&nbsp;Nama '.$field.'</th>';
	$data .='</tr>';
	$data .='</thead>';				
	$data .='<tbody>';
	
	$where = " where Kode$field like '%$key%' OR Nama$field like '%$key%'";
	$q = mysqli_query($con,"select Kode$field,Nama$field from ".$module." $where order by Nomor ASC");
	$no = 1;
	while($r = mysqli_fetch_array($q)){
		$manage = '<a class="btn btn-outline-info btn-sm btn-reset p-0 pl-2 pr-2" href="javascript:_edit(\''.$r["Kode$field"].'\')"><i class="fa fa-pencil"></i> Edit</a> <a class="p-0 pl-2 pr-2 btn btn-outline-danger btn-sm btn-reset" href="javascript:_remove(\''.$r["Kode$field"].'\',\''."Kode$field".'\')"><i class="fa fa-trash"></i> Remove</a>';
		$data .='<tr>';
		$data .='<td class="text-center border border-left-0">'.$r["Kode$field"].'</td>';
		$data .='<td class="text-left border border-right-0">&nbsp;'.$r["Nama$field"].'</td>';
		if($module=="alternatif"){
			$data .='<td width="18%" class="text-center border-left border-bottom">'.$manage.'</td>';
		}
		$data .='</tr>';				
	}
	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>';
	$data .='</div>';
	echo json_encode($data);
}



function alternatif(){
	
	global $con;
	$key=(empty($_REQUEST['key']))?"":$_REQUEST['key'];
	
	$data = '';	
	$data .='<div class="col-12 col-sm-12">';
	$data .='<div class="table-responsive mb-3 mt-3">';
	$data .='<table class="table table-sm">';
	$data .='<thead>';
	$data .='<tr>';
	$data .='<th width="14%" class="text-center bg-light text-muted border border-left-0">Kode</th>';
	$data .='<th class="text-left bg-light text-muted border border-right-0">&nbsp;Alternatif</th>';
	$data .='</tr>';
	$data .='</thead>';				
	$data .='<tbody>';
	
	$where = " WHERE KodeAlternatif LIKE '%$key%' OR NamaAlternatif LIKE '%$key%'";
	$q = mysqli_query($con,"select KodeAlternatif,NamaAlternatif from alternatif $where order by KodeAlternatif Asc");
	$no = 1;
	while($r = mysqli_fetch_array($q)){	
		$data .='<tr>';
		$data .='<td class="text-center border border-left-0">'.$r['KodeAlternatif'].'</td>';
		$data .='<td class="text-left border border-right-0">&nbsp;'.$r['NamaAlternatif'].'</td>';
		$data .='</tr>';				
	}
	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>';
	$data .='</div>';
	echo json_encode($data);
}

function kriteria(){
	
	global $con;
	$key=(empty($_REQUEST['key']))?"":$_REQUEST['key'];
	
	$data = '';	
	$data .='<div class="col-12 col-sm-12">';
	$data .='<div class="table-responsive mb-3 mt-3">';
	$data .='<table class="table table-sm">';
	$data .='<thead>';
	$data .='<tr>';
	$data .='<th width="14%" class="bg-secondary text-center text-light border border-left-0">Kode</th>';
	$data .='<th class="text-left bg-secondary border border-right text-light">&nbsp;Kriteria</th>';
	$data .='</tr>';
	$data .='</thead>';				
	$data .='<tbody>';
	
	$where = " WHERE KodeKriteria LIKE '%$key%' OR NamaKriteria LIKE '%$key%'";
	$q = mysqli_query($con,"select KodeKriteria,NamaKriteria from kriteria $where order by KodeKriteria Asc");
	$no = 1;
	while($r = mysqli_fetch_array($q)){
		$manage = '<a class="btn btn-info btn-sm btn-reset text-light" href="javascript:_edit(\''.$r['KodeKriteria'].'\',\'#KodeKriteria\')">Edit</a> <a class="btn btn-danger btn-sm btn-reset text-light">Remove</a>';
		$data .='<tr>';
		$data .='<td class="text-center border border-left-0">'.$r['KodeKriteria'].'</td>';
		$data .='<td class="text-left border-bottom">&nbsp;'.$r['NamaKriteria'].'</td>';
		$data .='<td width="16%" class="text-center border-left border-bottom">'.$manage.'</td>';
		$data .='</tr>';				
	}
	$data .='</tbody>';
	$data .='</table>';
	$data .='</div>';
	$data .='</div>';
	

	echo json_encode($data);
}

?>