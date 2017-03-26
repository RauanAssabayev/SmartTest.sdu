<?
	require "db.php";
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "GET") {
		if(isset($_GET['logout'])){
			session_destroy();
			session_unset();
			header('Location: index.php');
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SmartTest</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="libs/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/media.css">
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
<body>
<div class="container main-area">
	<div class="row">
		<div class="col-md-12 col-sm-12 main-header">	
			<a href="main.php">	
				<img src="img/logo.png" alt="" class="col-md-3 col-sm-4">
			</a>
			<div class="profile">
				<a class="prof" href="#">
					<i class="fa fa-address-card" aria-hidden="true"></i>
					<span> <?=$_SESSION['auth_user'] ?> </span>
					<i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
				</a>
				<ul style="display: none;" id="actions-list">
					<li> <a href="editprofile.php" > Edit profile </a> </li>
					<li> <a href="myresults.php" >  My Results </a> </li>
					<li> <a href="myquizes.php">  My Quizes </a> </li>
					<li id='signout'> <a href="?logout=1" >  Sign Out </a> </li>
				</ul>
			</div>
		</div>
	</div>
	<div class="question-block">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12  question-item passinfo">
				<?php
					$sQuery = "select * from passquiz where email = '".$_SESSION['email']."'";
					$rows = R::getAll($sQuery);
					foreach ($rows as  $row) {
						echo "<h3> Имя : ".$row['quiz_code']." </h3> \n";
						$tl = "select title from quizes where code = '".$row['quiz_code']."'";
						$r = R::getAll($tl);
						echo "<h3> Имя : ".$r[0]['title']." </h3> \n";
						echo "<h3> Правильные :".$row['correct']." </h3> \n";
						echo "<h3> Неправильные : ".$row['incorrect']." </h3> \n";
						echo "<h3> Штраф : ".$row['penalty']."  секунд </h3> \n";
					echo '<hr>';
					}
				?>
				</div>
			</div>
	</div>
<script>
$(document).ready(function(){
    $(".profile").click(function(){
		$("#actions-list").slideToggle('fast','swing');
	});
 });
</script>
</body>
</html>
