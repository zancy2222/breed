<?php
	session_start();
	
	session_destroy();
	
	header ('location:shop-log.php');
?>