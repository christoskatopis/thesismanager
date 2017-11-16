  <?php

		if (isset($_POST["login"])) {
		
			$username = $_POST["username"];
			$password = $_POST["password"];
			$hashed_pass = md5($password);
			if (($username == "") || ($password == ""))
				echo "<div id='error'><p>Παρακαλώ εισάγετε το όνομα χρήστη και τον κωδικό σας</p></div>";
			
			
			else {
				$query="SELECT * FROM users WHERE username='".$_POST["username"]."' AND password='$hashed_pass' AND requested=1";
			
				$result = mysql_query($query) or die(mysql_error());
		     
				if (mysql_num_rows($result) == 0) {
					echo "<div id='error'><p>Έχετε κάνει λάθος το όνομα χρήστη και τον κωδικό σας ή δεν σας έχει επιτραπεί η είσοδος.Παρακαλώ επικοινωνήστε με την Γραμματεία</p></div>";
					$username = "";
					$password = "";
				}
				
				else {
				
					$user = mysql_fetch_array($result);
					$_SESSION["islogged"] = "default";
					$_SESSION["username"] = $user["username"];
					$_SESSION["code"] = $user["code"];
					$_SESSION["access"] = $user["access"];
					$_SESSION["supervisor"] = $user["supervisor"];
					$username=$user["username"];
					if ($_SESSION["access"]<=1){
                    echo "<script language='Javascript'>alert('Καλωσήρθατε $username!');";
                    echo"window.location='index.php?action=home';";
                    echo "</script>";}
                    else
                    {echo "<script language='Javascript'>alert('Καλωσήρθατε $username!');";
                    echo"window.location='index.php?action=manageregnumbers';";
                    echo "</script>";}
                    }
				
				
					
				}
			}
			
			
		
		else {
		
			$username = "";
			$password = "";
		}
		
		
		?>

<div id="npost-area">

	<h1>Σύνδεση στο λογαριασμό μου</h1>
	
	<div class="gap"></div>
	
	<div class="gap"></div>
	
	<form name="form" method="POST" id="np-form">		
		<div class="inp">
			<label for="username">Όνομα Χρήστη<i> (5-15 χαρακτήρες)</i></label>
			<input type="text" name="username"/>
		</div>
		
		<div class="inp">
			<label for="password">Κωδικός Χρήστη</label>
			<input type="password" name="password"/>
		</div>
			
		<div style="margin-top:5px;">
			<button class="button-btn" formaction="index.php?action=login" type="submit" name="login">Σύνδεση</button></div>
			<button class='button-btn' id='btn2' type='submit' style='margin-top:5px' formaction="index.php?action=createaccount">Δεν έχω λογαριασμό</button>
		</div>
		
		</form>
		
	</form>

</div>

