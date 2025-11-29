<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 2 - Thi Trắc Nghiệm Lập Trình Android</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #667eea, #764ba2); padding: 40px 0; min-height: 100vh; }
        .quiz-card { border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.3); }
        .question-box { background: #f8f9fa; border-left: 5px solid #007bff; }
        h1 { font-weight: 900; color: #fff; text-shadow: 2px 2px 10px rgba(0,0,0,0.5); }
    </style>
</head>
<body>

<div class="container">
    <div class="quiz-card p-5 bg-white">
        <h1 class="text-center mb-5">THI TRẮC NGHIỆM LẬP TRÌNH ANDROID</h1>

        <form method="post">
            <?php
            $file_path = "../uploads/Quiz.txt";

            if (!file_exists($file_path)) {
                die("<div class='alert alert-danger text-center fs-4'>Không tìm thấy file Quiz.txt tại: <code>$file_path</code></div>");
            }

            $lines = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $questions = [];
            $i = 0;

            while ($i < count($lines)) {
                // Bỏ qua dòng chứa ANSWER:
                if (stripos($lines[$i], 'ANSWER:') !== false) {
                    $i++;
                    continue;
                }

                // Lấy câu hỏi (dòng không bắt đầu bằng A. B. C. D.)
                $question = trim($lines[$i]);
                if (preg_match('/^[ABCD][\.\)]\s*/', $question) || empty($question)) {
                    $i++;
                    continue;
                }

                $i++;
                $opts = ['a' => '', 'b' => '', 'c' => '', 'd' => ''];
                $answer = '';

                // Lấy 4 đáp án
                for ($j = 0; $j < 4 && $i < count($lines); $j++, $i++) {
                    $line = trim($lines[$i]);
                    if (preg_match('/^A[\.\)]\s*(.*)/i', $line, $m)) $opts['a'] = $m[1];
                    elseif (preg_match('/^B[\.\)]\s*(.*)/i', $line, $m)) $opts['b'] = $m[1];
                    elseif (preg_match('/^C[\.\)]\s*(.*)/i', $line, $m)) $opts['c'] = $m[1];
                    elseif (preg_match('/^D[\.\)]\s*(.*)/i', $line, $m)) $opts['d'] = $m[1];
                }

                // Tìm dòng ANSWER:
                while ($i < count($lines) && stripos($lines[$i], 'ANSWER:') === false) $i++;
                if ($i < count($lines)) {
                    $answer = trim(str_replace(['ANSWER:', 'answer:', 'Answer:'], '', $lines[$i]));
                    $answer = strtoupper(trim($answer));
                    $i++;
                }

                if (!empty($question) && !empty($answer) && !empty($opts['a']) && !empty($opts['b'])) {
                    $questions[] = [
                        'q'   => $question,
                        'a'   => $opts['a'],
                        'b'   => $opts['b'],
                        'c'   => $opts['c'] ?: 'Không có',
                        'd'   => $opts['d'] ?: 'Không có',
                        'ans' => $answer
                    ];
                }
            }

            // HIỂN THỊ CÂU HỎI
            foreach ($questions as $index => $q) {
                echo "<div class='question-box p-4 mb-4 rounded'>
                        <p class='fw-bold fs-5 mb-3 text-primary'>Câu " . ($index+1) . ": {$q['q']}</p>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='ans[$index]' value='A' required id='q{$index}A'>
                            <label class='form-check-label' for='q{$index}A'>A. {$q['a']}</label>
                        </div>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='ans[$index]' value='B' id='q{$index}B'>
                            <label class='form-check-label' for='q{$index}B'>B. {$q['b']}</label>
                        </div>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='ans[$index]' value='C' id='q{$index}C'>
                            <label class='form-check-label' for='q{$index}C'>C. {$q['c']}</label>
                        </div>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='ans[$index]' value='D' id='q{$index}D'>
                            <label class='form-check-label' for='q{$index}D'>D. {$q['d']}</label>
                        </div>
                      </div>";
            }
            ?>

            <button type="submit" name="submit" class="btn btn-success btn-lg w-100 mt-4 shadow">
                NỘP BÀI & XEM KẾT QUẢ
            </button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $score = 0;
            foreach ($questions as $i => $q) {
                if (isset($_POST['ans'][$i]) && strtoupper($_POST['ans'][$i]) === $q['ans']) {
                    $score++;
                }
            }
            $total = count($questions);
            $percent = round(($score / $total) * 100, 1);

            echo "<div class='alert alert-info text-center fs-3 mt-5 p-4'>
                    <strong>KẾT QUẢ:</strong> Bạn trả lời đúng <span class='text-success fw-bold'>$score / $total</span> câu<br>
                    Điểm: <span class='text-danger fw-bold'>$percent%</span>
                  </div>";
        }
        ?>
    </div>
</div>

</body>
</html>