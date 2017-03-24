<?
require "db.php";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['new_test'])){
    	session_start();
		$_SESSION['quiz_code'] = $_POST['code'];
		$quizes = R::dispense('quizes');
		$quizes->title = $_POST['title'];
		$quizes->email = $_SESSION['email'];
		$quizes->size = 0;
		$quizes->from = date('Y-m-d H:i:s');
		$quizes->to = date('Y-m-d H:i:s');
		$quizes->code  = $_POST['code'];
		R::store($quizes);
		header('Location: question.php');
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
</head>
<script>document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>')</script>
<body>
<div class="container">
	<div class="row">
		<div class="col-md-12 col-sm-12 main-header">	
			<img src="img/logo.png" alt="" class="col-md-3 col-sm-4">
			<!--<ul class="main-menu col-md-6">
				<li class="col-md-1">Тесты</li>
				<li class="col-md-1">Тесты</li>
				<li class="col-md-1">Тесты</li>
				<li class="col-md-1">Тесты</li>
			</ul> -->
			<div class="log-btn col-md-1 col-sm-2 
			col-md-offset-8 col-sm-offset-6"> 
				<a id="signup"> Войти </a>
			</div>
		</div>
		<div class="col-md-10 col-md-offset-1 block-main">
			<div class="col-md-4 col-md-offset-4 main-menu">
				<a href="" class="success-btn"> Новый тест </a>	
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
</body>
</html>
<? die() ?>