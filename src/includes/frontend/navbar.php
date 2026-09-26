<?php
$cartCount = array_sum($_SESSION['cart'] ?? []);
?>
<nav class="navbar navbar-expand-lg bg-success navbar-dark sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">
            <i class="bi bi-basket2-fill me-2"></i>RAU SẠCH HOA SEN
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#frontendNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="frontendNavbar">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="/">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/products.php">Sản phẩm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tin tức</a>
                </li>
            </ul>
            <div class="d-flex gap-2">
                <a class="btn btn-outline-light btn-sm" href="/cart.php">Giỏ hàng (<?= (int) $cartCount ?>)</a>
                <a class="btn btn-outline-light btn-sm" href="/admin/">Quản trị</a>
            </div>
        </div>
    </div>
</nav>