<div class="container">

    <hr>

    <!-- Footer -->
    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p>Copyright &copy; WIDEOKONFERENCJE 2016</p>
            </div>
        </div>
    </footer>

</div>
<!-- /.container -->

<script src="http://127.0.0.1/tip/js/bootstrap.min.js"></script>

<script type="text/javascript" charset="utf-8">
		
	function setCookie(cname,cvalue,exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires=" + d.toGMTString();
		document.cookie = cname+"="+cvalue+"; "+expires;
	}

	function getCookie(name)
	{
		var re = new RegExp(name + "=([^;]+)");
		var value = re.exec(document.cookie);
		return (value != null) ? unescape(value[1]) : null;
	}

	function checkCookie() {
		var user=getCookie("username");
		if (user != "") {
			alert("Welcome again " + user);
		} 	
		else {
				user = prompt("Please enter your name:","");
				if (user != "" && user != null) {
					setCookie("username", user, 30);
				}
			}
	}


	function usunCookie(nazwa) {                
		var data = new Date();
		data.setTime(date.getMonth()-1);
 
		document.cookie=nazwa + "=;expires=" + data.toGMTString();
	}
		
	window.onload = onloadFunction; // wywołanie funkcji po przeładowaniu strony
</script>
<link rel="stylesheet" href="http://127.0.0.1/tip/css/bootstrap.min.css">
    <script src="http://127.0.0.1/tip/js/jquery_new.min.js"></script>
    <script src="http://127.0.0.1/tip/js/bootstrap_new.js"></script>