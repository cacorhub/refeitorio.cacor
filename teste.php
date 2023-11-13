
<?php

$port = fopen('COM1', 'r+b');
sleep(1);
echo fgets($port);
fclose($port);

?>
