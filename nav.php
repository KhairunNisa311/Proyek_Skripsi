<div class="sidebar-header text-center p-2">
	<h3>FUZZY AHP</h3>
</div>

<ul class="list-unstyled components">
	<?php
		$get=(!isset($_REQUEST['get']))?"home":$_REQUEST['get'];
		$get = explode("_",$get);
		$get = $get[0];
		$link = [
			"home" => ["Home"],
			"kriteria" => ["Data Kriteria"],
			"alternatif" => ["Data Alternatif"],
			"pembobotan" => ["Pembobotan"],
			"rangking" => ["Perangkingan"],
		];
		
		$icon["home"] = "home";
		$icon["kriteria"] = "folder";
		$icon["alternatif"] = "user";
		$icon["pembobotan"] = "edit";
		$icon["rangking"] = "edit";
		foreach($link as $i => $v){			
			$active = ($get != $i)?"":"class='active'";
			if(count($v) == 1){
				echo '<li '.$active.'><a href="index.php?get='.$i.'"><i class="fa fa-'.$icon[$i].'"></i> '.$link[$i][0].'</a></li>';
			} else {				
				echo '<li '.$active.'>
				<a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">'.$link[$i][0].'</a>
				<ul class="collapse list-unstyled" id="homeSubmenu">';
				
				for($x = 1;$x < count($v); $x++){					
                    echo '<li><a href="index.php?get='.$i.'_'.$x.'">'.$link[$i][$x].'</a></li>';
				}
					
				echo '</ul></li>';				
			}
		}
	?>

	<li><a href="logout.php"><i class="fa fa-sign-out"></i>  Log out</a></li>			
</ul>