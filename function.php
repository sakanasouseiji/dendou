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

class ShopScraping{
	public	$shop;
	public	$FirstPage;
	public	$page;
	public	$firstPattern;
	public	$itemPattern;
	public	$zeinukiPatternn;
	public	$zeikomiPattern;

	public	$itemDeletePattern;

	public	$zeinukiDeletePattern;
	public	$zeikomiDeletePattern;
	public	$url;
	public	$AllResult;
	function __construct($shop){
		//変数の代入
		$this->shop=$shop;
		

	}
	function All(){
		$page=$this->shop->FirstPage;

		do{
			$pageResult=$this->pageScraping($page);
			$this->AllResult.=$pageResult;
			$page++;
		}while($pageResult!=false or $pageResult!=0 or $page<9);	

		file_put_contents('finalResult.txt',$AllResult,LOCK_EX);

	}
	function pageScraping($page){

		$firstPattern=$this->shop->firstPattern;
		$itemPattern=$this->shop->itemPattern;
		$zeinukiPattern=$this->shop->zeinukiPattern;
		$zeikomiPattern=$this->shop->zeikomiPattern;
		$itemDeletePattern=$this->shop->itemDeletePattern;
		$zeinukiDeletePattern=$this->shop->zeinukiDeletePattern;
		$zeikomiDeletePattern=$this->shop->zeikomiDeletePattern;

		$url=$this->shop->url($page);
		print $url."\r\n";
		$firstPattern=$this->shop->firstPattern;

		$itemName=array();
		$zeinukiPrice=array();
		$zeikomiPrice=array();
		$pageResult="";

		//クッキー取得のためのURL
		//ここにアクセスすればクッキーにフラグが立つというページ
		$scrap=scraping($url);
		//スクレイピングファイル出力
		file_put_contents('pageScrap.html'.$page,$scrap,LOCK_EX);

		//ここから抽出

		$endFlag=preg_match_all($firstPattern,$scrap,$array);
		if(	$endFlag==0 or	$endFlag==false	){
			return false;
		}

		//preg_match_allファイル出力
		error_log(var_export($array[0],true),3,"./scrap2.html");


		//必要なのは全体検索の結果のみ
		$array=$array[0];

		file_put_contents('array'.$page.'.html',$array,LOCK_EX);

		foreach($array as $key => $cell){
			preg_match($itemPattern,$cell,$itemName);
			preg_match($zeinukiPattern,$cell,$zeinukiPrice);
			preg_match($zeikomiPattern,$cell,$zeikomiPrice);

			$itemName[0]=str_replace($itemDeletePattern,"",$itemName[0]);
			$zeinukiPrice[0]=str_replace($zeinukiDeletePattern,"",$zeinukiPrice[0]);
			$zeikomiPrice[0]=str_replace($zeikomiDeletePattern,"",$zeikomiPrice[0]);


			$pageResult.=$itemName[0]."\n";
			$pageResult.=$zeinukiPrice[0]."\n";
			$pageResult.=$zeikomiPrice[0]."\n";
		}
		print $pageResult;
		return $pageResult;
	}
}

?>
