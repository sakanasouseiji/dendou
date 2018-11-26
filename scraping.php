<?php
//
//
require_once("./function.php");


//イオンバイク取得urt(テスト用)


//代入用クラス(イオンバイク)
class AeonShop{
	public	$FirstPage=1;
	public	$page;
	//ここからイオンバイク用取得パターン
	//最初に枠取得用パターン
	public	$firstPattern='/StyleD_Item(.*?)\/table>/s';
	//商品名取得用パターン
	public	$itemPattern="/title=\".*?\"><img alt/s";
	//値段取得用パターン
	public	$zeinukiPattern="/font-size:16px\">.*?<\/span>/";
	public	$zeikomiPattern="/font-size:12px\">.*?<\/span>/";

	//削除用パターン
	//商品名用
	public	$itemDeletePattern=array("title=\"","\"><img alt");

	//値段
	public	$zeinukiDeletePattern=array("font-size:16px\">","</span>");
	//
	public	$zeikomiDeletePattern=array("font-size:12px\">","</span>");


	function url($page){
		return 'https://www.aeonbike.co.jp/shop/category/category.aspx?category=020103&sort=sp&p='.$page.'&s_stock_list=#top';
	//イオンバイク用取得パターンここまで
	}	
}
$shop=new AeonShop();

$ShopScraping=new ShopScraping($shop);
$result=$ShopScraping->All();
print_r($ShopScraping);

/*

$itemName=array();
$zeinukiPrice=array();
$zeikomiPrice=array();
$finalResult="";

//クッキー取得のためのURL
//ここにアクセスすればクッキーにフラグが立つというページ
$scrap=scraping($url);
//スクレイピングファイル出力
file_put_contents('scrap.html',$scrap,LOCK_EX);




//ここから抽出
preg_match_all($firstPattern,$scrap,$array);

//preg_match_allファイル出力
error_log(var_export($array[0],true),3,"./scrap2.html");


//必要なのは全体検索の結果のみ
$array=$array[0];

file_put_contents('array.html',$array,LOCK_EX);

foreach($array as $key => $cell){
	preg_match($itemPattern,$cell,$itemName);
	preg_match($zeinukiPattern,$cell,$zeinukiPrice);
	preg_match($zeikomiPattern,$cell,$zeikomiPrice);

	$itemName[0]=str_replace($itemDeletePattern,"",$itemName[0]);
	$zeinukiPrice[0]=str_replace($zeinukiDeletePattern,"",$zeinukiPrice[0]);
	$zeikomiPrice[0]=str_replace($zeikomiDeletePattern,"",$zeikomiPrice[0]);


	$finalResult.=$itemName[0]."\n";
	$finalResult.=$zeinukiPrice[0]."\n";
	$finalResult.=$zeikomiPrice[0]."\n";
}
print $finalResult;
file_put_contents('finalResult.txt',$finalResult,LOCK_EX);
*/
?>
