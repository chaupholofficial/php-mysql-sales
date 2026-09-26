<?php
require_once '/var/www/src/config/session.php';
$pageTitle = 'Trang chủ - Rau Sạch Hoa Sen';
require_once __DIR__ . '/../src/includes/frontend/header.php';
require_once __DIR__ . '/../src/includes/frontend/navbar.php';
?>

<main class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-success">Chào mừng đến với Rau Sạch Hoa Sen</h1>
        <p class="lead text-muted">Thực phẩm tươi sạch, an toàn, chuẩn hữu cơ mỗi ngày.</p>
    </div>

    <div class="row text-center">
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <i class="bi bi-cart-check text-success" style="font-size: 3rem;"></i>
                    <h5 class="card-title mt-3">Mua sắm dễ dàng</h5>
                    <p class="text-muted">Chọn lựa các loại rau củ quả theo mùa tươi ngon nhất.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <i class="bi bi-truck text-success" style="font-size: 3rem;"></i>
                    <h5 class="card-title mt-3">Giao hàng tận nơi</h5>
                    <p class="text-muted">Đảm bảo độ tươi ngon đến tận nhà bạn trong thời gian sớm nhất.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <i class="bi bi-shield-check text-success" style="font-size: 3rem;"></i>
                    <h5 class="card-title mt-3">Đảm bảo chất lượng</h5>
                    <p class="text-muted">Nguồn gốc rõ ràng, không hóa chất, tốt cho sức khỏe.</p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../src/includes/frontend/footer.php'; ?>