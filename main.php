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
				<a href="newtest.php" class="success-btn"> Создать тест </a>
				<br> <br>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<label>
						<input type="text" pattern="[A-Za-zА-Яа-яЁё-s]"  name="name" class="form-control" placeholder="Код">
					</label>

					<button type="submit" name="reg" class="btn btn-primary">Начать тест</button>
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
	// $(document).keypress(function(e) {
	//     console.log(e.which);
	// });
	// $(document).ready(function(){
	//     $("body").click(function(){
	//         console.log('mouse');
	//         console.log(history.length);
	//     });
	// });
	var isActive;
	window.onfocus = function () { 
	  isActive = true; 
	}; 
	window.onblur = function () { 
	  isActive = false; 
	}; 
	setInterval(function () { 
	  console.log(window.isActive ? 'active' : 'inactive'); 
	}, 1000);
			
	
</script>



</body>
</html>
<? die() ?>