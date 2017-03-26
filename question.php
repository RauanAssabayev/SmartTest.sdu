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
		$questions->number = $number;
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
	if(isset($_GET['logout'])){
		session_destroy();
		session_unset();
		header('Location: index.php');
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
			<form action="" method="POST">
				<div class="question row">
					<? if(empty($number))$number = 1; ?>
					<p class="col-md-4"> Question №<?=$number ?> (required) </p>
				</div> 
				<div class="question row">
					<input class="col-md-6" id="question" placeholder="" type="text" name="question">
				</div>
				<div class="row">
					<input type="text" placeholder="Answer1(required)" class="col-md-4" name="a" required>
					<i id="a" class="fa fa-chevron-circle-down col-md-1" aria-hidden="true"></i>
					<input type="text" placeholder="Answer2(required)" class="col-md-4" name="b" required>
					<i id="b" class="fa fa-chevron-circle-down col-md-1" aria-hidden="true"></i>
					<input type="text" placeholder="Answer3" class="col-md-4" name="c">
					<i id="c" class="fa fa-chevron-circle-down col-md-1" aria-hidden="true"></i>
					<input type="text" placeholder="Answer4"; class="col-md-4" name="d">
					<i id="d" class="fa fa-chevron-circle-down col-md-1" aria-hidden="true"></i>
					<input type="hidden" id="correct" name="correct" value="a" >
					<input type="hidden" id="iterator" name="iterator" value=<?="\"".$number."\""?> >
					<div class="btn-action next col-md-1 col-md-offset-10" id="savediv"> 
						<input type="submit" name="save" id="save" value="SAVE">
					</div>
				</div>
			</form>
		</div>
	</div>
	<script>
	$(document).ready(function(){
	    $("#a").click(function(){
	    	clear();
	        $(this).css("color","white");
	        $("#correct").val("a");
	    });
	    $("#b").click(function(){
	    	clear();
	        $(this).css("color","white");
	        $("#correct").val("b");
	    });
	    $("#c").click(function(){
	    	clear();
	        $(this).css("color","white");
	        $("#correct").val("c");
	    });
	    $("#d").click(function(){
	    	clear();
	        $(this).css("color","white");
	        $("#correct").val("d");
	    });
	    function clear(){
	    	$("#save").css("display","block");
	    	$("#savediv").css("display","block");
	    	$("#a,#b,#c,#d").css("color","black");
	    }
		$(document).ready(function(){
		    $(".profile").click(function(){
		        $("#actions-list").slideToggle('fast','swing');
		    });
		});

	});
</script>
</body>
</html>
