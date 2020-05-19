<?php

$finfo = finfo_open(FILEINFO_MIME_TYPE);                            #讀取檔案類型
$mimetype = finfo_file($finfo, $_GET['file']);                          #$_GET['file']為檔案路徑及檔名
finfo_close($finfo);                                                                              #關閉finfo
//echo $mimetype;
if (preg_match("/image\//",$mimetype)) {                                #若檔案類型為圖片，用fread讀取後印出
  header('content-type: image/jpeg');
  $filename = fopen($_GET['file'],"rb");
  $contents = fread($filename,filesize($_GET['file']));
  echo $contents;
  fclose($filename);
}


if (preg_match("/text\//",$mimetype)) {                                         #若檔案為文字檔，用fgets讀取印出
  echo "<a href='file.php?realpath=".$_GET['realpath']."'>回主畫面</a><br><br>";      #印出回上一頁的超連結
  $filename = fopen($_GET['file'],"r");
  while ($line = fgets($filename)) {                                                    #fgets為一行一行讀取的型式，已while回圈印出並且每行印出後換行
    echo $line."<br>";
  }
  fclose($filename);
}

 ?>
