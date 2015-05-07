<?php 
	function __autoload($classe){
		include('includes/classes/'.$classe.'.class.php');
	}
?>