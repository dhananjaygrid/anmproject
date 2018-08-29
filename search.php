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

$check = count($data);
if ($check ==0){

$count = $db->query('SELECT count(*) FROM Devices');
while($heavy = $count->fetchArray(SQLITE3_ASSOC)) {
   
        $number_devices = $heavy['count(*)'];
        echo "No Match in $number_devices Devices";
     }
}
$result = array_unique($data);
$length = count($result);
for($i = 0; $i < $length; $i++){
    echo $result[$i]. "\n";
}
}
$db->close();
?>
