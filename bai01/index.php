<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>14 Loài Hoa Đẹp Nhất Xuân Hè 2025</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f5f5; padding-top: 30px; }
        .card { transition: 0.4s; border: none; }
        .card:hover { transform: translateY(-10px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
        .flower-img { height: 320px; object-fit: cover; border-radius: 10px; }
        .title { color: #d32f2f; }
    </style>
</head>
<body>

<div class="container">
    <h1 class="text-center title fw-bold mb-4">
        14 LOÀI HOA TUYỆT ĐẸP KHOE SẮC XUÂN HÈ 2025
    </h1>
    <p class="text-center text-muted lead mb-5">
        Cùng chiêm ngưỡng những bông hoa rực rỡ nhất mùa xuân hè năm nay
    </p>

    <?php include 'flowers.php'; ?>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($flowers as $i => $hoa): ?>
        <div class="col">
            <div class="card h-100">
                <img src="<?= $hoa['anh'] ?>" class="card-img-top flower-img" alt="<?= $hoa['ten'] ?>">
                <div class="card-body">
                    <h5 class="card-title text-danger fw-bold"><?= $hoa['ten'] ?></h5>
                    <p class="card-text text-secondary"><?= $hoa['mota'] ?></p>
                </div>
                <div class="card-footer bg-transparent border-0 text-end">
                    <small class="text-muted">Hoa thứ <?= $i + 1 ?></small>
                </div>
            </div>
        </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="text-center mt-5">
        <a href="admin.php" class="btn btn-dark btn-lg px-5">Chế độ Quản trị</a>
    </div>
</div>

</body>
</html>