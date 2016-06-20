<?php

include('../db.php');
session_start(); //rozpoczęcie sesji



if(isset($_POST['submitbutton']) && $_POST['submitbutton'] == "register")
{
	
	try{
		
		if(isset($_POST['nick']) && isset($_POST['pass']) && isset($_POST['email']))
		{
				$nick = $_POST['nick'];
				$pass = $_POST['pass'];
				$email = $_POST['email'];
			
// sprawdzenie czy ktoś już taki o podanym loginie istnieje

	$sth = $dbh->prepare("SELECT * 
						  FROM users 
						  WHERE login = ?");
    $sth->execute(array($nick));
	$results = $sth->fetchAll();
	
	if(count($results) > 0)
	{
		echo 'Użytkownik o podanym loginie już istnieje! Spróbuj jeszcze raz!';
        echo "<script>setTimeout('window.history.back()', 2000);</script>";
		die();
	}

			
			$sha256_pass = hash('sha256', $pass);
		
			$statement = $dbh->prepare("INSERT INTO users (nick,login,name,password_hash,email,register_date,last_modified_account,access_user) VALUES (?,?,NULL,?,?,NOW(),NOW(),1)");
			if($statement->execute(array($nick, $nick, $sha256_pass, $email)))
			{
				
				$_SESSION['login'] = $nick;
					echo '<script>function setCookie(cname, cvalue, exdays) {
						var d = new Date();
						d.setTime(d.getTime() + (exdays*24*60*60*1000));
						var expires = "expires="+ d.toUTCString();
						document.cookie = cname + "=" + cvalue + "; " + expires;
						} 
						
						function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(";");
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==" ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
} 

var Cookie =
{
   set: function(name, value, days)
   {
      var domain, domainParts, date, expires, host;

      if (days)
      {
         date = new Date();
         date.setTime(date.getTime()+(days*24*60*60*1000));
         expires = "; expires="+date.toGMTString();
      }
      else
      {
         expires = "";
      }

      host = location.host;
      if (host.split(".").length === 1)
      {
         document.cookie = name+"="+value+expires+"; path=/";
      }
      else
      {
         // Remember the cookie on all subdomains.
          //
         // Start with trying to set cookie to the top domain.
         // (example: if user is on foo.com, try to set
         //  cookie to domain ".com")
         //
         // If the cookie will not be set, it means ".com"
         // is a top level domain and we need to
         // set the cookie to ".foo.com"
         domainParts = host.split(".");
         domainParts.shift();
         domain = "."+domainParts.join(".");

         document.cookie = name+"="+value+expires+"; path=/; domain="+domain;

         // check if cookie was successfuly set to the given domain
         // (otherwise it was a Top-Level Domain)
         if (Cookie.get(name) == null || Cookie.get(name) != value)
         {
            // append "." to current domain
            domain = "."+host;
            document.cookie = name+"="+value+expires+"; path=/; domain="+domain;
         }
      }
   },

   get: function(name)
   {
      var nameEQ = name + "=";
      var ca = document.cookie.split(";");
      for (var i=0; i < ca.length; i++)
      {
         var c = ca[i];
         while (c.charAt(0)==" ")
         {
            c = c.substring(1,c.length);
         }

         if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
      }
      return null;
   },

   erase: function(name)
   {
      Cookie.set(name, "", -1);
   }
};

function hashCode(s){for(var h=0,i=0;i<s.length;h&=h){h=31*h+s.charCodeAt(i++)}return h}

var valueCookie = getCookie("PHPSESSID");

Cookie.set("sessionUser", valueCookie);
Cookie.set("sessionCode",hashCode(valueCookie + "login" ));
Cookie.set("userName","'.$_SESSION['login'].'");

setTimeout(window.location.href="http://127.0.0.1/tip/userpage.php", 2000);
						
</script>';
			}
			else echo "Eror: INSERT INTO Users ...";
		}
	}
	catch(Exception $e)
	{
		echo "Błąd ogólny!";
	}
}

