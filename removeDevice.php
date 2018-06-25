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
  
  
  $sql =<<<EOF
      SELECT ID from Devices WHERE IP = "$ip";
EOF;
   
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
      $id = $row['ID'] ;
      	}
   if ($id == NULL){
	echo "FALSE";
      }
   else {
	$sql1 = <<<EOF
             DELETE FROM Devices WHERE ID = "$id";
EOF;
   $ret1 = $db->query($sql1);	
   if(!$ret1){
     echo $db->lastErrorMsg();
   } else {
      echo "OK";
   }	
  }
  $db->close();
}

?>
