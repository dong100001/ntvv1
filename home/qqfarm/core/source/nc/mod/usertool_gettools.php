<?php

# 狗粮商店

foreach($toolstype as $key => $value) {
	$Tools[] = $value;
}

echo qf_jsonCode($Tools);

?>