<?php

require_once('LineBot.php');

// LINE:チャンネルID
//$CHANNEL_ID = '';
// LINE:チャンネルシークレット
//$CHANNEL_SECRET = '';
// LINE:MID
//$CHANNEL_MID = '';
$ACCESS_TOKEN = '`アクセストークン`';

// Bingアカウントキー
// $ACCOUNT_KEY = '[Bing Search APIのアカウントキー]';

//$bot = new LineBot($CHANNEL_ID, $CHANNEL_SECRET, $CHANNEL_MID);
$bot = new LineBot($ACCESS_TOKEN);
$bot->sendText('「%s」でチュ〜');
//$bot->sendImage($ACCOUNT_KEY);
