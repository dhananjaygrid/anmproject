<?php

require_once('config.php');

if (empty($_GET)){
  echo "FALSE";
  }
else {
  $search = htmlspecialchars($_GET["mac"]);
  $query = str_replace("|","", $search);
  
  $sql = <<<EOF
              SELECT * FROM List WHERE LIKE ('$query',MACS) = 1;
EOF;

  $output = $db->query($sql);
  while($row = $output->fetchArray() ){
         $data = array($row[1]. "|" . $row[2] . "|" . $row[3] . "|" . $row[4]);
     
   }
 
echo $data[0];
}
$db->close();
?>
