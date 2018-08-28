<?php
require_once('config.php');

$count = $db->query('SELECT count(*) FROM Status');
while($heavy = $count->fetchArray(SQLITE3_ASSOC)) {
   
    if ($heavy['count(*)'] == 0) {
        echo "No devs to probe yet!";
     }

else{
$devstats = $db->query('SELECT * FROM Status');

while ($row = $devstats->fetchArray()) {
    echo $row[1]. "|" .$row[2]. "|" .$row[3]. "|" .$row[4]. "|" .$row[5]. "|" .$row[6]. "|" .$row[7]. "\n";  
}
}
}
?>
