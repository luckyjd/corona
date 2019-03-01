<?php

return [
    // add
    'create_success' => '登録しました。',
    'create_failed' => '登録に失敗しました。',
    // update
    'update_success' => '編集しました。',
    'update_failed' => '更新に失敗しました。',
    // delete
    'delete_success' => '削除しました。',
    'delete_failed' => '削除に失敗しました。',

    'change_success' => '変更しました。',
    'failed' => 'お手数ですが再度やり直して下さい。',
    // search
    'no_result_found' => '検索条件で指定したデータは存在しません。',
    'db_not_connect' => 'DBへの接続に失敗しました。予期せぬエラーが発生していますのでシステム管理者に連絡してください。',
    'url_not_found' => 'URLが不正です',
    // send mail
    'send_success' => '送信しました。',
    'send_failed' => '送信に失敗しました。',
    'reset_password_success' => '変更しました。',
    'reset_password_failes' => 'お手数ですが再度やり直して下さい。',
    'send_reset_link_success' => '再発行パスワードのメールを送信しました。:emailをご確認ください。',

    // download
    'download_failed' => 'ダウンロードに失敗しました。',
    'no_file_download' => ':typeのファイルがありません。',

    // mail subject
    'mail_admin_notify' => '【'.env('MAIL_FROM_NAME').'】見積り依頼',
    'mail_customer_notify' => 'ご予約申請中【'.env('MAIL_FROM_NAME').'】',
    'mail_reset_password' => 'パスワード再発行のご案内【'.env('MAIL_FROM_NAME').'】',
    'mail_gmo_payment_notify' => 'お支払完了のお知らせ【'.env('MAIL_FROM_NAME').'】',
    'mail_register_invoice_notify' => 'お支払い手続きのご案内 【'.env('MAIL_FROM_NAME').'】',

    // serial numbers
    'error_max_quantity' => '最大13万シリアナンバー以下を生成してください。',

    // presents
    'not_delete_present' => 'このプレゼントは削除できません。',
    'empty_present' => 'このプレゼントは空です',
    'user_no_win' =>  'あなたは勝てない、別の贈り物を選んで招待する',
    'user_win' => 'あなたは勝ちます',
    'user_not_enough_point' => '客室内に追加可能なエキストラベッド/ベビーベッド：',
    'email_exist' => 'メールアドレスは存在しています。',

    //register success
    'register_success' => 'あなたが正常に登録されています',

    //congrats
    'congrats_success' =>'',
    'mail_congrats_admin' => '【プレゼント当選者よりフォームに入力がありました】'.getConstant('MAIL_FROM_NAME').'',
    'mail_congrats_customer' => '【当選おめでとうございます】'.getConstant('MAIL_FROM_NAME').'',
    'mail_register_success' => '【登録完了のお知らせ】'.getConstant('MAIL_FROM_NAME').'',
    'mail_reset_success' => '【'.getConstant('MAIL_FROM_NAME').'のパスワードを再設定してください】',

    'upload_csv_again' => '正しいCSVファイルをアップロードしてください。',
    'upload_csv_success' => '数を更新しました。',
];
