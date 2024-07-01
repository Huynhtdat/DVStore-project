<?php
if (!function_exists('TextLayoutSidebar')) {
    function TextLayoutSidebar($key)
    {
        $const = [
            "overview"              => "Tổng quan",
            "dashboard"             => "Bảng điều khiển",
            "statistical"           => "Thống kê",
            "website_management"    => "Quản lý website",
            "order"                 => "Đơn hàng",
            "category"              => "Danh mục",
            "product"               => "Sản phẩm",
            "producer"              => "Nhà sản xuất",
            "payment"               => "Thanh toán",
            "customer"              => "Khách hàng",
            "admin"                 => "Quản trị viên",
            "discount_code"         => "Mã giảm giá",
            "configuration"         => "Cấu hình website",
            "setting"               => "Cài đặt",
            "banner"                => "Biểu ngữ",
            "reset"                 => "Đặt lại",
            "logout"                => "Đăng xuất",
            "infomations"           => "Quản lý cá nhân",
            "profile"               => "Hồ sơ",
            "change_password"       => "Đổi mật khẩu",
            "administrators"        => "Nhân sự",
            "category"              => "Danh mục",
            "color"                 => "Màu sắc",
            "brand"                 => "Nhãn hiệu",
            "payment_method"        => "Cổng thanh toán",
            "order"                 => "Đơn hàng",
            "size"                  => "Kích cỡ",
            "setting"               => "Cấu hình",
        ];
        return $const[$key];
    }
}

if (!function_exists('TextLayoutTitle')) {
    function TextLayoutTitle($index)
    {
        $const = [
            "dashboard"             => "Bảng điều khiển",
            "statistical"           => "Thống kê",
            "order"                 => "Quản lý đơn hàng",
            "category"              => "Danh mục sản phẩm",
            "product"               => "Quản lý sản phẩm",
            "producer"              => "Quản lý nhà sản xuất",
            "payment"               => "Quản lý thanh toán",
            "customer"              => "Quản lý khách hàng",
            "staff"                 => "Quản lý nhân viên",
            "discount_code"         => "Quản lý mã giảm giá",
            "setting"               => "Cài đặt website",
            "banner"                => "Cài đặt biểu ngữ",
            "reset"                 => "Đặt lại website",
            "create_user"           => "Thêm khách hàng mới",
            "create_edit"           => "Chỉnh sửa khách hàng",
            "profile"               => "Hồ sơ cá nhân",
            "change_password"       => "Đổi mật khẩu",
            "administrators"        => "Quản lý nhân sự",
            "create_admin"          => "Thêm quản trị viên mới",
            "create_product"        => "Thêm sản phẩm mới",
            "create_category"       => "Thêm danh mục mới",
            "edit_category"         => "Chỉnh sửa danh mục",
            "color"                 => "Quản lý màu sắc",
            "edit_color"            => "Chỉnh sửa màu sắc",
            "create_color"          => "Thêm màu sắc mới",
            "create_brand"          => "Thêm nhãn hiệu mới",
            "edit_brand"            => "Chỉnh sửa nhãn hiệu",
            "brand"                 => "Quản lý nhãn hiệu",
            "payment_method"        => "Phương thức thanh toán",
            "order_detail"          => "Chi tiết đơn hàng",
            "size"                  => "Quản lý kích cỡ",
            "create_size"           => "Thêm kích cỡ mới",
            "edit_size"             => "Chỉnh sửa kích cỡ",
            "edit_admin"            => "Chỉnh sửa quản trị viên",
            "edit_product"          => "Chỉnh sửa sản phẩm",
            "edit_payment"          => "Chỉnh sửa phương thức thanh toán"
        ];
        return $const[$index];
    }
}
?>
