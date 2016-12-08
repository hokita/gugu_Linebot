<?php

require_once('LineBot.php');

// ここに指定のアクセストークンを入れる。
$ACCESS_TOKEN = "アクセストークン";

$bot = new LineBot($ACCESS_TOKEN);
// ユーザーから送られてきた本文に付け加えて返す。
$bot->sendText("「%s」でチュ〜");
