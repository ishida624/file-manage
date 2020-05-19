
<html>
<head>
  <meta http-http-equiv="Connect-type" content="text/html" ; charset="utf-8" />
<title>檔案總管</title>
</head>
<body>

  <form action="" method="get" >
    <input type = "text" name="item" placeholder="資料夾名稱">
    <br>
    <input type="hidden" name="action" value="add">
    <input type="hidden" name="realpath" value="<?php echo $_GET['realpath'];?>">
    <input type="submit" value="建立" name="add_index">
    <input type="submit" value="刪除" name="delete_index">
    <input type="submit" value="回上層" name="back_index">
    <input type="reset">
  </form>

  <form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="fileupload" >
    <input type="submit" value="送出">
  </form>

</body>
</html>

<?php

if (isset($_GET['realpath'])) {
  $filedir = $_GET['realpath'];
  chdir("$filedir");
}
else {
  $filedir = "/var/www/apache";                                 #初始頁面在/var/www/apache
  chdir("$filedir");
}




#按鈕判斷
if (isset($_GET["action"])=="add")
{
  if(isset($_GET["add_index"])   )
  {
      $index_name = $_GET['item'];
      $realpath = $_GET['realpath'];

     header("Location:create-index.php?realpath="."$realpath"."&&index_name="."$index_name");
}
if(isset($_GET["delete_index"]))
{
    rmdir($_GET["item"]);
}

if(isset($_GET["back_index"]))
{
   chdir("../");
   $realpath = realpath(".");
   header("Location:file.php?realpath=".$realpath);
}

}



echo "現在路徑為 ：".realpath(".")."<br><br>";

#顯示資料夾及檔案
$filedir = "*";
$fileresorce = glob($filedir);
echo "資料夾：<br>";
echo "<table border = '1' width= '400'>";

foreach ($fileresorce as $key => $index) {
  if (is_dir($index)) {
  echo "<tr><td>".$index."</td>";
  echo "<td>"."<a href = 'open.index.php?index=".realpath(".")."/".$index."'>進入</a>"."</td></tr>";
  }
}
echo "</table>";


echo "<br>檔案：<br>";
echo "<table border = '1' width= '50%'>";
echo "<tr><td>檔案名稱</td>";
echo "<td>檔案大小</td>";
echo "<td>功能</td>";
echo "<td> 功能2</td></tr>";

foreach ($fileresorce as $key => $filename) {
  if (is_file($filename)) {
  echo"<tr><td>".$filename."</td>";
  echo "<td>".filesize($filename)." byte</td>";
  echo "<td>"."<a href = 'delete.file.php?file=".realpath(".")."/".$filename."&&realpath=".realpath(".")."'>刪除</a>"."</td>";
  echo "<td>"."<a href = 'read-file.php?file=".realpath(".")."/".$filename."&&realpath=".realpath(".")."'>讀取</a>"."</td></tr>";
  }
}
echo "</table>";



#上傳檔案
if(isset ($_FILES["fileupload"]))                                                                                                                     #判斷是否送出上傳的html表單
{
if ($_FILES["fileupload"]["error"]==0  ) {                                                                                                  #判斷檔案是否上傳成功
  if (move_uploaded_file($_FILES["fileupload"]["tmp_name"],"./".$_FILES["fileupload"]["name"])) {         #上傳後從暫存區移動到資料夾內 成功的話回傳True ，if成立
    echo "上傳成功";
    if (isset($_GET['realpath'])) {                                                                                                 #判斷GET當下路徑，刷新當下頁面，else刷新主頁面
      header("Location:file.php?realpath=".$_GET['realpath']."");
    }
    else {
      header("Location:file.php");
    }
  }
  else {
    echo "上傳失敗";
  }
}
}

?>
