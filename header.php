
<div id="header">
	<div id="logo">
		<strong>Thesis</strong>Manager
	</div>
	<div class="logo-message">A website to help you watch and manage the progress of your master thesis</div>
	<hr class="intro-divider"></div></div>
	<div id="navbar">
		<ul>
			<li><img src='images/paper.png' style='background-color:transparent;border:none;padding-top:13px'></img></li><li><a href="index.php">Αρχική</a></li>
			
			
			<?php
				if (!isset($_SESSION["islogged"]))
					echo "
		
				         <li><img src='images/login.png' style='background-color:transparent;border:none;padding-top:13px' ></img></li>
						<li><a href='index.php?action=login'>Είσοδος Χρήστη</a></li>
						<li><img src='images/register.png' style='background-color:transparent;border:none;padding-top:13px' ></img></li>
						<li><a href='index.php?action=createaccount'>Εγγραφή Χρήστη</a></li>
						
					";
				else {
					if ($_SESSION["access"]<=1){
					echo "
					    <li><img src='images/home.png' style='background-color:transparent;border:none;padding-top:13px' ></img></li>
						<li><a href='index.php?action=home'>Κεντρική</a></li>
						<li><img src='images/logout.png' style='background-color:transparent;border:none;padding-top:14px' ></img></li>
						<li><a href='logout.php'>Αποσύνδεση</a></li>	
						
					";}
                    else 
                	  {  echo"<li><img src='images/teacher.png' style='background-color:transparent;border:none;padding-top:13px' ></img></li>";
                	  	 echo "<li><a href='index.php?action=manageteachers'>Καθηγητές</a></li>";
                	  	 echo"<li><img src='images/student.png' style='background-color:transparent;border:none;padding-top:13px' ></img></li>";
                         echo "<li><a href='index.php?action=managestudents'>Φοιτητές</a></li>";
                         echo"<li><img src='images/book.png' style='background-color:transparent;border:none;padding-top:13px' ></img></li>";
                         echo "<li><a href='index.php?action=manageregnumbers'>Μητρώα Γραμματείας</a></li>";
                         echo"<li><img src='images/logout.png' style='background-color:transparent;border:none;padding-top:14px' ></img></li>
						<li><a href='logout.php'>Αποσύνδεση</a></li>";
                    }

                }


			?>
		</ul>
	</div>
	<?php /*if (!isset($_SESSION["islogged"])) echo "<div class='main-buttons'><button type='input' class='button-main'>Log In</button><button type='input' class='button-main'>Sign In</button></div>"*/?>
</div>