<?php
// session_start();
// if(!isset($_SESSION['kanri'])):
//     exit('NotAccess');
// endif;
include('connect.php');
include("img_file_name.php");
if(isset($_POST['sub'])):
    $title= $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $img = img_file_name();
    $sql = "INSERT INTO books (title , author , price , stock , image)
            VALUES ('{$title}' , '{$author}' ,'{$price}' ,'{$stock}', '{$img}')";
    $rst = mysqli_query($com , $sql);    
endif; 

if(isset($_POST['addBook'])):
   $bookTitle = $_POST['titleBook'];
   $bookNum = $_POST['addNumber'];
   $sql = "SELECT * FROM books WHERE title ='{$bookTitle}'";
   $rst = mysqli_query( $com, $sql );
   if( $row = mysqli_fetch_assoc( $rst ) ){
    $stock = $row["stock"];
    $addStock = $stock + $bookNum;
    $sql = "UPDATE books SET stock='{$addStock}' WHERE title='{$bookTitle}'";
    $rst = mysqli_query( $com, $sql );
}
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
    <form action="" method ='post' accept-charset="UTF-8" enctype="multipart/form-data"> 
        <h2>新規書籍追加</h2>
        <p>書籍名<input type="text" name = 'title'></p>
        <p>作者名<input type="text" name = 'author'></p>
        <p>価格<input type="number" name = 'price'></p>
        <p>在庫数<input type="number" name = 'stock'></p>
        書籍画像(GIF/JPEG形式、100KB以下):<input type="file" name="uploadFile" size="40">
        <p><input type="submit" name ='sub'></p>
    </form>
    <form action="" method ='post'> 
        <h2>書籍追加</h2>
        <p>在庫補充する書籍のタイトル<input type="text" name = 'titleBook'></p>
        <p>追加する数<input type="number" name = 'addNumber' ></p>
        <p><input type="submit" name ='addBook'></p>
    </form>
</body>
</html>