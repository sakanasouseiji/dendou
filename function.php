<?php
/*
 * cookie必要サイトのスクレイピングの為のcURL利用関数,
 * 中身はweb検索のほぼマルコピ
 * コピ元
 * https://mayer.jp.net/?p=2599
 * 
 * 参考によし
 * https://qiita.com/kumasun/items/f7d17e7e74be5d441b29
 * cURLは要調べ
 *
 */



function scraping($url){
	//最終的にアクセスしたいページ
	//クッキーがないとアクセスできない

	//クッキー取得のためのアクセス
	$ch=curl_init();//初期化
	curl_setopt($ch,CURLOPT_URL,$url);//cookieを取得ページへ取りに行く
	curl_setopt($ch,CURLOPT_HEADER,FALSE);//httpヘッダ情報は表示しない
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);//データをそのまま出力
	curl_setopt($ch,CURLOPT_COOKIEJAR,'cookie.txt');//$cookieから取得した情報を保存するファイル名
	curl_setopt($ch,CURLOPT_FOLLOWLOCATION,TRUE);//Locationヘッダの内容をたどっていく
	curl_exec($ch);
	curl_close($ch);//いったん終了

	//見たいページにアクセス

	$ch=curl_init();
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_HEADER,FALSE);
	curl_setopt($ch,CURLOPT_COOKIEFILE, 'cookie.txt');//cookie情報を読み取る
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
	curl_setopt($ch,CURLOPT_FOLLOWLOCATION,TRUE);
	$html=curl_exec($ch);
	curl_close($ch);

//	
//	mb_language('Japanese');
//	$html=mb_convert_encoding($html,'utf8','auto');//UTF-8に変換


	return $html;
}
?>
