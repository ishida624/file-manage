<?php
chdir($_GET["index"]);
//$fileresorce = opendir(realpath("."));
$filedir = realpath(".");

header("Location:file.php?realpath=$filedir");
 ?>
