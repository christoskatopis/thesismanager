<?php include('settings.php'); 
 include('header.php');  	
?> 


	<div id="page-area">

<?php    
			global $action;
			
			switch ($action) {
				case "":
					include('mainpage.php');
					break;
				case "register":
					include('register.php');
					break;
				case "login":
					include('login.php');
					break;
			    case "home":
			       include('home.php');
			       break;
				case "manageregnumbers":
				    include('manageregnumbers.php');
				    break;
				 case "manageteachers":
				   include('manageteachers.php');
				   break;
				 case "managestudents":
				  include('managestudents.php');
				  break;
				 case "createaccount":
				 include('createaccount.php');
				 break;
				 case "calendar":
				 include('calendar.php');
				 break;
			}
			
		
		
		?>
</div>

 <div class="footer">
   	  <div class="wrapper">	
			<div class="copy_right">
				<p>Copyright © 2016        |       Designed by Chris Katopis John Kyriazis Nikos Soulantikas</p>
				  <hr class="intro-divider">
		   </div>
     </div>
    </div>	

 </body>
</html>