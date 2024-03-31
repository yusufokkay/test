<?php
$id = "";
$name = "";
$lastname = "";
$email = "";
$gender = "";

$errormessage = "";
$successmessage = "";

$veritabaniserveradi="localhost";
$kullaniciadi="root";
$sifre="";
$veritabaniadi="crud";

$baglanti=mysqli_connect($veritabaniserveradi,$kullaniciadi,$sifre,$veritabaniadi);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        // header("Location: index.php");
        // exit;
    }
    $id = $_GET["id"];
    $sql = "SELECT * FROM crud WHERE id=?";
    $stmt = $baglanti->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if (!$row) {
        // header("Location: index.php");
        // exit;
    }
    $name = $row["ad"];
    $lastname = $row["soyad"];
    $email = $row["email"];
    $gender = $row["cinsiyet"];
} else {
    $id = $_POST['İd'];
    $name = $_POST['ad'];
    $lastname = $_POST['soyad'];
    $email = $_POST['email'];
    $gender = $_POST['cinsiyet'];
    if (empty($id) || empty($name) || empty($lastname) || empty($email) || empty($gender)) {
        $errormessage = "Bu alanları doldurmak zorunludur";
    } else {
        $sql = "UPDATE crud SET ad=?, soyad=?, email=?, cinsiyet=? WHERE id=?";
        $stmt = $baglanti->prepare($sql);
        $stmt->bind_param("ssssi", $name, $lastname, $email, $gender, $id);
        $result = $stmt->execute();
        if (!$result) {
            $errormessage = "Geçersiz Değer" . $baglanti->error;
        } else {
            $successmessage = "Başarıyla güncellendi";    
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
            crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-x2w1XhKJKw4jQmg0drPvgF4Z+0oCBBFnnScJ+XaCwp1MA2Gd1PkkhKNXxIhFpwz3" crossorigin="anonymous"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <title>Düzenle</title>
</head>
<body>
<div class="container">
    <h2 style="text-align: center;">Düzenle</h2>
    <?php if (!empty($errormessage)): ?>
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>  
            <strong><?php echo $errormessage; ?></strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
    <?php endif; ?>
    <form method="post">
        <input type="hidden" name="İd" value="<?php echo $id ?>">
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Ad:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="ad" value="<?php echo $name ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Soyad:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="soyad" value="<?php echo $lastname ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email:</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" name="email" value="<?php echo $email ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Cinsiyet:</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="cinsiyet" value="<?php echo $gender ?>">
            </div>
        </div>
        <?php if (!empty($successmessage)): ?>
            <div class='alert alert-success alert-dismissible fade show' role='alert'>  
                <strong><?php echo $successmessage; ?></strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        <?php endif; ?>
        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Düzenle</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a href="index.php" class="btn btn-outline-primary" role="button">İptal</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
