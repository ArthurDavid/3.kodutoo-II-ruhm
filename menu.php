<h3>Menu</h3>
<?php echo $file_name; ?>
<ul>
	<?php if ($file_name == "data.php"){ ?>
		<li> Homepage </li>
	<?php } else { ?>
		<li> <a href="data.php">Homepage</a> </li>
	<?php } ?>
	
	<?php 
		if ($file_name == "login.php"){
			echo "<li> Login </li>";
		}else {
			echo '<li> <a href="login.php">Login</a> </li>';
		}
	?>
	<?php 
		if ($file_name == "edit.php"){
			echo "<li> Edit </li>";
		}else {
			echo '<li> <a href="edit.php">Edit</a> </li>';
		}
	?>	
</ul>