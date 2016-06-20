<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Wideokonferencja TIP</title>
    <link href='http://127.0.0.1/tip/css/font.css' rel='stylesheet' type='text/css'>
    
    <link rel="stylesheet" href="http://127.0.0.1/tip/css/normalize.css">

    
        <link rel="stylesheet" href="http://127.0.0.1/tip/css/style.css">

    
    
    
  </head>

  <body>

    <div class="form">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">Zarejestruj</a></li>
        <li class="tab"><a href="#login">Zaloguj</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="signup">   
          <h1>Formularz rejestracji</h1>
          
          <form method="post" id="forms" action="http://127.0.0.1/tip/roomAccess.php">
          
	<div class="field-wrap">
              <label>
                Login<span class="req">*</span>
              </label>
              <input type="text" name="nick" required autocomplete="off" />
            </div>

	<div class="field-wrap">
            <label>
              Hasło<span class="req">*</span>
            </label>
            <input name="pass" type="password"required autocomplete="off"/>
          </div>

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input name="email" required />
          </div>
                    
          <button name="submitbutton" type="submit" class="button button-block" value="register" />ZAŁÓŻ KONTO</button>
          
          </form>

        </div>
        
        <div id="login">   
          <h1>Formularz logowania</h1>
          
          <form id="forms" method="post" action="http://127.0.0.1/tip/roomAccess.php">
          
            <div class="field-wrap">
            <label>
              Login<span class="req">*</span>
            </label>
            <input name="nick" required autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
            <label>
              Hasło<span class="req">*</span>
            </label>
            <input name="pass" type="password"required autocomplete="off"/>
          </div>
          
          <button name ="submitbutton" class="button button-block" type="submit" value="login" />ZALOGUJ</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
    <script src='http://127.0.0.1/tip/js/jquery2.min.js'></script>

        <script src="http://127.0.0.1/tip/js/index.js"></script>

    
    
    
  </body>
</html>
