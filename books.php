<?php
include('connect.php');

if(isset($_POST['sub'])):
    $res = $_POST['buy'];
    $man = 0;
    foreach($res as $resItems): 
        $sql = "SELECT * FROM books WHERE title ='{$resItems}'";
        $rst =  mysqli_query($com, $sql);
        if( $row = mysqli_fetch_assoc( $rst )){
            $man = $man + intval($row['price']);
        }
        $upSql = "UPDATE books SET stock = stock - 1 WHERE title='{$resItems}'";
        $rst = mysqli_query( $com, $upSql );
    endforeach;
    echo  '合計金額は' . $man. '円です';
endif;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method= 'post'>
     <?php 
     $sql = "SELECT * FROM `books` WHERE 1";
     $rst = mysqli_query($com, $sql);
     while( $row = mysqli_fetch_array( $rst )){
     ?>
     <p>書籍名：<?php print $row["title"]?></p>
     <p>作者名：<?php print $row["author"]?></p>
     <p>価格：<?php print $row["price"]?></p>
     <p>在庫数：<?php if($row['stock'] == 0):
                 print '在庫切れです';
                 else:
                 print $row["stock"];
                 endif;?></p>
     <p>画像：<img src='./upload/<?php print $row["image"]?>' alt=""></p>
     <p>購入<input type="checkbox" name = 'buy[]' value ='<?php print $row["title"] ;?>'></p>
     <?php };?> 
     <input type="submit" name = 'sub' value = '購入する'> 
    </form>
    <p><a href="kanri.php">新規書籍登録</a></p>
    <!-- <form action="">

    </form> -->
</body>
</html>