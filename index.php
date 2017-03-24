<?
require "db.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['login'])){
    	$loginsql = "select * from users where email = '".$_POST['email']."'
		and password = '".md5($_POST['password'])."' ;";
		$user = R::getAll($loginsql);
	    if($user){
	    	session_start();
			$_SESSION['email'] = $_POST['email'];
			//header('Location: main.php');
			include('main.php');
		}
	}
	if(isset($_POST['reg'])){
		$user = R::getAll('select * from users where email= :login',
		array(':login'=>$_POST['login']));
	    if(!$user){
			$_SESSION['login'] = $_POST['login'];
			$users = R::dispense('users');
			$users->name = $_POST['name'];
			$users->email = $_POST['email'];
			$users->password = md5($_POST['password']);
			R::store($users);
			echo "<script> alert('User added'); </script>";
		}
	}
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
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
<div class="container main-area">
	<div class="row">
		<div class="col-md-12 col-sm-12 header">	
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
		<div class="text-block col-md-7">
			<h1 class="col-md-12 col-sm-12">
				Это интересные и эффективные 
				игры для развития мозга.
			</h1>

			<h2 class="col-md-10 col-sm-12">
				Уже более 100 000 человек развиваются с нами 
				— присоединяйтесь и вы.
			</h2>
			<ul class="vertical-items">
				<li class="col-md-12">
					<img src="" class="benefits-item_1">
					<div class="cont">
						<div class="H4">Увлекательные</div>
						<span class="benefits-cases">BrainApps делает развитие вашего мозга увлекательным</span>
					</div>
				</li>
				<li class="col-md-8">
					<img  src="" class="benefits-item_2">
					<div class="cont">
						<div class="H4">Индивидуальные</div>
						<span class="benefits-cases">BrainApps подстраивается именно под вас</span>
					</div>
				</li>
				<li class="col-md-8">
					<img src="" class="benefits-item_3">
					<div class="cont">
						<div class="H4">Эффективные</div>
						<span class="benefits-cases">Прогресс не заставит себя ждать</span>
					</div>
				</li>
			</ul>
		</div>
		<div class="reg-block col-md-3 col-md-offset-1">
			<div class="vertical-item_1-form">
				<h2 class="item-title">Бесплатная регистрация</h2>
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  accept-charset="UTF-8">
				<label>
					<div>Имя</div>
					<input type="text" pattern="[A-Za-zА-Яа-яЁё-s]"  name="name" class="form-control">
				</label>
				<label>
					<div>Электронная почта</div>
					<input type="email" name="email" class="form-control">
				</label>
				<label>
					<div>Пароль</div>
					<input type="password" pattern="[a-z0-9._%+-]{6,}"  name="password"
					 class="form-control">
				</label>
				<button type="submit" name="reg" class="btn btn-primary">Зарегистрироваться</button>
				</form>
			</div>
		</div>
		<div class="footer col-md-12">
		</div>	
	</div>
</div>
<div class="full">
	
</div>
<div class="reg-block sign-block">
		<div class="vertical-item_1-form">
			<h2 class="item-title">Вход</h2>
			<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" accept-charset="UTF-8">
			<label>
				<div>Электронная почта</div>
				<input type="email" name="email" class="form-control">
			</label>
			<label>
				<div>Пароль</div>
				<input type="password"  name="password" class="form-control">
			</label>
			<button type="submit" name="login" class="btn btn-primary">Войти</button>
			</form>
		</div>
	</div>

<script>
$(document).ready(function(){
    $("#signup").click(function(){
        $(".full").toggle();
        $(".sign-block").toggle();
    });
});
</script>
</body>
</html>