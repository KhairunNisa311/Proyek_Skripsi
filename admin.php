<div class="wrapper">
	<nav id="sidebar"> <?php require("nav.php"); ?> </nav>
	<div id="content" class="bg-white">
		<?php
		$get=(!isset($_REQUEST['get']) or $_REQUEST['get']=="home")?"home":"module";
		$page = ($get=="home") ? "Home Page": $_REQUEST['get'] . " Page";
		?>				
		<div class="container-fluid bg-light p-3 mb-4 shadow bg-light rounded">
			<div class="row justify-content-center">		
				<div class="col-2 col-sm-2">			
					<button type="button" id="sidebarCollapse" class="navbar-btn">
					<span></span>
					<span></span>
					<span></span>
					</button>		
				</div>
				<div class="col-10 col-sm-10 text-right">			
					<button class="btn disabled btn-light text-dark border-0">
					<strong class="moduletitle"><?php echo strtoupper($page); ?></strong>
					</button>
				</div>					
			</div>
		</div>					
		<?php include($get.".php");?>	
		<input type="hidden" id="txtlink" value="<?php echo $_REQUEST['get'] ?? '' ?>">
	</div>
</div>