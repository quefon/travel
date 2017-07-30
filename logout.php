<!DOCTYPE html>
<?php session_start(); 
	$url=$_GET['where'];
	unset($_SESSION['usename']);
	unset($_SESSION['password']);
	header("Location:$url");
?>
