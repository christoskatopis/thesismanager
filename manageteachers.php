<h3>KAΘΗΓΗΤΕΣ ΤΟΥ THESIS MANAGER</span></h3>
<?php 

if(isset($_POST["delete"])){
$querydelete="DELETE FROM users WHERE id='".$_POST["id"]."'";
mysql_query($querydelete);
}

if (isset($_POST["update"])){
 $code=$_POST["code"];
 $fullname=$_POST["fullname"];
 $username=$_POST["username"];
 $email=$_POST["email"];
 $queryupdate="UPDATE users SET code='$code',fullname='$fullname',username='$username',email='$email' WHERE id='".$_POST["id"]."'";
 mysql_query($queryupdate);
 echo $queryupdate;
}

if (isset($_POST["insert"])){
 $code=$_POST["code"];
 $fullname=$_POST["fullname"];
 $username=$_POST["username"];
 $password=md5($_POST["password"]);
 $date=date('Y-m-d H:i:s');
 $email=$_POST["email"];
 $queryinsert="INSERT INTO users (code,username,password,fullname,email,access,requested,supervisor,thesistitle,date_registered) VALUES ('$code','$username','$password','$fullname','$email',1,1,'','','$date')";
 mysql_query($queryinsert) or die(mysql_error());

}

$query="SELECT * from users WHERE access=1";
$results=mysql_query($query);
if ($results){
$item="<h2><span style='border-bottom:solid 1px #ddd'>Α.Μ.<span class='title-dtb'>Όνομα</span><span class='title-dtb'>e - mail</span><span class style='padding-left:100px'>Όνομα Χρήστη</span><span class style='padding-left:30px'>Ημερομηνία Εγγραφής</span></h2>";
	while($obj=mysql_fetch_object($results)){
    $item.=<<<EOT
<form method="POST" action="index.php?action=manageteachers" style="margin-top:20px">
<input type="hidden" value="$obj->id" name="id"></input>
<input type="text" value="$obj->code" name="code" class="inputyes"></input>
<input type="text" value="$obj->fullname" name="fullname" class="inputyes"></input>
<input type="text" value="$obj->email" name="email" class="inputyes"></input>
<input type="text" value="$obj->username" name="username" class="inputyes"></input>
<input type="text" value="$obj->date_registered" name="date_registered" class="inputyes"></input>
<input type="submit" value="Ένημέρωση" name="update" class="button-yes"></input>
<input type="submit" value="Διαγραφή" name="delete" class="button-no"></input>
</form>
EOT;
	}
}
$item.='<h2 style="margin-top:10px"><span style="border-bottom:solid 1px #ddd">Εισαγωγή νέου καθηγητή</span><form method="POST" action="index.php?action=manageteachers" style="margin-top:10px">
<input type="text"  name="code" class="inputyes" placeholder="Αριθμός Μητρώου"></input>
<input type="text" name="fullname" class="inputyes" placeholder="Ονοματεπώνυμο"></input>
<input type="text"  name="email" class="inputyes" placeholder="e-mail"></input>
<input type="text" name="username" class="inputyes" placeholder="Username"></input>
<input type="text" name="password" class="inputyes" placeholder="Password"></input>
<input type="submit" value="Εισαγωγή" name="insert" class="button-send"></input></form>';
echo $item; ?>