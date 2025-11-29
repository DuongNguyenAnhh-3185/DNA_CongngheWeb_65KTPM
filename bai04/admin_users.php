<?php include '../database/connect.php'; ?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Quản trị Sinh viên</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">QUẢN TRỊ DANH SÁCH SINH VIÊN (BÀI 4)</h2>

    <form method="post" enctype="multipart/form-data" class="card p-4">
        <input type="file" name="csv" accept=".csv" required class="form-control">
        <button name="import" class="btn btn-primary mt-3">Import CSV vào CSDL</button>
    </form>

    <?php
    if (isset($_POST['import'])) {
        $file = $_FILES['csv']['tmp_name'];
        $handle = fopen($file, "r");
        fgetcsv($handle); // bỏ header
        $pdo->exec("DELETE FROM users");
        $stmt = $pdo->prepare("INSERT INTO users (username,password,lastname,firstname,class,email) VALUES (?,?,?,?,?,?)");
        while ($row = fgetcsv($handle)) {
            $stmt->execute($row);
        }
        echo "<div class='alert alert-success mt-3'>Đã import thành công sinh viên!</div>";
    }
    ?>
</div>
</body>
</html>