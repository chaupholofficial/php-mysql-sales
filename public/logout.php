<?php
require_once '/var/www/src/config/session.php';

// Chỉ xóa dữ liệu xác thực khách hàng, GIỮ LẠI GIỎ HÀNG
unset($_SESSION['customer_id'], $_SESSION['customer_name']);
session_regenerate_id(true);

header('Location: /');
exit;