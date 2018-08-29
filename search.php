<?php

require_once('config.php');

if (empty($_GET)){
  echo "FALSE";
  }
else {
  $search = htmlspecialchars($_GET["mac"]);
  
  
  $sql = <<<EOF
              SELECT * FROM List WHERE LIKE ('$search',MACS) = 1;
EOF;

  $output = $db->query($sql);
  $data = array(); 
  while($row = $output->fetchArray() ){
         
         #echo $row[1]. "|" . $row[2] . "|" . $row[3] . "|" . $row[4] . "\n";
         $data[] = $row[1]. "|" . $row[2] . "|" . $row[3] . "|" . $row[4];
     
   }

$result = array_unique($data);
$length = count($result);
for($i = 0; $i < $length; $i++){
    echo $result[$i]. "\n";
}
}
$db->close();
?>
