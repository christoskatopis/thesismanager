<?php  
/***********************ΤΗESIS***********************/
if (isset($_POST["update"])){
  $id=$_POST['id'];
  $fromperson=$_SESSION['code'];
  $toperson=$_POST["student"];
  $date=date('Y-m-d H:i:s');
  $comment=$_POST["comment"];
  $title=$_POST["title"];
  $progress=$_POST["progress"];
  $updatethesis="UPDATE thesis SET title='$title', comment='$comment', progress='$progress' WHERE id='$id'";
  mysql_query($updatethesis);
  $requesthesis="INSERT INTO requests (type,fromperson,toperson,date_created) VALUES ('ptyxiaki enimerwthike','$fromperson','$toperson','$date')";
  mysql_query($requesthesis);
}

if(isset($_POST["delete"])){
  $id=$_POST["id"];
  $code=$_POST["student"];
  $thesisdelete="DELETE FROM thesis WHERE id='$id'";
  $cleansupervisor="UPDATE users SET supervisor='' WHERE code='$code'";
  mysql_query($thesisdelete);
  mysql_query($cleansupervisor);

}

if(isset($_POST["insert"])){
  $code=$_POST["code"];
  $username=$_POST["username"];
  $password=md5($_POST["password"]);
  $fullname=$_POST["fullname"];
  $email=$_POST["email"];
  $date=date('Y-m-d H:i:s');
  $title=$_POST["title"];
  $supervisor=$_SESSION["code"];
  $createstudent="INSERT INTO users (code,username,password,fullname,email,access,requested,supervisor,date_registered) VALUES ('$code','$username','$password','$fullname','$email',0,1,'$supervisor','$date')";
  $createthesis="INSERT INTO thesis (title,progress,student,teacher) VALUES ('$title','0%','$code','$supervisor')";
  mysql_query($createstudent);
  mysql_query($createthesis);
}

if(isset($_POST["upload"])){
  $id=$_POST["id"];
  $fileName = $_FILES['userfile']['name'];
 $tmpName  = $_FILES['userfile']['tmp_name'];
 $fileSize = $_FILES['userfile']['size'];
 $fileType = $_FILES['userfile']['type'];
 $fp      = fopen($tmpName, 'r');
 $content = fread($fp, filesize($tmpName));
 $content = addslashes($content);

fclose($fp);

if(!get_magic_quotes_gpc())

{
$fileName = addslashes($fileName);
}
$thesisupload="UPDATE thesis SET name='$fileName',size='$fileSize',type='$fileType',content='$content' WHERE id='$id'";
mysql_query($thesisupload);
  $fromperson=$_SESSION['code'];
  $toperson='T0001';
  $date=date('Y-m-d H:i:s');
$updaterequest="INSERT INTO requests (type,fromperson,toperson,date) VALUES ('ptyxiaki enimerwthike','$fromperson','$toperson','$date')";
mysql_query($updaterequest); 
echo "<div id='confirmation'>Tο αρχείο σας στάλθηκε με επιτυχία</div>";

}


if(isset($_POST["download"])){
  $id=$_POST['id'];
  $thesisdownload="SELECT name,type,size,content FROM thesis WHERE id='$id'";
  $thesisfile=mysql_query($thesisdownload);
  list($name, $type, $size, $content) = mysql_fetch_array($thesisfile);
  header("Content-length: $size");
  header("Content-type: $type");
  header("Content-Disposition: attachment; filename=$name");
  echo $content; exit;
}

if ($_SESSION["access"]==1)
 $querythes="SELECT * FROM thesis WHERE teacher='".$_SESSION["code"]."'";
else
 $querythes="SELECT * FROM thesis WHERE student='".$_SESSION["code"]."'";

