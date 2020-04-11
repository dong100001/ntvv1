<?php
//Game siêu thị bạn bè được phát triển bởi GoHooH.CoM
//Vui lòng giữ bản quyền Việt hóa của GoHooH.Com
//Cám ơn bạn đã sử dụng sản phẩm của GoHooH.CoM
include_once('./common.php');

//�Ƿ�ر�վ��
checkclose();

$space = $_SGLOBAL['supe_uid']?getspace($_SGLOBAL['supe_uid']):array();

//����ķ���
$com = $_GET['com'];

//������� php �ļ�
include_once(S_ROOT."./components/com_{$com}.php");

//�˵�����
$menuactives = array('network'=>' class="active"');

?>