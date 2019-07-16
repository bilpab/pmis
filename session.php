<?php
	session_start();
	include 'config.php';

	if(!isset($_SESSION['id']) || trim($_SESSION['id']) == ''){
		header('location: dashboard.php');
	}

	$sql = "SELECT tbl_user.*, employees.* FROM tbl_user LEFT JOIN employees ON employees.`bio_id`=tbl_user.`bio_id` WHERE `tbl_user`.`id`= '".$_SESSION['id']."'";
	$qry = $connect->prepare($sql);
	$qry->execute();
	$fetch = $qry->fetchAll();
	foreach ($fetch as $user);
?>