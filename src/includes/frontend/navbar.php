<?php
// Kiểm tra trạng thái đăng nhập của khách hàng
$isLoggedIn = isset($_SESSION['customer_id']);
$customerName = $_SESSION['customer_name'] ?? '';
$cartCount = array_sum($_SESSION['cart'] ?? []);
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">🌿 RAU SẠCH HOA SEN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/products.php">Sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/news.php">Tin tức</a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                <a href="/cart.php" class="btn btn-outline-light me-3">
                    Giỏ hàng (<span id="cart-count"><?= $cartCount ?></span>)
                </a>

                <?php if ($isLoggedIn): ?>
                    <span class="text-light me-3">
                        Xin chào, <strong><?= htmlspecialchars($customerName) ?></strong>
                    </span>
                    <a class="btn btn-outline-light btn-sm me-2" href="/logout.php">Đăng xuất</a>
                <?php else: ?>
                    <a class="btn btn-outline-light btn-sm me-2" href="/register.php">Đăng ký</a>
                    <a class="btn btn-outline-light btn-sm me-2" href="/login.php">Đăng nhập</a>
                <?php endif; ?>

                <a href="/admin/" class="btn btn-light btn-sm">Quản trị</a>
            </div>
        </div>
    </div>
</nav>