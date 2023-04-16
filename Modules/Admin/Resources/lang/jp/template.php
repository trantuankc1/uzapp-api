<?php

return [
    'nav' => [
        'order_list' => 'Order',
        'product_list' => 'Product',
        'category_list' => 'Category',
        'customer_list' => 'Customer',
    ],
    'order' => [
        'list' => [
            'title' => 'Order List',
            'form_search' => [
                'period' => 'Period',
                'order_ID' => 'Order ID',
                'customer_name' => 'Customer Name',
                'btn_search' => 'Search',
                'btn_download_csv' => 'Download CSV',
            ],
            'table' => [
                'total_money' => 'Total Money',
                'order_ID' => 'Order ID',
                'order_start_date' => 'Order Start Date',
                'status' => 'Status',
                'customer_name' => 'Customer Name'
            ]
        ],
        'order_status' => [
            'pending' => 'Pending',
            'success' => 'Succeeded',
            'canceled' => 'Canceled',
        ],
        'detail' => [
            'product_ID' => 'Product ID',
            'product_name' => 'Product Name',
            'quantity' => 'Quantity',
            'price' => 'Price'
        ]
    ],
    'product' => [
        'title' => 'Product List',
        'form_search' => [
            'product_ID' => 'Product ID',
            'product_name' => 'Product Name',
            'btn_search' => 'Search',
            'btn_download' => 'Download',
            'btn_create' => 'Create',
        ],
        'table' => [
            'product_ID' => 'Product ID',
            'product_code' => 'Product Code',
            'product_name' => 'Product Name',
            'product_price' => 'Price',
            'product_amount' => 'Amount',
            'product_category' => 'Category',
            'product_action' => 'Action',
            'product_description' => 'Description',
            'image_product' => 'Product Image'
        ],
    ],
    'category' => [
        'title' => 'Category List',
        'form_search' => [
            'category_ID' => 'Category ID',
            'category_name' => 'Category Name',
            'btn_search' => 'Search',
            'btn_create' => 'Create',
        ],
        'table' => [
            'ID' => 'ID',
            'category_ID' => 'Category ID',
            'category_name' => 'Category Name',
            'create_date' => 'Create Date',
            'category_action' => 'Show',
            'category_note' => 'Note',
        ]
    ],
    'customer' => [
        'title' => 'Customer List',
        'form_search' => [
            'customer_ID' => 'Customer ID',
            'customer_name' => 'Customer Name',
            'btn_search' => 'Search',
            'btn_download' => 'Download'
        ],
        'table' => [
            'customer_ID' => 'Customer ID',
            'customer_name' => 'Customer Name',
            'customer_gender' => 'Gender',
            'customer_phone' => 'Phone Number',
            'customer_birthday' => 'Birthday',
            'customer_email' => 'Email',
        ]
    ],
    'general' => [
        'btn_cancel' => 'Cancel',
        'btn_create' => 'Create',
        'btn_edit' => 'Edit',
        'btn_update' => 'Update',
        'btn_delete' => 'Delete',
        'btn_yes' => 'Yes',
        'btn_no' => 'No',
    ]
];