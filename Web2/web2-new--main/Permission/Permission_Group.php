<?php
    $permissions = [    
    'NhanVien' => [
        'sanpham' => ['view', 'add', 'edit', 'delete'],
        'order' => ['view'],
        'account' => ['view'],
        'statistics' => ['view']
    ],
    'Admin' => [
        'sanpham' => ['view', 'add', 'edit', 'delete'],
        'order' => ['view', 'add', 'edit', 'delete'],
        'account' => ['view', 'add', 'edit', 'delete'],
        'statistics' => ['view', 'add', 'edit', 'delete']
    ]
    ];

    
?>