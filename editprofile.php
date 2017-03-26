<?
require "db.php";
session_start();

$sql = "select * from users where email = '".$_SESSION['email']."'";
$user = R::getAll($sql);

if($_SERVER["REQUEST_METHOD"] == "POST") {
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
		<div class="reg-block col-md-4 col-md-offset-4">
			<div class="vertical-item_1-form edit">
				<h2 class="item-title">Edit profile</h2>
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  accept-charset="UTF-8">
				<label>
					<div><p> Имя </p> </div>
					<input type="text" pattern="[A-Za-zА-Яа-яЁё-s]"  name="name" value="<?=$user[0]['name']?>" class="form-control">
				</label>
				<label>
					<div> <p> Электронная почта </p> </div>
					<input type="email" name="email" class="form-control"
					value="<?=$user[0]['email']?>" >
				</label>
				<label>
					<div> <p> Пароль </p> </div>
					<input type="password" pattern="[a-z0-9._%+-]{6,}"  name="password"
					 class="form-control">
				</label>
				<button type="submit" name="reg" class="btn btn-primary">Сохранить</button>
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
			<i  id="close" class="fa fa-times" aria-hidden="true"></i>
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
    $(".profile").click(function(){
        $("#actions-list").slideToggle('fast','swing');
    });
});
</script>
</body>
</html>