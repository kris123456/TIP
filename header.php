<!-- Navigation -->
<?php
session_start();
?>
<?php include('../db.php'); 
?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://127.0.0.1/tip/userpage.php">WIDEOKONFERENCJE</a>
        </div>

        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
				<?php
				
					if(isset($_COOKIE['userName']))
					{
						echo '<li><a href="http://127.0.0.1/tip/edition_user.php">Edycja danych</a></li>';
					}
				
				?>
                
				<?php 
					if(isset($_COOKIE['userName']))
					{
						echo '<li><a href="http://127.0.0.1/tip/userpage.php">Witaj '.$_COOKIE['userName'].'</a></li>';
					}
					else echo '<li><a href="http://127.0.0.1/tip/start.php">Zaloguj</a></li>';
				
				?>
				<?php 
				
				if(isset($_COOKIE['userName']))				
				{
					echo '<li><a href="logout.php">Wyloguj</a></li>';
				}
				
				?>
				<?php
				if(!(isset($_COOKIE['userName'])))
					echo '<li><a href="http://127.0.0.1/tip/start.php">Zarejestruj</a></li>';
				?>
            </ul>
        </div><!--/.nav-collapse -->

    </div>
    <!-- /.container -->
</nav>