
<?php
//
//
require_once("./function.php");

//さいくるべーすあさひ取得urt(テスト用)


//代入用クラス(さいくるべーすあさひ)
class AsahiShop{
	public	$fileName="All";
	public	$shopName="サイクルベースあさひ";
	public	$FirstPage=0;
	public	$page;
	//ここからあさひ用取得パターン
	//最初に枠取得用パターン
	public	$firstPattern='/list_item__product sli_list_col2(.*?)<\/div><\/div>/ius';


	//商品名取得用パターン
	public	$itemPattern='/data-sli-test=\"resultlink\">(.*?)<\/a>/ius';
	//値段取得用パターン
	public	$zeinukiPattern='';
	public	$zeikomiPattern='/sli_price\">(.*?)<\/span>/ius';

	//リンク取得用パターン
	public	$linkPattern='<a data-tb-sid=\"st_title-link\" class="list_item__product__name\" rel=\"nofollow\" href=\"(.*)\">';
	public	$linkDeletePattern=array('<a data-tb-sid=\"st_title-link\" class=\"list_item__product__name\" rel="nofollow" href=','>');

	//カラー取得用パターン
	public	$kobetuColorPattern='/data-js-color-thumb-label=\".*\">/ius';	


	//削除用パターン
	//商品名用
	public	$itemDeletePattern=array("data-sli-test=\"resultlink\">\n","</a>");

	//値段
	public	$zeinukiDeletePattern=array("");
	//
	public	$zeikomiDeletePattern=array("sli_price\">￥","</span>");



	function url($page){
		$page=$page*24;
		return 'https://ec.cb-asahi.co.jp/category/cat1/%E9%9B%BB%E5%8B%95%E8%87%AA%E8%BB%A2%E8%BB%8A/'.$page.'?isort=price';
	//あさひ用取得パターンここまで
	}	
}



$shop=new AsahiShop();

$ShopScraping=new ShopScraping($shop);
$result=$ShopScraping->All();


?>
