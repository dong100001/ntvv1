<?php

# 装饰品商店



foreach($itemtype as $key => $value) {
	
		$item_list[] = $value;
	
}

echo qf_jsonCode($item_list);

?>