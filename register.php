<?php 
	include('login-func.php');
	if ($_SESSION['created']==1){
		$_SESSION['job']=$_POST["job"];
	}
	$_SESSION['created']=$_SESSION['created']+1;
	if ($_SESSION["job"]=="Student"){
				$access=0;
				$requested=0;
			}
			else 
				{$access=1;
			   $requested=1;}
?>
<div id="npost-area">

	<h1>Δημουργία νέου λογαριασμού</h1>
	
	<?php
			
		if (isset($_POST["submit"])){
		
			$myname = $_POST["myname"];
			$username = $_POST["username"];
			$password = $_POST["password"];
			$email = $_POST["email"];
			$supervisor=$_POST["supervisor"];
			$code=$_POST["code"];
			$title=$_POST["title"];
			$checkam="SELECT * FROM regnumbers where code='$code'";
			$isam=mysql_query($checkam);
			$user=mysql_fetch_array($isam);
			$validateam="SELECT * FROM users where code='$code'";
			$existam=mysql_query($validateam);
			$checksupervisor="SELECT * FROM users where fullname='$supervisor' AND access=1";
			$resultssupervisor=mysql_query($checksupervisor);

			
			
			if ($myname == "")
				echo "<div id='error'><p>Παρακαλώ εισάγετε το όνομά σας.</p></div>";
			elseif (validate_username($username) != "OK") {
				$error = validate_username($username);
				echo "<div id='error'><p>$error</p></div>";
				$username = "";
			}

			elseif ($code=="") {
				echo"<div id='error'><p>Παρακαλώ εισάγετε τον αριθμό μητρώου σας</p></div>";
				$code="";
			}

			elseif (mysql_num_rows($isam)==0) {
				echo"<div id='error'><p>Ο αριθμός μητρώου δεν είναι έγκυρος αριθμός μητρώου</p></div>";
			}

			elseif (mysql_num_rows($existam)>0) {
				echo"<div id='error'>Ο χρήστης που αντιστοιχεί σε αυτό τον αριθμό μητρώου έχει ήδη εγγραφεί στο σύστημα.</p></div>";
			}
			elseif (validate_password($password)!= "OK") {
				$error = validate_password($password);
				echo "<div id='error'><p>$error</p></div>";
				$password = "";
			}
			elseif (!validate_email($email)) {
				echo "<div id='error'><p>Παρακαλώ εισάγετε σωστά το  e-mail σας</p></div>";
				$email = "";
			}

			elseif($_SESSION["job"]=="Student"&&mysql_num_rows($resultssupervisor)==0)
			{  echo "<div id='error'><p>Παρακαλώ εισάγετε σωστά το όνομα του επιβλέποντα καθηγητή</p></div>";
                  $supervisor="";}

            elseif ($_SESSION["job"]=="Student"&&$user["access"]==1){
                echo "<div id='error'><p>Αυτός ο αριθμός μητρώου αντιστοιχεί σε καθηγητή</p></div>";
            }


           elseif ($_SESSION["job"]=="Teacher"&&$user["access"]==0){
                echo "<div id='error'><p>Αυτός ο αριθμός μητρώωου αντιστοιχεί σε φοιτητή</p></div>";}
           
		   

		   else {


                $checkusername="SELECT * FROM users WHERE username='$username'";
				$existusername = mysql_query($checkusername) or die(mysql_error());
				echo $existusername;
			
				if (mysql_num_rows($existusername) > 0) {
					echo "<div id='error'><p>Αυτό το username χρησιμοποιείται.</p></div>";
					$username = "";
				}
				else {
				    echo "test";
					$date = date( 'Y-m-d H:i:s');
					if ($_SESSION["job"]=="Student"){
						$nametocode="SELECT code FROM users WHERE fullname='$supervisor'";
				        $resultnametocode=mysql_query($nametocode) or die(mysql_error());
				        $user=mysql_fetch_array($resultnametocode);
				        $usercode=$user['code'];}
				    else 
				    	{$usercode="";}
					$query = "INSERT INTO users (code,username, password,fullname,email,access,requested,supervisor,thesistitle,date_registered) VALUES ('$code','$username','". md5($password)."','$myname','$email','$access','$requested','$usercode','$title','$date')";
					mysql_query($query) or die(mysql_error());
					echo $query;
					if ($_SESSION["job"]=="Student") {
					  echo "<div id='confirmation'>H αίτηση επίβλεψή σας καταχωρήθηκε επιτυχώς. Θα σας ενημερώσουμε για την έγκρισή της από τον επιβλέποντα καθηγητή</div>";
                      $request="INSERT INTO requests (type,fromperson,toperson,date_created) VALUES ('aitisi ptyxiakis','$code','$usercode','$date')";
					  mysql_query($request) or die(mysql_error());

				}
					else
					 {echo "<div id='confirmation'>Ο χρήστης δημιουργήθηκε επιτυχώς.Παρακαλώ <a href='index.php?action=login'> συνδεθείτε</a>για να εισέλθετε.</div>";

				}

				  
				}
		    }
		
		}
		else { 
			$myname = "";
			$username = "";
			$password = "";
			$email = "";
			$supervisor="";
			$code="";
		
		}
		
		
		
	?>
	<div class="gap"></div>
	
	<form action="index.php?action=register" method="POST" id="np-form">
	
		<div class="inp">
			<label for="myname">Ονοματεπώνυμο</label>
			<input type="text" name="myname" value="<?php echo $myname; ?>"/>
		</div>

		<div class="inp">
			<label for="code">Αριθμός Μητρώου</label>
			<input type="text" name="code" value="<?php echo $code; ?>"/>
		</div>
       

		<div class="inp">
			<label for="email">e-mail</label>
			<input type="text" name="email" value="<?php echo $email; ?>"/>
		</div>
		
		<div class="inp">
			<label for="username">Όνομα Χρήστη<i>(5-15 χαρακτήρες)</i></label>
			<input type="text" name="username" value="<?php echo $username; ?>"/>
		</div>
		
		<div class="inp">
			<label for="password">Κωδικός Χρήστη</label>
			<input type="password" name="password" value="<?php echo $password; ?>"/>
		</div>
		
		

		<?php if ($_SESSION['job']=="Student") echo '<div class="inp">
			<label for="supervisor">Επιβλέπων Καθηγητής</label>
			<input type="text" name="supervisor" value=""/></div>
			<div class="inp">
			<label for="title">Τίτλος Πτυχιακής</label>
			<input type="text" name="title" value=""/>
		</div>'; ?>
			<button class="button-btn" type="submit" name="submit">Εγγραφή</button>
			<button class='button-btn' id='btn2' type='submit' name="login2" style='margin-top:5px' formaction="index.php?action=login">Έχω λογαριασμό</button>
		</div>
			</form>

</div>

