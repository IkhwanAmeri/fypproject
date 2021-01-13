<?php session_start();
if(isset($_GET['logout'])) // Destroying All Sessions
{
	session_destroy();
	header("Location: ../index.php"); // Redirecting To Index Page
}
?>