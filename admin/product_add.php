<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../config/db.php';

// 1. KIỂM TRA QUYỀN ADMIN
if (
    !isset($_SESSION['user']) ||
    !isset($_SESSION['user']['role']) ||
    $_SESSION['user']['role'] != 'admin'
) {
    header("Location: ../login.php");
    exit();
}

// 2. KẾT NỐI DATABASE
$db = new Database();
$conn = $db->conn;

if (!$conn || $conn->connect_error) {
    die("Lỗi kết nối Database!");
}

$error = '';
$success = '';

// 3. XỬ LÝ THÊM SẢN PHẨM
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = trim($_POST['name'] ?? '');
    $price = intval($_POST['price'] ?? 0);
    $stock = intval($_POST['stock'] ?? 0);
    $cat_id = intval($_POST['category_id'] ?? 0);
    $desc = trim($_POST['description'] ?? '');

    $image = 'no-image.png';
    $uploaded_file = '';

    // Kiểm tra thông tin
    if ($name == '' || $price < 0 || $stock < 1) {
        $error = "Vui lòng nhập đầy đủ thông tin hợp lệ!";
    }

    // 4. XỬ LÝ UPLOAD ẢNH
    if (
        empty($error) &&
        isset($_FILES['image']) &&
        $_FILES['image']['error'] != UPLOAD_ERR_NO_FILE
    ) {

        if ($_FILES['image']['error'] != UPLOAD_ERR_OK) {
            $error = "Có lỗi khi tải ảnh lên!";
        } else {

            $target_dir = "../assets/images/";

            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $file_extension = strtolower(
                pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION)
            );

            $allow_types = ['jpg', 'jpeg', 'png', 'webp'];

            if (!in_array($file_extension, $allow_types)) {
                $error = "Chỉ chấp nhận ảnh JPG, JPEG, PNG, WEBP!";
            } else {

                $file_name = time() . '_' . rand(100, 999)
                    . '.' . $file_extension;

                $target_file = $target_dir . $file_name;

                if (move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    $target_file
                )) {
                    $image = $file_name;
                    $uploaded_file = $target_file;
                } else {
                    $error = "Không thể lưu ảnh sản phẩm!";
                }
            }
        }
    }

    // 5. LƯU SẢN PHẨM VÀO DATABASE
    if (empty($error)) {

        $sql = "INSERT INTO products
                (name, price, image, description, category_id, stock)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            $error = "Lỗi chuẩn bị SQL: " . $conn->error;
        } else {

            $stmt->bind_param(
                "sissii",
                $name,
                $price,
                $image,
                $desc,
                $cat_id,
                $stock
            );

            if ($stmt->execute()) {

                $stmt->close();

                // Thông báo và quay lại danh sách sản phẩm
                echo "<script>
                    alert('Thêm sản phẩm thành công!');
                    window.location.href='index.php?page=products';
                </script>";
                exit();
            } else {
                $error = "Lỗi thêm sản phẩm: " . $stmt->error;
                $stmt->close();

                // Xóa ảnh nếu lưu database thất bại
                if ($uploaded_file != '' && file_exists($uploaded_file)) {
                    unlink($uploaded_file);
                }
            }
        }
    }
}
?>
<?php require_once 'sidebar.php'; ?>

<div class="content">
    <div class="section-header">
        <div class="section-title">Thêm Sản Phẩm Mới</div>
        <a href="index.php?page=products" class="btn-action" style="background: #ddd; color: #333;">
            <i class="fa fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <?php if ($error): ?>
        <div style="padding: 15px; background: #FFEBEE; color: #D32F2F; border-radius: 10px; margin-bottom: 20px;">
            <i class="fa fa-exclamation-circle"></i> <?= $error ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div style="padding: 15px; background: #E8F5E9; color: #2E7D32; border-radius: 10px; margin-bottom: 20px;">
            <i class="fa fa-check-circle"></i> <?= $success ?>
        </div>
    <?php endif; ?>

    <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
        <form action="" method="POST" enctype="multipart/form-data">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div>
                    <label style="font-weight: bold; display: block; margin-bottom: 8px;">Tên sản phẩm:</label>
                    <input type="text" name="name" required class="input-field" placeholder="Ví dụ: Lego City..."
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
                </div>

                <div>
                    <label style="font-weight: bold; display: block; margin-bottom: 8px;">Danh mục:</label>
                    <select name="category_id" required
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
                        <option value="">-- Chọn danh mục --</option>
                        <option value="2">Lego Lắp Ráp</option>
                        <option value="4">Xe Mô Hình</option>
                        <option value="3">Búp Bê</option>
                        <option value="1">Gấu Bông</option>
                    </select>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
                <div>
                    <label style="font-weight: bold; display: block; margin-bottom: 8px;">Giá bán (VNĐ):</label>
                    <input type="number" name="price" required min="0" placeholder="100000"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
                </div>
                <div>
                    <label style="font-weight: bold; display: block; margin-bottom: 8px;">Số lượng kho:</label>
                    <input type="number" name="stock" required min="1" value="10"
                        style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;">
                </div>
            </div>

            <div style="margin-top: 20px;">
                <label style="font-weight: bold; display: block; margin-bottom: 8px;">Ảnh sản phẩm:</label>
                <input type="file" name="image" required style="padding: 10px;">
            </div>

            <div style="margin-top: 20px;">
                <label style="font-weight: bold; display: block; margin-bottom: 8px;">Mô tả chi tiết:</label>
                <textarea name="description" rows="5"
                    style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px;"
                    placeholder="Nhập thông tin chi tiết sản phẩm..."></textarea>
            </div>

            <div style="margin-top: 30px; text-align: right;">
                <button type="submit" class="btn-add"
                    style="border: none; cursor: pointer; padding: 12px 30px; font-size: 16px;">
                    <i class="fa fa-save"></i> Lưu Sản Phẩm
                </button>
            </div>

        </form>
    </div>
</div>