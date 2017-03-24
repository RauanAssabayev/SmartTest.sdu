<?php
if(isset($_GET['switchstatus'])){
	require "/../db.php";
	$sQuery = "UPDATE quizes SET status=".$_GET['switchstatus']." WHERE code = '".$_GET['code']."'";
	R::exec($sQuery);
	echo $sQuery;
}
else{
	echo "string";
}

