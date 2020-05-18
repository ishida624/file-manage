<?php
chdir("../");
$filedir = "*";
// $fileresorce = opendir($filedir);
// while ($filelist = readdir($fileresorce)) {
// //  if (is_dir($filedir."/".$filelist)) {
//   echo $filelist."<br>";
// }


$fileresorce = glob($filedir);

foreach ($fileresorce as $key => $value) {
  if (is_dir($value)) {
  echo basename($value)."<br>";
}
}
echo realpath(".");
 ?>
