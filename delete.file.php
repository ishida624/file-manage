<?php
unlink("$_GET[file]");
header("Location:file.php?realpath=".$_GET['realpath']."");

 ?>
