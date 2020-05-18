<?php
chdir(realpath(".")."/".$_GET["file"]);
//$fileresorce = opendir(realpath("."));
$filedir = realpath(".");

header("Location:file.php?realpath=$filedir");
 ?>
