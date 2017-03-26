<?
require "db.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['new_test'])){
		$_SESSION['quiz_code'] = $_POST['code'];
		$_SESSION['quiz_title'] = $_POST['title'];
		$quizes = R::dispense('quizes');
		$quizes->title = $_POST['title'];
		$quizes->email = $_SESSION['email'];
		$quizes->size = 0;
		//$quizes->from = date('Y-m-d H:i:s');
		$quizes->status = 1;
		$quizes->code  = $_POST['code'];
		R::store($quizes);
		header('Location: question.php');
	}
}
if($_SERVER["REQUEST_METHOD"] == "GET"){
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
					<span> <?=$_SESSION['auth_user']?> </span>
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
		<div class="col-md-10 col-md-offset-1 block-main">
			<div class="col-md-4 col-md-offset-4 main-menu">
				<h2> Новый тест </h2>	
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
					<label>
						<input type="text" pattern="[A-Za-zА-Яа-яЁё-s]"  name="title" class="form-control" placeholder="Enter a Quiz Title" required>
					</label>
					<label>
						<h3 class="section-title"> Quiz pin </h3>
						<input type="text" readonly name="code" class="form-control" value="<?=substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0,5);?>">
					</label>
					<button type="submit" name="new_test" class="btn btn-primary">Создать тест</button>
				</form>
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