<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 3 - Danh sách sinh viên CSE485</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; padding: 40px 0; }
        .table thead { background-color: #0d47a1; color: white; }
        h1 { color: #0d47a1; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center mb-4">DANH SÁCH SINH VIÊN HỌC PHẦN CSE485 - K65 (2025)</h1>
    <h5 class="text-center text-muted mb-5">Lớp 65HTTT - Trường Đại học Thủy Lợi</h5>

    <?php
    $csv_file = "../uploads/65HTTT_Danh_sach_diem_danh.csv";

    if (!file_exists($csv_file)) {
        echo "<div class='alert alert-danger text-center fs-4'>
                Không tìm thấy file CSV!<br>
                Vui lòng đặt file <code>65HTTT_Danh_sach_diem_danh.csv</code> vào thư mục <code>uploads</code>
              </div>";
        die();
    }

    $file = fopen($csv_file, "r");
    if (!$file) {
        die("<div class='alert alert-danger'>Không thể mở file CSV!</div>");
    }

    // Bỏ qua dòng tiêu đề
    fgetcsv($file);
    ?>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle shadow-sm">
            <thead>
                <tr>
                    <th width="70" class="text-center">STT</th>
                    <th width="120">MSSV</th>
                    <th width="100">Họ</th>
                    <th width="100">Tên</th>
                    <th width="100">Lớp</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stt = 1;
                while (($data = fgetcsv($file)) !== false) {
                    if (count($data) < 6) continue; // phòng lỗi dòng trống
                    echo "<tr>
                            <td class='text-center fw-bold'>$stt</td>
                            <td><span class='badge bg-primary fs-6'>{$data[0]}</span></td>
                            <td>{$data[2]}</td>
                            <td><strong>{$data[3]}</strong></td>
                            <td>{$data[4]}</td>
                            <td><a href='mailto:{$data[5]}'>{$data[5]}</a></td>
                          </tr>";
                    $stt++;
                }
                fclose($file);
                ?>
            </tbody>
        </table>
    </div>

    <div class="text-center mt-4">
        <p class="text-muted">Tổng cộng: <strong><?= $stt - 1 ?></strong> sinh viên</p>
    </div>
</div>

</body>
</html>