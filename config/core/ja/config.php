<?php
return [
    // form
    'default_option' => ['' => '選択してください'],
    'user' => [
        // user auth type
        'auth_types' => array(
            0 => 'マスター権限',
            1 => '本部権限',
            2 => '営業権限',
        ),

        // user group
        'groups' => array(
            1 => 'Aグループ',
            2 => 'Bグループ',
            3 => 'Cグループ',
        ),
    ],

    'application' => [
        'statuses' => [
            0 => 'ハズレ',
            1 => 'あたり',
        ]
    ],
    'presents'=> [
        'types' => [
            0 => '1点応募',
            1 => '5点応募'
        ]
    ],
    // another
    // file info
    'file' => array(
        'default' => [
            'image' => [
                'ext' => array('jpeg', 'jpg', 'png', 'gif'),
                'size' => ['min' => 0.01, 'max' => 2], // MB
            ]
        ],
        'admin' => [
            'avatar' => array(
                'size' => ['min' => 0.01, 'max' => 2], // MB
                'ext' => ['jpeg', 'jpg', 'png', 'mp4', 'mov'],
                'id' => 'image',
                'class' => 'img-crop',
                'aspect_ratio' => 9 / 9,

            )
        ],
        'presents' => [
            'image' => array(
                'size' => ['min' => 0.01, 'max' => 2], // MB
                'ext' => ['jpeg', 'jpg', 'png'],
                'id' => 'image',
//                'class' => 'img-crop',
                'aspect_ratio' => 16 / 9,
            )
        ]
    ),
    'csv' => [
        'export' => [
            'admin' => [
                'filename_prefix' => 'Admin',
                'header' =>
                    [
                        'id' => 'ID',
                        'email' => 'Email',
                        'avatar' => 'Avatar',
                        'ins_date' => 'Created at',
                        'upd_date' => 'Updated at',
                    ],
            ],
            'customer' => [
                'filename_prefix' => 'Customer',
                'header' => [
                    'id' => 'ID',
                    'first_name' => 'First name',
                    'last_name' => 'Last name',
                    'email' => 'メールアドレス',
                    'point' => '応募ポイント',
                    'ins_datetime' => '登録日時',
                    'upd_datetime' => '更新日時',
                ]
            ],
            'serial_numbers' => [
                'filename_prefix' => 'Serial_numbers',
                'header' => [
                    'id' => 'ID',
                    'serial_number' => 'シリアルナンバー',
                    'key' => 'シリアルナンバーキー',
                    'ins_datetime' => '登録日時',
                ],
            ],
        ],
        'import' => [
            'shipping' => [
                '応募ID' => 'id',
                '﻿配送ID' => 'id',
                '名前' => 'first_name',
                'ユーザメールアドレス' => 'email',
                '住所' => 'address',
                '参加した店舗' => 'store_list',
                '電話番号' => 'tel',
                '発送フラグ' => 'shipping_flg'
            ]
        ]
    ],
    'quantities' => [
        5000 => 5000,
        10000 => 10000,
        50000 => 50000,
        getConstant('MAX_QUANTITY') => getConstant('MAX_QUANTITY'),
    ],
    'prefs' => [
        1 => '北海道',
        2 => '青森県',
        3 => '岩手県',
        4 => '宮城県',
        5 => '秋田県',
        6 => '山形県',
        7 => '福島県',
        8 => '茨城県',
        9 => '栃木県',
        10 => '群馬県',
        11 => '埼玉県',
        12 => '千葉県',
        13 => '東京都',
        14 => '神奈川県',
        15 => '新潟県',
        16 => '富山県',
        17 => '石川県',
        18 => '福井県',
        19 => '山梨県',
        20 => '長野県',
        21 => '岐阜県',
        22 => '静岡県',
        23 => '愛知県',
        24 => '三重県',
        25 => '滋賀県',
        26 => '京都府',
        27 => '大阪府',
        28 => '兵庫県',
        29 => '奈良県',
        30 => '和歌山県',
        31 => '鳥取県',
        32 => '島根県',
        33 => '岡山県',
        34 => '広島県',
        35 => '山口県',
        36 => '徳島県',
        37 => '香川県',
        38 => '愛媛県',
        39 => '高知県',
        40 => '福岡県',
        41 => '佐賀県',
        42 => '長崎県',
        43 => '熊本県',
        44 => '大分県',
        45 => '宮崎県',
        46 => '鹿児島県',
        47 => '沖縄県'
    ],
    'throttle' => ['times' => 60, 'minute' => 1],

    // social
    'social' => [
        'login' => [
            'show_popup_register_mode' => 'off'
        ]
    ],
    'shipping' => [
        'shipping_flg' => [
            ''=>'未配送',
            '0' => '未配送',
            '1' => '配送済',
        ]
    ]
];
