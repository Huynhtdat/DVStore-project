<?php

namespace App\Helpers\admin;

class TextSystemConst
{
    public const EMAIL_EXIST_SYSTEM = "Email already exists in the system"; // Email đã tồn tại trong hệ thống
    public const CHANGE_PASSWORD_SUCCESS = "Password changed successfully"; // Thay đổi mật khẩu thành công
    public const PURCHASE_HISTORY = "Purchase History"; // Lịch Sử Mua Hàng
    public const DELETE_SUCCESS = "Deleted successfully"; // Xóa thành công
    public const DELETE_FAILED = "Deletion failed"; // Xóa thất bại
    public const SYSTEM_ERROR = "An error occurred, please try again"; // Có lỗi xảy ra vui lòng thử lại
    public const CREATE_SUCCESS = "Added successfully"; // Thêm thành công
    public const CREATE_FAILED = "Addition failed, please try again"; // Thêm thất bại hãy thử lại
    public const UPDATE_SUCCESS = "Information updated successfully"; // Chỉnh sửa thông tin thành công
    public const UPDATE_FAILED = "Update failed, please try again"; // Chỉnh sửa thất bại hãy thử lại
    public const CHANGE_PASSWORD = [
        'success' => 'Password changed successfully', // Thay đổi mật khẩu thành công
        'error' => 'Operation failed, please try again' // Thực hiện thất bại vui lòng thử lại
    ];
    public const ORDER_PROCESSING = "Order processed successfully"; // Xử lý đơn hàng thành công
    public const ORDER_FAILED = "Order processing failed"; // Xử lý đơn hàng thất bại
    public const ADD_CART_ERROR_QUANTITY = "Insufficient stock quantity"; // Số lượng trong kho không đủ
    public const MESS_ORDER_HISTORY = [
        'cancel' => "You have successfully canceled the order", // Bạn đã hủy đơn hàng thành công
        'confirm' => "You have successfully received the order", // Bạn đã nhận hàng thành công
        'delete' => "You have successfully deleted the order", // Bạn đã xóa đơn hàng thành công
        'reorder' => "You have successfully reordered", // Bạn đã đặt lại đơn hàng thành công
    ];
}
?>
