<?php
//
//
require_once("./function.php");


//さいくるべーすあさひ取得urt(テスト用)


//代入用クラス(さいくるべーすあさひ)
class AsahiShop{
	public	$FirstPage=0;
	public	$page;
	//ここからあさひ用取得パターン
	//最初に枠取得用パターン
	public	$firstPattern='/list_item_product_sli_list_col2.*</noscript></div>/';
	//商品名取得用パターン
	public	$itemPattern="";
	//値段取得用パターン
	public	$zeinukiPattern="";
	public	$zeikomiPattern="";

	//削除用パターン
	//商品名用
	public	$itemDeletePattern=array("");

	//値段
	public	$zeinukiDeletePattern=array("");
	//
	public	$zeikomiDeletePattern=array("");


	function url($page){
		$page=$page*24
		return 'https://ec.cb-asahi.co.jp/category/cat1/%E9%9B%BB%E5%8B%95%E8%87%AA%E8%BB%A2%E8%BB%8A/'.$page.'?isort=price';
	//あさひ用取得パターンここまで
	}	
}
$shop=new AsahiShop();

$ShopScraping=new ShopScraping($shop);
$result=$ShopScraping->All();

?>
