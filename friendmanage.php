<?php

include('../db.php');
session_start(); //rozpoczęcie sesji

if(isset($_POST['adduser']) && $_COOKIE['userName'])
{
	$login = $_COOKIE['userName'];
	$myid = "";
	$addid = $_POST['adduser'];
	
	$sql = "SELECT id_user 
	FROM users
	WHERE login = ?";
	$s = $dbh->prepare($sql);
	$s->execute(array($login));
	$results = $s->fetchAll();
	
	foreach($results as $result) {
		$myid = $result['id_user'];	
	}
	
	$statement = $dbh->prepare("INSERT INTO friends (id_user_friend1,id_user_friend2) VALUES (?,?)");
	if($statement->execute(array($myid, $addid)))
	{
			
	}
	else 
		echo "Eror: INSERT INTO friends....";
	
}

if(isset($_POST['deleteuser']) && $_COOKIE['userName'])
{
	$login = $_COOKIE['userName'];
	$myid = "";
	$deleteid = $_POST['deleteuser'];
	
	$sql = "SELECT id_user 
	FROM users
	WHERE login = ?";
	$s = $dbh->prepare($sql);
	$s->execute(array($login));
	$results = $s->fetchAll();
	
	foreach($results as $result) {
		$myid = $result['id_user'];	
	}
	
	$statement = $dbh->prepare("DELETE FROM friends WHERE id_user_friend1 = ? AND id_user_friend2 = ?");
	if($statement->execute(array($myid,$deleteid))){}				
}

header('Location: http://127.0.0.1/tip/adduser.php');	

?>