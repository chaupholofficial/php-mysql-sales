<?php
$appName = "Hệ thống quản lý bán hàng";
?>

<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $appName ?></title>
</head>
<body>

    <h1><?= $appName ?></h1>
    <p>Ứng dụng PHP đang hoạt động.</p>

</body>
</html><?php

$pageTitle = 'Quản lý danh mục';

require_once '/var/www/src/config/database.php';

$sql = "
    SELECT
        CategoryID,
        CategoryName,
        Description
    FROM categories
    ORDER BY CategoryID
";

$result = $conn->query($sql);

require_once '/var/www/src/includes/header.php';
require_once '/var/www/src/includes/navbar.php';

?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h2>Quản lý danh mục</h2>

        <a href="#" class="btn btn-primary">
            Thêm danh mục
        </a>

    </div>

    <div class="table-responsive">

        <table class="table table-bordered table-striped">

            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Mô tả</th>
                    <th>Thao tác</th>
                </tr>
            </thead>

            <tbody>

            <?php while ($category = $result->fetch_assoc()): ?>

                <tr>

                    <td>
                        <?= $category['CategoryID'] ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($category['CategoryName']) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($category['Description'] ?? '') ?>
                    </td>

                    <td>

                        <a href="#" class="btn btn-sm btn-warning">
                            Sửa
                        </a>

                        <a href="#" class="btn btn-sm btn-danger">
                            Xóa
                        </a>

                    </td>

                </tr>

            <?php endwhile; ?>

            </tbody>

        </table>

    </div>

</div>

<?php

require_once '/var/www/src/includes/footer.php';

$conn->close();
