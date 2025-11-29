<?php include '../database/connect.php'; ?>
<!DOCTYPE html>
<html><head><meta charset="UTF-8"><title>Quản trị Câu hỏi</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center mb-4">QUẢN TRỊ CÂU HỎI TRẮC NGHIỆM (BÀI 4)</h2>
    <a href="../quiz_from_db.php" class="btn btn-info mb-3">Về trang thi (dùng CSDL)</a>

    <form method="post" enctype="multipart/form-data" class="card p-4">
        <input type="file" name="quizfile" accept=".txt" required class="form-control">
        <button name="upload" class="btn btn-primary mt-3">Upload Quiz.txt vào CSDL</button>
    </form>

    <?php
    if (isset($_POST['upload'])) {
        $lines = file($_FILES['quizfile']['tmp_name'], FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $pdo->exec("DELETE FROM questions");
        $stmt = $pdo->prepare("INSERT INTO questions (question, option_a, option_b, option_c, option_d, answer) VALUES (?,?,?,?,?,?)");
        
        for ($i = 0; $i < count($lines); $i += 7) {
            if ($i + 6 >= count($lines)) break;
            $q = trim($lines[$i]);
            $a = trim(str_replace(['A.', 'A. '], '', $lines[$i+1]));
            $b = trim(str_replace(['B.', 'B. '], '', $lines[$i+2]));
            $c = trim(str_replace(['C.', 'C. '], '', $lines[$i+3]));
            $d = trim(str_replace(['D.', 'D. '], '', $lines[$i+4]));
            $ans = trim(str_replace('ANSWER: ', '', $lines[$i+6]));
            $stmt->execute([$q, $a, $b, $c, $d, $ans]);
        }
        echo "<div class='alert alert-success mt-3'>Đã import thành công " . intdiv(count($lines),7) . " câu hỏi!</div>";
    }
    ?>
</div>
</body>
</html>