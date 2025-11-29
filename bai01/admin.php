<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản trị - Danh sách hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <h2 class="mb-4">QUẢN TRỊ – DANH SÁCH HOA (CRUD)</h2>
    <a href="index.php" class="btn btn-primary mb-3">Xem giao diện khách</a>

    <?php include 'flowers.php'; ?>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th width="80">STT</th>
                <th width="150">Ảnh minh họa</th>
                <th>Tên hoa</th>
                <th>Mô tả</th>
                <th width="150">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($flowers as $i => $hoa): ?>
            <tr>
                <td class="text-center"><?= $i + 1 ?></td>
                <td><img src="<?= $hoa['anh'] ?>" width="120" class="rounded"></td>
                <td><strong><?= $hoa['ten'] ?></strong></td>
                <td><?= $hoa['mota'] ?></td>
                <td class="text-center">
                    <button class="btn btn-warning btn-sm">Sửa</button>
                    <button class="btn btn-danger btn-sm">Xóa</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button class="btn btn-success mt-3">Thêm hoa mới</button>
</div>

</body>
</html>