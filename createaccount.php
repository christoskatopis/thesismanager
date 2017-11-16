<?php $_SESSION['created']=1;?>

<div id="npost-area">
<form action="index.php?action=register" method="POST" id="np-form">
<h2>Παρακαλώ επιλέξτε την ιδιότητά σας:</h2>
<div class="inp">
	<select name="job" class="select" required>
                               <option value="Teacher" name="teacher"><p>Καθηγητής</p></option>
                               <option value="Student" name="student"><p>Φοιτητής</p></option></select>
                               </div>
 <button class="button-btn" type="submit">Συνέχεια</button>
</form>
</div>
