<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'The :attribute must be accepted.',
    'active_url'           => 'The :attribute is not a valid URL.',
    'after'                => 'The :attribute must be a date after :date.',
    'after_or_equal'       => 'The :attribute must be a date after or equal to :date.',
    'alpha'                => 'The :attribute may only contain letters.',
    'alpha_dash'           => 'The :attribute may only contain letters, numbers, and dashes.',
    'alpha_num'            => 'The :attribute may only contain letters and numbers.',
    'array'                => 'The :attribute must be an array.',
    'before'               => 'The :attribute must be a date before :date.',
    'before_or_equal'      => 'The :attribute must be a date before or equal to :date.',
    'between'              => [
        'numeric' => ':attributeは:min〜:max整数のみで入力してください。',
        'file'    => 'The :attribute must be between :min and :max kilobytes.',
        'string'  => 'The :attribute must be between :min and :max characters.',
        'array'   => 'The :attribute must have between :min and :max items.',
    ],
    'boolean'              => 'The :attribute field must be true or false.',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'The :attribute is not a valid date.',
    'date_format'          => ':attributeが不正です。',
    'different'            => ':attributeと:otherは違う値を入力してください。',
    'digits'               => ':attribute は :digits 数字で入力してください。.',
    'digits_between'       => ':attributeの長さは:min～:maxまでの数値の入力しか許可しません。',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'The :attribute field has a duplicate value.',
    'email'                => ':attributeはメールのフォーマットで入力してください。',
    'exists'               => ':attributeは存在していません。',
    'custom_exists'        => ':attributeは存在していません。',
    'file'                 => 'The :attribute must be a file.',
    'filled'               => 'The :attribute field must have a value.',
    'image'                => 'The :attribute must be an image.',
    'in'                   => ':attributeが不正です。',
    'in_array'             => ':attributeが不正です。',
    'integer'              => ':attributeは整数で入力してください。',
    'ip'                   => 'The :attribute must be a valid IP address.',
    'json'                 => 'The :attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => ':attributeは:maxより小さな数字を入力してください。',
        'file'    => ':attributeのサイズは:max MB未満にしてください。',
        'string'  => ':attributeは:max文字以内で入力してください。',
        'array'   => 'The :attribute may not have more than :max items.',
    ],
    'mimes'                => ':attributeのファイル形式は「:values」にしてください。',
    'mimetypes'            => ':attributeのファイル形式は「:values」にしてください。',
    'min'                  => [
        'numeric' => ':attributeは:minより大きな数字を入力してください。',
        'file'    => ':attributeのサイズは:min MBを超えるようにしてください。',
        'string'  => ':attributeは:min文字最小で入力してください。',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'phone'               => ':attributeが不正です。',
    'not_in'               => ':attributeが不正です。',
    'numeric'              => ':attributeは数値で入力してください。',
    'present'              => 'The :attribute field must be present.',
    'regex'                => ':attributeが不正です。',
    'not_empty'            => ':attribute は必須です。',
    'required'             => ':attributeは必須です。',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => ':attributeは必須です。',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => ':attribute、 :otherドが一致しません。',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => ':attribute は :size 数字で入力してください。.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => ':attributeは存在しています。',
    'custom_unique'        => ':attributeは存在しています。',
    'field_unique'         => ':attributeは存在しています。',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => ':attributeはURLのフォーマットで入力してください。',
    'greater_than_field'   => ':attribute＞:otherとなるように入力してください。',
    'greater_than_or_equal_field'   => ':attribute≧:otherとなるように入力してください。',
    'greater_than_or_equal_time_field'   => ':attribute≧:otherとなるように入力してください。',
    'less_than_field'      => ':attribute＜:otherとなるように入力してください。',
    'less_than_or_equal_field'   => ':attribute≦:otherとなるように入力してください。',
    'katakana'             => ':attributeはカタカナで入力してください。',
    'array_required'             => ':attributeは必須です。',
    'with_app_type'             => ':attributeが不正です。',

    // validate
    'VALIDATE_IS_NUMERIC_HALF_WIDTH'    => "%sは半角数値で入力してください。",
    'VALIDATE_DATETIME_GREATER_THAN'    => "%sより未来日時の入力をしてください。",
    'VALIDATE_IS_ARRAY'                 => "%sが不正です。",
    'VALIDATE_FORMAT_HOUR'              => "%sは時刻形式で入力してください。",
    'VALIDATE_ITEMS_ARE_NUMERICS'       => "%sは不正です。",
    'VALIDATE_IS_INVALID'               => '%sが不正です。',
    'VALIDATE_RE_PASSWORD'              => '新しいパスワードと一致しません。',
    'VALIDATE_LOGIN_ID_EXISTED'         => 'メールアドレス(ID)が存在しています。',
    'VALIDATE_STORE_ID_EXISTED'         => '入力されたメールアドレスは登録済の為、登録できません。詳細はお電話にてお問い合わせください。',
    'VALIDATE_EMAIL_NOT_CORRECT'        => 'メールアドレスが不正です。',
    'VALIDATE_NO_FILE_UPLOAD'           => 'VALIDATE_NO_FILE_UPLOAD。',
    'VALIDATE_FORMAT'                   => '%sのフォーマットが不正です。',
    'VALIDATE_DECIMAL_NUMBER'           => '%sの少数は第%s位まで入力してください。',
    'VALIDATE_KATAKANA'                 => '%sはカタカナで入力してください。',
    'VALIDATE_CANNOT_ALLOW_CHANGE'      => '%sは入力できません。',
    'VALIDATE_URL'                      => "%sはURLのフォーマットで入力してください。",
    'VALIDATE_UNIQUE_POSITION'          => '同じ商品 && 同じ台 && 同じ段(y) && 同じ位置(x) の場合には登録できません。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
