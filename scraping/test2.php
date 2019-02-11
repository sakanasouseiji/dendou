<?php
$subject=file_get_contents("https://ec.cb-asahi.co.jp/catalog/products/9F12ED255B764839935A1CCFCE2A442B");
$linkPattern=array(	'/product_color_carousel_title.*</div></div></div></div></div>/ius',
					'/data-js-color-thumb-label=.*><img src/ius');
$linkDeletePattern=array('<a href=\'','\' onclick=');

preg_match_all($linkPattern,$subject,$array);
print_r($array);
?>
