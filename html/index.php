<?
	global $manager;
	$manager="Unknown";
	if(isset($_GET["manager"])) 
		$manager=$_GET["manager"];
	require_once("background.php");
	require_once("../lib/header.php");
	session_start();
?>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
	<title> HomePage </title>
</head>
<body>
	<div align="center" >   
		</br></br>
		</br></br>
		</br></br>
		</br></br>
		<H1> Who Moved My Cheese! </H1>
		</br></br>
		<form action="login.php", method="post">
			<table border="0" width="%100" id="table1">
				<tr width="%100" id="tr1">
					<td> Mouse_Name: </td> <td> <input type="text", name="user"> </td>
				</tr>
				<tr>
					<td align="right"> Cheese: </td> <td> <input type="password" name="password"> </td>
				</tr>
				<tr> 
					<td> </td> <td> </td>
				 </tr>
				<tr>
					<td></td><td align="right"> <input type="submit", name="Login" value="Take!">  </td>
				</tr>
			</table>
			</br>
		</form>
	</div>
</body>
</html>
