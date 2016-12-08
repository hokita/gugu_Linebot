<?php

class LineBot
{
	const API_URL = 'https://api.line.me/v2/bot/message/reply';
	public $access_token;
	public $response_header;
	public $reply_token;
	public $user_text;

	public function __construct($access_token = null)
	{
		$this->access_token = $access_token;
		// headerの作成
		$this->response_header = array(
			'Content-Type: application/json;',
			'Authorization: Bearer ' . $this->access_token
		);

		$event = $this->getEvent();
		// replytokenの取得
		$reply_token = $event->{"replyToken"};
		// ユーザーから送られてきた本文を取得
		$user_text = $event->{"message"}->{"text"};
	}

	// ユーザーから送られてきた情報を取得
	private function getEvent(){
		$obj = json_decode(file_get_contents("php://input"));
		$event = $obj->{"events"}[0];
		return $event;
	}

	// ユーザーにテキストを送る。
	public function sendText($format = null)
	{
		$response_text = "";
		if ($format) {
			$response_text = sprintf($format, $user_text);
		} else {
			$response_text = $user_text;
		}

		$post = [
			"replyToken" => $reply_token,
			"messages" => array(
				array(
					"type" => "text",
					"text" => $response_text
				)
			)
		];
		return $this->sendMessage($post);
	}

	// Message APIを使用してユーザーにLineを送る。
	public function sendMessage($post_data)
	{
		$ch = curl_init(self::API_URL);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->response_header);
		$result = curl_exec($ch);
		curl_close($ch);
		// logの出力
		error_log(print_r('[' . date("Y-m-d H:i:s") . ']' . $result . "\n", true), 3, '../logs/result.log');

		return $result;
	}
}
