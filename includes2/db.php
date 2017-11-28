<?php
	
	define('DBNAME', 'store'); /*THIS IS A CONSTANT AND THIS IS HOW TO DEFINE IT*/
	define('DBUSER', 'root');/*THIS IS DONE TO PROTECT OUR CONNECTION STRING FROM ATTACKERS*/
	define('DBPASS', 'osinachi');

	try{ /*this is to try to catch an error*/

	$conn = new PDO('mysql:host=localhost;dbname='.DBNAME, DBUSER, DBPASS);

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

	} catch(PDOException $err){ /*this catch catches error thrown*/ /*Exceptions in programming means errors*/
		echo $err->getMessage(); /*getMessage is a property of PDOException*/
	}

?>