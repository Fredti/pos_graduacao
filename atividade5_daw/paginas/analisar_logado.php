<?php
	
	if(empty($_SESSION['login'])){
		header('Location:../index.php');
		exit;
	}
		
?>