$resultsthes=mysql_query($querythes);
?>
<div class="main">
<?php
$itemthesis='<div class="thesis"><div class="thesis-heading">Πτυχιακές</div><table><tr><th style="padding-left:0">#</th><th>Όνομα Φοιτητή</th><th style="padding-left:50px">Tίτλος Πτυχιακής</th><th style="padding-left:80px">Αρχείο</th><th style="padding-left:300px">Σχόλια</th><th style="padding-left:95px">Πρόοδος</th></tr></table>';
if ($_SESSION["access"]==1){
if ($resultsthes){
	while ($obj=mysql_fetch_object($resultsthes)) {
		 
		 	$selectname="SELECT fullname FROM users WHERE code='$obj->student'";
		 	$resultname=mysql_query($selectname);
		  $student=mysql_fetch_array($resultname);
		$itemthesis .= <<<EOT
<form method="post" action="index.php?action=home" style="margin-top:10px">
    <tr>
    <input type="text" value="$obj->id" name="id" class="inputnone1"></input>
    <input type="hidden" value="$obj->student" name="student"></input>
    <input type="text" value={$student['fullname']} class="inputnone"></input>
    <input type="text" value="$obj->title" name="title" class="inputyes"></input>
    <input type="text" value="$obj->name" name="name" class="inputyes"></input>
    <button type="submit" name="download" name="download" class="button-download">Λήψη Αρχείου</button>
    <input type="text" value="$obj->comment" name="comment" class="inputyes"></input>
    <select value="$obj->progress" name="progress"><option><p>$obj->progress</p></option><option><p>0%</p></option><option><p>10%</p></option>
                               <option><p>20%</p></option>
                               <option><p>30%</p></option>
                               <option><p>40%</p></option>
                               <option><p>50%</p></option>
                               <option><p>60%</p></option>
                               <option><p>70%</p></option>
                               <option><p>80%</p></option>
                               <option><p>90%</p></option>
                               <option><p>100%</p></option></input>
   </tr>
   <input type="submit" value="Ένημέρωση" name="update" class="button-yes"></input>
   <input type="submit" value="Διαγραφή" name="delete" class="button-no"></input>
   </form>
EOT;
}}
  $itemthesis.='<h2 style="margin-top:10px">Δημουργία νέου φοιτητή</h2><form method="POST" action="index.php?action=home" style="margin-top:3px;margin-bottom:10px;border:none"><input type="text" class="inputyes" name="code" placeholder="Αριθμός Μητρώου"></input><input type="text" class="inputyes" name="fullname" placeholder="Ονοματεπώνυμο"></input><input type="text" class="inputyes" name="email" placeholder="e-mail"></input><input type="text" class="inputyes" name="username" placeholder="Όνομα Χρήστη"></input><input type="text" class="inputyes" name="password" placeholder="Κωδικός"></input><input type="text"  name="title" placeholder="Τίτλος Πτυχιακής" class="inputyes"></input><button name="insert" class="button-send">Εισαγωγή</button></form></input>';
}
else
 {if($resultsthes){
  while($obj=mysql_fetch_object($resultsthes)){
      $selectname="SELECT fullname FROM users WHERE code='$obj->student'";
      $resultname=mysql_query($selectname);
      $student=mysql_fetch_array($resultname);
      $itemthesis.=<<<EOT
<form method="post" action="index.php?action=home" style="margin-top:10px" enctype="multipart/form-data">
<input type="text" value="$obj->id" name="id" class="inputnone1"></input>
<input type="text" value={$student['fullname']} class="inputnone"></input>
<input type="text" value="$obj->title" name="title" class="inputyes"></input>
<input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
<input id="userfile" type="file" name="userfile"/>
    <button type="submit" name="upload" class="button-download">Αποστολή Αρχείου</button>
    <input type="text" value="$obj->comment" name="comment" class="inputnone" style="margin-left:15px"></input>
    <input type="text" value="$obj->progress" name="progress" class="inputnone" style="margin-left:35px"></input>
    <button name="update" class="button-yes">Ενημέρωση</button></form>
EOT;
  }
 }}
$itemthesis.='</div>';
echo $itemthesis; 



/************************************************************************************************************/
 

/******************************CHAT*************************************************************************/
if (isset($_POST["reply"])) {
  $subject=$_POST["subject"];
  $content=$_POST["content"];
  $sender=$_SESSION["code"];
  $message_date=date('Y-m-d H:i:s');
  if ($_SESSION["access"]==1){
  $receiver=$_POST["receiver"];
  $nametocode="SELECT * FROM users WHERE fullname='$receiver'";
  $resultnametocode=mysql_query($nametocode);
  $user=mysql_fetch_array($resultnametocode);
  $receivercode=$user['code'];}
  else 
    {$receivercode=$_SESSION["supervisor"];}
  $querymessage="INSERT INTO messages (subject,content,sender,receiver,message_date,seen)  VALUES ('$subject','$content','$sender','$receivercode','$message_date',0)";
  mysql_query($querymessage);
  $requestmessage="INSERT INTO requests (type,fromperson,toperson,date_created) VALUES ('minima','$sender','$receivercode','$message_date')";
  mysql_query($requestmessage);
}


