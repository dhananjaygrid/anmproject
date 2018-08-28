<?php

require_once('config.php');

if (empty($_GET)){
  echo "FALSE";
  }
else {
  $ip = htmlspecialchars($_GET["ip"]);
  $port = htmlspecialchars($_GET["port"]);
  $community = htmlspecialchars($_GET["community"]);
  $version = htmlspecialchars($_GET["version"]);
	
  $sql = <<<EOF
    CREATE TABLE IF NOT EXISTS Devices (ID INTEGER PRIMARY KEY AUTOINCREMENT, IP varchar(20), COMMUNITY varchar(10),PORT varchar(25), VERSION varchar(5));
EOF;
  $exe = $db->exec($sql);
  if (!$exe) {
    echo $db->LastErrorMsg();
    } 	
 $sql2 = <<<EOF
    CREATE TABLE IF NOT EXISTS Status (ID INTEGER PRIMARY KEY AUTOINCREMENT, IP varchar(20), PORT varchar(25), COMMUNITY varchar(10),VERSION varchar(5), FIRST_PROBE varchar(50), LATEST_PROBE varchar(50), Failed_attempts INTEGER);
EOF;
  $exe2 = $db->exec($sql2);
  if (!$exe2) {
    echo $db->LastErrorMsg();
    } 
	
  $sql1 = <<<EOF
    INSERT INTO Devices (IP,PORT,COMMUNITY,VERSION)
    VALUES ('$ip','$port','$community','$version');
EOF;
  $exe1 = $db->exec($sql1);
  if (!$exe1){
    echo $db->LastErrorMsg();
    } else {
        echo "OK";
          }
$sql3 = <<<EOF
    INSERT INTO Status (IP,PORT,COMMUNITY,VERSION)
    VALUES ('$ip','$port','$community','$version');
EOF;
  $exe3 = $db->exec($sql3);
  if (!$exe3){
    echo $db->LastErrorMsg();
    }
$db->close();
}

?>
