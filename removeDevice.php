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
      DELETE from Devices WHERE IP = "$ip";
EOF;
   
   $ret = $db->exec($sql);
   if(!$ret){
     echo $db->lastErrorMsg();
   } else {
      echo "OK";
   }	
  
  $db->close();
}

?>
