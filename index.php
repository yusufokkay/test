<?php
// Veritabanı bağlantısını sağlayın
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud";

$conn = new mysqli($servername, $username, $password, $dbname);

// Veritabanı bağlantısını kontrol edin
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}

// Verileri alın
$sql = "SELECT İd ,ad, soyad, email, cinsiyet FROM crud";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="p-3 mb-9 bg-success text-white">
            <h6 style="text-align: center;">CRUD</h6>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">İd</th>
                    <th scope="col">Ad</th>
                    <th scope="col">Soyad</th>
                    <th scope="col">Email</th>
                    <th scope="col">Cinsiyet</th>
                    <th scope="row">İşlem</th>    
                </tr>   
            </thead>
            <tbody>
                <?php
                // Verileri HTML tablosuna dönüştürün
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["İd"]."</td>";
                        echo "<td>" . $row["ad"]. "</td>";
                        echo "<td>" . $row["soyad"]. "</td>";
                        echo "<td>" . $row["email"]. "</td>";
                        echo "<td>" . $row["cinsiyet"]. "</td>";
                        echo "<td>";
                        echo "<a href='edit.php?id=".$row["İd"]."' target='_blank'     ><button  class='btn btn-primary'>Düzenle</button></a>";
                        echo "<a href='delete.php?id=".$row["İd"]."' ><button class='btn btn-danger'>Sil</button></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Veritabanında kayıtlı kullanıcı bulunamadı.";
                }
                ?>
            </tbody>
        </table>
        <a href="create.php"><button type="submit" class="btn btn-primary">Kullanıcı Ekle</button></a>
    </div> 
     
</body>
</html>

<?php
// Veritabanı bağlantısını kapatın
$conn->close();
?>
