<?
require "db.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST['save'])){
		$number = $_POST["iterator"];
		if(empty($number)){
			$number = 1;
		}
		$questions = R::dispense('questions');
		$questions->question = $_POST['question'];
		$questions->quiz_code = $_SESSION['quiz_code'];
		$questions->a = $_POST['a'];
		$questions->b = $_POST['b'];
		$questions->c = $_POST['c'];
		$questions->d = $_POST['d'];
		$questions->correct = $_POST['correct'];
		$sql = "UPDATE quizes SET size = ".$number++." WHERE code = '".$_SESSION['quiz_code']."'"; 
		R::exec($sql);
		R::store($questions);
		header('Location: questions.php');
	}

}
if($_SERVER["REQUEST_METHOD"] == "GET") {
	if(isset($_GET['nbr'])){
		$number = $_GET["nbr"];
		if(empty($number)){
			$number = 1;
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
</div>
<div class="question-block">
	<div class="question row">
	</div>
</div>
<script>
$(document).ready(function(){
    $('#switchid').change(function() {
        if($(this).is(":checked")) {
            $.ajax({ type: "GET",   
                 url: "php/main.php?switchstatus=1&code=<?=$_SESSION['quiz_code']?>",   
                 success : function(text)
                 {
                    console.log(text);
                 }
        		});
        }else{
        	$.ajax({ type: "GET",   
                 url: "php/main.php?switchstatus=0&code=<?=$_SESSION['quiz_code']?>",     
                 success : function(text)
                 {
                    console.log(text);
                 }
        		});
        }     
	});
});
</script>
</body>
</html>