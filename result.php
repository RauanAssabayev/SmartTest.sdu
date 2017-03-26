<?php

require "db.php";
session_start();


if($_SERVER["REQUEST_METHOD"] == "GET") {
	if(isset($_GET['logout'])){
		session_destroy();
		session_unset();
		header('Location: index.php');
	}
}


$sQuery = "select * from (select * from answers order by id desc) as ans where ans.quiz_code = '".$_SESSION['code']."' and email = '".$_SESSION['email']."' group by ans.number";
	$rows = R::getAll($sQuery);

$query = "select * from quizes where code = '".$_SESSION['code']."'";
$qu = R::getAll($query);

$passquiz = "select * from passquiz where quiz_code = '".$_SESSION['code']."' 
and email = '".$_SESSION['email']."'";

$pass = R::getAll($passquiz);

$title = $qu[0]['title'];
$code = $qu[0]['code'];
$penalty = $pass[0]['penalty'];
$correct = 0;
$incorrect = 0;

$sql = "select * from questions where quiz_code = '".$_SESSION['code']."'";
$questions = R::getAll($sql);

foreach ($rows as  $row) {
	if($row['answer'] === $questions[$row['number']-1]['correct']){
		$correct++;
	}else{
		$incorrect++;
	}
}
$sql = "UPDATE passquiz SET correct=".$correct." , incorrect=".$incorrect." 
 WHERE quiz_code = '".$_SESSION['code']."' and email = '".$_SESSION['email']."'";
R::exec($sql);



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
					<span> <?=$_SESSION['auth_user']?> </span>
					<i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
				</a>
				<ul style="display: none;" id="actions-list">
					<li> <a href="editprofile.php"> Edit profile </a> </li>
					<li> <a href="myresults.php">  My Results </a> </li>
					<li> <a href="myquizes.php">  My Quizes </a> </li>
					<li id='signout'> <a href="?logout=1" >  Sign Out </a> </li>
				</ul>
			</div>
		</div>
		<div class="col-md-10 col-md-offset-1 block-main">
			<div class="col-md-4 col-md-offset-4 main-menu quizresult" >
				<span> Имя : <?=$title?> </span>
				<span> Код : <?=$code?> </span>
				<span> Правильные : <?=$correct?> </span>
				<span> Неправильные : <?=$incorrect?> </span>
				<span> Штраф : <?=$penalty?> секунд </span>
				<span> В сумме : <?=($correct+$incorrect)?> </span>
				<br> <br>
			</div>
		</div>
		<div class="footer col-md-12">
		</div>	
	</div>
</div>
<div class="full">	
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
<? die() ?>