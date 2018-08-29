<?php
require_once('config.php');

$count = $db->query('SELECT count(*) FROM List');
while($heavy = $count->fetchArray(SQLITE3_ASSOC)) {
   
    if ($heavy['count(*)'] == 0) {
        echo "No Macs to show!";
     }

else{
$devstats = $db->query('SELECT * FROM List');

while ($row = $devstats->fetchArray()) {
    echo $row[1]. "|" .$row[2]. "|" .$row[3]. "|" .$row[4]. "\n";  
}
}
}
?>

