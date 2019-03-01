<?php
return [
    // migrate // set empty if have no using
    'default_auth_id' => 1,
    'created_at_column' => ['field' => 'ins_datetime', 'comment' => '登録日時'],
    'updated_at_column' => ['field' => 'upd_datetime', 'comment' => '更新日時'],
    'deleted_at_column' => [],
    'del_flag_column' => ['field' => 'del_flag', 'comment' => '削除フラグ', 'active' => 0, 'deleted' => 1],
    'created_by_column' => ['field' => 'ins_id', 'comment' => '登録者ID'],
    'updated_by_column' => ['field' => 'upd_id', 'comment' => '更新者ID'],
    'deleted_by_column' => [],
    'status_column' => [],
    // route
    'backend_alias' => env('BACKEND_ALIAS', 'management'),
    'backend_domain' => env('BACKEND_DOMAIN', ''),
    'frontend_alias' => env('FRONTEND_ALIAS', '/'),
    'frontend_domain' => env('FRONTEND_DOMAIN', ''),
    'api_alias' => env('API_ALIAS', 'v1'),
    'api_domain' => env('API_DOMAIN', ''),
    'back_url_limit' => 200,
    //auth
    'backend_guard' => 'admins',
    'frontend_guard' => 'frontend',
    'api_guard' => 'api',
    'guest_guard' => 'guest',
    //log
    'log_dir' => storage_path('logs'),
    'log_info_filename' => 'info',
    'log_error_filename' => 'errors',
    'log_warning_filename' => 'warning',
    'log_debug_filename' => 'debug',
    'log_api_filename' => 'api',
    'sql_log' => env('SQL_LOG', true),
    'enabled_log_viewer' => env('ENABLED_LOG_VIEWER', env('APP_ENV') != 'production'),
    'log_viewer_password' => env('LOG_VIEWER_PASSWORD', 'AsEgxSuP'),
    'app_log_param' => env('APP_LOG_PARAM', env('APP_ENV') != 'production'),
    'trans_with_editor' => env('TRANS_WITH_EDITOR', env('APP_ENV') != 'production'),
    // static version
    'static_version' => strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? time() : env('STATIC_VERSION', '0.0.1'),
    // upload
    'tmp_upload_dir' => 'tmp_uploads',
    'media_dir' => 'media',
    // class default
    'form_class_default' => ' form-control ',
    'form_open_class_default' => ' form-horizontal ',
];
