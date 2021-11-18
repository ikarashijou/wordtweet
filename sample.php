<?php
// TwitterOAuthを利用するためComposerのautoload.phpを読み込み
require __DIR__ . '/vendor/autoload.php';
// TwitterOAuthクラスをインポート
use Abraham\TwitterOAuth\TwitterOAuth;

require_once('/word/Contorollers/Controller.php');
$Controller = new Controller();

// Twitter APIを利用するための認証情報。xxxxxxxxの箇所にそれぞれの情報をセット
$CK = 'aZxlWZVhUG2dQo3Ll7S9AnXFA'; // Consumer Keyをセット
$CS = 'fNgC76sJ6stjkJ0N0SPdyDxZNgNInOtrTMCXQjhcJLlwzCkc3o'; // Consumer Secretをセット
$AT = '1433094195481219079-xk12hD5UbSPz3PYcfHwmjxU5clOQKq'; // Access Tokenをセット
$AS = 'BYy85YEh52BIe9urAnkh8gpiKnPBF39M9tBuXapvRvgVb'; // Access Token Secretをセット

// TwitterOAuthクラスのインスタンスを作成
$connect = new TwitterOAuth( $CK, $CS, $AT, $AS );

$tweet_shugo = $Controller->shugodata_text_select();
$tweet_jutugo = $Controller->jutugodata_text_select();

$value_shugo = array();
$value_jutugo = array();

foreach($tweet_shugo as $value){
    array_push($value_shugo,$value['text']);
}
foreach($tweet_jutugo as $value){
    array_push($value_jutugo,$value['text']);
}

$tweet_shugo_randa = $value_shugo[array_rand($tweet_shugo)];
$tweet_jutugo_randa = $value_jutugo[array_rand(($tweet_jutugo))];

$tweet = $tweet_shugo_randa.$tweet_jutugo_randa;

$result = $connect->post(
    'statuses/update',
    array(
		// 投稿するツイートを指定
        'status' => $tweet
    )
);
