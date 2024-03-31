<?php
$name = "";
$lastname = "";
$email = "";
$gender = "";

$veritabaniserveradi="localhost";
$kullaniciadi="root";
$sifre="";
$veritabaniadi="crud";

$baglanti=mysqli_connect($veritabaniserveradi,$kullaniciadi,$sifre,$veritabaniadi);
if(!$baglanti){
    die("Veritabanı bağlanmadı". mysqli_connect_error());

}
$errormessage = ""; 
$successmessage = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["ad"];
    $lastname = $_POST["soyad"];
    $email = $_POST["email"];
    $gender = $_POST["cinsiyet"];
    do {
        if (empty($name) || empty($lastname) || empty($email) || empty($gender)) {
            $errormessage = "Bu alanları doldurmak zorunludur";
            break;
        }

$sql="INSERT INTO crud(ad,soyad,email,cinsiyet)" . "VALUES('$name','$lastname','$email','$gender')";  
$result=$baglanti->query($sql);
if(!$result){
    die("Geçersiz sorgu". $baglanti->error);
}
        $name = "";
        $lastname = "";
        $email = "";
        $gender = "";

        $successmessage = "Yeni kişi eklendi";
        // header("Location:index.php");
        // exit;
    } while (false);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <title>Oluştur</title>
    <?php
    if (!empty($errormessage)) {    
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>  
        <strong>$errormessage</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
    }
    ?>
</head>
<body>
   <div class="container">
        <h2 style="text-align: center;">Yeni Kişi Ekle</h2>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Ad:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="ad" value="<?php echo $name?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Soyad:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="soyad"  value="<?php echo $lastname?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email:</label>
                <div class="col-sm-6">
                    <input type="email" class="form-control" name="email"  value="<?php echo $email?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Cinsiyet:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="cinsiyet"  value="<?php echo $gender?>">
                </div>
            </div>
            <?php
            if (!empty($successmessage)) {
                echo "
        <div class='alert alert-success alert-dismissible fade show' role='alert'>  
        <strong>$successmessage</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                  <button type="submit" class="btn btn-primary">Gönder</button>
                </div>
                <div class="col-sm-3 d-grid">
              <a href="index.php" class="btn btn-outline-primary" role="button">İptal</a>
                </div>
        </form>
   </div> 
</body>
</html>
