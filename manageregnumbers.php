<h3><span style='border-bottom:solid 1px #ddd'>ΜΗΤΡΩΑ ΓΡΑΜΜΑΤΕΙΑΣ</span></h3>
<?php 

if(isset($_POST["delete"])){
$querydelete="DELETE FROM regnumbers WHERE id='".$_POST["id"]."'";
mysql_query($querydelete);
}

if (isset($_POST["update"])){
if ($_POST["identity"]=="Καθηγητής")
	$access=1;
else 
	$access=0;
$queryupdate="UPDATE regnumbers SET code='".$_POST["code"]."',access='$access' WHERE id='".$_POST["id"]."'";
mysql_query($queryupdate);
}

if (isset($_POST["insert"])){
	if ($_POST["identity"]=="Καθηγητής")
	$access=1;
else 
	$access=0;
$queryinsert="INSERT INTO regnumbers (code,access) VALUES ('".$_POST["code"]."','$access')";
mysql_query($queryinsert);
}
$query="SELECT * from regnumbers";
$results=mysql_query($query);
if ($results){
$item="<h2><span style='border-bottom:solid 1px #ddd'>#<span style='padding-left:100px'>Α.Μ.</span><span style='padding-left:160px'>Ιδιότητα</span></span></h2>";
	while($obj=mysql_fetch_object($results)){
	if ($obj->access==1)
		$identity="Καθηγητής";
    else 
    	$identity="Φοιτητής";

    $item.=<<<EOT
<form method="POST" action="index.php?action=manageregnumbers" style="margin-top:20px">
<input type="text" value="$obj->id" name="id" class="inputnone1"></input>
<input type="text" value="$obj->code" name="code" class="inputyes"></input>
<input type="text" value="$identity" name="identity" class="inputyes"></input>
<input type="submit" value="Ένημέρωση" name="update" class="button-yes"></input>
<input type="submit" value="Διαγραφή" name="delete" class="button-no"></input>
</form>
EOT;
	}
}
$item.='<h2 style="margin-top:10px">Εισαγωγή νέου μητρώου<form method="POST" action="index.php?action=manageregnumbers" style="margin-top:10px">
<input type="text" name="code"class="inputyes" placeholder="Αριθμός Μητρώωου"></input><input type="text" name="identity" class="inputyes" placeholder="Ιδιότητα"></input><input type="submit" value="Εισαγωγή" name="insert" class="button-send"></input></form>';
echo $item; ?>