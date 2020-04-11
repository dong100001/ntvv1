<?php

# 牧场商店

foreach($animaltype as $key => $value) {
	$shop_list[] = $value;
}

echo qf_jsonCode($shop_list);

?>