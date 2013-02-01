<?
	$num = $_GET["maxShows"];
	$callback = $_GET["callback"];
	if($num<100) $num = 100;
	$dbuser="insigmvn_tvapp";
	$dbpass="tvapp123";
	$dbname="insigmvn_tvapp";  //the name of the database
	$chandle = mysql_connect("localhost", $dbuser, $dbpass) 
			or die("Connection Failure to Database");
	mysql_select_db($dbname, $chandle) or die ($dbname . " Database not found. " . $dbuser);
	$emailid = mysql_real_escape_string($emailid);
	$password = mysql_real_escape_string($password);

	$mainsection="tvschedule"; //The name of the table
	$password=md5($password);
	//$query1="select * from tvschedule ";  //select the home section
	$query1="select id,x.sid,sname,network,title,episode,link,day,time,genre from tvschedule x,tvgenre y where x.sid=y.sid";
	$result = mysql_db_query($dbname, $query1) or die("Failed Query of " . $query1);  //do the query
	$rows = array();
	$i=0;
	while($thisrow=mysql_fetch_assoc($result))
	{
		$rows[] = $thisrow;		
		$i++;
		if($i==$num) break;
		
	}
	$json = json_encode($rows);
	if(strlen($callback) <2)  echo $json;
	else echo callback+"("+$json+")";

?>