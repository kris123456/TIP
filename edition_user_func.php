<?php

session_start();

include('../db.php');

if (isset($_COOKIE['userName']) && isset($_POST['submit'])) {

	//var_dump($_POST);

	$id_user = 0;
	
	$sth = $dbh->prepare("SELECT * FROM users
						WHERE login = ?");
						
	$sth->execute(array($_COOKIE['userName']));
	$results = $sth->fetchAll();
	
	foreach($results as $result) {
	
		$id_user = $result['id_user'];
	
    }


    if (isset($_POST['name']) && $_POST["name"] != "") {
		
		$statement1 = $dbh->prepare("UPDATE users SET name = ? WHERE id_user = ?");
		if($statement1->execute(array($_POST['name'],$id_user)));
		else
		{
			echo "Error: UPDATE orders SET name...";
		}	
    }

    if (isset($_POST['email']) && $_POST["email"] != "") {
		
		$statement1 = $dbh->prepare("UPDATE users SET email = ? WHERE id_user = ?");
		if($statement1->execute(array($_POST['email'],$id_user)));
		else
		{
			echo "Error: UPDATE Contact SET email...";
		}	
    }

    if (isset($_POST['nick']) && $_POST["nick"] != "") {
		
		$statement1 = $dbh->prepare("UPDATE users SET nick = ? WHERE id_user = ?");
		if($statement1->execute(array($_POST['nick'],$id_user)));
		else
		{
			echo "Error: UPDATE Addresses SET street...";
		}	
    }
	
	if(isset($_POST['pass']) && isset($_POST['cpass']) && ($_POST['pass'] == $_POST['cpass']) && $_POST['pass'] != ""){
		
		// zamiana hasła na skrót md5 i zapisanie do bazy danych
		

		$sha256_pass = hash('sha256', $_POST['pass']);
		
		$statement1 = $dbh->prepare("UPDATE users SET password_hash = ? WHERE id_user = ?");
		if($statement1->execute(array($sha256_pass,$id_user)));
		else
		{
			echo "Error: UPDATE users SET password_hash...";
		}	
	}

	echo '<a href="edition_user.php">Powrót na stronę edycji profilu...</a>';
	echo '<script>setTimeout(function(){location.href="http://127.0.0.1/tip/edition_user.php", 1000} );</script>';
	
}
else 
{
	echo '<a href="index.php">Powrót na stronę główną...</a>';
	echo '<script>setTimeout(function(){location.href="http://127.0.0.1/tip/userpage.php", 1000} );</script>';
}

?>