<br>
<div class="col-md-3">
    <div class="list-group kategorie">
        <h3 class="list-group-item" style="background-color: #f5f5f5;">Znajomi</h3>
		<div class="list-group-item">

        <?php

	  include('../db.php');
		
		try{
		
		// pobranie id znajomych
		
		$idFriend[] = 0; // tablica do przechowywania id znajomych
		$userName = $_COOKIE['userName'];

	$sql = "SELECT fr.id_user_friend2 
							FROM friends AS fr
							JOIN users AS us ON
							us.id_user = fr.id_user_friend1
							WHERE us.login = :userName";
	$s = $dbh->prepare($sql);
	$s -> bindValue(':userName', $userName);
    $s->execute();
	
	
	$results = $s->fetchAll();
	

    foreach($results as $result) {
            $idFriend[] = $result['id_user_friend2'];
        }
		
		
		
		// wyświetlenie nicków znajomych oraz ich dostępności na podstawie wczesniej
		// pobranych id
	array_shift($idFriend);
	if(count($idFriend) > 0){
		
	$in = str_repeat('?,',count($idFriend) - 1).'?';
	$sql = "SELECT nick, access_user 
				FROM users
				WHERE id_user IN ($in)";
	$s = $dbh->prepare($sql);
    $s->execute($idFriend);
	$results = $s->fetchAll();
	
        foreach($results as $result) {
			if($result['access_user'] == 1)
			{
				echo '<center><div class="btn btn-info btn-lg" style="background-color:green!important;">
          &#10004;</span>'. $result['nick'].'</div></center><br>';
			}
			else
			{
				echo '<center><div class="btn btn-info btn-lg" style="background-color: red!important;">
          ✖</span>'.$result['nick'].'</div></center><br>';
			}
			
        }
		
		
	}
	else 
		echo "Nie masz znajomych!";
		}
		
		catch(Exception $e)
		{
			echo "Error.".$e;
			exit;
		}
		
        ?>

    </div>
 </div>
	
    <div class="list-group kontakt" style="line-height: 25px">
        <h3 class="list-group-item" style="background-color: #f5f5f5;">Autorzy projektu</h3>
        <div class="list-group-item">
            Krzysztof Jerzyński<br>
            Mateusz Paterak<br>
            <b>Kierunek:</b> Informatyka<br>
			<b>Semestr: </b> 6<br>
			<b>Specjalizacja </b> BSI
        </div>
    </div>

</div>