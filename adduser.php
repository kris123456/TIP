<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DODAWANIE ZNAJOMYCH - WIDEOKONFERENCJE - PROJEKT TELEFONIA IP</title>


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->	
    </head>

    <body>

        <?php include 'header.php'; ?>

        <!-- Page Content -->
        <div class="container">
            <div class="row">

                <?php include 'sidebar.php'; ?>

			<div class="col-md-9">
					<form action="adduser.php" method="POST">
					<h3>Szukaj</h3>
					<div class="form-inline">
						<div class="form-group">
							<label for="exampleInputName2">Nick:</label>
							<input name="nick" type="text" class="form-control" id="exampleInputName2" placeholder="Wpisz słowa">
							<button type="submit" class="btn btn-default big-button"><b>SZUKAJ</b></button>
						</div>
					</div>
					</form>
					<form action="friendmanage.php" method="POST">
					<?php
					
						$my_nick = $_COOKIE['userName'];
					
						// sprawdzenie czy nie mam już na liście znajomych takiego użytkownika
							
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
									//echo $result['id_user_friend2']."<br>";
								}
								
								// wyświetlenie nicków znajomych oraz ich dostępności na podstawie wczesniej
								// pobranych id
								array_shift($idFriend);
								
								$in = "";
								if(count($idFriend) > 0)
									$in = str_repeat('?,',count($idFriend) - 1).'?';
								
								if(count($results) > 0)
								{
									$sql = "SELECT id_user, nick, access_user 
									FROM users
									WHERE id_user IN ($in)";
									$s = $dbh->prepare($sql);
									$s->execute($idFriend);
									$results_friend = $s->fetchAll();
								}
							
					
						if(isset($_POST['nick']))
						{
							
							$nick = $_POST['nick'];

							// wyszukiwanie niepowtarzających się użytkowników, nawet jeżeli mają te same nicki , to są brane pod uwage ich różne id
							
							echo "<h3>Wyniki wyszukiwania</h3>";
							
			
								$sql = "SELECT id_user, nick
								FROM users
								WHERE id_user not IN ($in) AND nick = '$nick'";
								$s = $dbh->prepare($sql);
								$s->execute($idFriend);
								$results = $s->fetchAll();
						                           
                             foreach($results as $result) {
								
								// jeżeli próbuje znaleźć mój nick, to kontynyuj
								if($result['nick'] == $my_nick)
									continue;
								echo '<div class="form-inline">
						<div class="form-group">
							<label for="exampleInputName2">'.$result['nick'].'</label>';
							
								// dodanie funkcjonalności - opcja DODAJ ZNAJOMEGO
							
								echo '<button name="adduser" value="'.$result['id_user'].'" type="submit" class="btn btn-default big-button"><b>DODAJ ZNAJOMEGO</b></button>';
							
								echo '</div>
									</div>';

							 }		
							
							 if(count($results) < 1)
								 echo "Brak wyników wyszukiwania";
							
						}
						

						echo "<h3>Lista znajomych</h3>";
					
					if(count($idFriend) > 0)
					{
					
					
					foreach($results_friend as $result) {
					
						if($result['nick'] == $my_nick)
									continue;
								echo '<div class="form-inline">
						<div class="form-group">
							<label for="exampleInputName2">'.$result['nick'].'</label>';
							
								
							
								echo '<button name="deleteuser" type="submit" value="'.$result['id_user'].'" class="btn btn-default big-button"><b>USUŃ ZNAJOMEGO</b></button>';
							
							
							
								echo '</div>
									</div>';					 
					}
					}
					
					if(count($idFriend) < 1 )
							echo "Lista znajomych jest pusta!";
						
					echo "<h3>Lista ogólna użytkowników</h3>";
					
					$results_not_friend = "";
					
					if(count($idFriend) > 0 )
					{
					$in = str_repeat('?,',count($idFriend) - 1).'?';
					$sql = "SELECT id_user, nick
					FROM users
					WHERE id_user not IN ($in)";
					$s = $dbh->prepare($sql);
					$s->execute($idFriend);
					$results_not_friend = $s->fetchAll();
					}
					else 
					{
					$sql = "SELECT id_user, nick
					FROM users";
					$s = $dbh->prepare($sql);
					$s->execute();
					$results_not_friend = $s->fetchAll();
					}

					
					foreach($results_not_friend as $result) {
					
						if($result['nick'] == $my_nick)
									continue;
								echo '<div class="form-inline">
						<div class="form-group">
							<label for="exampleInputName2">'.$result['nick'].'</label>';
							
								
							
								echo '<button name="adduser" value="'.$result['id_user'].'" type="submit" class="btn btn-default big-button"><b>DODAJ ZNAJOMEGO</b></button>';
							
							
							
								echo '</div>
									</div>';					 
					}
					
					?>
					</form>
				</div>
                

            </div>
        </div>
        <!-- /.container -->

        <?php include 'footer.php'; ?>

    </body>


</html>