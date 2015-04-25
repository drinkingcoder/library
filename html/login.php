<?
	global $manager,$row;
	require("background.php");
	if(($connection = mysql_connect("localhost","drinkingcoder","drinking123"))==FALSE)
		die("could not connect the mysql");
	if(mysql_select_db("library",$connection)==FALSE)
		die("could not use database library");
	?></br></br><?
	if(isset($_POST["Login"])==TRUE)
	{
		if(isset($_POST["user"])&&isset($_POST["password"]))
		{
			$sql = sprintf("select * from manager where name='%s'",mysql_real_escape_string($_POST["user"]));
			if(($result=mysql_query($sql))==FALSE)
				die("could not query");
			if(mysql_num_rows($result)==1)
			{
				if(($row=mysql_fetch_row($result))==False) die("Can not Fetch Row");
				$manager=$row[1];
				if(isset($row[2])) $password=$row[2];
				else die("No Password Input!");
				if($password!=$_POST["password"])
				{
					?>
						<script> alert('Password Wrong!'); </script>
					<?
					die("");
				}
			} else
			{
				?>
				<script> alert('No this User!'); </script>
				<?
				die("");
			}
		}
	}
	if(isset($_GET["manager"])) $manager=$_GET["manager"];
?>
<div align="center">
</br></br>
</br></br>
</br></br>
<h1>
Hello, <? echo $manager; ?>
</h1>
</br></br>
<form action="index.php" method="get">
<input type="hidden" name="manager" value="<?echo $manager;?>"/>
<input type="submit" name="Return Login" value="Return to Login"/>
</form>
<form action="manage.php" method="get">
<input type="hidden" name="manager" value="<?echo $manager;?>"/>
<input type="submit" name="Return Login" value="Manage Books"/>
</form>
<form action="card.php" method="get">
<input type="hidden" name="manager" value="<?echo $manager;?>"/>
<input type="submit" name="Return Login" value="Manage Cards"/>
</form>
<form action="operate.php" method="get">
<input type="hidden" name="manager" value="<?echo $manager;?>"/>
<input type="submit" name="Return Login" value="Borrow or Return Books"/>
</form>
</div>
