<?php
include_once './park/ClassParkInfo.php';
//ʵ��
realname_get();
//��ȡ��ǰ�û��Ŀռ���Ϣ
$space = getspace($_SGLOBAL['supe_uid']);
include_once( template( "park/view/park_add" ));
?>