<?php

return [
    'nav' => [
        'order_list' => 'Đơn hàng',
        'product_list' => 'Sản phẩm',
        'category_list' => 'Danh mục',
        'customer_list' => 'Khách hàng',
    ],
    'order' => [
        'list' => [
            'title' => 'Danh sách Order',
            'form_search' => [
                'period' => 'Ngày tạo',
                'order_ID' => 'Order ID',
                'customer_name' => 'Tên khách hàng',
                'btn_search' => 'Tìm kiếm',
                'btn_download_csv' => 'Tải xuống CSV',
            ],
            'table' => [
                'total_money' => 'Tổng số tiền',
                'order_ID' => 'Order ID',
                'order_start_date' => 'Ngày tạo Order',
                'status' => 'Trạng thái',
                'customer_name' => 'Tên khách hàng'
            ]
        ],
        'order_status' => [
            'pending' => 'Đang chờ',
            'success' => 'Thành công',
            'canceled' => 'Đã huỷ',
        ],
        'detail' => [
            'product_ID' => 'ID sản phẩm',
            'product_name' => 'Tên sản phẩm',
            'quantity' => 'Số lượng',
            'price' => 'Giá'
        ]
    ],
    'product' => [
        'title' => 'Product List',
        'form_search' => [
            'product_ID' => 'ID sản phẩm',
            'product_name' => 'Tên sản phẩm',
            'btn_search' => 'Tìm kiếm',
            'btn_download' => 'Tải xuống',
            'btn_create' => 'Tạo',
        ],
        'table' => [
            'product_ID' => 'ID sản phẩm',
            'product_code' => 'Mã sản phẩm',
            'product_name' => 'Tên sản phẩm',
            'product_price' => 'Giá',
            'product_amount' => 'Số lượng',
            'product_category' => 'Danh mục',
            'product_action' => 'Hành động',
            'product_description' => 'Mô tả',
        ],
        'image_product' => 'Ảnh sản phẩm'
    ],
    'category' => [
        'title' => 'Danh sách danh mục',
        'form_search' => [
            'category_ID' => 'ID danh mục',
            'category_name' => 'Tên danh mục',
            'btn_search' => 'Tìm kiếm',
            'btn_create' => 'Tạo',
        ],
        'table' => [
            'ID' => 'ID',
            'category_ID' => 'ID danh mục',
            'category_name' => 'Tên danh mục',
            'create_date' => 'Ngày tạo',
            'category_action' => 'Hiển thị',
            'category_note' => 'Ghi chú',
        ]
    ],
    'customer' => [
        'title' => 'Danh sách Khách hàng',
        'form_search' => [
            'customer_ID' => 'ID khách hàng',
            'customer_name' => 'Tên khách hàng',
            'btn_search' => 'Tìm kiếm',
            'btn_download' => 'Tải xuống'
        ],
        'table' => [
            'customer_ID' => 'ID khách hàng',
            'customer_name' => 'Tên khách hàng',
            'customer_gender' => 'Giới tính',
            'customer_phone' => 'Điện thoại',
            'customer_birthday' => 'Ngày sinh',
            'customer_email' => 'Email',
        ]
    ],
    'general' => [
        'btn_cancel' => 'Huỷ',
        'btn_create' => 'Tạo',
        'btn_edit' => 'Sửa',
        'btn_update' => 'Cập nhật',
        'btn_delete' => 'Xoá',
        'btn_yes' => 'Đồng ý',
        'btn_no' => 'Không',
    ]
];