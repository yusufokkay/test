<?php
if(isset($_GET["id"])){
    $id=$_GET["id"];

$veritabaniserveradi="localhost";
$kullaniciadi="root";
$sifre="";
$veritabaniadi="crud";

$baglanti=mysqli_connect($veritabaniserveradi,$kullaniciadi,$sifre,$veritabaniadi);

$sql="DELETE FROM crud WHERE id=$id";
$baglanti->query($sql);

header("Location:index.php");
exit;
}
?>