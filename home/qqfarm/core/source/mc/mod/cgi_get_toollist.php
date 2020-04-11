<?php

# 买罐头
foreach($toolstype as $key => $value) {
	
		$tools_list[] = $value;
	
}

echo qf_jsonCode($tools_list);


?>