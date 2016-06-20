<?php

session_start();
include('../db.php'); 

if(isset($_POST['logout']) || isset($_COOKIE['userName']))
{
	
 $login = $_COOKIE['userName'];
 
 		$statement1 = $dbh->prepare("UPDATE users SET access_user = 0 WHERE login = ?");
		if($statement1->execute(array($login)));
		else
		{
			echo "Error: UPDATE users SET access_user...";
		}

echo '<script>var Cookie =
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


Cookie.erase("sessionUser");
Cookie.erase("sessionCode");
Cookie.erase("userName");

</script>';

		echo "Zostałeś wylogowany!";

		echo '<script type="text/javascript">
         window.location.href = "http://127.0.0.1/tip/start.php";
      </script>';
	  
	  session_destroy();
}
?>