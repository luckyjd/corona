
コロナウインターエスケープ キャンペーン
プレゼント当選者よりフォームに入力がありました。

━━━━━━━━━━━━━━━━━━━

姓：{{$data['last_name']}}
名：{{$data['first_name']}}
Emailアドレス：{{$data['email']}}
郵便番号：{{$data['zip_code']}}
都道府県：{!! getConfig('prefs')[$data['pref_id']] !!}
ご住所：{{$data['address']}}
お電話番号：{{$data['tel']}}
キャンペーンに参加した店舗：{{$data['store_list']}}
プレゼント名：{{$data['presentName']}}

━━━━━━━━━━━━━━━━━━━


