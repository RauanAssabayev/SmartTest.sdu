<?
require "db.php";
session_start();
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
			<h3 class="col-md-2 col-md-offset-2 pass-status"> ALL OK </h3>
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
		<div class="question-list">
		<?
		$sql = "select count(*) as size from questions where quiz_code = '".$_SESSION['code']."'";
		$result = R::getAll($sql);
		if($result){
			for($i = 0; $i<$result[0]['size']; $i++ ){
				if($i == 0){
					echo '<span class="nl active"  data-id='.($i+1).' > '.($i+1).'</span>'; 
				}else{
					echo '<span class="nl"  data-id='.($i+1).' > '.($i+1).'</span>'; 
				}
			}
			$number = 1;
		}
		else{
			$number = 0;
		}
		$rlink  = "question.php?nbr=".$number;
		?>
	</div>
		<div class="question-block">
			<?	
				$sql = "select * from questions where quiz_code = '".$_SESSION['code']."'";
				$fqst = R::getAll($sql);
			?>
			<br>
			<div class="row">
				<div class="question-content col-md-10 col-md-offset-1">
					<h3  id="question"> <?=$number.'. '.$fqst[0]['question'] ?> </h3>
					<input type="hidden" name="number">
			
					<div class="answer-item">
						<input class="ans" align="right" id="a" type="radio" name="quiz" value="a">
						<h4 id="ansa"> <?=$fqst[0]['a'] ?> </h4>
					</div>
					<div class="answer-item">
						<input class="ans" type="radio" id="b" name="quiz" value="b">
						<h4 id="ansb"> <?=$fqst[0]['b'] ?> </h4>
					</div>
					<div class="answer-item">
						<input class="ans" type="radio" id="c" name="quiz" value="c">
						<h4 id="ansc"> <?=$fqst[0]['c'] ?> </h4>
					</div>
					<div class="answer-item">
						<input class="ans" type="radio" id="d" name="quiz" value="d">
						<h4 id="ansd"> <?=$fqst[0]['d'] ?> </h4>
					</div>
				</div>
	
				<span id="finish" class="fin-btn col-md-2 col-md-offset-5"> Закончить </span>
			</div>
		</div>
</div>
<script>
$(document).ready(function(){
	var obj = "span.nl.active";
	var numb = '1';
    $(".nl").click(function(){	
    	obj = $(this);
    	console.log(obj);
        var id = obj.data('id');
        $(this).addClass('active');
    	$.ajax({ type: "GET",  
                 url: "php/main.php?code=<?=$_SESSION['quiz_code']?>&id=".concat(id),   
                 success : function(text)
                 {
                 	console.log(text);
                    var obj = jQuery.parseJSON(text);
                     numb = obj[0]['number'];
	                 $('#question').text(obj[0]['question']);
	                 $('#ansa').text(obj[0]['a']);
	                 $('#ansb').text(obj[0]['b']);
	                 $('#ansc').text(obj[0]['c']);
	                 $('#ansd').text(obj[0]['d']);
                 }
	    });
    });
    $(".profile").click(function(){
		$("#actions-list").slideToggle('fast','swing');
	});
	$(".ans").click(function(){
		$(obj).addClass('checked');
    	$(obj).removeClass('active');
    	$.ajax({ type: "GET",  
                 url: "php/main.php?qcode=<?=$_SESSION['quiz_code']?>&penalty=".concat(penalty).concat("&number=").concat(numb).concat("&ans=".concat($(this).attr('id'))),   
                 success : function(text)
                 {
                 	console.log(text);
                 }
	    });
	});

	$("#finish").click(function(){
    	$.ajax({ type: "GET",  
         url: "php/main.php?fcode=<?=$_SESSION['quiz_code']?>&email=<?=$_SESSION['email']?>",   
         success : function(text)
         {
         	console.log(text);
         	window.open ('main.php','_self',false); 
         }
	    });
	});

});



	var isActive;
	var penalty = 0;
	window.onfocus = function () { 
	  isActive = true; 
	}; 
	window.onblur = function () { 
	  isActive = false; 
	}; 
	setInterval(function () { 
	  console.log(window.isActive ? 'active' : 'inactive'); 
	  if(!window.isActive){
			$('.pass-status').text("PENALTY "+(penalty++));
			$('.pass-status').css("color","red");
	  }
	}, 1000);

</script>
</body>
</html>