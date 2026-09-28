<?php
$pageTitle = 'Chỉnh sửa đơn hàng';
require_once __DIR__ . '/../../../src/config/database.php';

$error = '';
$orderID = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($orderID <= 0) {
    die("ID đơn hàng không hợp lệ.");
}

// 1. Xử lý lưu dữ liệu khi người dùng bấm Cập nhật
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_date  = trim($_POST['OrderDate'] ?? '');
    $customer_id = !empty($_POST['CustomerID']) ? (int)$_POST['CustomerID'] : NULL;
    $employee_id = !empty($_POST['EmployeeID']) ? (int)$_POST['EmployeeID'] : NULL;
    $shipper_id  = !empty($_POST['ShipperID']) ? (int)$_POST['ShipperID'] : NULL;

    if (empty($order_date)) {
        $error = 'Ngày đặt hàng không được để trống.';
    } else {
        $sql = "UPDATE orders SET OrderDate = ?, CustomerID = ?, EmployeeID = ?, ShipperID = ? WHERE OrderID = ?";
        $stmt = $conn->prepare($sql);
        
        if ($stmt) {
            $stmt->bind_param("siiii", $order_date, $customer_id, $employee_id, $shipper_id, $orderID);
            
            if ($stmt->execute()) {
                header("Location: /orders/");
                exit();
            } else {
                $error = "Lỗi khi cập nhật đơn hàng: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $error = "Lỗi câu lệnh SQL: " . $conn->error;
        }
    }
}

// 2. Lấy thông tin đơn hàng cũ theo ID
$stmt = $conn->prepare("SELECT * FROM orders WHERE OrderID = ?");
$stmt->bind_param("i", $orderID);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();

if (!$order) {
    die("Không tìm thấy đơn hàng trong hệ thống.");
}
$stmt->close();

// 3. Lấy dữ liệu cho các Dropdown (Khách hàng, Nhân viên, Người giao hàng)
$customers = $conn->query("SELECT CustomerID, CustomerName FROM customers ORDER BY CustomerName");
$employees = $conn->query("SELECT EmployeeID, CONCAT(LastName, ' ', FirstName) AS EmployeeName FROM employees ORDER BY FirstName");
$shippers  = $conn->query("SELECT ShipperID, ShipperName FROM shippers ORDER BY ShipperName");

require_once __DIR__ . '/../../../src/includes/admin/header.php';
require_once __DIR__ . '/../../../src/includes/admin/navbar.php';
?>

<div class="container mt-4">
    <h2 class="mb-4">Chỉnh sửa đơn hàng #<?= $order['OrderID'] ?></h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Ngày đặt hàng <span class="text-danger">*</span></label>
                <input type="date" name="OrderDate" class="form-control" required value="<?= htmlspecialchars($order['OrderDate']) ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Khách hàng</label>
                <select name="CustomerID" class="form-select">
                    <option value="">-- Chọn khách hàng --</option>
                    <?php while($c = $customers->fetch_assoc()): ?>
                        <option value="<?= $c['CustomerID'] ?>" <?= ($order['CustomerID'] == $c['CustomerID']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c['CustomerName']) ?>
                        </option>
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
                        <option value="<?= $e['EmployeeID'] ?>" <?= ($order['EmployeeID'] == $e['EmployeeID']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($e['EmployeeName']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Người giao hàng</label>
                <select name="ShipperID" class="form-select">
                    <option value="">-- Chọn đơn vị giao hàng --</option>
                    <?php while($s = $shippers->fetch_assoc()): ?>
                        <option value="<?= $s['ShipperID'] ?>" <?= ($order['ShipperID'] == $s['ShipperID']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($s['ShipperName']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-warning">Cập nhật đơn hàng</button>
        <a href="/orders/" class="btn btn-secondary">Hủy</a>
    </form>
</div>

<?php require_once __DIR__ . '/../../../src/includes/admin/footer.php'; ?>