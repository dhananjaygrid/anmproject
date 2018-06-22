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
$db->close();
}

?>
