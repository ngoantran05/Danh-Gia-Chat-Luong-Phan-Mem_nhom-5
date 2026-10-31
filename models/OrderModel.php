<?php
class OrderModel
{
    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    // 1. Tạo đơn hàng mới

    public function createOrder($user_id, $fullname, $email, $phone, $address, $note, $total_money, $payment_method = 'COD')
    {
        $conn = $this->db->conn;

        $fullname = $conn->real_escape_string($fullname);
        $email = $conn->real_escape_string($email);
        $phone = $conn->real_escape_string($phone);
        $address = $conn->real_escape_string($address);
        $note = $conn->real_escape_string($note);
        $payment_method = $conn->real_escape_string($payment_method);

        // Chỉ chấp nhận 2 phương thức thanh toán
        if (!in_array($payment_method, ['COD', 'Chuyển khoản ngân hàng'], true)) {
            $payment_method = 'COD';
        }

        $total_money = intval($total_money);
        $user_id = intval($user_id);

        $created_at = date('Y-m-d H:i:s');

        $sql = "INSERT INTO orders
            (user_id, fullname, email, phone, address, note, total_money, payment_method, status, created_at)
            VALUES
            ($user_id, '$fullname', '$email', '$phone', '$address', '$note',
            $total_money, '$payment_method', 'Chờ xử lý', '$created_at')";

        if ($this->db->execute($sql)) {
            return $conn->insert_id;
        }

        return false;
    }

    // 2. Thêm chi tiết đơn hàng
    public function addOrderDetail($order_id, $product_id, $price, $quantity)
    {
        $order_id = intval($order_id);
        $product_id = intval($product_id);
        $price = intval($price);
        $quantity = intval($quantity);

        $sql = "INSERT INTO order_details
                (order_id, product_id, price, quantity)
                VALUES ($order_id, $product_id, $price, $quantity)";

        return $this->db->execute($sql);
    }

    // 3. Trừ số lượng tồn kho
    public function reduceStock($product_id, $quantity)
    {
        $product_id = intval($product_id);
        $quantity = intval($quantity);

        if ($product_id <= 0 || $quantity <= 0) {
            return false;
        }

        $sql = "UPDATE products
                SET stock = stock - $quantity
                WHERE id = $product_id
                AND stock >= $quantity";

        $this->db->execute($sql);

        return $this->db->conn->affected_rows > 0;
    }

    // 4. Lấy danh sách đơn hàng của User
    public function getOrdersByUser($user_id)
    {
        $user_id = intval($user_id);

        $sql = "SELECT * FROM orders
                WHERE user_id = $user_id
                ORDER BY id DESC";

        return $this->db->getAll($sql);
    }

    // 5. Lấy thông tin đơn hàng
    public function getOrderById($id)
    {
        $id = intval($id);

        $sql = "SELECT * FROM orders WHERE id = $id";

        return $this->db->getOne($sql);
    }

    // 6. Hủy đơn hàng
    public function cancelOrder($id, $user_id)
    {
        $id = intval($id);
        $user_id = intval($user_id);

        $conn = $this->db->conn;

        try {
            $conn->begin_transaction();

            $sql = "SELECT * FROM orders
                    WHERE id = $id AND user_id = $user_id
                    FOR UPDATE";

            $order = $this->db->getOne($sql);

            if (!$order || !in_array($order['status'], ['0', 'Chờ xử lý'])) {
                $conn->rollback();
                return false;
            }

            // Lấy sản phẩm trong đơn hàng
            $details = $this->db->getAll(
                "SELECT product_id, quantity
                 FROM order_details
                 WHERE order_id = $id"
            );

            // Hoàn lại tồn kho
            foreach ($details as $item) {
                $product_id = intval($item['product_id']);
                $quantity = intval($item['quantity']);

                $this->db->execute(
                    "UPDATE products
                     SET stock = stock + $quantity
                     WHERE id = $product_id"
                );
            }

            // Cập nhật trạng thái
            $this->db->execute(
                "UPDATE orders
                 SET status = 'Đã hủy'
                 WHERE id = $id"
            );

            $conn->commit();
            return true;
        } catch (Throwable $e) {
            $conn->rollback();
            return false;
        }
    }
}
