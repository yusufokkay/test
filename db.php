<?php
$veritabaniserveradi="localhost";
$kullaniciadi="root";
$sifre="";
$veritabaniadi="crud";

$baglanti=mysqli_connect($veritabaniserveradi,$kullaniciadi,$sifre,$veritabaniadi);


if(!$baglanti){
    die("Veritabanı bağlanmadı". mysqli_connect_error());

}
echo "Bağlantı başarılı";
$sql="SELECT * FROM crud";  
$result=$connection->query($sql);
if(!$result){
    die("Geçersiz sorgu". $connection_error);
}
while($row=$result->fetch_assoc()){
    echo "
    <tr>
    <td>$row[İd]</td>
    <td>$row[ad]</td>
    <td>$row[soyad]</td>
    <td>$row[email]</td>
    <td>$row[cinsiyet]</td>
    <td>
    <a href="create.php"><button type="submit" class="btn btn-primary">Düzenle</button></a>
    <a href="edit.php"><button type="submit" class="btn btn-danger">Sil</button></a>
    </td>
    </tr>
    "
}
?>