if(isset($_POST['submitbutton']) && $_POST['submitbutton'] == "login")
{
if(isset($_POST['nick']) && isset($_POST['pass']))
{
	$login = $_POST['nick'];
	$pass = $_POST['pass'];
	$sha256_pass = hash('sha256', $pass);

	$sth = $dbh->prepare("SELECT * 
						  FROM users 
						  WHERE login = ? 
						  AND password_hash = ?");
    $sth->execute(array($login,$sha256_pass));
	$results = $sth->fetchAll();
	
	foreach($results as $result) {

        if (($login == $result['login']) && ($sha256_pass == $result['password_hash'])) {

		$statement1 = $dbh->prepare("UPDATE users SET access_user = 1 WHERE login = ?");
		if($statement1->execute(array($result['login'])));
		else
		{
			echo "Error: UPDATE users SET access_user...";
			'<script>setTimeout(window.location.href="http://127.0.0.1/tip/start.php", 2000);</script>';
			die();
		}	
		
						$_SESSION['login'] = $login;
						$hash = hash('md5', $login);
						echo '<script>function setCookie(cname, cvalue, exdays) {
						var d = new Date();
						d.setTime(d.getTime() + (exdays*24*60*60*1000));
						var expires = "expires="+ d.toUTCString();
						document.cookie = cname + "=" + cvalue + "; " + expires;
						} 
						
						function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(";");
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==" ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
} 

var Cookie =
{
   set: function(name, value, days)
   {
      var domain, domainParts, date, expires, host;

      if (days)
      {
         date = new Date();
         date.setTime(date.getTime()+(days*24*60*60*1000));
         expires = "; expires="+date.toGMTString();
      }
      else
      {
         expires = "";
      }

      host = location.host;
      if (host.split(".").length === 1)
      {
         document.cookie = name+"="+value+expires+"; path=/";
      }
      else
      {
         // Remember the cookie on all subdomains.
          //
         // Start with trying to set cookie to the top domain.
         // (example: if user is on foo.com, try to set
         //  cookie to domain ".com")
         //
         // If the cookie will not be set, it means ".com"
         // is a top level domain and we need to
         // set the cookie to ".foo.com"
         domainParts = host.split(".");
         domainParts.shift();
         domain = "."+domainParts.join(".");

         document.cookie = name+"="+value+expires+"; path=/; domain="+domain;

         // check if cookie was successfuly set to the given domain
         // (otherwise it was a Top-Level Domain)
         if (Cookie.get(name) == null || Cookie.get(name) != value)
         {
            // append "." to current domain
            domain = "."+host;
            document.cookie = name+"="+value+expires+"; path=/; domain="+domain;
         }
      }
   },

   get: function(name)
   {
      var nameEQ = name + "=";
      var ca = document.cookie.split(";");
      for (var i=0; i < ca.length; i++)
      {
         var c = ca[i];
         while (c.charAt(0)==" ")
         {
            c = c.substring(1,c.length);
         }

         if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
      }
      return null;
   },

   erase: function(name)
   {
      Cookie.set(name, "", -1);
   }
};

function hashCode(s){for(var h=0,i=0;i<s.length;h&=h){h=31*h+s.charCodeAt(i++)}return h}

var valueCookie = getCookie("PHPSESSID");

Cookie.set("sessionUser", valueCookie);
Cookie.set("sessionCode",hashCode(valueCookie + "login" ));
Cookie.set("userName","'.$_SESSION['login'].'");
						
</script>';

echo '<script>setTimeout(window.location.href="http://127.0.0.1/tip/userpage.php", 2000);</script>';

					}
					else 
					{
				echo 'Podano nieprawidłowe dane! Spróbuj jeszcze raz!';
               // echo "<script>setTimeout('http://127.0.0.1/tip/start.php', 2000);</script>";
				echo '<script>window.location.href="http://127.0.0.1/tip/start.php"</script>';
					}
                    die();
				}
echo 'Nieprawidłowe dane! Spróbuj jeszcze raz!';
echo '<script>setTimeout(window.location.href="http://127.0.0.1/tip/start.php", 2000);</script>';
		
}

else 
{
		echo '<script type="text/javascript">
         window.location.href = "http://127.0.0.1/tip/start.php";
      </script>';
}
}



?>