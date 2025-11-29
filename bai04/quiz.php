<?php 
// Sửa đúng đường dẫn kết nối CSDL
require_once '../database/connect.php'; 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thi Trắc Nghiệm Android - Dữ liệu từ CSDL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #667eea, #764ba2); min-height: 100vh; padding: 30px 0; }
        .card { border-radius: 20px; }
        h1 { color: white; text-shadow: 2px 2px 8px rgba(0,0,0,0.6); }
    </style>
</head>
<body>

<div class="container">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white text-center py-4">
            <h1>THI TRẮC NGHIỆM LẬP TRÌNH ANDROID<br><small>(DỮ LIỆU TỪ CƠ SỞ DỮ LIỆU - BÀI 4)</small></h1>
        </div>
        <div class="card-body p-5">

            <form method="post">
                <?php
                try {
                    $stmt = $pdo->query("SELECT * FROM questions ORDER BY id");
                    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($questions) == 0) {
                        echo "<div class='alert alert-warning text-center fs-4'>Chưa có câu hỏi nào trong CSDL!<br>Vui lòng vào <a href='admin_quiz.php'>Quản trị</a> để upload file Quiz.txt trước.</div>";
                    } else {
                        foreach ($questions as $index => $q) {
                            echo "<div class='mb-4 p-4 border rounded bg-light'>
                                    <p class='fw-bold fs-5 text-primary mb-3'>Câu " . ($index+1) . ": " . htmlspecialchars($q['question']) . "</p>
                                    <div class='form-check'><input class='form-check-input' type='radio' name='ans[$index]' value='A' required> <label>A. " . htmlspecialchars($q['option_a']) . "</label></div>
                                    <div class='form-check'><input class='form-check-input' type='radio' name='ans[$index]' value='B'> <label>B. " . htmlspecialchars($q['option_b']) . "</label></div>
                                    <div class='form-check'><input class='form-check-input' type='radio' name='ans[$index]' value='C'> <label>C. " . htmlspecialchars($q['option_c']) . "</label></div>
                                    <div class='form-check'><input class='form-check-input' type='radio' name='ans[$index]' value='D'> <label>D. " . htmlspecialchars($q['option_d']) . "</label></div>
                                  </div>";
                        }
                    }
                } catch (Exception $e) {
                    echo "<div class='alert alert-danger'>Lỗi kết nối CSDL: " . $e->getMessage() . "</div>";
                }
                ?>

                <?php if (!empty($questions)): ?>
                <button type="submit" name="submit" class="btn btn-success btn-lg w-100 mt-3">NỘP BÀI & XEM KẾT QUẢ</button>
                <?php endif; ?>
            </form>

            <?php
            if (isset($_POST['submit']) && !empty($questions)) {
                $score = 0;
                foreach ($questions as $i => $q) {
                    if (isset($_POST['ans'][$i]) && strtoupper($_POST['ans'][$i]) === strtoupper($q['answer'])) {
                        $score++;
                    }
                }
                $percent = round($score / count($questions) * 100, 1);
                echo "<div class='alert alert-info text-center fs-2 mt-5 p-4'>
                        KẾT QUẢ: <strong class='text-success'>$score / " . count($questions) . "</strong> câu đúng → <strong class='text-danger'>$percent%</strong>
                      </div>";
            }
            ?>

            <div class="text-center mt-4">
                <a href="admin_quiz.php" class="btn btn-warning btn-lg px-5">Quản trị câu hỏi</a>
                <a href="../bai02/index.php" class="btn btn-secondary btn-lg px-5 ms-3">Thi từ file TXT (Bài 2)</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>