<?php
// =====================================
// CÁC HÀM CẦN KIỂM THỬ
// =====================================

// Hàm tính tổng tiền
function calculateTotal($price, $quantity)
{
    if ($price < 0 || $quantity < 0) {
        return false;
    }

    return $price * $quantity;
}

// Hàm kiểm tra số lượng mua
function checkQuantity($quantity)
{
    return is_numeric($quantity) && $quantity > 0;
}

// Hàm kiểm tra tồn kho
function checkStock($quantity, $stock)
{
    return $quantity > 0 && $stock >= $quantity;
}

// Hàm kiểm tra phương thức thanh toán
function checkPaymentMethod($method)
{
    return in_array($method, [
        'COD',
        'Chuyển khoản ngân hàng'
    ], true);
}

// =====================================
// CHẠY CÁC TEST CASE
// =====================================

$passed = 0;
$failed = 0;

function runTest($testName, $expected, $actual)
{
    global $passed, $failed;

    if ($expected === $actual) {
        echo "[PASSED] $testName" . PHP_EOL;
        $passed++;
    } else {
        echo "[FAILED] $testName" . PHP_EOL;
        echo "Expected: " . var_export($expected, true) . PHP_EOL;
        echo "Actual: " . var_export($actual, true) . PHP_EOL;
        $failed++;
    }
}

// TC01: Tính tổng tiền bình thường
runTest(
    "TC01 - Tinh tong tien",
    200000,
    calculateTotal(100000, 2)
);

// TC02: Số lượng bằng 0
runTest(
    "TC02 - So luong bang 0",
    false,
    checkQuantity(0)
);

// TC03: Số lượng hợp lệ
runTest(
    "TC03 - So luong hop le",
    true,
    checkQuantity(3)
);

// TC04: Đủ hàng trong kho
runTest(
    "TC04 - Kiem tra ton kho du",
    true,
    checkStock(2, 10)
);

// TC05: Không đủ hàng trong kho
runTest(
    "TC05 - Kiem tra ton kho thieu",
    false,
    checkStock(10, 5)
);

// TC06: Thanh toán COD
runTest(
    "TC06 - Thanh toan COD",
    true,
    checkPaymentMethod('COD')
);

// TC07: Thanh toán chuyển khoản
runTest(
    "TC07 - Thanh toan chuyen khoan",
    true,
    checkPaymentMethod('Chuyển khoản ngân hàng')
);

// =====================================
// TỔNG KẾT
// =====================================

echo PHP_EOL;
echo "============================" . PHP_EOL;
echo "TONG KET UNIT TEST" . PHP_EOL;
echo "============================" . PHP_EOL;

echo "Tong so test: " . ($passed + $failed) . PHP_EOL;
echo "Passed: " . $passed . PHP_EOL;
echo "Failed: " . $failed . PHP_EOL;
