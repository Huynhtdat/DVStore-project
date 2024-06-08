<?php
if (!function_exists('TextLayoutSidebar')) {
    function TextLayoutSidebar($key)
    {
        $const = [
            "overview"              => "Overview",
            "dashboard"             => "Dashboard",
            "statistical"           => "Statistics",
            "website_management"    => "Website Management",
            "order"                 => "Orders",
            "category"              => "Categories",
            "product"               => "Products",
            "producer"              => "Producers",
            "payment"               => "Payments",
            "customer"              => "Customers",
            "admin"                 => "Admin",
            "discount_code"         => "Discount Codes",
            "configuration"         => "Website Configuration",
            "setting"               => "Settings",
            "banner"                => "Banner",
            "reset"                 => "Reset",
            "logout"                => "Logout",
            "infomations"           => "Personal Management",
            "profile"               => "Profile",
            "change_password"       => "Change Password",
            "administrators"        => "Human Resources",
            "category"              => "Categories",
            "color"                 => "Colors",
            "brand"                 => "Brands",
            "payment_method"        => "Payment Gateways",
            "order"                 => "Orders",
            "size"                  => "Sizes",
            "setting"               => "Configuration",
        ];
        return $const[$key];
    }
}

if (!function_exists('TextLayoutTitle')) {
    function TextLayoutTitle($index)
    {
        $const = [
            "dashboard"             => "Dashboard",
            "statistical"           => "Statistics",
            "order"                 => "Order Management",
            "category"              => "Product Categories",
            "product"               => "Product Management",
            "producer"              => "Producer Management",
            "payment"               => "Payment Management",
            "customer"              => "Customer Management",
            "staff"                 => "Staff Management",
            "discount_code"         => "Discount Code Management",
            "setting"               => "Website Settings",
            "banner"                => "Banner Settings",
            "reset"                 => "Reset Website",
            "create_user"           => "Add New Customer",
            "create_edit"           => "Edit Customer",
            "profile"               => "Personal Profile",
            "change_password"       => "Change Password",
            "administrators"        => "HR Management",
            "create_admin"          => "Add New Admin",
            "create_product"        => "Add New Product",
            "create_category"       => "Add New Category",
            "edit_category"         => "Edit Category",
            "color"                 => "Color Management",
            "edit_color"            => "Edit Color",
            "create_color"          => "Add New Color",
            "create_brand"          => "Add New Brand",
            "edit_brand"            => "Edit Brand",
            "brand"                 => "Brand Management",
            "payment_method"        => "Payment Methods",
            "order_detail"          => "Order Details",
            "size"                  => "Size Management",
            "create_size"           => "Add New Size",
            "edit_size"             => "Edit Size",
            "edit_admin"            => "Edit Admin",
            "edit_product"          => "Edit Product",
            "edit_payment"          => "Edit Payment Method"
        ];
        return $const[$index];
    }
}
?>
