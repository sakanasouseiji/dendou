
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
	public	$linkPattern='/st_title-link\" class="list_item__product__name\" rel=\"nofollow\" href=\"(.*)\" data-sli-test=\"resultlink/ius';
	public	$linkDeletePattern=array('st_title-link" class="list_item__product__name" rel="nofollow" href="','" data-sli-test="resultlink');

	//リンク修正パターン
	public	$linkReplacePattern=array("/^.*products%2f/ius","/&lgsku=[0-9]{5}$/ius");
	public	$linkReplacement=array("https:\/\/ec.cb-asahi.co.jp\/catalog\/products\/","");
	/*
	public	$linkReplacePattern="/[a-zA-Z0-9]{32}/ius";
	public	$linkReplacement="https:\/\/ec.cb-asahi.co.jp\/catalog\/products\/\\0";
	*/

	//カラー取得用パターン
	//public	$kobetuColorPattern='/(product_color_carousel_title.*<\/div><\/div><\/div><\/div><\/div>)(data-js-color-thumb-label=.*><img src)/ius';
	public	$kobetuColorPattern='/product_color_carousel_title.*page_container/ius';
	//削除用パターン
	//商品名用
	public	$itemDeletePattern=array("data-sli-test=\"resultlink\">\n","</a>");

	//値段
	public	$zeinukiDeletePattern=array("");
	//
	public	$zeikomiDeletePattern=array("sli_price\">￥","</span>");



	function url($page){
		$page=$page*24;
		return 'https://ec.cb-asahi.co.jp/category/cat1/%E9%9B%BB%E5%8B%95%E8%87%AA%E8%BB%A2%E8%BB%8A/'.$page.'?isort=price&view=list';
	//あさひ用取得パターンここまで
	}	
}


$shop=new AsahiShop();

$ShopScraping=new ShopScraping($shop);
$result=$ShopScraping->All();


?>
