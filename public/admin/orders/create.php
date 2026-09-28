<?php
$pageTitle = 'Tạo Đơn hàng mới';
require_once __DIR__ . '/../../../src/config/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_date = $_POST['OrderDate'];
    $customer_id = !empty($_POST['CustomerID']) ? (int)$_POST['CustomerID'] : NULL;
    $employee_id = !empty($_POST['EmployeeID']) ? (int)$_POST['EmployeeID'] : NULL;
    $shipper_id  = !empty($_POST['ShipperID']) ? (int)$_POST['ShipperID'] : NULL;

    if (empty($order_date)) {
        $error = 'Ngày đặt hàng không được để trống.';
    } else {
        $sql = "INSERT INTO orders (OrderDate, CustomerID, EmployeeID, ShipperID) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("siii", $order_date, $customer_id, $employee_id, $shipper_id);
            if ($stmt->execute()) {
                header("Location: /orders/");
                exit();
            } else {
                $error = "Lỗi khi lưu đơn hàng: " . $stmt->error;
            }
        }
    }
}

// Lấy dữ liệu cho các Dropdown
$customers = $conn->query("SELECT CustomerID, CustomerName FROM customers ORDER BY CustomerName");
$employees = $conn->query("SELECT EmployeeID, CONCAT(LastName, ' ', FirstName) AS EmployeeName FROM employees ORDER BY FirstName");
$shippers  = $conn->query("SELECT ShipperID, ShipperName FROM shippers ORDER BY ShipperName");

require_once __DIR__ . '/../../../src/includes/admin/header.php';
require_once __DIR__ . '/../../../src/includes/admin/navbar.php';
?>

<div class="container mt-4">
    <h2 class="mb-4">Tạo đơn hàng mới</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Ngày đặt hàng <span class="text-danger">*</span></label>
                <input type="date" name="OrderDate" class="form-control" value="<?= date('Y-m-d') ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Khách hàng</label>
                <select name="CustomerID" class="form-select">
                    <option value="">-- Chọn khách hàng --</option>
                    <?php while($c = $customers->fetch_assoc()): ?>
                        <option value="<?= $c['CustomerID'] ?>"><?= htmlspecialchars($c['CustomerName']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nhân viên phụ trách</label>
                <select name="EmployeeID" class="form-select">
                    <option value="">-- Chọn nhân viên --</option>
                    <?php while($e = $employees->fetch_assoc()): ?>
                        <option value="<?= $e['EmployeeID'] ?>"><?= htmlspecialchars($e['EmployeeName']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Người giao hàng</label>
                <select name="ShipperID" class="form-select">
                    <option value="">-- Chọn đơn vị giao hàng --</option>
                    <?php while($s = $shippers->fetch_assoc()): ?>
                        <option value="<?= $s['ShipperID'] ?>"><?= htmlspecialchars($s['ShipperName']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Lưu đơn hàng</button>
        <a href="/orders/" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<?php require_once __DIR__ . '/../../../src/includes/admin/footer.php'; ?>