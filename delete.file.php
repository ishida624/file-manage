<?php
unlink("$_GET[file]");
//echo $_GET['file'];
header("Location:file.php?realpath=".$_GET['realpath']."");

 ?>
