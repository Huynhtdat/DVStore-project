<?php

namespace App\Helpers\admin;

class TextSystemConst
{
    public const EMAIL_EXIST_SYSTEM = "Email đã tồn tại trong hệ thống"; // Email already exists in the system
    public const CHANGE_PASSWORD_SUCCESS = "Thay đổi mật khẩu thành công"; // Password changed successfully
    public const PURCHASE_HISTORY = "Lịch sử mua hàng"; // Purchase History
    public const DELETE_SUCCESS = "Xóa thành công"; // Deleted successfully
    public const DELETE_FAILED = "Xóa thất bại"; // Deletion failed
    public const SYSTEM_ERROR = "Có lỗi xảy ra, vui lòng thử lại"; // An error occurred, please try again
    public const CREATE_SUCCESS = "Thêm thành công"; // Added successfully
    public const CREATE_FAILED = "Thêm thất bại, hãy thử lại"; // Addition failed, please try again
    public const UPDATE_SUCCESS = "Chỉnh sửa thông tin thành công"; // Information updated successfully
    public const UPDATE_FAILED = "Chỉnh sửa thất bại, hãy thử lại"; // Update failed, please try again
    public const CHANGE_PASSWORD = [
        'success' => 'Thay đổi mật khẩu thành công', // Password changed successfully
        'error' => 'Thực hiện thất bại, vui lòng thử lại' // Operation failed, please try again
    ];
    public const ORDER_PROCESSING = "Xử lý đơn hàng thành công"; // Order processed successfully
    public const ORDER_FAILED = "Xử lý đơn hàng thất bại"; // Order processing failed
    public const ADD_CART_ERROR_QUANTITY = "Số lượng trong kho không đủ"; // Insufficient stock quantity
    public const MESS_ORDER_HISTORY = [
        'cancel' => "Bạn đã hủy đơn hàng thành công", // You have successfully canceled the order
        'confirm' => "Bạn đã nhận hàng thành công", // You have successfully received the order
        'delete' => "Bạn đã xóa đơn hàng thành công", // You have successfully deleted the order
        'reorder' => "Bạn đã đặt lại đơn hàng thành công", // You have successfully reordered
    ];
}
?>
