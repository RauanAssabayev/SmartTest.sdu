<?
require "db.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST['questions'])){
		header('Location: questions.php');
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
			<img src="img/logo.png" alt="" class="col-md-3 col-sm-4">
			<!--<ul class="main-menu col-md-6">
				<li class="col-md-1">Тесты</li>
				<li class="col-md-1">Тесты</li>
				<li class="col-md-1">Тесты</li>
				<li class="col-md-1">Тесты</li>
			</ul> -->
			<div class="log-btn btn-action finish col-md-1 col-sm-2 col-md-offset-8 col-sm-offset-6"> 
					<input type="submit" value="Выйти">
			</div>
		</div>
	</div>
	<div class="question-block">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12  question-item">
					<img class="col-md-1" src="img/quiz-title.png">
					<h3> Quiz title: <? echo $_SESSION['quiz_title']; ?> </h3>
					<h3> Quiz code: <? echo $_SESSION['quiz_code']; ?> </h3>
					<label class="switch">
					  <input id="switchid" type="checkbox" checked>
					  <div class="slider round "></div>
					</label>
				</div>
				
				
				<?
				$sql = "select * from questions where quiz_code = '".$_SESSION['quiz_code']."'";
				$result = R::getAll($sql);
				if($result){
					$number = 1;
					foreach($result as $questions) {
						echo "<div class='col-md-8 col-md-offset-2 
								col-sm-8 col-sm-offset-2 col-xs-12 questions-item'>";
						echo "<h3 class='col-md-10'> Question № ".$number." : ".$questions['question']."</h3>";
						echo "<i class='fa fa-pencil-square-o col-md-1' aria-hidden='true'></i>";
						echo "<i class='fa fa-times col-md-1' aria-hidden='true'></i>";
						echo "</div>";
						$number++;
					}
				}
				else{
					$number = 1;
				}
				$rlink  = "question.php?nbr=".$number;
				?>

				<a href="<?=$rlink?>">
					<div class="add-question col-md-2 col-sm-2 col-md-offset-5 col-sm-offset-6"> 
						<img src="img/plus.png"> 
						<p> Add question </p>
					</div>
				</a>
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