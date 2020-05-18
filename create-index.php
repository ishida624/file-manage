<?php
mkdir($_GET['realpath']."/".$_GET['index_name'],0777);
//echo $_GET['realpath'];
$realpath = $_GET['realpath'];
header("Location:file.php?realpath="."$realpath");
 ?>
