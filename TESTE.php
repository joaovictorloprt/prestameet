<?php
/*
if($_COOKIE['facebook'] == "true"){
	$result_face = $db->query("SELECT * FROM contas WHERE login = '" . $_COOKIE['email'] . "' AND nome = '".$_COOKIE['first_name']." ".$_COOKIE['last_name']."'");
	if($result_face->rowCount() == 0){
		$insert = $db->query("INSERT INTO clientes VALUES (NULL,'".$_COOKIE['first_name']."','".$_COOKIE['last_name']."','".$_COOKIE['email']."',NULL,NULL,NULL,'0','".$_COOKIE['picture']."')");
		if($insert){
			$sqlSelect123 = "SELECT * FROM clientes WHERE nome = '".$_COOKIE['first_name']."' AND sobrenome = '".$_COOKIE['last_name']."' AND email = '".$_COOKIE['email']."'";

			$result123 = $db->query($sqlSelect123);

			$account = $result123->fetchAll();
			$insert2 = $db->query("INSERT INTO contas VALUES (NULL,'".$_COOKIE['first_name']." ".$_COOKIE['last_name']."','".$_COOKIE['email']."','".$_COOKIE['password']."','".$account['id']."','1','0',NOW(),NULL,'".$_COOKIE['picture']."','1','...','...',null)");
			$fetch_face = $db->query("SELECT * FROM contas WHERE login = '" . $_COOKIE['email'] . "' AND senha = ''")->fetchAll();
			setcookie('tipo_conta', $account['tipo_conta'], time() + 3e+7);
			if($_COOKIE['tipo_conta'] == 1){
				$contas = select("contas", " WHERE login = '" . $_COOKIE['email'] . "' AND senha = ''");
				$user = select("clientes", " WHERE id = " . $contas['id_cliente']);
			}else if($_COOKIE['tipo_conta'] == 2){
				$contas = select("contas", " WHERE login = '" . $_COOKIE['email'] . "' AND senha = ''");
				$user = select("prestador", " WHERE id = " . $contas['id_cliente']);
			}	
		} else {
			header("Location: logout.php");	
		}
	} else {
		$sqlSelect123 = "SELECT * FROM clientes WHERE nome = '".$_COOKIE['first_name']."' AND sobrenome = '".$_COOKIE['last_name']."' AND email = '".$_COOKIE['email']."'";

		$result123 = $db->query($sqlSelect123);

		$account = $result123->fetchAll();
		
		setcookie('tipo_conta', $account['tipo_conta'], time() + 3e+7);
		
		if($_COOKIE['tipo_conta'] == 1){
			$contas = select("contas", " WHERE login = '" . $_COOKIE['email'] . "' AND senha = ''");
			$user = select("clientes", " WHERE id = " . $contas['id_cliente']);
		}else if($_COOKIE['tipo_conta'] == 2){
			$contas = select("contas", " WHERE login = '" . $_COOKIE['email'] . "' AND senha = ''");
			$user = select("prestador", " WHERE id = " . $contas['id_cliente']);
		}
	}
}else{
*/
?>
<!DOCTYPE html>
<html>
<head>
<title>Facebook Login JavaScript Example</title>
<meta charset="UTF-8">
</head>
<body>

<script>
      function statusChangeCallback(response) {
        console.log('statusChangeCallback');
        console.log(response);
        if (response.status === 'connected') {
          testAPI();
        } else if (response.status === 'not_authorized') {
          document.getElementById('status').innerHTML = 'Please log ' +
            'into this app.';
        } else {
          document.getElementById('status').innerHTML = 'Please log ' +
            'into Facebook.';
        }
      }

      function checkLoginState() {
        FB.getLoginStatus(function(response) {
          statusChangeCallback(response);
        });
      }

      window.fbAsyncInit = function() {
      FB.init({
        appId      : '725380280975429',
        cookie     : true,  // enable cookies to allow the server to access 
                            // the session
        xfbml      : true,  // parse social plugins on this page
        version    : 'v2.5' // use graph api version 2.5
      });

      FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
      });

      };
	
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
	
	 function testAPI() {
		  FB.api( "/me?fields=name,email,id,first_name,last_name,picture", function(response){
			setCookie('email',response.email,30);
			setCookie('first_name',response.first_name,30);
			setCookie('last_name',response.last_name,30);
			setCookie('picture','https://graph.facebook.com/' + response.id + '/picture',30);
			setCookie('password','',30);
			setCookie('facebook','true',30);
			window.location='https://PrestaMeet.kinghost.net/index.php?page=principal';
	});
}
		
    </script>
    
    
	<script>
	function setCookie(cname,cvalue,exdays) {
		var d = new Date();
		d.setTime(d.getTime() + (exdays*24*60*60*1000));
		var expires = "expires=" + d.toGMTString();
		document.cookie = cname+"="+cvalue+"; "+expires;
	}
	</script>

    <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
    </fb:login-button>

    <div id="status">
    </div>

</body>
</html>