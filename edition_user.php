<!DOCTYPE html>
<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Edycja danych - WIDEOKONFERENCJA</title>


    </head>

    <body>

        <?php include 'header.php'; ?>

        <!-- Page Content -->
        <div class="container">
            <div class="row">

                <?php include 'sidebar.php'; ?>		

                <div class="col-md-9">
                    <form class="form-horizontal" method="POST" action="edition_user_func.php">

                        <?php
               

                        if (isset($_SESSION['login'])) { 

                         								
							$sth = $dbh->prepare("SELECT * FROM users 
								WHERE login = ?");
							$sth->execute(array($_COOKIE['userName']));
							$results = $sth->fetchAll();
						                           

                             foreach($results as $result) { 

                           



                              echo '<br><div class="form-group">
                            <label class="col-sm-3 control-label">Login</label>
                            <div class="col-sm-9"><input type="text" class="form-control" placeholder="Login" name="name" value="' . $result['login'] . '" readonly /></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Nick</label>
                            <div class="col-sm-9"><input type="text" class="form-control" placeholder="Nick" name="nick" value="' . $result['nick'] . '" /></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Imię</label>
                            <div class="col-sm-9"><input type="text" class="form-control" placeholder="Imię" name="name" value="' . $result['name'] . '" /></div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Hasło</label>
                            <div class="col-sm-9"><input type="password" id="haslo" class="form-control" placeholder="Hasło" name="pass"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Potwierdź hasło</label>
                            <div class="col-sm-9"><input id="haslo_potw" type="password" class="form-control" placeholder="Potwierdź hasło" name="cpass"></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">E-mail</label>
                            <div class="col-sm-9"><input type="text" class="form-control" placeholder="E-mail" name="email" value="' . $result['email'] . '" /></div>
                        </div>
                       
                        </div>';
                                    }
                                
                            
                            echo' <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-5">
                                <center><button id="button" type="submit" name="submit" class="btn btn-default big-button"><b>Zapisz dane</b></button></center>
                            </div>
							<div class="col-sm-offset-3 col-sm-5"><br></div>
							 <div class="col-sm-offset-3 col-sm-5"><center><a href="http://127.0.0.1/tip/userpage.php" class="btn btn-default big-button"><b>Wróc</b></a></center></div>
                        </div>';

                            echo '</form>';
                        }
                        ?>

                </div>

            </div>

        </div>
        <!-- /.container -->

        <?php include 'footer.php'; ?>

    </body>

</html>
