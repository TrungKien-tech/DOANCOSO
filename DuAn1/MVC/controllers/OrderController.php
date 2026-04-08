<?php
class OrderController extends Controller
{
    public function orderSuccess()
    {
        // ... Xử lý đơn hàng thành công ...

        $user_id = $_SESSION['userlogin'][3]; // Lấy user_id từ session
        $so_diem_muon_cong = 10; // Hoặc tính theo giá trị đơn hàng

        $this->model('UserModel')->addPoint($user_id, $so_diem_muon_cong);

        // ... Tiếp tục xử lý hoặc chuyển trang ...
        $this->view('order/success');
    }
}
?>