$querychat="SELECT * FROM messages WHERE sender='".$_SESSION["code"]."' OR receiver='".$_SESSION["code"]."' ORDER BY message_date ASC LIMIT 5";
$resultchat=mysql_query($querychat); ?>
<div class="main-wrapper-left">
<div id="gap"></div>
<?php 
$itemchat='<div class="chat"><div class="chat-heading">Μηνύματα</div><table>'; 

if($resultchat){
 while ($obj=mysql_fetch_object($resultchat)){
 	  $querysend="SELECT * FROM users WHERE code='$obj->sender'";
 	  $resultsend=mysql_query($querysend);
 	  $send=mysql_fetch_object($resultsend);
    if ($obj->sender==$_SESSION["code"]){
      $fullname="Εγώ";
    }
    else 
      $fullname=$send->fullname;
    if($obj->seen==1){
      $seen="Διαβάστηκε";
    }
    else 
      $seen="";
	 $itemchat .=<<<EOT
<form method="POST" action="index.php?action=home" style="margin-top:10px"><div class="chat-background">
      <tr style="background-color:#ddd"><td><strong>Aποστολέας:</strong>$fullname</td><td background-color:#ddd><strong>Θέμα:</strong>$obj->subject</td> <td><strong>H/Ω:</strong>$obj->message_date</td></tr></div><tr><td>$obj->content</td><td class="seen">$seen</td> </tr>

EOT;
}}
if ($_SESSION["access"]==1) {
$itemchat.='<th><strong>Νέο Μήνυμα<strong></th><tr><td><input type="text" name="subject" placeholder="Θέμα" class="inputyes"></td></tr><tr><td><input type="text" name="receiver" placeholder="Παραλήπτης" class="inputyes"></td></tr><tr><td><input type="text" name="content" placeholder="Μήνυμα" class="inputyes"></td><td><button name="reply" class="button-send">Αποστολή</button></td></tr></form></table></div>';}
else 
  {$itemchat.='<th><strong>Νέο Μήνυμα<strong></th><tr><td><input type="text" name="subject" placeholder="Θέμα" class="inputyes"></td></tr><tr><td><input type="text" name="content" placeholder="Μήνυμα" class="inputyes"></td><td><button name="reply" class="button-send">Αποστολή</button></td></tr></form></table></div>';}
echo $itemchat;
?> 
</div>

<!--requests-->
<?php

if (isset($_POST["deleterequest"])){
   $fromperson=$_POST["fromperson"];
   $type=$_POST["type"];
   $toperson=$_POST["toperson"];
   $date=$_POST["date_created"];
   if ($type=="aitisi ptyxiakis"){
     mysql_query("UPDATE users SET requested=1 WHERE code='$fromperson'");
     $resultstudent=mysql_query("SELECT * FROM users WHERE code='$fromperson'");
     $poststudent=mysql_fetch_array($resultstudent);
     $title=$poststudent["thesistitle"];
     mysql_query("INSERT INTO thesis (title,comment,progress,student,teacher) VALUES('$title','','0%','$fromperson','".$_SESSION["code"]."')");
  }
  elseif ($type=="minima"){
    mysql_query("UPDATE messages SET seen=1  WHERE sender='$fromperson' AND receiver='$toperson'");
  }
  else {
  }
  $delrequest="DELETE FROM requests WHERE id='".$_POST['id']."'";
  mysql_query($delrequest) or die(mysql_error());
}

$queryrequest="SELECT * FROM requests WHERE toperson='".$_SESSION["code"]."' ORDER BY date_created DESC";
$resultrequest=mysql_query($queryrequest);

if ($resultrequest){
  if (mysql_num_rows($resultrequest)>0){
  $itemrequest='<div class="requests"><div class="requests-heading">Ειδοποιήσεις</div><table>';}
while($req=mysql_fetch_object($resultrequest)){
    $codetoname="SELECT fullname FROM users WHERE code='$req->fromperson'";
    $resultname=mysql_query($codetoname);
    $user=mysql_fetch_object($resultname);
 $itemrequest.=<<<EOT
<form method="POST" action="index.php?action=home">
<tr><input type="hidden" name="id" value="$req->id"></input><input type="hidden" name="type" value="$req->type"></input><input type="hidden" name="fromperson" value="$req->fromperson"></input><input type="hidden" name="toperson" value="$req->toperson"></input><input type="hidden" name="date_created" value=$req->date_created"></input><td>1</td><td>$req->type</td><td>από $user->fullname</td><td>στις $req->date_created</td><td><button name="deleterequest" class="okbutton"><img src="images/ok.png"></img>OK!</button></td></tr></form>
EOT;
}
$itemrequest.="</table></div>";
} 
echo $itemrequest; 
 ?>
</div>