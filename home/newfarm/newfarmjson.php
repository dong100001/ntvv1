<?php
//Ucenter Home GoHooH Full (full mod, full game, full skin) hack by GoHooH.CoM
//More mod, skin, game, plugins for Discuz!, Ucenter Home at http://www.gohooh.com/forum/
/*********************/
/*                   */
/*  Version : 3.0.0  */
/*  Author  : SAMɽķ*/
/*  Comment : 100112 */
/*                   */
/*********************/
include_once ("farm.php");
include_once ("config.php");

function avatarfarm($uid, $size = 'small')
{
    global $_SCONFIG;
    $type = empty($_SCONFIG['avatarreal']) ? 'virtual' : 'real';
    if (empty($_SCONFIG['uc_dir'])) {
        return UC_API . '/avatar.php?uid=' . $uid . '&size=' . $size . '&type=' . (empty
            ($_SCONFIG['avatarreal']) ? 'virtual' : 'real');
    } else {
        if (ckavatar($uid)) {
            return UC_API . '/data/avatar/' . avatarfile($uid, $size, $type);
        } else {
            return UC_API . "/images/noavatar_$size.gif";
        }
    }
}
if (empty($_SGLOBAL['supe_uid'])) {
    showmessage("Vui lòng đăng nhập", "do.php?ac=login");
}
$space = getspace($_SGLOBAL['supe_uid']);

if ($_REQUEST['number'] && (!is_numeric($_REQUEST['number']) || $_REQUEST['number'] < 0)) { exit();} //��ֹ���������

if ($_REQUEST['mod'] == "user" && $_REQUEST['act'] == "run") {
    if (intval($_REQUEST['ownerId']) != $_SGLOBAL['supe_uid'] && $_REQUEST['flag'] ==1 && intval($_REQUEST['ownerId']) != "0") {
        $query = $_SGLOBAL['db']->query("SELECT farmlandstatus,money,exp,fb,reclaim,decorative,dog,message,charm FROM " . tname("plug_newfarm") . " where uid=" . intval($_REQUEST['ownerId']));
        while ($value = $_SGLOBAL['db']->fetch_array($query)) {
            $list[] = $value;
        }
        $farmlandStatus = (array )json_decode($list[0][farmlandstatus]);
        foreach ($farmlandStatus[farmlandstatus] as $key => $value) {
            if ($key < $list[0][reclaim]) {
                if (stristr($value->n, "," . $_SGLOBAL['supe_uid'] . ",")) {
                    $value->n = 1;
                } else {
                    $value->n = 2;
                }
                $farmlandstatusarr[] = json_encode($value);
            }
        }
        $farmlandstatusarr = json_encode($farmlandstatusarr);
        $farmlandstatusarr = str_replace("\"{", "{", $farmlandstatusarr);
        $farmlandstatusarr = str_replace("}\"", "}", $farmlandstatusarr);
        $decorativearr = json_decode($list[0][decorative], true);
        $decorativesql = 0;
        foreach ($decorativearr as $itemtype => $value) {
            foreach ($value as $key => $value1) {
                //���´����жϣ������ϵͳĬ��װ�Σ��������ʱ��û���ڵģ�����ʣ�µģ�ȫ�������ʡ��ݿ�ռ䣬��߳�������Ч�ʣ�
                if ($value1['status'] == 1) {
                    if ($_SGLOBAL['timestamp'] < $value1['validtime'] || $value1['validtime'] == 0) {
                        $decorativearr_srt[] = "" . $itemtype . "\":{\"itemId\":" . $key . "}";
                    } else {
                        unset($decorativearr[$itemtype][$key]);
                        $decorativesql = 1;
                        $value[$itemtype][status] = 1;
                        $decorativearr_srt[] = "" . $itemtype . "\":{\"itemId\":" . $itemtype . "}";
                    }
                } else {
                    if ($value1['validtime'] != 0 && $_SGLOBAL['timestamp'] >= $value1['validtime']) {
                        unset($decorativearr[$itemtype][$key]);
                        $decorativesql = 1;
                    }
                }
            }
        }
        $decorativesql == 1 && $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set decorative='" . json_encode($decorativearr) . "' where uid=" . intval($_REQUEST['ownerId']));
        $decorative_srt = json_encode($decorativearr_srt);
        $decorative_srt = str_replace("\"{", "{", $decorative_srt);
        $decorative_srt = str_replace("}\"", "}", $decorative_srt);
        $decorative_srt = str_replace("[", "", $decorative_srt);
        $decorative_srt = str_replace("]", "", $decorative_srt);
        $dog = json_decode($list[0][dog]);
        $dogstr = "{\"dogId\":0,\"dogFeedTime\":0,\"dogUnWorkTime\":0}";
        foreach ($dog as $key => $value) {
            if ($value->status == 1) {
                $dogstr = "{\"dogId\":" . $key . ",\"dogFeedTime\":" . $value->dogFeedTime . ",\"dogUnWorkTime\":" .
                    $value->dogUnWorkTime . "}";
            }
        }
        $message = json_decode($list[0][message]);
        $top = "";
        $executesql = false;
        foreach ($message->e as $key => $value) {
            if ($value->status == 2) {
                if (3000 < $value->formulaId) {
                    $type = 3;
                    $Rid = 1;
                } else
                    if (2000 < $value->formulaId && $value->formulaId < 3000) {
                        $type = 2;
                        $Rid = 1;
                    } else {
                        $type = 1;
                        $Rid = $value->formulaId % 12;
                    }
                    if ($value->validTime == 0) {
                        if ($_SGLOBAL['timestamp'] - $value->sendTime > $timeout[$type][$Rid]) {
                            $executesql = true;
                            unset($message->e[$key]);
                        } else {
                            $top[] = "{\"id\":" . $value->id . ",\"formulaId\":\"" . $value->formulaId . "\",\"type\":" .
                                $type . ",\"friendId\":\"" . $value->friendId . "\",\"fName\":\"" . $value->
                                fName . "\",\"charm\":" . $value->charm . ",\"msg\":\"" . $value->msg . "\",\"show\":\"1\",\"x\":\"" .
                                $value->x . "\",\"y\":\"" . $value->y . "\",\"z\":\"" . $value->z . "\"}";
                        }
                    } else {
                        if ($_SGLOBAL['timestamp'] > $value->validTime) {
                            $executesql = true;
                            unset($message->e[$key]);
                        } else {
                            $top[] = "{\"id\":" . $value->id . ",\"formulaId\":\"" . $value->formulaId . "\",\"type\":" .
                                $type . ",\"friendId\":\"" . $value->friendId . "\",\"fName\":\"" . $value->
                                fName . "\",\"charm\":" . $value->charm . ",\"msg\":\"" . $value->msg . "\",\"show\":\"1\",\"x\":\"" .
                                $value->x . "\",\"y\":\"" . $value->y . "\",\"z\":\"" . $value->z . "\"}";
                        }
                    }
            }
        }
        $top = json_encode($top);
        $top = str_replace("\"{", "{", $top);
        $top = str_replace("}\"", "}", $top);
        $top = str_replace("\\u", "\\\\u", $top);
        if ($top == "") {
            $top = "null";
        }
        if ($executesql) {
            $message = json_encode($message);
            $message = preg_replace("'\"[0-9]+\":{'", "{", $message);
            $message = str_ireplace("\"e\":{{", "\"e\":[{", $message);
            $message = str_ireplace("}}}", "}]}", $message);
            $message = str_replace("\\u", "\\\\u", $message);
            $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set message='" . $message .
                "' where uid=" . intval($_REQUEST['ownerId']));
        }
        echo stripslashes("{\"farmlandStatus\":" . $farmlandstatusarr . ",\"items\":{" .
            $decorative_srt . "},\"exp\":" . $list[0][exp] . ",\"charm\":" . $list[0][charm] .
            ",\"dog\":" . $dogstr . ",\"top\":" . $top . "}");
        exit();
    } else {
        $query = $_SGLOBAL['db']->query("SELECT farmlandstatus,money,username,exp,fb,reclaim,decorative,dog,message,charm,taskid,activity FROM " .
            tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']);
        while ($value = $_SGLOBAL['db']->fetch_array($query)) {
            $list[] = $value;
        }
        $farmlandStatus = (array )json_decode($list[0][farmlandstatus]);
        foreach ($farmlandStatus[farmlandstatus] as $key => $value) {
            if ($key < $list[0][reclaim]) {
                $value->n = 2;
                $farmlandstatusarr[] = json_encode($value);
            }
        }
        $farmlandstatusarr = json_encode($farmlandstatusarr);
        $farmlandstatusarr = str_replace("\"{", "{", $farmlandstatusarr);
        $farmlandstatusarr = str_replace("}\"", "}", $farmlandstatusarr);
        $decorativearr = json_decode($list[0][decorative], true);
        $decorativesql = 0;
        foreach ($decorativearr as $itemtype => $value) {
            foreach ($value as $key => $value1) {
                //���´����жϣ������ϵͳĬ��װ�Σ��������ʱ��û���ڵģ�����ʣ�µģ�ȫ�������ʡ��ݿ�ռ䣬��߳�������Ч�ʣ�
                if ($value1['status'] == 1) {
                    if ($_SGLOBAL['timestamp'] < $value1['validtime'] || $value1['validtime'] == 0) {
                        $decorativearr_srt[] = "" . $itemtype . "\":{\"itemId\":" . $key . "}";
                    } else {
                        unset($decorativearr[$itemtype][$key]);
                        $decorativesql = 1;
                        $value[$itemtype][status] = 1;
                        $decorativearr_srt[] = "" . $itemtype . "\":{\"itemId\":" . $itemtype . "}";
                    }
                } else {
                    if ($value1['validtime'] != 0 && $_SGLOBAL['timestamp'] >= $value1['validtime']) {
                        unset($decorativearr[$itemtype][$key]);
                        $decorativesql = 1;
                    }
                }
            }
        }
        $decorativesql == 1 && $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set decorative='" . json_encode($decorativearr) . "' where uid=" . $_SGLOBAL['supe_uid']);
        $decorative_srt = json_encode($decorativearr_srt);
        $decorative_srt = str_replace("\"{", "{", $decorative_srt);
        $decorative_srt = str_replace("}\"", "}", $decorative_srt);
        $decorative_srt = str_replace("[", "", $decorative_srt);
        $decorative_srt = str_replace("]", "", $decorative_srt);
        $dog = json_decode($list[0][dog]);
        $dogstr = "{\"dogId\":0,\"dogFeedTime\":0,\"dogUnWorkTime\":0}";
        foreach ($dog as $key => $value) {
            if ($value->status == 1) {
                $dogstr = "{\"dogId\":" . $key . ",\"dogFeedTime\":" . $value->dogFeedTime . ",\"dogUnWorkTime\":" .
                    $value->dogUnWorkTime . "}";
            }
        }
        $message = json_decode($list[0][message]);
        $top = "";
        $c = 0;
        $b = substr_count(json_encode($message->c), ',"status":0,'); //�û��ʼ�
        $b += substr_count(json_encode($message->d), ',"status":"0",'); //�û�װ��
        $executesql = false;
        foreach ($message->e as $key => $value) {
            if ($value->status == 0) {
                $b++;
            } elseif ($value->status == 2) {
                if (3000 < $value->formulaId) {
                    $type = 3;
                    $Rid = 1;
                } else
                    if (2000 < $value->formulaId && $value->formulaId < 3000) {
                        $type = 2;
                        $Rid = 1;
                    } else {
                        $type = 1;
                        $Rid = $value->formulaId % 12;
                    }
                    if ($value->validTime == 0) {
                        if ($_SGLOBAL['timestamp'] - $value->sendTime > $timeout[$type][$Rid]) {
                            $executesql = true;
                            unset($message->e[$key]);
                        } else {
                            $top[] = "{\"id\":" . $value->id . ",\"formulaId\":\"" . $value->formulaId . "\",\"type\":" .
                                $type . ",\"friendId\":\"" . $value->friendId . "\",\"fName\":\"" . $value->
                                fName . "\",\"charm\":" . $value->charm . ",\"msg\":\"" . $value->msg . "\",\"show\":\"1\",\"x\":\"" .
                                $value->x . "\",\"y\":\"" . $value->y . "\",\"z\":\"" . $value->z . "\"}";
                        }
                    } else {
                        if ($_SGLOBAL['timestamp'] > $value->validTime) {
                            $executesql = true;
                            unset($message->e[$key]);
                        } else {
                            $top[] = "{\"id\":" . $value->id . ",\"formulaId\":\"" . $value->formulaId . "\",\"type\":" .
                                $type . ",\"friendId\":\"" . $value->friendId . "\",\"fName\":\"" . $value->
                                fName . "\",\"charm\":" . $value->charm . ",\"msg\":\"" . $value->msg . "\",\"show\":\"1\",\"x\":\"" .
                                $value->x . "\",\"y\":\"" . $value->y . "\",\"z\":\"" . $value->z . "\"}";
                        }
                    }
            }
        }
        $top = json_encode($top);
        $top = str_replace("\"{", "{", $top);
        $top = str_replace("}\"", "}", $top);
        $top = str_replace("\\u", "\\\\u", $top);
        if ($top == "") {
            $top = "null";
        }
        $taskid = "";
        if ($list[0][taskid] < 12) {
            $taskid = ",\"task\":{\"taskId\":" . $list[0][taskid] . ",\"taskFlag\":1}";
        }
        if ($list[0][taskid] == 1) {
            $taskid = ",\"task\":{\"taskId\":" . $list[0][taskid] . ",\"taskFlag\":1},\"welcome\":1";
        }
        $isread = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT COUNT(*) FROM " .
            tname('plug_newfarm_logs') . " WHERE uid = " . $_SGLOBAL['supe_uid'] .
            " and isread = 0"), 0);
        if ($isread) {
            $a = 1;
        } else {
            $a = 0;
        }
        if ($executesql) {
            $message = json_encode($message);
            $message = preg_replace("'\"[0-9]+\":{'", "{", $message);
            $message = str_ireplace("\"e\":{{", "\"e\":[{", $message);
            $message = str_ireplace("}}}", "}]}", $message);
            $message = str_replace("\\u", "\\\\u", $message);
            $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set message='" . $message .
                "' where uid=" . $_SGLOBAL['supe_uid']);
        }
        echo stripslashes("{\"farmlandStatus\":" . $farmlandstatusarr . ",\"items\":{" .
            $decorative_srt . "},\"exp\":" . $list[0][exp] . ",\"charm\":" . $list[0][charm] .
            ",\"dog\":" . $dogstr . ",\"top\":" . $top . ",\"weather\":{\"weatherId\":1},\"serverTime\":{\"time\":" .
            $_SGLOBAL['timestamp'] . "},\"user\":{\"uId\":\"" . $_SGLOBAL['supe_uid'] . "\",\"userName\":\"" .
            str_replace("\\u", "\\\\u", unicode_encodegb($list[0]['username'])) . "\",\"money\":" .
            $list[0][money] . ",\"FB\":\"" . $list[0][fb] . "\",\"exp\":" . $list[0][exp] .
            ",\"charm\":" . $list[0][charm] . ",\"headPic\":\"" . avatarfarm($_SGLOBAL[supe_uid],
            "small", true) . "\"},\"l\":" . $list[0][activity] . ",\"a\":" . $a . ",\"c\":" .
            $c . ",\"b\":" . $b . "" . $taskid . "}");
        exit();
    }
}
if ($_REQUEST['mod'] == "shop" && $_REQUEST['act'] == "getShopInfo") { //[=2=]
    if ($_REQUEST['type'] == "1") { //���ӡ�����
        foreach ($crops as $key => $value) {
            if ($value[cType] == 2) {
                ($key - 101) / 4 == intval(($key - 101) / 4) && $shop_list[] = $value;
            } else {
                $shop_list[] = $value;
            }
        }
        $shop_list_str = str_replace("\\\u", "\u", json_encode($shop_list));
        echo "{\"1\":{$shop_list_str}}";
    } elseif ($_REQUEST['type'] == "3,4") { //���ߡ���
        foreach ($tools as $key => $value) {
            $shop_list[] = $value;
        }
        $shop_list_str = str_replace("\\\u", "\u", json_encode($shop_list));
        foreach ($dogs as $key => $value) {
            $dog_list[] = $value;
        }
        $dog_list_str = str_replace("\\\u", "\u", json_encode($dog_list));
        echo "{\"3\":{$shop_list_str},\"4\":{$dog_list_str}}";
    } elseif ($_REQUEST['type'] == "2") { //װ��
        foreach ($decorative as $key => $value) {
            $key > 4 && $shop_list[] = $value;
        }
        $shop_list_str = str_replace("\\\u", "\u", json_encode($shop_list));
        echo "{\"2\":{$shop_list_str}}";
    }
    exit();

} //[=2=] //�̵��б�
if ($_REQUEST['mod'] == "Package" && $_REQUEST['act'] == "getPackageInfo") {
    $query = $_SGLOBAL['db']->query("SELECT package,fertilizer,decorative,dog,nosegay FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $package = (array )json_decode($list[0][package]);
    foreach ($package as $key => $value) {
        if (0 < $value) {
            $packagearr[] = "{\"type\":1,\"cId\":" . $key . ",\"cName\":\"" . $crops[$key][cName] .
                "\",\"amount\":" . $value . ",\"view\":1}";
        }
    }
    $package = json_encode($packagearr);
    $package = str_replace("\"{", "{", $package);
    $package = str_replace("}\"", "}", $package);
    $fertilizer = (array )json_decode($list[0][fertilizer]);
    foreach ($fertilizer as $key => $value) {
        if (0 < $value && $key < 500) {
            if ($key == 5) {
                $fertilizerarr[] = "{\"type\":21,\"tId\":" . $key . ",\"tName\":\"" . $tools[$key][tName] .
                    "\",\"amount\":" . $value . ",\"view\":0}";
            } else
                if ($key == 6) {
                    $fertilizerarr[] = "{\"type\":22,\"tId\":" . $key . ",\"tName\":\"" . $tools[$key][tName] .
                        "\",\"amount\":" . $value . ",\"view\":0}";
                } else {
                    $fertilizerarr[] = "{\"type\":3,\"tId\":" . $key . ",\"tName\":\"" . $tools[$key][tName] .
                        "\",\"amount\":" . $value . ",\"view\":1}";
                }
        }
        if ((0 < $value) && (500 <= $key)) {
            $fertilizerarr[] = "{\"type\":23,\"tId\":501,\"tName\":\"Food\",\"amount\":" .
                $value . ",\"view\":\"3\"}";
        }
    }
    $fertilizer = json_encode($fertilizerarr);
    $fertilizer = str_replace("\"{", "{", $fertilizer);
    $fertilizer = str_replace("}\"", "}", $fertilizer);
    $decorativearr = (array )json_decode($list[0][decorative]);
    foreach ($decorativearr as $itemtype => $value) {
        foreach ($value as $key => $value1) {
            if (($value1->validtime == 0) || ($_SGLOBAL['timestamp'] < $value1->validtime)) {
                $decorativearr_srt[] = "{\"id\":" . $key . ",\"itemId\":" . $key . ",\"itemType\":" .
                    $itemtype . ",\"itemName\":\"" . $decorative[$key][itemName] . "\",\"validTime\":" .
                    $value1->validtime . ",\"status\":" . $value1->status . "}";
            }
        }
    }
    $decorative_srt = json_encode($decorativearr_srt);
    $decorative_srt = str_replace("\"{", "{", $decorative_srt);
    $decorative_srt = str_replace("}\"", "}", $decorative_srt);
    $dogarr = json_decode($list[0][dog]);
    foreach ($dogarr as $key => $value) {
        if (0 < $value->dogFeedTime) {
            $dog_arr[] = "{\"id\":" . $value->id . ",\"dogId\":\"" . $key . "\",\"dogName\":\"" .
                $dogs[$key][tName] . "\",\"dogValidTime\":" . $value->dogValidTime . ",\"status\":" .
                $value->status . "}";
        }
    }
    $dog_arr = json_encode($dog_arr);
    $dog_arr = str_replace("\"{", "{", $dog_arr);
    $dog_arr = str_replace("}\"", "}", $dog_arr);
    $nosegay = json_decode($list[0][nosegay]);
    foreach ($nosegay as $key => $value) {
        if (0 < $value) {
            $nosegay_arr[] = "{\"id\":" . $key . ",\"num\":" . $value . "}";
        }
    }
    $nosegay_arr = json_encode($nosegay_arr);
    $nosegay_arr = str_replace("\"{", "{", $nosegay_arr);
    $nosegay_arr = str_replace("}\"", "}", $nosegay_arr);
    echo stripslashes("{\"1\":" . $package . ",\"2\":" . $decorative_srt . ",\"3\":" .
        $fertilizer . ",\"4\":" . $dog_arr . ",\"9\":" . $nosegay_arr . "}");
    exit();
}
if ($_REQUEST['mod'] == "friend") { //��ʾ�����б�ʼ
    if ($_REQUEST['false'] == "refresh") {
        echo "{\"code\":0}";
        exit();
    }
    if (!empty($space[friend])) {
        $space[friend] = $space[friend] . ",";
    }
    $query = $_SGLOBAL['db']->query("SELECT uid,username,exp,money,charm FROM " . tname("plug_newfarm") . " WHERE uid IN (" . $space[friend] . $_SGLOBAL['supe_uid'] . ")limit 0,300");
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $jishu = 0;
    foreach ($list as $value) {
        $jishu++;
        if ($jishu > 300) {
            break;
        }
        $friendavatarimage = avatarfarm($value[uid], 'small', true);
        $friend_str[] = "{\"userId\":" . $value[uid] . ",\"userName\":\"" .
            unicode_encodegb($value[username]) . "\",\"headPic\":\"" . $friendavatarimage .
            "\",\"exp\":" . $value[exp] . ",\"money\":" . $value[money] . ",\"charm\":" . $value[charm] .
            "}";
    }
    $friend_str = json_encode($friend_str);
    $friend_str = str_replace("\"{", "{", $friend_str);
    $friend_str = str_replace("}\"", "}", $friend_str);
    $friend_str = str_replace("\\/", "\\\\/", $friend_str);
    $friend_str = str_replace(",null,", ",", $friend_str);
    echo stripslashes($friend_str);
    exit();
} //��ʾ�����б����
if ($_REQUEST['mod'] == "farmlandstatus" && $_REQUEST['act'] == "scarify") {
    $query = $_SGLOBAL['db']->query("SELECT farmlandstatus,exp,levelup FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $farm_arr = (array )json_decode($list[0][farmlandstatus]);
    if (0 < $farm_arr[farmlandstatus][$_REQUEST['place']]->a) {
        $scarifyexp = 0;
        if ($farm_arr[farmlandstatus][$_REQUEST['place']]->b == 7) {
            $scarifyexp = 3;
        }
        $levelup_arr = 'false';
        $list[0][exp] >= $list[0][levelup] && $list[0][levelup] < 93001 && include_once ("levelup.php"); //����ʾ
        echo stripslashes("{\"farmlandIndex\":" . $_REQUEST['place'] . ",\"code\":1,\"direction\":\"\",\"exp\":" .
            $scarifyexp . ",\"levelUp\":" . $levelup_arr . "}");
        $farm_arr[farmlandstatus][$_REQUEST['place']]->a = 0;
        $farm_arr[farmlandstatus][$_REQUEST['place']]->b = 0;
        $farm_arr[farmlandstatus][$_REQUEST['place']]->f = 0;
        $farm_arr[farmlandstatus][$_REQUEST['place']]->g = 0;
        $farm_arr[farmlandstatus][$_REQUEST['place']]->h = 1;
        $farm_arr[farmlandstatus][$_REQUEST['place']]->i = array();
        $farm_arr[farmlandstatus][$_REQUEST['place']]->j = 0;
        $farm_arr[farmlandstatus][$_REQUEST['place']]->k = 0;
        $farm_arr[farmlandstatus][$_REQUEST['place']]->l = 0;
        $farm_arr[farmlandstatus][$_REQUEST['place']]->m = 0;
        $farm_arr[farmlandstatus][$_REQUEST['place']]->n = "";
        $farm_arr[farmlandstatus][$_REQUEST['place']]->o = 0;
        $farm_arr[farmlandstatus][$_REQUEST['place']]->p = array();
        $farm_arr[farmlandstatus][$_REQUEST['place']]->q = 0;
        $farm_arr[farmlandstatus][$_REQUEST['place']]->r = 0;
        $farm_arr[farmlandstatus][$_REQUEST['place']]->s = 0;
        $farm_arr[farmlandstatus][$_REQUEST['place']]->t = 0;
        $farm_arr[farmlandstatus][$_REQUEST['place']]->u = 0;
        $farm_arr = json_encode($farm_arr);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set farmlandstatus='" . $farm_arr . "',exp=exp+" . $scarifyexp . " where uid=" .
            $_SGLOBAL['supe_uid']);
    } else {
        echo "{\"farmlandIndex\":" . $_REQUEST['place'] . ",\"code\":0,\"poptype\":1,\"direction\":\"Đã mua đất thành công\"}";
    }
    exit();
}
if ($_REQUEST['mod'] == "item" && $_REQUEST['act'] == "activeItem") {
    $query = $_SGLOBAL['db']->query("SELECT money,fb,decorative FROM " . tname("plug_newfarm") .
        " where uid=" . $_SGLOBAL['supe_uid']);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $decorativearr = (array )json_decode($list[0][decorative]);
    foreach ($decorativearr as $itemtype => $value) {
        foreach ($value as $itemid => $value1) {
            if ($itemtype == $decorative[$_REQUEST['id']][itemType]) {
                if ($itemid == $_REQUEST['id']) {
                    if ($_SGLOBAL['timestamp'] < $value1->validtime || $value1->validtime == 0) {
                        $value1->status = 1;
                    } else {
                        exit();
                    }
                } else {
                    $value1->status = 0;
                }
            }
        }
    }
    $decorativearr = json_encode($decorativearr);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set decorative='" .
        $decorativearr . "' where uid=" . $_SGLOBAL['supe_uid']);
    echo "{\"code\":1,\"id\":" . $_REQUEST['id'] . "}";
    include_once (S_ROOT . "./source/function_cp.php");
    $icon = "farm";
    $title_template = "{actor} tham gia <a href=\"newfarm.php\">hội nông dân</a> <a href=\"http://www.gohooh.com/nhatui\">NHÀ TUI</a>";
    $body_general = "Tớ là nông dân tiêu biểu đó!";
    feed_add($icon, $title_template);
    exit();
}
if ($_REQUEST['mod'] == "shop" && $_REQUEST['act'] == "buy" && $_REQUEST['type'] == "1") //��������
    {
    $query = $_SGLOBAL['db']->query("SELECT money,package,fb FROM " . tname("plug_newfarm") .
        " where uid=" . $_SGLOBAL['supe_uid']);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    if ($_REQUEST['id'] == "2001") {
        if ($_REQUEST['number'] == "1" && $list[0][fb] < 3) {
            exit();
        }
        if ($_REQUEST['number'] == "10" && $list[0][fb] < 27) {
            exit();
        }
        if ($_REQUEST['number'] == "100" && $list[0][fb] < 240) {
            exit();
        }
        if ($_REQUEST['number'] == "1") {
            $fb = 3;
        }
        if ($_REQUEST['number'] == "10") {
            $fb = 27;
        }
        if ($_REQUEST['number'] == "100") {
            $fb = 240;
        }
        if (empty($fb)) {
            exit();
        }
        $package = json_decode($list[0][package]);
        $package->$_REQUEST['id'] = $package->$_REQUEST['id'] + $_REQUEST['number'];
        //�Զ�ѹ�����
        foreach ($package as $key => $value) {
            if ($value == 0) {
                unset($package->$key);
            }
        }
        $package = json_encode($package);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set fb=fb-" . $fb .
            ",package='" . $package . "' where uid=" . $_SGLOBAL['supe_uid']);
        echo "{\"code\":1,\"cId\":" . $_REQUEST['id'] . ",\"cName\":\"" . $crops[$_REQUEST['id']][cName] .
            "\",\"num\":" . $_REQUEST['number'] . ",\"FB\":-" . $fb . "}";
        exit();
    } else {
        if ($list[0][money] < $crops[$_REQUEST['id']][price] * $_REQUEST['number']) {
            exit();
        }
        $package = json_decode($list[0][package]);
        $package->$_REQUEST['id'] = $package->$_REQUEST['id'] + $_REQUEST['number'];
        //�Զ�ѹ�����
        foreach ($package as $key => $value) {
            if ($value == 0) {
                unset($package->$key);
            }
        }
        $package = json_encode($package);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set money=money-" .
            $crops[$_REQUEST['id']][price] * $_REQUEST['number'] . ",package='" . $package .
            "' where uid=" . $_SGLOBAL['supe_uid']);
        echo "{\"code\":1,\"cId\":" . $_REQUEST['id'] . ",\"cName\":\"" . $crops[$_REQUEST['id']][cName] .
            "\",\"num\":" . $_REQUEST['number'] . ",\"money\":-" . $crops[$_REQUEST['id']][price] *
            $_REQUEST['number'] . "}";
        //��������־
        $sql = "INSERT INTO " . tname("plug_newfarm_logs") .
            " (`uid`, `type`, `count`, `fromid`, `time`, `cropid`, `isread` ) VALUES (" . $_SGLOBAL['supe_uid'] .
            ", 7, " . $_REQUEST['number'] . ", " . $_SGLOBAL['supe_uid'] . ", " . $_SGLOBAL['timestamp'] .
            ", " . $_REQUEST['id'] . ", 0);";
        $_SGLOBAL['db']->query($sql);
        exit();
    }
}
if ($_REQUEST['mod'] == "shop" && $_REQUEST['act'] == "buy" && $_REQUEST['type'] == "2") //����װ��
    {
    $ids = explode(",", $_REQUEST['id']);
    if (is_array($ids) && count($ids) > 1) {
        $query = $_SGLOBAL['db']->query("SELECT money,fb,decorative,exp FROM " . tname("plug_newfarm") .
            " where uid=" . $_SGLOBAL['supe_uid']);
        while ($value = $_SGLOBAL['db']->fetch_array($query)) {
            $list[] = $value;
        }
        $FBPrices = 0;
        $prices = 0;
        for ($a = 0; $a < count($ids); $a++) {
            $FBPrices = $FBPrices + $decorative[$ids[$a]][FBPrice];
            $prices = $prices + $decorative[$ids[$a]][price];
        }
        $queryexp = floor($list[0][exp]);
        $j = -1;
        for ($i = 200; $i < $queryexp; $i = $i + 200 * $j) {
            $j++;
        }
        if ($j < 10) {
            echo "{\"farmlandIndex\":1,\"code\":0,\"poptype\":1,\"direction\":\"Level của bạn không thể mua số lượng lớn\"}";
            exit();
        }
        $_fb = 0;
        $_money = 0;
        if ($_REQUEST['useFB'] == "true") {
            if ($list[0][fb] < $FBPrices) {
                exit();
            }
            $list[0][fb] = $list[0][fb] - $FBPrices;
            $_fb = 0 - $FBPrices;
        } else {
            if ($list[0][money] < $prices) {
                exit();
            }
            $list[0][money] = $list[0][money] - $prices;
            $_money = 0 - $prices;
        }
        $decorativearr = json_decode($list[0][decorative]);
        $kk = 0;
        $decorativesql = 0;
        for ($a = 0; $a < count($ids); $a++) {
            foreach ($decorativearr as $itemtype => $value) {
                foreach ($value as $key => $value1) {
                    if ($key == $ids[$a]) {
                        $decorativesql = 1;
                        $value1->validtime = $_SGLOBAL['timestamp'] + $decorative[$key][itemValidTime];
                        $decorative[$key][itemName] = str_replace("\\u", "\\\\u", $decorative[$key][itemName]);
                        $item_Name = $decorative[$key][itemName];
                        if ($kk == 0) {
                            $decorativearr_srt = "{\"id\":" . $key . ",\"itemId\":" . $key . ",\"itemType\":" .
                                $itemtype . ",\"itemName\":\"" . $item_Name . "\",\"validTime\":" . $value1->
                                validtime . ",\"status\":" . $value1->status . "}";
                            $kk++;
                        } else {
                            $decorativearr_srt .= ",{\"id\":" . $key . ",\"itemId\":" . $key . ",\"itemType\":" .
                                $itemtype . ",\"itemName\":\"" . $item_Name . "\",\"validTime\":" . $value1->
                                validtime . ",\"status\":" . $value1->status . "}";
                        }
                    }
                }
            }
            if ($decorativesql == 0) {
                $ids_id = $ids[$a];
                $keyid = $decorative[$ids_id][itemType];
                $item_Name = str_replace("\\u", "\\\\u", $decorative[$ids_id][itemName]);
                $decorativearr->$keyid->$ids_id->status = 0;
                $decorativearr->$keyid->$ids_id->validtime = $_SGLOBAL['timestamp'] + $decorative[$key][itemValidTime];
                if ($kk == 0) {
                    $decorativearr_srt = "{\"id\":" . $ids_id . ",\"itemId\":" . $ids_id . ",\"itemType\":" .
                        $keyid . ",\"itemName\":\"" . $item_Name . "\",\"validTime\":" . $decorativearr->
                        $keyid->$ids_id->validtime . ",\"status\":0}";
                    $kk++;
                } else {
                    $decorativearr_srt .= ",{\"id\":" . $ids_id . ",\"itemId\":" . $ids_id . ",\"itemType\":" .
                        $keyid . ",\"itemName\":\"" . $item_Name . "\",\"validTime\":" . $decorativearr->
                        $keyid->$ids_id->validtime . ",\"status\":0}";
                }
            }
        }
        $decorativearr_srt = "[" . $decorativearr_srt . "]";
        $decorativearr = json_encode($decorativearr);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set money=" . $list[0][money] .
            ",fb=" . $list[0][fb] . ",decorative='" . $decorativearr . "' where uid=" . $_SGLOBAL['supe_uid']);
        echo stripslashes("{\"code\":1,\"item\":" . $decorativearr_srt . ",\"money\":" .
            $_money . ",\"FB\":" . $_fb . "}");
        exit();
    } else {
        if (strchr($_REQUEST['id'], ",") != false) {
            echo "{\"farmlandIndex\":1,\"code\":0,\"poptype\":1,\"direction\":\"Level của bạn không thể  mua với số lượng lớn\"}";
            exit();
        }
        $query = $_SGLOBAL['db']->query("SELECT money,fb,decorative FROM " . tname("plug_newfarm") .
            " where uid=" . $_SGLOBAL['supe_uid']);
        while ($value = $_SGLOBAL['db']->fetch_array($query)) {
            $list[] = $value;
        }
        $_fb = 0;
        $_money = 0;
        if ($_REQUEST['useFB'] == "true") {
            if ($list[0][fb] < $decorative[$_REQUEST['id']][FBPrice]) {
                exit();
            }
            $list[0][fb] = $list[0][fb] - $decorative[$_REQUEST['id']][FBPrice];
            $_fb = 0 - $decorative[$_REQUEST['id']][FBPrice];
        } else {
            if ($list[0][money] < $decorative[$_REQUEST['id']][price]) {
                exit();
            }
            $list[0][money] = $list[0][money] - $decorative[$_REQUEST['id']][price];
            $_money = 0 - $decorative[$_REQUEST['id']][price];
        }
        $decorativearr = json_decode($list[0][decorative]);
        $decorativesql = 0;
        foreach ($decorativearr as $itemtype => $value) {
            foreach ($value as $key => $value1) {
                if ($key == $_REQUEST['id']) {
                    $decorativesql = 1;
                    $value1->validtime = $_SGLOBAL['timestamp'] + $decorative[$_REQUEST['id']][itemValidTime];
                    $decorative[$key][itemName] = str_replace("\\u", "\\\\u", $decorative[$key][itemName]);
                    $decorativearr_srt = "[{\"id\":" . $key . ",\"itemId\":" . $key . ",\"itemType\":" .
                        $itemtype . ",\"itemName\":\"" . $decorative[$key][itemName] . "\",\"validTime\":" .
                        $value1->validtime . ",\"status\":" . $value1->status . "}]";
                }
            }
        }
        if ($decorativesql == 0) {
            $ids_id = $_REQUEST['id'];
            $keyid = $decorative[$ids_id][itemType];
            $decorativearr->$keyid->$ids_id->status = 0;
            $decorativearr->$keyid->$ids_id->validtime = $_SGLOBAL['timestamp'] + $decorative[$key][itemValidTime];
            $item_Name = str_replace("\\u", "\\\\u", $decorative[$ids_id][itemName]);
            $decorativearr_srt = "[{\"id\":" . $ids_id . ",\"itemId\":" . $ids_id . ",\"itemType\":" .
                $keyid . ",\"itemName\":\"" . $item_Name . "\",\"validTime\":" . $decorativearr->
                $keyid->$ids_id->validtime . ",\"status\":0}]";
        }
        $decorativearr = json_encode($decorativearr);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set money=" . $list[0][money] .
            ",fb=" . $list[0][fb] . ",decorative='" . $decorativearr . "' where uid=" . $_SGLOBAL['supe_uid']);
        echo stripslashes("{\"code\":1,\"item\":" . $decorativearr_srt . ",\"money\":" .
            $_money . ",\"FB\":" . $_fb . "}");
        exit();
    }
}
if ($_REQUEST['mod'] == "shop" && $_REQUEST['act'] == "buy" && $_REQUEST['type'] ==
    "3") //���򹤾�
    {
    $query = $_SGLOBAL['db']->query("SELECT money,fb,fertilizer FROM " . tname("plug_newfarm") .
        " where uid=" . $_SGLOBAL['supe_uid']);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $_fb = 0;
    $_money = 0;
    if ($_REQUEST['useFB'] == "true") {
        if ($_REQUEST['id'] == "501") {
            if ($_REQUEST['number'] == "1" && $list[0][fb] < 2) {
                exit();
            }
            if ($_REQUEST['number'] == "10" && $list[0][fb] < 15) {
                exit();
            }
            if ($_REQUEST['number'] == "100" && $list[0][fb] < 130) {
                exit();
            }
            if ($_REQUEST['number'] == "1") {
                $_fb = 2;
            }
            if ($_REQUEST['number'] == "10") {
                $_fb = 15;
            }
            if ($_REQUEST['number'] == "100") {
                $_fb = 130;
            }
            if (empty($_fb)) {
                exit();
            }
        } else {
            $_fb = $tools[$_REQUEST['id']]['list'][1][FBPrice] * $_REQUEST['number'];
            if ($_REQUEST['number'] == 10) {
                $_fb = $tools[$_REQUEST['id']]['list'][10][FBPrice];
            }
            if ($_REQUEST['number'] == 100) {
                $_fb = $tools[$_REQUEST['id']]['list'][100][FBPrice];
            }
            if ($list[0][fb] < $_fb) {
                exit();
            }
        }
        $list[0][fb] = $list[0][fb] - $_fb;
    } else {
        $_money = $tools[$_REQUEST['id']]['list'][1][price] * $_REQUEST['number'];
        if ($_REQUEST['number'] == 10) {
            $_money = $tools[$_REQUEST['id']]['list'][10][price];
        }
        if ($_REQUEST['number'] == 100) {
            $_money = $tools[$_REQUEST['id']]['list'][100][price];
        }
        if ($list[0][money] < $_money) {
            exit();
        }
        $list[0][money] = $list[0][money] - $_money;
    }
    $fertilizer = json_decode($list[0][fertilizer]);
    $fertilizer->$_REQUEST['id'] = $fertilizer->$_REQUEST['id'] + $_REQUEST['number'];
    //�Զ�ѹ�����
    foreach ($fertilizer as $key => $value) {
        if ($value == 0) {
            unset($fertilizer->$key);
        }
    }
    $fertilizer = json_encode($fertilizer);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set money=money-" .
        $_money . ",fb=fb-" . $_fb . ",fertilizer='" . $fertilizer . "' where uid=" . $_SGLOBAL['supe_uid']);
    $_fb = 0 - $_fb;
    $_money = 0 - $_money;
    echo "{\"tId\":" . $_REQUEST['id'] . ",\"tName\":\"" . $tools[$_REQUEST['id']][tName] .
        "\",\"code\":1,\"direction\":\"Buy success\",\"num\":" .
        $_REQUEST['number'] . ",\"money\":" . $_money . ",\"FB\":" . $_fb . ",\"type\":3}";
    //�򹤾���־
    $sql = "INSERT INTO " . tname("plug_newfarm_logs") .
        " (`uid`, `type`, `count`, `fromid`, `time`, `cropid`, `isread` ) VALUES (" . $_SGLOBAL['supe_uid'] .
        ", 8, " . $_REQUEST['number'] . ", " . $_SGLOBAL['supe_uid'] . ", " . $_SGLOBAL['timestamp'] .
        ", " . $_REQUEST['id'] . ", 0);";
    $_SGLOBAL['db']->query($sql);
    exit();
}
if ($_REQUEST['mod'] == "shop" && $_REQUEST['act'] == "buy" && $_REQUEST['type'] ==
    "4") //�������
    {
    $query = $_SGLOBAL['db']->query("SELECT dog,fertilizer,fb FROM " . tname("plug_newfarm") .
        " where uid=" . $_SGLOBAL['supe_uid']);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    if ($list[0][fb] < $dogs[$_REQUEST['id']]['list'][1][FBPrice]) {
        exit();
    }
    $dog = json_decode($list[0][dog]);
    $fertilizerarr = json_decode($list[0][fertilizer]);
    $dogsql = 0;
    foreach ($dog as $key => $value) {
        if ($key == $_REQUEST['id']) {
            $value->status = 1;
            $value->dogFeedTime = $_SGLOBAL['timestamp'] + 172800;
            $dogsql = 1;

        } else {
            $value->status = 0;
        }
    }
    if ($dogsql == 0) {
        $dog->$_REQUEST['id']->id = $_REQUEST['id'];
        $dog->$_REQUEST['id']->dogValidTime = 1;
        $dog->$_REQUEST['id']->status = 1;
        $dog->$_REQUEST['id']->dogFeedTime = $_SGLOBAL['timestamp'] + 172800;
        $dog->$_REQUEST['id']->dogUnWorkTime = 0;
    }
    $gouliang = 501;
    $fertilizerarr->$gouliang = $fertilizerarr->$gouliang + $dogs[$_REQUEST['id']]['list'][1][gouliang];
    //�Զ�ѹ�����
    foreach ($fertilizerarr as $key2 => $value2) {
        if ($value2 == 0) {
            unset($fertilizerarr->$key2);
        }
    }
    $fertilizerarr_srt = json_encode($fertilizerarr);
    $dog_srt = json_encode($dog);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set fb=fb-" . $dogs[$_REQUEST['id']]['list'][1][FBPrice] .
        ",dog='" . $dog_srt . "',fertilizer='" . $fertilizerarr_srt . "' where uid=" . $_SGLOBAL['supe_uid']);
    echo "{\"code\":1,\"id\":" . $dog->$_REQUEST['id']->id . ",\"dogName\":\"" . $dogs[$_REQUEST['id']][tName] .
        "\",\"userDog\":{\"dogId\":\"" . $_REQUEST['id'] . "\",\"dogValidTime\":" . $dog->
        $_REQUEST['id']->dogValidTime . ",\"dogFeedTime\":" . $dog->$_REQUEST['id']->
        dogFeedTime . ",\"dogUnWorkTime\":0},\"direction\":\"Buy success.\",\"money\":0,\"FB\":-" .
        $dogs[$_REQUEST['id']]['list'][1][FBPrice] . ",\"type\":4,\"item\":{\"eType\":3,\"eParam\":501,\"eNum\":" .
        $dogs[$_REQUEST['id']]['list'][1][gouliang] . ",\"name\":\"Food\"}}";
    //����־
    $sql = "INSERT INTO " . tname("plug_newfarm_logs") .
        " (`uid`, `type`, `count`, `fromid`, `time`, `cropid`, `isread` ) VALUES (" . $_SGLOBAL['supe_uid'] .
        ", 3, 1, " . $_SGLOBAL['supe_uid'] . ", " . $_SGLOBAL['timestamp'] . ", " . $_REQUEST['id'] .
        ", 1);";
    $_SGLOBAL['db']->query($sql);
    include_once (S_ROOT . "./source/function_cp.php");
    $icon = "farm";
    $title_template = "{actor} tham gia <a href=\"newfarm.php\">nông trại vui vẻ</a> ở <a href=\"http://www.gohooh.com/nhatui\">NHÀ TUI</a>";
    $body_general = "Nông trại vui vẻ tuyệt quá!";
    feed_add($icon, $title_template);
    exit();
}
if ($_REQUEST['mod'] == "farmlandstatus" && $_REQUEST['act'] == "planting") //��ֲ
    {
    $query = $_SGLOBAL['db']->query("SELECT package,exp,farmlandstatus,levelup FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $farmarr = json_decode($list[0][farmlandstatus]);
    $packagearr = json_decode($list[0][package]);
    if ($packagearr->$_REQUEST['cId'] == 0) {
        exit();
    }
    if ($farmarr->farmlandstatus[$_REQUEST['place']]->a != 0) {
        exit();
    }
    $packagearr->$_REQUEST['cId'] = $packagearr->$_REQUEST['cId'] - 1;
    $farmarr->farmlandstatus[$_REQUEST['place']]->a = $_REQUEST['cId'];
    $farmarr->farmlandstatus[$_REQUEST['place']]->b = 6;
    $farmarr->farmlandstatus[$_REQUEST['place']]->f = 0;
    $farmarr->farmlandstatus[$_REQUEST['place']]->g = 0;
    $farmarr->farmlandstatus[$_REQUEST['place']]->h = 1;
    $farmarr->farmlandstatus[$_REQUEST['place']]->i = array();
    $farmarr->farmlandstatus[$_REQUEST['place']]->j = 0;
    $farmarr->farmlandstatus[$_REQUEST['place']]->k = $crops[$_REQUEST['cId']][output];
    $farmarr->farmlandstatus[$_REQUEST['place']]->l = floor($crops[$_REQUEST['cId']][output] *
        0.6);
    if ($farmarr->farmlandstatus[$_REQUEST['place']]->l == 0) {
        $farmarr->farmlandstatus[$_REQUEST['place']]->l = 1;
    }
    $farmarr->farmlandstatus[$_REQUEST['place']]->m = $crops[$_REQUEST['cId']][output];
    $farmarr->farmlandstatus[$_REQUEST['place']]->n = "";
    $farmarr->farmlandstatus[$_REQUEST['place']]->o = 0;
    $farmarr->farmlandstatus[$_REQUEST['place']]->p = array();
    $farmarr->farmlandstatus[$_REQUEST['place']]->q = $_SGLOBAL['timestamp'];
    $farmarr->farmlandstatus[$_REQUEST['place']]->r = $_SGLOBAL['timestamp'];
    $farmarr->farmlandstatus[$_REQUEST['place']]->s = 0;
    $farmarr->farmlandstatus[$_REQUEST['place']]->t = 0;
    $farmarr->farmlandstatus[$_REQUEST['place']]->u = 0;
    $farmarr = json_encode($farmarr);
    $packagearr = json_encode($packagearr);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
        " set exp=exp+2,farmlandstatus='" . $farmarr . "',package='" . $packagearr .
        "' where uid=" . $_SGLOBAL['supe_uid']);
    $levelup_arr = 'false';
    $list[0][exp] >= $list[0][levelup] && $list[0][levelup] < 93001 && include_once ("levelup.php"); //����ʾ
    echo stripslashes("{\"cId\":" . $_REQUEST['cId'] . ",\"farmlandIndex\":" . $_REQUEST['place'] .
        ",\"code\":1,\"poptype\":0,\"direction\":\"\",\"exp\":2,\"levelUp\":" . $levelup_arr .
        "}");
    exit();
}
if ($_REQUEST['mod'] == "farmlandstatus" && $_REQUEST['act'] == "fertilize")
    //ʩ��
    {
    if (intval($_REQUEST['ownerId']) == $_SGLOBAL['supe_uid'] && $_REQUEST['tId'] !=
        "4") {
        $query = $_SGLOBAL['db']->query("SELECT fertilizer,farmlandstatus,activity FROM " .
            tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']);
        while ($value = $_SGLOBAL['db']->fetch_array($query)) {
            $list[] = $value;
        }
        $farmarr = json_decode($list[0][farmlandstatus]);
        $fertarr = json_decode($list[0][fertilizer]);
        if ($fertarr->$_REQUEST['tId'] == 0) {
            echo "1";
            exit();
        }
        $zuowutime = $_SGLOBAL['timestamp'] - $farmarr->farmlandstatus[$_REQUEST['place']]->
            q;
        $ii = 0;
        foreach ($cropstime[$farmarr->farmlandstatus[$_REQUEST['place']]->a] as $key =>
            $value) {
            if ($value <= $zuowutime) {
                $ii = $key + 1;
            }
        }
        if ($farmarr->farmlandstatus[$_REQUEST['place']]->o == $ii + 1) {
            echo $farmarr->farmlandstatus[$_REQUEST['place']]->o;
            echo "|";
            echo $_SGLOBAL['timestamp'];
            echo "|";
            echo $farmarr->farmlandstatus[$_REQUEST['place']]->q;
            echo "|";
            echo $zuowutime;
            echo "|";
            echo $value;
            echo "|";
            exit();
        }
        //������Ч��-�Լ�
        if ($list[0][activity] == 7) {
            $tools[$_REQUEST['tId']][effect] = $tools[$_REQUEST['tId']][effect] * 2;
        }
        $zuowutime += $tools[$_REQUEST['tId']][effect];
        if ($cropstime[$farmarr->farmlandstatus[$_REQUEST['place']]->a][$ii] < $zuowutime) {
            $zuowutime = $cropstime[$farmarr->farmlandstatus[$_REQUEST['place']]->a][$ii];
        }
        $farmarr->farmlandstatus[$_REQUEST['place']]->q = $_SGLOBAL['timestamp'] - $zuowutime;
        $farmarr->farmlandstatus[$_REQUEST['place']]->o = $ii + 1;
        $fertarr->$_REQUEST['tId'] = $fertarr->$_REQUEST['tId'] - 1;
        $farmarr_str = json_encode($farmarr);
        $fertarr = json_encode($fertarr);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set farmlandstatus='" . $farmarr_str . "',fertilizer='" . $fertarr .
            "' where uid=" . $_SGLOBAL['supe_uid']);
        echo "{\"farmlandIndex\":" . $_REQUEST['place'] . ",\"code\":1,\"tId\":" . $_REQUEST['tId'] .
            ",\"status\":{\"cId\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->a . ",\"cropStatus\":" .
            $farmarr->farmlandstatus[$_REQUEST['place']]->b . ",\"weed\":" . $farmarr->
            farmlandstatus[$_REQUEST['place']]->f . ",\"pest\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->
            g . ",\"humidity\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->h . ",\"killer\":" .
            json_encode($farmarr->farmlandstatus[$_REQUEST['place']]->i) . ",\"harvestTimes\":" .
            $farmarr->farmlandstatus[$_REQUEST['place']]->j . ",\"output\":" . $farmarr->
            farmlandstatus[$_REQUEST['place']]->k . ",\"min\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->
            l . ",\"leavings\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->m . ",\"thief\":2,\"fertilize\":" .
            $farmarr->farmlandstatus[$_REQUEST['place']]->o . ",\"action\":" . json_encode($farmarr->
            farmlandstatus[$_REQUEST['place']]->p) . ",\"plantTime\":" . $farmarr->
            farmlandstatus[$_REQUEST['place']]->q . ",\"updateTime\":" . $farmarr->
            farmlandstatus[$_REQUEST['place']]->r . ",\"pId\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->
            s . ",\"nph\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->t . ",\"mph\":" .
            $farmarr->farmlandstatus[$_REQUEST['place']]->u . "}}";
        exit();
    }
    if ((intval($_REQUEST['ownerId']) != $_SGLOBAL['supe_uid']) && $_REQUEST['tId'] ==
        "4") {
        $farmarr = $_SGLOBAL['db']->query("SELECT farmlandstatus,activity FROM " . tname
            ("plug_newfarm") . " where uid=" . intval($_REQUEST['ownerId']));
        $fertarr = $_SGLOBAL['db']->query("SELECT fertilizer FROM " . tname("plug_newfarm") .
            " where uid=" . $_SGLOBAL['supe_uid']);
        while ($value = $_SGLOBAL['db']->fetch_array($farmarr)) {
            $list[] = $value;
        }
        $farmarr = json_decode($list[0][farmlandstatus]);
        while ($value = $_SGLOBAL['db']->fetch_array($fertarr)) {
            $list1[] = $value;
        }
        $fertarr = json_decode($list1[0][fertilizer]);
        if ($fertarr->$_REQUEST['tId'] == 0) {
            exit();
        }
        $zuowutime = $_SGLOBAL['timestamp'] - $farmarr->farmlandstatus[$_REQUEST['place']]->
            q;
        $ii = 0;
        foreach ($cropstime[$farmarr->farmlandstatus[$_REQUEST['place']]->a] as $key =>
            $value) {
            if ($value <= $zuowutime) {
                $ii = $key + 1;
            }
        }
        if ($farmarr->farmlandstatus[$_REQUEST['place']]->o == $ii + 1) {
            exit();
        }
        //������Ч��-����
        if ($list[0][activity] == 7) {
            $tools[$_REQUEST['tId']][effect] = $tools[$_REQUEST['tId']][effect] * 2;
        }
        $zuowutime += $tools[$_REQUEST['tId']][effect];
        if ($cropstime[$farmarr->farmlandstatus[$_REQUEST['place']]->a][$ii] < $zuowutime) {
            $zuowutime = $cropstime[$farmarr->farmlandstatus[$_REQUEST['place']]->a][$ii];
        }
        $farmarr->farmlandstatus[$_REQUEST['place']]->q = $_SGLOBAL['timestamp'] - $zuowutime;
        $farmarr->farmlandstatus[$_REQUEST['place']]->o = $ii + 1;
        $fertarr->$_REQUEST['tId'] = $fertarr->$_REQUEST['tId'] - 1;
        $farmarr_str = json_encode($farmarr);
        $fertarr = json_encode($fertarr);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set farmlandstatus='" . $farmarr_str . "' where uid=" . intval($_REQUEST['ownerId']));
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set fertilizer='" .
            $fertarr . "' where uid=" . $_SGLOBAL['supe_uid']);
        echo "{\"farmlandIndex\":" . $_REQUEST['place'] . ",\"code\":1,\"tId\":" . $_REQUEST['tId'] .
            ",\"status\":{\"cId\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->a . ",\"cropStatus\":" .
            $farmarr->farmlandstatus[$_REQUEST['place']]->b . ",\"weed\":" . $farmarr->
            farmlandstatus[$_REQUEST['place']]->f . ",\"pest\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->
            g . ",\"humidity\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->h . ",\"killer\":" .
            json_encode($farmarr->farmlandstatus[$_REQUEST['place']]->i) . ",\"harvestTimes\":" .
            $farmarr->farmlandstatus[$_REQUEST['place']]->j . ",\"output\":" . $farmarr->
            farmlandstatus[$_REQUEST['place']]->k . ",\"min\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->
            l . ",\"leavings\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->m . ",\"thief\":2,\"fertilize\":" .
            $farmarr->farmlandstatus[$_REQUEST['place']]->o . ",\"action\":" . json_encode($farmarr->
            farmlandstatus[$_REQUEST['place']]->p) . ",\"plantTime\":" . $farmarr->
            farmlandstatus[$_REQUEST['place']]->q . ",\"updateTime\":" . $farmarr->
            farmlandstatus[$_REQUEST['place']]->r . ",\"pId\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->
            s . ",\"nph\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->t . ",\"mph\":" .
            $farmarr->farmlandstatus[$_REQUEST['place']]->u . "}}";
        //�����ʩ����־
        $sql = "INSERT INTO " . tname("plug_newfarm_logs") .
            " (`uid`, `type`, `count`, `fromid`, `time`, `cropid`, `isread` ) VALUES (" . $_REQUEST['ownerId'] .
            ", 9, 0, " . $_SGLOBAL['supe_uid'] . ", " . $_SGLOBAL['timestamp'] . ", 0, 0);";
        $_SGLOBAL['db']->query($sql);
        include_once (S_ROOT . "./source/function_cp.php");
        $icon = "farm";
        $title_template = "{actor} chăm sóc <a href=\"newfarm.php\">nông sản</a> ở <a href=\"http://www.gohooh.com/nhatui\">NHÀ TUI</a>";
        $touserspace = getspace(intval($_REQUEST['ownerId']));
        if (empty($touserspace[name])) {
            $touserspace[name] = $touserspace[username];
        }
        $title_data = array("touser" => "<a href=\"space.php?uid=" . intval($_REQUEST['ownerId']) .
            "\">" . $touserspace[username] . "</a>");
        $body_general = "Vụ này tớ sẽ trúng lớn";
        feed_add($icon, $title_template, null, null, null, null);
        exit();
    }
}
if ($_REQUEST['mod'] == "repertory" && $_REQUEST['act'] == "getUserCrop") //�ֿ�
    {
    $fruit = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT fruit FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
    $fruit = json_decode($fruit);
    //�Զ�ѹ������ֿⳬʱ
    foreach ($fruit as $key2 => $value2) {
        if ($key2 == 0) {
          unset($fruit->$key2);
		  $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set fruit='".json_encode($fruit)."' where uid=" . $_SGLOBAL['supe_uid']);
       }
    }
    $fruitarr = array();
    foreach ($fruit as $key => $value) {
        if (0 < $value) {
            $fruitarr[] = "{\"cId\":" . $key . ",\"cType\":" . $crops[$key][cType] . ",\"cName\":\"" . $crops[$key][cName] . "\",\"amount\":" . $value . ",\"price\":\"" . $crops[$key][sale] . "\"}";
        }
    }
    if (join($fruitarr) != '') {
        $fruitarr = json_encode($fruitarr);
        $fruitarr = str_replace("\"{", "{", $fruitarr);
        $fruitarr = str_replace("}\"", "}", $fruitarr);
    } else {
        $fruitarr = '[]';
    }
    echo stripslashes($fruitarr);
}
if ($_REQUEST['mod'] == "farmlandstatus" && $_REQUEST['act'] == "harvest") //�ջ�
    {
    $query = $_SGLOBAL['db']->query("SELECT fruit,farmlandstatus,nosegay,exp,levelup,activity FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $farmarr = json_decode($list[0][farmlandstatus]);
    $fruitarr = json_decode($list[0][fruit]);
    $nosegayarr = json_decode($list[0][nosegay]);
    if ($farmarr->farmlandstatus[$_REQUEST['place']]->j == 0 && $_SGLOBAL['timestamp'] -
        $farmarr->farmlandstatus[$_REQUEST['place']]->q < $cropstime[$farmarr->
        farmlandstatus[$_REQUEST['place']]->a][4]) {
        exit();
    }
    if ($farmarr->farmlandstatus[$_REQUEST['place']]->j > 0 && $_SGLOBAL['timestamp'] -
        $farmarr->farmlandstatus[$_REQUEST['place']]->q < $cropstime[$farmarr->
        farmlandstatus[$_REQUEST['place']]->a][4]) {
        exit();
    }
    $cid = $farmarr->farmlandstatus[$_REQUEST['place']]->a;
    if ($farmarr->farmlandstatus[$_REQUEST['place']]->b == 7) {
        exit();
    }
    if (2000 < $cid) {
        $nosegayarr->$cid = $nosegayarr->$cid + $farmarr->farmlandstatus[$_REQUEST['place']]->
            m;
    } else {
        $output = $farmarr->farmlandstatus[$_REQUEST['place']]->f + $farmarr->
            farmlandstatus[$_REQUEST['place']]->g + ($farmarr->farmlandstatus[$_REQUEST['place']]-> h == 1 ? 0 : 1) + $farmarr->farmlandstatus[$_REQUEST['place']]->s * 3; //������вݣ������һ��������д�棬�����3����Щ���ۼӵģ����һ��أ�3�ò�3��С��ɺ�1���棬��������󽫼�� 3+3+1+1*3=10
        if ($farmarr->farmlandstatus[$_REQUEST['place']]->m > $output) {
            $farmarr->farmlandstatus[$_REQUEST['place']]->m -= $output;
        } else {
            $farmarr->farmlandstatus[$_REQUEST['place']]->m = 1;
        }

        //���������
        if ($list[0][activity] == 1) {
            $farmarr->farmlandstatus[$_REQUEST['place']]->m = $farmarr->farmlandstatus[$_REQUEST['place']]->
                m * 2;
        }

        $fruitarr->$cid = $fruitarr->$cid + $farmarr->farmlandstatus[$_REQUEST['place']]->
            m;
    }
    $charm = 0;
    if (100 < $cid) {
        $charm = $crops[$cid][cropChr];
        //���������
        if ($list[0][activity] == 3) {
            $charm = $crops[$cid][cropChr] * 2;
        }
    }
    $harvest = $farmarr->farmlandstatus[$_REQUEST['place']]->m;
    $farmarr->farmlandstatus[$_REQUEST['place']]->f = 0;
    $farmarr->farmlandstatus[$_REQUEST['place']]->g = 0;
    $farmarr->farmlandstatus[$_REQUEST['place']]->h = 1;
    $farmarr->farmlandstatus[$_REQUEST['place']]->i = array();
    $farmarr->farmlandstatus[$_REQUEST['place']]->n = "";
    $farmarr->farmlandstatus[$_REQUEST['place']]->o = 0;
    $farmarr->farmlandstatus[$_REQUEST['place']]->p = array();
    $farmarr->farmlandstatus[$_REQUEST['place']]->r = $_SGLOBAL['timestamp'];
    $farmarr->farmlandstatus[$_REQUEST['place']]->s = 0;
    $farmarr->farmlandstatus[$_REQUEST['place']]->t = 0;
    $farmarr->farmlandstatus[$_REQUEST['place']]->u = 0;
    if ($farmarr->farmlandstatus[$_REQUEST['place']]->j + 1 == $crops[$farmarr->
        farmlandstatus[$_REQUEST['place']]->a][maturingTime]) {
        $farmarr->farmlandstatus[$_REQUEST['place']]->b = 7;
        $farmarr->farmlandstatus[$_REQUEST['place']]->j = 0;
        $farmarr->farmlandstatus[$_REQUEST['place']]->q = 0;
        $farmarr->farmlandstatus[$_REQUEST['place']]->k = 0;
        $farmarr->farmlandstatus[$_REQUEST['place']]->l = 0;
        $farmarr->farmlandstatus[$_REQUEST['place']]->m = 0;
    } else {
        $farmarr->farmlandstatus[$_REQUEST['place']]->b = 6;
        $farmarr->farmlandstatus[$_REQUEST['place']]->j = $farmarr->farmlandstatus[$_REQUEST['place']]->
            j + 1;
        $farmarr->farmlandstatus[$_REQUEST['place']]->q = $_SGLOBAL['timestamp'] - $cropstime[$farmarr->
            farmlandstatus[$_REQUEST['place']]->a][2];
        $farmarr->farmlandstatus[$_REQUEST['place']]->k = $crops[$farmarr->
            farmlandstatus[$_REQUEST['place']]->a][output];
        $farmarr->farmlandstatus[$_REQUEST['place']]->l = floor($crops[$farmarr->
            farmlandstatus[$_REQUEST['place']]->a][output] * 0.6);
        $farmarr->farmlandstatus[$_REQUEST['place']]->m = $crops[$farmarr->
            farmlandstatus[$_REQUEST['place']]->a][output];
    }
    $farmarr_str = json_encode($farmarr);
    $fruitarr = json_encode($fruitarr);
    $nosegayarr = json_encode($nosegayarr);
    //���������
    if ($list[0][activity] == 2) {
        $crops[$farmarr->farmlandstatus[$_REQUEST['place']]->a][cropExp] = $crops[$farmarr->
            farmlandstatus[$_REQUEST['place']]->a][cropExp] * 2;
    }

    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set charm=charm+" .
        $charm . ",exp=exp+" . $crops[$farmarr->farmlandstatus[$_REQUEST['place']]->a][cropExp] .
        ",farmlandstatus='" . $farmarr_str . "',fruit='" . $fruitarr . "',nosegay='" . $nosegayarr .
        "' where uid=" . $_SGLOBAL['supe_uid']);
    $levelup_arr = 'false';
    $list[0][exp] >= $list[0][levelup] && $list[0][levelup] < 93001 && include_once ("levelup.php"); //����ʾ
    echo stripslashes("{\"farmlandIndex\":" . $_REQUEST['place'] . ",\"code\":1,\"poptype\":4,\"direction\":\"\",\"harvest\":" .
        $harvest . ",\"exp\":" . $crops[$farmarr->farmlandstatus[$_REQUEST['place']]->a][cropExp] .
        ",\"levelUp\":" . $levelup_arr . ",\"charm\":\"" . $charm . "\",\"status\":{\"cId\":" .
        $farmarr->farmlandstatus[$_REQUEST['place']]->a . ",\"cropStatus\":" . $farmarr->
        farmlandstatus[$_REQUEST['place']]->b . ",\"weed\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->
        f . ",\"pest\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->g . ",\"humidity\":" .
        $farmarr->farmlandstatus[$_REQUEST['place']]->h . ",\"killer\":" . json_encode($farmarr->
        farmlandstatus[$_REQUEST['place']]->i) . ",\"harvestTimes\":" . $farmarr->
        farmlandstatus[$_REQUEST['place']]->j . ",\"output\":" . $farmarr->
        farmlandstatus[$_REQUEST['place']]->k . ",\"min\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->
        l . ",\"leavings\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->m . ",\"thief\":2,\"fertilize\":" .
        $farmarr->farmlandstatus[$_REQUEST['place']]->o . ",\"action\":" . json_encode($farmarr->
        farmlandstatus[$_REQUEST['place']]->p) . ",\"plantTime\":" . $farmarr->
        farmlandstatus[$_REQUEST['place']]->q . ",\"updateTime\":" . $farmarr->
        farmlandstatus[$_REQUEST['place']]->r . ",\"pId\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->
        s . ",\"nph\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->t . ",\"mph\":" .
        $farmarr->farmlandstatus[$_REQUEST['place']]->u . "}}");
    exit();
}
if ($_REQUEST['mod'] == "farmlandstatus" && $_REQUEST['act'] == "scrounge") {
    $money_a = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT money FROM " .
        tname("plug_newfarm") . " where uid=" . intval($_SGLOBAL['supe_uid'])), 0);
    $query = $_SGLOBAL['db']->query("SELECT dog,activity FROM " . tname("plug_newfarm") .
        " where uid=" . intval($_REQUEST['ownerId']));
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $dog = json_decode($list[0][dog]);
    $dogstr = "";
    $dog_poptype = 4;
    $dog_harvest = 1;
    $dog_money = 0;
    $dog_thief = 1;
    $dog_ok = 0;
    foreach ($dog as $key => $value) {
        if ($value->status == 1 && $_SGLOBAL['timestamp'] < $value->dogFeedTime && $_SGLOBAL['timestamp'] >
            $value->dogUnWorkTime) {
            $suiji = rand(1, 10);
            if ($suiji > 6) {
                $dog_ok = 1;
                $dog_poptype = 3;
                $dog_harvest = 0;
                $dog_thief = 0;
                $suiji2 = rand(1, 10);
                if ($suiji2 > 8) {
                    $dog_money = round(20 * rand(1, 30) / 5) * rand(1, 2);
                } else {
                    $dog_money = round(10 * rand(1, 20) / 5);
                }
            }
        }
    }
    $farm = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT farmlandstatus FROM " .
        tname("plug_newfarm") . " where uid=" . intval($_REQUEST['ownerId'])), 0);
    $fruit = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT fruit FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
    $farmarr = json_decode($farm);
    $fruitarr = json_decode($fruit);
    if (stristr($farmarr->farmlandstatus[$_REQUEST['place']]->n, "," . $_SGLOBAL['supe_uid'] .
        ",")) {
        exit();
    }
    if ($dog_ok == 0) {
        $cid = $farmarr->farmlandstatus[$_REQUEST['place']]->a;
        $place_m = mt_rand(1, 3); //������͵�����1~3
        $fruitarr->$cid = $fruitarr->$cid + $place_m;
        if ($place_m > $farmarr->farmlandstatus[$_REQUEST['place']]->m - $farmarr->
            farmlandstatus[$_REQUEST['place']]->l) {
            $place_m = $farmarr->farmlandstatus[$_REQUEST['place']]->m - $farmarr->
                farmlandstatus[$_REQUEST['place']]->l;
        } //�жϣ�����͵���������1С�������ɵ��������ô�����ɵ�����Զ���С����Чֵ
        $farmarr->farmlandstatus[$_REQUEST['place']]->m = $farmarr->farmlandstatus[$_REQUEST['place']]->
            m - $place_m;
        if ($farmarr->farmlandstatus[$_REQUEST['place']]->m < $farmarr->farmlandstatus[$_REQUEST['place']]->
            l) {
            exit();
        }
        $farmarr->farmlandstatus[$_REQUEST['place']]->n = $farmarr->farmlandstatus[$_REQUEST['place']]->
            n . "," . $_SGLOBAL['supe_uid'] . ",";
        $farmarr_str = json_encode($farmarr);
        $fruitarr = json_encode($fruitarr);

        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set farmlandstatus='" . $farmarr_str . "' where uid=" . intval($_REQUEST['ownerId']));
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set fruit='" . $fruitarr .
            "' where uid=" . $_SGLOBAL['supe_uid']);
        //͵��־
        $sql1 = "SELECT `id`, `uid`, `cropid`, `fromid`, `count`,`counts`,`time`, `type` FROM  " .
            tname("plug_newfarm_logs") . " WHERE fromid = " . $_SGLOBAL['supe_uid'] .
            " and type=1 and uid = " . $_REQUEST['ownerId'] . " and time > " . ($_SGLOBAL['timestamp'] -
            3600);
        $query_r = $_SGLOBAL['db']->query($sql1);
        $value_r = $_SGLOBAL['db']->fetch_array($query_r);
        if ($value_r != null) {
            //while ( $value_r = $_SGLOBAL['db']->fetch_array($query_r) ){
            $result[] = $value_r;
            //}
            if (strpos($result[0][counts], ':') !== false) {
                $counts_ = explode(';', $result[0][counts]);
                $counts_chk = true;
                foreach ($counts_ as $key => $value_) {
                    $counts_t = explode(':', $value_);
                    if ($counts_t[0] == $cid) {
                        $counts_t[1]++;
                        $counts_chk = false;
                        $counts_[$key] = join(':', $counts_t);
                        break;
                    }
                }
                if ($counts_chk) {
                    $counts_all = $result[0][counts] . ";{$cid}:1";
                } else {
                    $counts_all = join(';', $counts_);
                }
            } else {
                $counts_all = "{$cid}:1";
            }
            $sql = "UPDATE " . tname("plug_newfarm_logs") . " set count = count+1,counts='{$counts_all}',time = " .
                $_SGLOBAL['timestamp'] . " where id = " . $result[0][id];
        } else {
            $sql = "INSERT INTO " . tname("plug_newfarm_logs") .
                " (`uid`, `type`, `count`,`counts`, `fromid`, `time`, `cropid`, `isread` ) VALUES (" .
                $_REQUEST['ownerId'] . ", 1, 1,'{$cid}:1', " . $_SGLOBAL['supe_uid'] . ", " . $_SGLOBAL['timestamp'] .
                ", " . $cid . ", 0);";
        }
        $_SGLOBAL['db']->query($sql);
        //͵��־
        echo "{\"farmlandIndex\":" . $_REQUEST['place'] . ",\"code\":1,\"poptype\":4,\"direction\":\"\",\"harvest\":" .
            $place_m . ",\"status\":{\"cId\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->
            a . ",\"cropStatus\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->b . ",\"weed\":" .
            $farmarr->farmlandstatus[$_REQUEST['place']]->f . ",\"pest\":" . $farmarr->
            farmlandstatus[$_REQUEST['place']]->g . ",\"humidity\":" . $farmarr->
            farmlandstatus[$_REQUEST['place']]->h . ",\"killer\":" . json_encode($farmarr->
            farmlandstatus[$_REQUEST['place']]->i) . ",\"harvestTimes\":" . $farmarr->
            farmlandstatus[$_REQUEST['place']]->j . ",\"output\":" . $farmarr->
            farmlandstatus[$_REQUEST['place']]->k . ",\"min\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->
            l . ",\"leavings\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->m . ",\"thief\":1,\"fertilize\":" .
            $farmarr->farmlandstatus[$_REQUEST['place']]->o . ",\"action\":" . json_encode($farmarr->
            farmlandstatus[$_REQUEST['place']]->p) . ",\"plantTime\":" . $farmarr->
            farmlandstatus[$_REQUEST['place']]->q . ",\"updateTime\":" . $farmarr->
            farmlandstatus[$_REQUEST['place']]->r . ",\"pId\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->
            s . ",\"nph\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->t . ",\"mph\":" .
            $farmarr->farmlandstatus[$_REQUEST['place']]->u . "}}";

        //FEED ADD
        include_once (S_ROOT . "./source/function_cp.php");
        $icon = "farm";
        $title_template = "{actor} xuống giống <a href=\"newfarm.php\">nông sản</a> ở <a href=\"http://www.gohooh.com/nhatui\">NHÀ TUI</a>";
        $touserspace = getspace(intval($_REQUEST['ownerId']));
        if (empty($touserspace[name])) {
            $touserspace[name] = $touserspace[username];
        }
        $title_data = array("touser" => "<a href=\"space.php?uid=" . intval($_REQUEST['ownerId']) .
            "\">" . $touserspace[username] . "</a>");
        $body_general = "Tham gia nông trại để có nhiều bạn mới";
    } else {
        if ($money_a < $farmarr->farmlandstatus[$_REQUEST['place']]->m) {
            echo "{\"farmlandIndex\":" . $_REQUEST['place'] . ",\"code\":1,\"poptype\":1,\"direction\":\"Không hái trộm nó, nếu không bạn sẽ bị trả tiền đánh bắt.\",\"status\":{\"cId\":" .
                $farmarr->farmlandstatus[$_REQUEST['place']]->a . ",\"cropStatus\":" . $farmarr->
                farmlandstatus[$_REQUEST['place']]->b . ",\"weed\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->
                f . ",\"pest\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->g . ",\"humidity\":" .
                $farmarr->farmlandstatus[$_REQUEST['place']]->h . ",\"killer\":" . json_encode($farmarr->
                farmlandstatus[$_REQUEST['place']]->i) . ",\"harvestTimes\":" . $farmarr->
                farmlandstatus[$_REQUEST['place']]->j . ",\"output\":" . $farmarr->
                farmlandstatus[$_REQUEST['place']]->k . ",\"min\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->
                l . ",\"leavings\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->m . ",\"thief\":0,\"fertilize\":" .
                $farmarr->farmlandstatus[$_REQUEST['place']]->o . ",\"action\":" . json_encode($farmarr->
                farmlandstatus[$_REQUEST['place']]->p) . ",\"plantTime\":" . $farmarr->
                farmlandstatus[$_REQUEST['place']]->q . ",\"updateTime\":" . $farmarr->
                farmlandstatus[$_REQUEST['place']]->r . ",\"pId\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->
                s . ",\"nph\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->t . ",\"mph\":" .
                $farmarr->farmlandstatus[$_REQUEST['place']]->u . "}}";
            exit();
            exit();
        }
        $farmarr->farmlandstatus[$_REQUEST['place']]->n = $farmarr->farmlandstatus[$_REQUEST['place']]->
            n . "," . $_SGLOBAL['supe_uid'] . ",";
        $farmarr_str = json_encode($farmarr);
        //������Ч��-����
        if ($list[0][activity] == 8) {
            $dog_money = $dog_money * 2;
        }
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set money=money-" .
            $dog_money . " where uid=" . intval($_SGLOBAL['supe_uid']));
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set money=money+" .
            $dog_money . " where uid=" . intval($_REQUEST['ownerId']));
        //��ҧ��־
        $sql1 = "SELECT `id`, `uid`, `fromid`, `count`, `type` FROM  " . tname("plug_newfarm_logs") .
            " WHERE fromid = " . $_SGLOBAL['supe_uid'] . " and type = 4 and uid = " . $_REQUEST['ownerId'];
        $result = $_SGLOBAL['db']->query($sql1);
        $result = $_SGLOBAL['db']->fetch_array($result);
        if ($result != null) {
            $sql = "UPDATE " . tname("plug_newfarm_logs") . " set count = count+" . $dog_money .
                ", time = " . $_SGLOBAL['timestamp'] . " where fromid = " . $_SGLOBAL['supe_uid'] .
                " and type = 4 and uid = " . $_REQUEST['ownerId'];
        } else {
            $sql = "INSERT INTO " . tname("plug_newfarm_logs") .
                " (`uid`, `type`, `count`, `fromid`, `time`, `cropid`, `isread` ) VALUES (" . $_REQUEST['ownerId'] .
                ", 4," . $dog_money . ", " . $_SGLOBAL['supe_uid'] . ", " . $_SGLOBAL['timestamp'] .
                ", 0, 0);";
        }
        $_SGLOBAL['db']->query($sql); //��ҧ��־

        $farmarr_str = json_encode($farmarr);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set farmlandstatus='" . $farmarr_str . "' where uid=" . intval($_REQUEST['ownerId']));
        echo "{\"farmlandIndex\":" . $_REQUEST['place'] . ",\"code\":1,\"poptype\":3,\"direction\":\"Bạn đã bị hái trộm khi chó của bạn không canh gác." .
            $dog_money . "Gold.\",\"money\":" . (0 - $dog_money) . ",\"status\":{\"cId\":" .
            $farmarr->farmlandstatus[$_REQUEST['place']]->a . ",\"cropStatus\":" . $farmarr->
            farmlandstatus[$_REQUEST['place']]->b . ",\"weed\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->
            f . ",\"pest\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->g . ",\"humidity\":" .
            $farmarr->farmlandstatus[$_REQUEST['place']]->h . ",\"killer\":" . json_encode($farmarr->
            farmlandstatus[$_REQUEST['place']]->i) . ",\"harvestTimes\":" . $farmarr->
            farmlandstatus[$_REQUEST['place']]->j . ",\"output\":" . $farmarr->
            farmlandstatus[$_REQUEST['place']]->k . ",\"min\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->
            l . ",\"leavings\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->m . ",\"thief\":0,\"fertilize\":" .
            $farmarr->farmlandstatus[$_REQUEST['place']]->o . ",\"action\":" . json_encode($farmarr->
            farmlandstatus[$_REQUEST['place']]->p) . ",\"plantTime\":" . $farmarr->
            farmlandstatus[$_REQUEST['place']]->q . ",\"updateTime\":" . $farmarr->
            farmlandstatus[$_REQUEST['place']]->r . ",\"pId\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->
            s . ",\"nph\":" . $farmarr->farmlandstatus[$_REQUEST['place']]->t . ",\"mph\":" .
            $farmarr->farmlandstatus[$_REQUEST['place']]->u . "}}";


        //FEED ADD
        include_once (S_ROOT . "./source/function_cp.php");
        $icon = "farm";
        $title_template = "{actor}ȥ{touser}�� <a href=\"newfarm.php\">ũ��</a> ͵����С�ı��������";
        $touserspace = getspace(intval($_REQUEST['ownerId']));
        if (empty($touserspace[name])) {
            $touserspace[name] = $touserspace[username];
        }
        $title_data = array("touser" => "<a href=\"space.php?uid=" . intval($_REQUEST['ownerId']) .
            "\">" . $touserspace[username] . "</a>");
        $body_general = "��ʵ�ĳ�����Զ��С͵���µģ�";


    }
    exit();
}
if ($_REQUEST['mod'] == "repertory" && $_REQUEST['act'] == "sale") //��������ʵ--����
    {
    $fruit = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT fruit FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
    $fruitarr = json_decode($fruit);
    if ($fruitarr->$_REQUEST['cId'] < $_REQUEST['number']) {
        exit();
    }
    $fruitarr->$_REQUEST['cId'] = $fruitarr->$_REQUEST['cId'] - $_REQUEST['number'];
    //�Զ�ѹ�����
    foreach ($fruitarr as $key => $value) {
        if ($value == 0) {
            unset($fruitarr->$key);
        }
    }
    $fruitarr = json_encode($fruitarr);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set money=money+" .
        $crops[$_REQUEST['cId']][sale] * $_REQUEST['number'] . ",fruit='" . $fruitarr .
        "' where uid=" . $_SGLOBAL['supe_uid']);
    echo "{\"cId\":" . $_REQUEST['cId'] . ",\"code\":1,\"direction\":\"Bán thành công <font color=\\\"#0099FF\\\"> <b>" .
        $_REQUEST['number'] . "<\\/b> <\\/font>\\đơn vị " . $crops[$_REQUEST['cId']][cName] .
        ", nhận được <font color=\\\"#FF6600\\\"> <b>" . $crops[$_REQUEST['cId']][sale] *
        $_REQUEST['number'] . "<\\/b> <\\/font>\",\"money\":" . $crops[$_REQUEST['cId']][sale] *
        $_REQUEST['number'] . "}";
    //������־
    $sql = "INSERT INTO " . tname("plug_newfarm_logs") .
        " (`uid`, `type`, `count`, `fromid`, `time`, `cropid`, `isread` ) VALUES (" . $_SGLOBAL['supe_uid'] .
        ", 6, " . $_REQUEST['number'] . ", " . $_SGLOBAL['supe_uid'] . ", " . $_SGLOBAL['timestamp'] .
        ", " . $_REQUEST['cId'] . ", 0);";
    $_SGLOBAL['db']->query($sql);
    exit();
}
if ($_REQUEST['mod'] == "repertory" && $_REQUEST['act'] == "saleAll") { //��������ʵ--ȫ��
    $Rtype = $_REQUEST['type'];
    if ($Rtype == "1" || $Rtype == "2") {
        $fruit = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT fruit FROM " .
            tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
        $fruitarr = json_decode($fruit);
        $money = 0;
        foreach ($fruitarr as $key => $value) {
            if ((0 < $value) && ($crops[$key][cType] == $Rtype) && $key != 40 && $key != 3) {
                $money = $money + $crops[$key][sale] * $value;
                $fruitarr->$key = 0;
            }
        }
        $money == 0 && exit("{\"code\":1,\"direction\":\"\",\"money\":0}");
        //�Զ�ѹ��
        foreach ($fruitarr as $key2 => $value2) {
            if ($value2 == 0) {
                unset($fruitarr->$key2);
            }
        }
        $fruitarr = json_encode($fruitarr);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set money=money+" .
            $money . ",fruit='" . $fruitarr . "' where uid=" . $_SGLOBAL['supe_uid']);
        echo "{\"code\":1,\"direction\":\"\",\"money\":" . $money . "}";
        exit();
    }
} //[=17=]����ֿ⣬����ʵ
if ($_REQUEST['mod'] == "farmlandstatus" && $_REQUEST['act'] == "clearWeed")
    //���
    {
    //����ʾ+����Զ����뱳��+�������
    $query = $_SGLOBAL['db']->query("SELECT exp,levelup,fruit,activity FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $mc_id = 40;
    $fruitarr = json_decode($list[0][fruit]);
    $fruitarr->$mc_id = $fruitarr->$mc_id + 1;
    $fruitstr = json_encode($fruitarr);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set fruit='" . $fruitstr .
        "' where uid=" . $_SGLOBAL['supe_uid']);
    $levelup_arr = 'false';
    $list[0][exp] >= $list[0][levelup] && $list[0][levelup] < 93001 && include_once ("levelup.php"); //����ʾ
    //�������
    $exp = 2;
    if ($list[0][activity] == 4) {
        $exp = $exp * 2;
    }

    $farm = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT farmlandstatus FROM " .
        tname("plug_newfarm") . " where uid=" . intval($_REQUEST['ownerId'])), 0);
    $farm = json_decode($farm);
    if ($farm->farmlandstatus[$_REQUEST['place']]->f == 0) {
        exit();
    }
    $farm->farmlandstatus[$_REQUEST['place']]->f = $farm->farmlandstatus[$_REQUEST['place']]->
        f - 1;
    $farm_srt = json_encode($farm);
    if (intval($_REQUEST['ownerId']) == $_SGLOBAL['supe_uid']) {
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set money=money+2,exp=exp+" . $exp . ",farmlandstatus='" . $farm_srt .
            "' where uid=" . $_SGLOBAL['supe_uid']);
        $direction = "";
    } else {
        //��æ�����־
        if ($_SGLOBAL['supe_uid'] != $_REQUEST['ownerId']) {
            $sql1 = "SELECT `id`, `uid`, `cropid`, `fromid`, `count`,`counts`,`time`, `type` FROM  " .
                tname("plug_newfarm_logs") . " WHERE fromid = " . $_SGLOBAL['supe_uid'] .
                " and type=2 and uid = " . $_REQUEST['ownerId'] . " and time > " . ($_SGLOBAL['timestamp'] -
                3600);
            $query_r = $_SGLOBAL['db']->query($sql1);
            $value_r = $_SGLOBAL['db']->fetch_array($query_r);
            if ($value_r != null) {
                //while ( $value_r = $_SGLOBAL['db']->fetch_array($query_r) ){
                $result[] = $value_r;
                //}
                if (strpos($result[0][counts], ':') !== false) {
                    $counts_ = explode(':', $result[0][counts]);
                    $counts_[0]++;
                    $counts_all = join(':', $counts_);
                } else {
                    $counts_all = "1:0:0";
                }
                $sql = "UPDATE " . tname("plug_newfarm_logs") . " set count = count+1,counts='{$counts_all}',time = " .
                    $_SGLOBAL['timestamp'] . " where id = " . $result[0][id];
            } else {
                $sql = "INSERT INTO " . tname("plug_newfarm_logs") .
                    " (`uid`, `type`, `count`,`counts`, `fromid`, `time`, `cropid`, `isread` ) VALUES (" .
                    $_REQUEST['ownerId'] . ", 2, 1,'1:0:0', " . $_SGLOBAL['supe_uid'] . ", " . $_SGLOBAL['timestamp'] .
                    ", 0, 0);";
            }
            $_SGLOBAL['db']->query($sql);
        } //��æ�����־����
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set farmlandstatus='" . $farm_srt . "' where uid=" . intval($_REQUEST['ownerId']));
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set money=money+2,exp=exp+" . $exp . " where uid=" . $_SGLOBAL['supe_uid']);
        $direction = "Cám ơn bạn đã giúp mình diệt cỏ";
    }
    echo stripslashes("{\"tId\":0,\"farmlandIndex\":" . $_REQUEST['place'] . ",\"code\":1,\"poptype\":1,\"direction\":\"" .
        $direction . "\",\"money\":2,\"exp\":" . $exp . ",\"levelUp\":" . $levelup_arr .
        ",\"humidity\":" . $farm->farmlandstatus[$_REQUEST['place']]->h . ",\"pest\":" .
        $farm->farmlandstatus[$_REQUEST['place']]->g . ",\"weed\":" . $farm->
        farmlandstatus[$_REQUEST['place']]->f . ",\"pId\":" . $farm->farmlandstatus[$_REQUEST['place']]->
        s . ",\"nph\":" . $farm->farmlandstatus[$_REQUEST['place']]->t . ",\"mph\":" . $farm->
        farmlandstatus[$_REQUEST['place']]->u . ",\"killer\":" . json_encode($farm->
        farmlandstatus[$_REQUEST['place']]->i) . "}");
}
if ($_REQUEST['mod'] == "farmlandstatus" && $_REQUEST['act'] == "spraying") //���
    {

    $farm = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT farmlandstatus FROM " .
        tname("plug_newfarm") . " where uid=" . intval($_REQUEST['ownerId'])), 0);
    $farm = json_decode($farm);
    if ($farm->farmlandstatus[$_REQUEST['place']]->g == 0 && $farm->farmlandstatus[$_REQUEST['place']]->
        s == 0) {
        exit();
    }
    $fertarr = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT fertilizer FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
    $fertarr = json_decode($fertarr);
    $farm->farmlandstatus[$_REQUEST['place']]->i = (array )$farm->farmlandstatus[$_REQUEST['place']]->
        i;
    if ($farm->farmlandstatus[$_REQUEST['place']]->s == 1 && $farm->farmlandstatus[$_REQUEST['place']]->
        g == 0) {
        foreach ($farm->farmlandstatus[$_REQUEST['place']]->i as $key => $val) {
            if ($key == $_SGLOBAL['supe_uid'] && $val > $_SGLOBAL['timestamp'] - 3600) {
                echo "{\"farmlandIndex\":" . $_REQUEST['place'] . ",\"code\":0,\"poptype\":1,\"direction\":\"Bạn có thuốc trừ sâu, mỗi giờ chỉ giết sâu 1 lần.\"}";
                exit();
            }
        }
    }

    if ($_REQUEST['tId'] == 6) {
        if ($farm->farmlandstatus[$_REQUEST['place']]->s == 1) {
            //ǿ�ɱ���
            if ($fertarr->$_REQUEST['tId'] == 0) {
                exit();
            }
            $getmoney = $getexp = 35;
            $farm->farmlandstatus[$_REQUEST['place']]->t = 0;
            $farm->farmlandstatus[$_REQUEST['place']]->u = 0;
            $farm->farmlandstatus[$_REQUEST['place']]->s = 0;
            $farm->farmlandstatus[$_REQUEST['place']]->i = array();
            $fertarr->$_REQUEST['tId'] = $fertarr->$_REQUEST['tId'] - 1;
            $direction = "Cám ơn bạn đã giúp mình trừ sâu!";
        }
    } else {
        if ($farm->farmlandstatus[$_REQUEST['place']]->g > 0) {
            $getmoney = 2;
            $getexp = 2;
            $farm->farmlandstatus[$_REQUEST['place']]->g = $farm->farmlandstatus[$_REQUEST['place']]->
                g - 1;
            $direction = "";
        } elseif ($farm->farmlandstatus[$_REQUEST['place']]->t > 0) {
            //����ǰ�漸�ξ���Ϊ5
            $getmoney = 5;
            $getexp = 5;
            $farm->farmlandstatus[$_REQUEST['place']]->t = $farm->farmlandstatus[$_REQUEST['place']]->
                t - 1;
            $farm->farmlandstatus[$_REQUEST['place']]->i[$_SGLOBAL['supe_uid']] = $_SGLOBAL['timestamp'];
            $direction = "Beast là rất mạnh mẽ, nhanh chóng khóc " . ($farm->
                farmlandstatus[$_REQUEST['place']]->t + 1) . " Bạn bè đến để giúp đỡ!";
        } else {
            //���һ�ξ���15
            $getmoney = 15;
            $getexp = 15;
            $farm->farmlandstatus[$_REQUEST['place']]->t = 0;
            $farm->farmlandstatus[$_REQUEST['place']]->u = 0;
            $farm->farmlandstatus[$_REQUEST['place']]->s = 0;
            $farm->farmlandstatus[$_REQUEST['place']]->i = array();
            $direction = "Cám ơn bạn đã diệt cỏ giúp mình! ";
        }
    }
    $fertarr = json_encode($fertarr);
    $farm_srt = json_encode($farm);
    //����ʾ+�������
    $query = $_SGLOBAL['db']->query("SELECT exp,levelup,activity FROM " . tname("plug_newfarm") .
        " where uid=" . $_SGLOBAL['supe_uid']);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $levelup_arr = 'false';
    $list[0][exp] >= $list[0][levelup] && $list[0][levelup] < 93001 && include_once ("levelup.php"); //����ʾ
    //�������
    if ($list[0][activity] == 5) {
        $getexp = $getexp * 2;
    }

    if (intval($_REQUEST['ownerId']) == $_SGLOBAL['supe_uid']) {
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set money=money+$getmoney,exp=exp+$getexp,farmlandstatus='" .
            $farm_srt . "',fertilizer='" . $fertarr . "' where uid=" . $_SGLOBAL['supe_uid']);
        $direction = "";
    } else {
        //��æɱ����־��ʼ
        if ($_SGLOBAL['supe_uid'] != $_REQUEST['ownerId']) {
            $sql1 = "SELECT `id`, `uid`, `cropid`, `fromid`, `count`,`counts`,`time`, `type` FROM  " .
                tname("plug_newfarm_logs") . " WHERE fromid = " . $_SGLOBAL['supe_uid'] .
                " and type=2 and uid = " . $_REQUEST['ownerId'] . " and time > " . ($_SGLOBAL['timestamp'] -
                3600);
            $query_r = $_SGLOBAL['db']->query($sql1);
            $value_r = $_SGLOBAL['db']->fetch_array($query_r);
            if ($value_r != null) {
                //while ( $value_r = $_SGLOBAL['db']->fetch_array($query_r) ){
                $result[] = $value_r;
                //}
                if (strpos($result[0][counts], ':') !== false) {
                    $counts_ = explode(':', $result[0][counts]);
                    $counts_[1]++;
                    $counts_all = join(':', $counts_);
                } else {
                    $counts_all = "0:1:0";
                }
                $sql = "UPDATE " . tname("plug_newfarm_logs") . " set count = count+1,counts='{$counts_all}',time = " .
                    $_SGLOBAL['timestamp'] . " where id = " . $result[0][id];
            } else {
                $sql = "INSERT INTO " . tname("plug_newfarm_logs") .
                    " (`uid`, `type`, `count`,`counts`, `fromid`, `time`, `cropid`, `isread` ) VALUES (" .
                    $_REQUEST['ownerId'] . ", 2, 1,'0:1:0', " . $_SGLOBAL['supe_uid'] . ", " . $_SGLOBAL['timestamp'] .
                    ", 0, 0);";
            }
            $_SGLOBAL['db']->query($sql);
        } //��æɱ����־����
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set farmlandstatus='" . $farm_srt . "' where uid=" . intval($_REQUEST['ownerId']));
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set money=money+$getmoney,exp=exp+$getexp,fertilizer='" .
            $fertarr . "' where uid=" . $_SGLOBAL['supe_uid']);
        $direction = "Cám ơn bạn đã giúp mình trừ sâu! ";
    }
    $direction = str_replace("\\u", "\\\\u", $direction);
    echo stripslashes("{\"tId\":" . $_REQUEST['tId'] . ",\"farmlandIndex\":" . $_REQUEST['place'] .
        ",\"code\":1,\"poptype\":1,\"direction\":\"" . $direction . "\",\"money\":$getmoney,\"exp\":$getexp,\"levelUp\":" .
        $levelup_arr . ",\"humidity\":" . $farm->farmlandstatus[$_REQUEST['place']]->h .
        ",\"pest\":" . $farm->farmlandstatus[$_REQUEST['place']]->g . ",\"weed\":" . $farm->
        farmlandstatus[$_REQUEST['place']]->f . ",\"pId\":" . $farm->farmlandstatus[$_REQUEST['place']]->
        s . ",\"nph\":" . $farm->farmlandstatus[$_REQUEST['place']]->t . ",\"mph\":" . $farm->
        farmlandstatus[$_REQUEST['place']]->u . ",\"killer\":" . json_encode($farm->
        farmlandstatus[$_REQUEST['place']]->i) . "}");
}
if ($_REQUEST['mod'] == "farmlandstatus" && $_REQUEST['act'] == "water") {
    $farm = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT farmlandstatus FROM " .
        tname("plug_newfarm") . " where uid=" . intval($_REQUEST['ownerId'])), 0);
    $farm = json_decode($farm);
    if ($farm->farmlandstatus[$_REQUEST['place']]->h == 1) {
        exit();
    }
    $farm->farmlandstatus[$_REQUEST['place']]->h = 1;
    $farm_srt = json_encode($farm);
    //����ʾ+���ˮ��
    $query = $_SGLOBAL['db']->query("SELECT exp,levelup,activity FROM " . tname("plug_newfarm") .
        " where uid=" . $_SGLOBAL['supe_uid']);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $levelup_arr = 'false';
    $list[0][exp] >= $list[0][levelup] && $list[0][levelup] < 93001 && include_once ("levelup.php"); //����ʾ
    //���ˮ��
    $exp = 2;
    if ($list[0][activity] == 6) {
        $exp = $exp * 2;
    }

    if (intval($_REQUEST['ownerId']) == $_SGLOBAL['supe_uid']) {
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set money=money+2,exp=exp+" . $exp . ",farmlandstatus='" . $farm_srt .
            "' where uid=" . $_SGLOBAL['supe_uid']);
        $direction = "";
    } else {
        //��æ��־��ʼ
        if ($_SGLOBAL['supe_uid'] != $_REQUEST['ownerId']) {
            $sql1 = "SELECT `id`, `uid`, `cropid`, `fromid`, `count`,`counts`,`time`, `type` FROM  " .
                tname("plug_newfarm_logs") . " WHERE fromid = " . $_SGLOBAL['supe_uid'] .
                " and type=2 and uid = " . $_REQUEST['ownerId'] . " and time > " . ($_SGLOBAL['timestamp'] -
                3600);
            $query_r = $_SGLOBAL['db']->query($sql1);
            $value_r = $_SGLOBAL['db']->fetch_array($query_r);
            if ($value_r != null) {
                //while ( $value_r = $_SGLOBAL['db']->fetch_array($query_r) ){
                $result[] = $value_r;
                //}
                if (strpos($result[0][counts], ':') !== false) {
                    $counts_ = explode(':', $result[0][counts]);
                    $counts_[2]++;
                    $counts_all = join(':', $counts_);
                } else {
                    $counts_all = "0:0:1";
                }
                $sql = "UPDATE " . tname("plug_newfarm_logs") . " set count = count+1,counts='{$counts_all}',time = " .
                    $_SGLOBAL['timestamp'] . " where id = " . $result[0][id];
            } else {
                $sql = "INSERT INTO " . tname("plug_newfarm_logs") .
                    " (`uid`, `type`, `count`,`counts`, `fromid`, `time`, `cropid`, `isread` ) VALUES (" .
                    $_REQUEST['ownerId'] . ", 2, 1,'0:0:1', " . $_SGLOBAL['supe_uid'] . ", " . $_SGLOBAL['timestamp'] .
                    ", 0, 0);";
            }
            $_SGLOBAL['db']->query($sql);
        } //��æ��־����
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set farmlandstatus='" . $farm_srt . "' where uid=" . intval($_REQUEST['ownerId']));
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set money=money+2,exp=exp+" . $exp . " where uid=" . $_SGLOBAL['supe_uid']);
        $direction = "Cám ơn bạn đã giúp đỡ";
    }
    $direction = str_replace("\\u", "\\\\u", $direction);
    echo stripslashes("{\"tId\":0,\"farmlandIndex\":" . $_REQUEST['place'] . ",\"code\":1,\"poptype\":1,\"direction\":\"" .
        $direction . "\",\"money\":2,\"exp\":" . $exp . ",\"levelUp\":" . $levelup_arr .
        ",\"humidity\":" . $farm->farmlandstatus[$_REQUEST['place']]->h . ",\"pest\":" .
        $farm->farmlandstatus[$_REQUEST['place']]->g . ",\"weed\":" . $farm->
        farmlandstatus[$_REQUEST['place']]->f . ",\"pId\":" . $farm->farmlandstatus[$_REQUEST['place']]->
        s . ",\"nph\":" . $farm->farmlandstatus[$_REQUEST['place']]->t . ",\"mph\":" . $farm->
        farmlandstatus[$_REQUEST['place']]->u . ",\"killer\":" . json_encode($farm->
        farmlandstatus[$_REQUEST['place']]->i) . "}");
}
if ($_REQUEST['mod'] == "dog" && $_REQUEST['act'] == "changeDog") {
    $dog = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT dog FROM " . tname
        ("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
    $dog = json_decode($dog);
    foreach ($dog as $key => $value) {
        if ($value->id == $_REQUEST['id']) {
            if ($value->status == 1) {
                $value->status = 0;
                $dog_echo = "{\"code\":1,\"id\":" . $value->id . ",\"userDog\":{\"dogId\":0,\"dogValidTime\":0,\"dogFeedTime\":" .
                    $value->dogFeedTime . ",\"dogUnWorkTime\":0}}";
            } else {
                $value->status = 1;
                $dog_echo = "{\"code\":1,\"id\":" . $value->id . ",\"userDog\":{\"dogId\":" . $key .
                    ",\"dogValidTime\":0,\"dogFeedTime\":" . $value->dogFeedTime . ",\"dogUnWorkTime\":0}}";
            }
        } else {
            $value->status = 0;
        }
    }
    $dog_srt = json_encode($dog);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set dog='" . $dog_srt .
        "' where uid=" . $_SGLOBAL['supe_uid']);
    echo $dog_echo;
    exit();
}
if ($_REQUEST['mod'] == "Nosegay" && $_REQUEST['act'] == "makeDogFood") {
    $query = $_SGLOBAL['db']->query("SELECT fruit,fertilizer FROM " . tname("plug_newfarm") .
        " where uid=" . $_SGLOBAL['supe_uid']);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $fruit = json_decode($list[0][fruit]);
    $cIds = explode(",", $_REQUEST['cIds']);
    foreach ($cIds as $key => $value) {
        if ($fruit->$value < 3) {
            exit();
        }
        $fruit->$value = $fruit->$value - 3;
    }
    $fertilizer = json_decode($list[0][fertilizer]);
    $gouliang = 501;
    $fertilizer->$gouliang = $fertilizer->$gouliang + 2;
    $fruit = json_encode($fruit);
    $fertilizer = json_encode($fertilizer);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set fruit='" . $fruit .
        "',fertilizer='" . $fertilizer . "' where uid=" . $_SGLOBAL['supe_uid']);
    echo "{\"code\":1,\"cIds\":[" . $_REQUEST['cIds'] . "],\"item\":{\"tId\":501,\"tName\":\"Food\",\"num\":2,\"type\":5}}";
    exit();
}
if ($_REQUEST['mod'] == "Nosegay" && $_REQUEST['act'] == "makeToySeed") {
    $query = $_SGLOBAL['db']->query("SELECT fruit,package FROM " . tname("plug_newfarm") .
        " where uid=" . $_SGLOBAL['supe_uid']);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $fruit = json_decode($list[0][fruit]);
    $cIds = explode(",", $_REQUEST['cIds']);
    foreach ($cIds as $key => $value) {
        if ($fruit->$value < 15) {
            exit();
        }
        $fruit->$value = $fruit->$value - 15;
    }
    $toyid = mt_rand(2001, 2003);
    $package = json_decode($list[0][package]);
    $package->$toyid = $package->$toyid + 1;
    $fruit = json_encode($fruit);
    $package = json_encode($package);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set fruit='" . $fruit .
        "',package='" . $package . "' where uid=" . $_SGLOBAL['supe_uid']);
    echo "{\"code\":1,\"cIds\":[" . $_REQUEST['cIds'] . "],\"item\":{\"cId\":" . $toyid .
        ",\"tName\":\"Mystery Toy Seed\",\"num\":1,\"type\":3}}";
    exit();
}
if ($_REQUEST['mod'] == "Nosegay" && $_REQUEST['act'] == "makeNosegay") //������
    {
    if (3000 < $_REQUEST['id']) {
        $GLOBALS['_REQUEST']['cIds'] = "4,7,10,15,13";
        $query = $_SGLOBAL['db']->query("SELECT fruit,nosegay FROM " . tname("plug_newfarm") .
            " where uid=" . $_SGLOBAL['supe_uid']);
        while ($value = $_SGLOBAL['db']->fetch_array($query)) {
            $list[] = $value;
        }
        $fruit = json_decode($list[0][fruit]);
        $cIds = explode(",", $_REQUEST['cIds']);
        foreach ($cIds as $key => $value) {
            if ($fruit->$value < 15) {
                exit();
            }
            $fruit->$value = $fruit->$value - 15;
        }
        $mooncakeid = mt_rand(3001, 3005);
        $nosegay = json_decode($list[0][nosegay]);
        $nosegay->$mooncakeid = $nosegay->$mooncakeid + 1;
        //�Զ�ѹ�����
        foreach ($nosegay as $key2 => $value2) {
            if ($value2 == 0) {
                unset($nosegay->$key2);
            }
        }
        $fruit = json_encode($fruit);
        $nosegay = json_encode($nosegay);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set fruit='" . $fruit .
            "',nosegay='" . $nosegay . "',charm=charm+20 where uid=" . $_SGLOBAL['supe_uid']);
        echo "{\"code\":1,\"id\":" . $mooncakeid . ",\"charm\":20,\"direction\":\"\"}";
        exit();
    } else {
        $query = $_SGLOBAL['db']->query("SELECT fruit,nosegay FROM " . tname("plug_newfarm") .
            " where uid=" . $_SGLOBAL['supe_uid']);
        while ($value = $_SGLOBAL['db']->fetch_array($query)) {
            $list[] = $value;
        }
        $fruit = json_decode($list[0][fruit]);
        if ($fruit->$makenosegay[$_REQUEST['id']][cid] < $makenosegay[$_REQUEST['id']][neednum]) {
            exit();
        }
        $nosegay = json_decode($list[0][nosegay]);
        $fruit->$makenosegay[$_REQUEST['id']][cid] = $fruit->$makenosegay[$_REQUEST['id']][cid] -
            $makenosegay[$_REQUEST['id']][neednum];
        $nosegay->$_REQUEST['id'] = $nosegay->$_REQUEST['id'] + 1;
        //�Զ�ѹ�����
        foreach ($nosegay as $key => $value) {
            if ($value == 0) {
                unset($nosegay->$key);
            }
        }
        $fruit = json_encode($fruit);
        $nosegay = json_encode($nosegay);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set fruit='" . $fruit .
            "',nosegay='" . $nosegay . "',charm=charm+" . $makenosegay[$_REQUEST['id']][charm] .
            " where uid=" . $_SGLOBAL['supe_uid']);
        echo "{\"code\":1,\"id\":\"" . $_REQUEST['id'] . "\",\"direction\":\"\"}";
        exit();
    }
}
if ($_REQUEST['mod'] == "message" && $_REQUEST['act'] == "getList") {
    $message = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT message FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
    $message = json_decode($message);
    foreach ($message->c as $key => $value) {
        $messagetype3[] = "{\"id\":" . $value->id . ",\"sendTime\":" . $value->sendTime .
            ",\"status\":" . $value->status . "}";
    }
    $messagetype3 = json_encode($messagetype3);
    $messagetype3 = str_replace("\"{", "{", $messagetype3);
    $messagetype3 = str_replace("}\"", "}", $messagetype3);
    foreach ($message->d as $key => $value) {
        if ($value->status == 0) {
            $messagetype4[] = "{\"id\":\"" . $value->id . "\",\"fromId\":\"" . $value->
                fromId . "\",\"fName\":\"" . $value->name . "\",\"sendTime\":\"" . $value->
                sendTime . "\",\"validTime\":\"" . $value->validTime . "\"}";
        }
    }
    $messagetype4 = json_encode($messagetype4);
    $messagetype4 = str_replace("\"{", "{", $messagetype4);
    $messagetype4 = str_replace("}\"", "}", $messagetype4);
    foreach ($message->e as $key => $value) {
        if ($value->status == 0) {
            $messagetype5[] = "{\"id\":" . $value->id . ",\"fromId\":" . $value->friendId .
                ",\"fName\":\"" . $value->fName . "\",\"sendTime\":" . $value->sendTime . ",\"validTime\":" .
                $value->validTime . "}";
        }
    }
    $messagetype5 = json_encode($messagetype5);
    $messagetype5 = str_replace("\"{", "{", $messagetype5);
    $messagetype5 = str_replace("}\"", "}", $messagetype5);
    $result = "{\"1\":[],\"2\":[],\"3\":" . $messagetype3 . ",\"4\":" . $messagetype4 .
        ",\"5\":" . $messagetype5 . "}";
    echo stripslashes(str_ireplace("null", "[]", $result));
    exit();
}
if ($_REQUEST['mod'] == "message" && $_REQUEST['act'] == "openMessage" && $_REQUEST['type'] ==
    "3") {
    $message = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT message FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
    $message = json_decode($message);
    $writesql = 0;
    foreach ($message->c as $key => $value) {
        if ($_REQUEST['id'] == $value->sendTime) {
            if ($value->status == 0) {
                $writesql = 1;
                $value->status = 1;
            }
            $messagetype3 = "{\"fromId\":\"" . $value->fromId . "\",\"sendTime\":" . $value->
                sendTime . ",\"eDesc\":\"" . $value->eDesc . "\",\"status\":" . $value->status .
                ",\"id\":" . $value->id . ",\"name\":\"" . $value->name . "\"}";
        }
    }
    if ($writesql == 1) {
        $message = str_replace("\\", "\\\\", json_encode($message));
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set message='" . $message .
            "' where uid=" . $_SGLOBAL['supe_uid']);
    }
    echo $messagetype3;
}
if ($_REQUEST['mod'] == "message" && $_REQUEST['act'] == "openMessage" && $_REQUEST['type'] ==
    "4") { //�û��������￪ʼ
    $query = $_SGLOBAL['db']->query("SELECT message,decorative FROM " . tname("plug_newfarm") .
        " where uid=" . $_SGLOBAL['supe_uid']);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $message = json_decode($list[0][message]);
    $decorativearr = json_decode($list[0][decorative]);
    $writesql = 0;
    $value_itemId = 0;
    $value_validTime = 1;
    foreach ($message->d as $key => $value) {
        if ($_REQUEST['id'] == $value->id) {
            if ($value->status == 0) {
                $writesql = 1;
                $value->status = 1;
            }
            $value_itemId = $value->itemId;
            $value_validTime = $value->validTime;
            $messagetype4 = "{\"id\":\"" . $value->id . "\",\"itemId\":\"" . $value->itemId .
                "\",\"itemType\":\"" . $value->itemType . "\",\"validTime\":\"" . $value->
                validTime . "\",\"status\":\"2\",\"itemName\":\"\",\"name\":\"" . $value->name .
                "\"}";
        }
    }
    $value_itemId == 0 && exit();
    if ($writesql == 1) {
        foreach ($decorativearr as $key1 => $value1) {
            foreach ($value1 as $key2 => $value2) {
                if ($key2 == $value_itemId) {
                    $value2->validtime = $value_validTime;
                    $writesql = 0;
                }
            }
        }
        if ($writesql == 1) {
            $keyid = $decorative[$value_itemId][itemType];
            $decorativearr->$keyid->$value_itemId->status = 0;
            $decorativearr->$keyid->$value_itemId->validtime = $value_validTime;
        }
        $message = str_replace("\\", "\\\\", json_encode($message));
        $decorativearr = json_encode($decorativearr);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set message='" . $message .
            "',decorative='" . $decorativearr . "' where uid=" . $_SGLOBAL['supe_uid']);
    }
    echo $messagetype4;
    exit();
} //�û������������
if ($_REQUEST['mod'] == "message" && $_REQUEST['act'] == "openMessage" && $_REQUEST['type'] ==
    "5") {
    $message = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT message FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
    $message = json_decode($message);
    $charm = 0;
    foreach ($message->e as $key => $value) {
        if ($_REQUEST['id'] == $value->id) {
            $value->status = 1;
            if (3000 < $value->formulaId) {
                $type = 3;
            } else
                if (2000 < $value->formulaId && $value->formulaId < 3000) {
                    $type = 2;
                } else {
                    $type = 1;
                }
                $messagetype5 = "{\"id\":" . $value->id . ",\"formulaId\":" . $value->formulaId .
                    ",\"type\":" . $type . ",\"friendId\":\"" . $value->friendId . "\",\"fName\":\"" .
                    $value->fName . "\",\"charm\":" . $value->charm . ",\"msg\":\"" . $value->msg .
                    "\",\"show\":0,\"x\":0,\"y\":0,\"z\":0,\"addCharm\":" . $value->charm . "}";
            $charm = $value->charm;
        }
    }
    $message = str_replace("\\", "\\\\", json_encode($message));
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set message='" . $message .
        "',charm=charm+" . $charm . " where uid=" . $_SGLOBAL['supe_uid']);
    echo stripslashes($messagetype5);
}
if ($_REQUEST['mod'] == "Message" && $_REQUEST['act'] == "deleteMessage") //ɾ����Ϣ
    {
    $message = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT message FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
    $message = json_decode($message);
    foreach ($message->c as $key => $value) {
        if ($value->id == $_REQUEST['id']) {
            unset($message->c[$key]);
        }
    }
    $message = json_encode($message);
    $message = preg_replace("'\"[0-9]+\":{'", "{", $message);
    $message = str_ireplace("\"c\":{{", "\"c\":[{", $message);
    $message = str_ireplace("}},\"d\"", "}],\"d\"", $message);
    $message = str_replace("\\u", "\\\\u", $message);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set message='" . $message .
        "' where uid=" . $_SGLOBAL['supe_uid']);
    echo "{\"code\":1}";
    exit();
}
if ($_REQUEST['mod'] == "message" && $_REQUEST['act'] == "sendMessage" && $_REQUEST['type'] ==
    "3") //������Ϣ
    {
    $message = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT message FROM " .
        tname("plug_newfarm") . " where uid=" . intval($_REQUEST['toId'])), 0);
    if ($message == '') {
        exit();
    }
    $request_msg = str_replace(array(",", "\\\"", "\\'", "\\", "\t", "\r\n", "\n", "\r"),
        array(';', '``', '`', '|', '', ' ', '', ''), $_REQUEST['msg']);
    if ($request_msg == '') {
        exit();
    }
    $message = json_decode($message);
    if (count($message->c) >= 59) {
        array_splice($message->c, 0, 1); //ɾ�����ģ�����60��
    }
    $username = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT username FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
    $message->c[] = "{\"fromId\":\"" . $_SGLOBAL['supe_uid'] . "\",\"sendTime\":" .
        $_SGLOBAL['timestamp'] . ",\"eDesc\":\"" . $request_msg . "\",\"status\":0,\"id\":" .
        $_SGLOBAL['timestamp'] . ",\"name\":\"" . unicode_encodegb($username) . "\"}";
    $message = json_encode($message);
    $message = str_replace(array("\"{", "}\"", "\\u", ",null", "null"), array("{",
        "}", "\\\\u", "", ""), $message);
    $message = preg_replace('/,\s*([\]}])/m', '$1', $message); //�滻�����Ķ���{"a":1,"b":2,}
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set message='" . $message .
        "' where uid=" . intval($_REQUEST['toId']));
    echo "{\"code\":1}";
    exit();
}
if ($_REQUEST['mod'] == "message" && $_REQUEST['act'] == "sendMessage" && $_REQUEST['type'] ==
    "4") //����װ��
    {
    $message = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT message FROM " .
        tname("plug_newfarm") . " where uid=" . intval($_REQUEST['toId'])), 0);
    $message = json_decode($message);

    $query = $_SGLOBAL['db']->query("SELECT decorative,username FROM " . tname("plug_newfarm") .
        " where uid=" . $_SGLOBAL['supe_uid'], 0);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $decorativearr = json_decode($list[0][decorative]);
    $validTime = $_SGLOBAL['timestamp'] + 2505600;
    foreach ($decorativearr as $key1 => $value1) {
        foreach ($value1 as $key2 => $value2) {
            if ($key2 == $_REQUEST['id']) {
                $validTime = $value2->validtime;
                $value2->validtime = "1";
            }
        }
    }
    $message->d[] = "{\"id\":\"" . $_SGLOBAL['timestamp'] . "\",\"itemId\":\"" . $_REQUEST['id'] .
        "\",\"itemType\":\"" . $_REQUEST['type'] . "\",\"validTime\":\"" . $validTime .
        "\",\"status\":\"0\",\"itemName\":\"\",\"name\":\"" . unicode_encodegb($list[0][username]) .
        "\"}";
    $message = json_encode($message);
    $message = str_replace("\"{", "{", $message);
    $message = str_replace("}\"", "}", $message);
    $message = str_replace("\\u", "\\\\u", $message);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set message='" . $message .
        "' where uid=" . intval($_REQUEST['toId']));
    $decorativearr = json_encode($decorativearr);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set decorative='" .
        $decorativearr . "' where uid=" . $_SGLOBAL['supe_uid']);
    echo "{\"code\":1,\"type\":4,\"id\":\"" . $_REQUEST['id'] . "\"}";
    exit();
}
if ($_REQUEST['mod'] == "message" && $_REQUEST['act'] == "sendMessage" && $_REQUEST['type'] ==
    "5") //��������
    {
    $query = $_SGLOBAL['db']->query("SELECT nosegay,username FROM " . tname("plug_newfarm") .
        " where uid=" . $_SGLOBAL['supe_uid'], 0);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $nosegay = json_decode($list[0][nosegay]);
    if ($nosegay->$_REQUEST['id'] < 1) {
        echo "1";
        exit();
    }
    $nosegay->$_REQUEST['id'] = $nosegay->$_REQUEST['id'] - 1;
    $message = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT message FROM " .
        tname("plug_newfarm") . " where uid=" . intval($_REQUEST['toId'])), 0);
    if ($message == '') {
        exit();
    }
    $request_msg = str_replace(array(",", "\\\"", "\\'", "\\", "\t", "\r\n", "\n", "\r"),
        array(';', '``', '`', '|', '', ' ', '', ''), $_REQUEST['msg']);
    $message = json_decode($message);
    $duixiang = "{\"id\":" . $_SGLOBAL['timestamp'] . ",\"formulaId\":" . $_REQUEST['id'] .
        ",\"friendId\":\"" . $_SGLOBAL['supe_uid'] . "\",\"fName\":\"" .
        unicode_encodegb($list[0][username]) . "\",\"charm\":" . $makenosegay[$_REQUEST['id']][charm] .
        ",\"validTime\":0,\"msg\":\"" . $request_msg . "\",\"sendTime\":" . $_SGLOBAL['timestamp'] .
        ",\"status\":0,\"x\":0,\"y\":0,\"z\":0}";
    $duixiang = json_decode($duixiang);
    $message->e[] = $duixiang;
    $message = json_encode($message);
    $message = str_replace(array("\"{", "}\"", "\\u", ",null", "null"), array("{",
        "}", "\\\\u", "", ""), $message);
    $message = preg_replace('/,\s*([\]}])/m', '$1', $message); //�滻�����Ķ���{"a":1,"b":2,}
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set message='" . $message .
        "' where uid=" . intval($_REQUEST['toId']));
    //�Զ�ѹ�����
    foreach ($nosegay as $key => $value) {
        if ($value == 0) {
            unset($nosegay->$key);
        }
    }
    $nosegay = json_encode($nosegay);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set nosegay='" . $nosegay .
        "' where uid=" . $_SGLOBAL['supe_uid']);
    echo "{\"code\":1,\"type\":5,\"id\":" . $_REQUEST['id'] . "}";
    include_once (S_ROOT . "./source/function_cp.php");
    $icon = "farm";
    $title_template = "{actor} ghé thăm <a href=\"newfarm.php\">nông trại</a> của {touser}";
    $touserspace = getspace(intval($_REQUEST['toId']));
    if (empty($touserspace[name])) {
        $touserspace[name] = $touserspace[username];
    }
    $title_data = array("touser" => "<a href=\"space.php?uid=" . intval($_REQUEST['toId']) .
        "\">" . $touserspace[username] . "</a>");
    $body_general = "Giúp đỡ nhau mới là nông dân Nhà Tui";
    feed_add($icon, $title_template, $title_data);
    exit();
}
if ($_REQUEST['mod'] == "Gift" && $_REQUEST['act'] == "setXYZ") {
    $message = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT message FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
    $message = json_decode($message);
    foreach ($message->e as $key => $value) {
        if ($_REQUEST['id'] == $value->id) {
            if ($_REQUEST['z'] == "0") {
                $value->status = 1;
                $value->z = $_REQUEST['z'];
                $value->x = $_REQUEST['x'];
                $value->y = $_REQUEST['y'];
            } else {
                $value->status = 2;
                $value->z = $_REQUEST['z'];
                $value->x = $_REQUEST['x'];
                $value->y = $_REQUEST['y'];
            }
        }
    }
    $message = str_replace("\\", "\\\\", json_encode($message));
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set message='" . $message .
        "' where uid=" . $_SGLOBAL['supe_uid']);
    echo "{\"code\":1}";
    exit();
}
if ($_REQUEST['mod'] == "Gift" && $_REQUEST['act'] == "getGift") {
    $message = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT message FROM " .
        tname("plug_newfarm") . " where uid=" . intval($_REQUEST['ownerId'])), 0);
    $message = json_decode($message);
    foreach ($message->e as $key => $value) {
        if ($value->status == 2) {
            if (3000 < $value->formulaId) {
                $type = 3;
            } else
                if (2000 < $value->formulaId && $value->formulaId < 3000) {
                    $type = 2;
                } else {
                    $type = 1;
                }
                $result[] = "{\"id\":" . $value->id . ",\"formulaId\":" . $value->formulaId . ",\"type\":" .
                    $type . ",\"friendId\":\"" . $value->friendId . "\",\"fName\":\"" . $value->
                    fName . "\",\"charm\":" . $value->charm . ",\"msg\":\"" . $value->msg . "\",\"show\":2,\"x\":" .
                    $value->x . ",\"y\":" . $value->y . ",\"z\":" . $value->z . "}";
        }
        if ($value->status == 1) {
            if (3000 < $value->formulaId) {
                $type = 3;
            } else
                if (2000 < $value->formulaId && $value->formulaId < 3000) {
                    $type = 2;
                } else {
                    $type = 1;
                }
                $result[] = "{\"id\":" . $value->id . ",\"formulaId\":" . $value->formulaId . ",\"type\":" .
                    $type . ",\"friendId\":\"" . $value->friendId . "\",\"fName\":\"" . $value->
                    fName . "\",\"charm\":" . $value->charm . ",\"msg\":\"" . $value->msg . "\",\"show\":1,\"x\":" .
                    $value->x . ",\"y\":" . $value->y . ",\"z\":" . $value->z . "}";
        }
        if ($value->status == 0) {
            if (3000 < $value->formulaId) {
                $type = 3;
            } else
                if (2000 < $value->formulaId && $value->formulaId < 3000) {
                    $type = 2;
                } else {
                    $type = 1;
                }
                $result[] = "{\"id\":" . $value->id . ",\"formulaId\":" . $value->formulaId . ",\"type\":" .
                    $type . ",\"friendId\":\"" . $value->friendId . "\",\"fName\":\"" . $value->
                    fName . "\",\"charm\":" . $value->charm . ",\"msg\":\"" . $value->msg . "\",\"show\":0,\"x\":" .
                    $value->x . ",\"y\":" . $value->y . ",\"z\":" . $value->z . "}";
        }
    }
    $result = json_encode($result);
    $result = str_replace("[\"", "", $result);
    $result = str_replace("\"]", "", $result);
    $result = str_replace(",\"\\\"", ",\\\"", $result);
    $result = str_replace("\\u", "\\\\u", $result);
    $result = str_replace("}\"", "}", $result);
    $result = str_replace("},\"", "},", $result);
    $result = "[" . $result . "]";
    echo stripslashes(str_ireplace("[null]", "[]", $result));
    exit();
}
if ($_REQUEST['mod'] == "Gift" && $_REQUEST['act'] == "deleteGift") {
    $message = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT message FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
    $message = json_decode($message);
    foreach ($message->e as $key => $value) {
        if ($value->id == $_REQUEST['id']) {
            unset($message->e[$key]);
        }
    }
    $message = json_encode($message);
    $message = preg_replace("'\"[0-9]+\":{'", "{", $message);
    $message = str_ireplace("\"e\":{{", "\"e\":[{", $message);
    $message = str_ireplace("}}}", "}]}", $message);
    $message = str_replace("\\u", "\\\\u", $message);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set message='" . $message .
        "' where uid=" . $_SGLOBAL['supe_uid']);
    echo "{\"code\":1}";
    exit();
}
if ($_REQUEST['mod'] == "dog" && $_REQUEST['act'] == "feed") {
    $fertilizer = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT fertilizer FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
    $fertilizer = json_decode($fertilizer);
    $gouliang = 501;
    if ($fertilizer->$gouliang < $_REQUEST['num']) {
        exit();
    }
    $fertilizer->$gouliang = $fertilizer->$gouliang - $_REQUEST['num'];
    $dog = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT dog FROM " . tname
        ("plug_newfarm") . " where uid=" . intval($_REQUEST['ownerId'])), 0);
    $dog = json_decode($dog);
    foreach ($dog as $key => $value) {
        if ($value->status == 1) {
            if ($value->dogFeedTime > $_SGLOBAL['timestamp'])
                $value->dogFeedTime = $value->dogFeedTime + $_REQUEST['num'] * 86400;
            else
                $value->dogFeedTime = $_SGLOBAL['timestamp'] + $_REQUEST['num'] * 86400;
            $dogFeedTime = $value->dogFeedTime;
        }
    }
    $dog = json_encode($dog);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set dog='" . $dog .
        "' where uid=" . intval($_REQUEST['ownerId']));
    $fertilizer = json_encode($fertilizer);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set fertilizer='" .
        $fertilizer . "' where uid=" . $_SGLOBAL['supe_uid']);
    echo "{\"dogFeedTime\":" . $dogFeedTime . ",\"id\":501,\"num\":" . $_REQUEST['num'] .
        "}";
}
if ($_REQUEST['mod'] == "task" && $_REQUEST['act'] == "update") {
    $query = $_SGLOBAL['db']->query("SELECT taskid,exp,levelup FROM " . tname("plug_newfarm") .
        " where uid=" . $_SGLOBAL['supe_uid']);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $taskid = $list[0][taskid];
    if ($taskid >= 0 && $taskid <= 11) {
        $upmoney = $taskid * 50;
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set exp=exp+100,money=money+{$upmoney},taskid=taskid+1 where uid=" . $_SGLOBAL['supe_uid']);
        $levelup_arr = 'false';
        $list[0][exp] >= $list[0][levelup] && $list[0][levelup] < 93001 && include_once ("levelup.php"); //����ʾ
        $taskFlag = 2;
        if ($taskid == 11) {
            $taskFlag = 0;
            $taskid = 0;
        }
        echo stripslashes("{\"eDesc\":\"\\Chúc \\mừng \\bạn \\hoàn \\thành \\nhiệm \\vụ \\và \\nhận \\100 \\exp \\cùng \\{$upmoney} \\tiền \\vàng!\",\"item\":[{\"eType\":7,\"eParam\":0,\"eNum\":100},{\"eType\":6,\"eParam\":0,\"eNum\":50}],\"levelUp\":" .
            $levelup_arr . ",\"task\":{\"taskId\":{$taskid},\"taskFlag\":{$taskFlag}}}");
    }
    exit();
} // ����
if ($_REQUEST['mod'] == "user" && $_REQUEST['act'] == "welcome") {
    echo "null";
}
if ($_REQUEST['mod'] == "task" && $_REQUEST['act'] == "accept") {
    $taskid = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT taskid FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
    echo "{\"taskId\":" . $taskid . "}";
}
if ($_REQUEST['mod'] == "user" && $_REQUEST['act'] == "reclaimPay") {
    $reclaim = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT reclaim FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
    echo "{\"money\":" . $tudiarr[$reclaim][money] . ",\"level\":" . $tudiarr[$reclaim][level] .
        "}";
}
if ($_REQUEST['mod'] == "user" && $_REQUEST['act'] == "reclaim") {
    $query = $_SGLOBAL['db']->query("SELECT farmlandstatus,reclaim,money,exp FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    if ($list[0][money] < $tudiarr[$list[0][reclaim]][money] || $list[0][exp] < $tudiarr[$list[0][reclaim]][exp]) {
        exit();
    }
    //���ѹ���
    $farmarr = json_decode($list[0][farmlandstatus]);
    foreach ($farmarr->farmlandstatus as $key => $value) {
        if ($key >= $list[0][reclaim]) {
            unset($farmarr->farmlandstatus[$key]);
        }
    }
    $farmarr->farmlandstatus[$list[0][reclaim]] = json_decode("{\"a\":0,\"b\":0,\"f\":0,\"g\":0,\"h\":1,\"i\":[],\"j\":0,\"k\":0,\"l\":0,\"m\":0,\"n\":\"2\",\"o\":0,\"p\":[],\"q\":0,\"r\":1251351725,\"s\":0,\"t\":0,\"u\":0}");
    $farmarr_str = json_encode($farmarr);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
        " set farmlandstatus='" . $farmarr_str . "',reclaim=reclaim+1,money=money-" . $tudiarr[$list[0][reclaim]][money] .
        " where uid=" . $_SGLOBAL['supe_uid']);
    echo "{\"code\":1,\"direction\":\"\",\"money\":-" . $tudiarr[$list[0][reclaim]][money] .
        "}";
}
if ($_REQUEST['mod'] == "fb" && $_REQUEST['amount'] == "10") {
    $credit = $_SGLOBAL['db']->result($_SGLOBAL['db']->query('SELECT credit FROM ' .
        tname('space') . ' where uid=' . $_SGLOBAL['supe_uid']), 0);
    if (10 * 10 > $credit) {
        echo ("<script type='text/javascript'> alert('Bạn chưa đủ điểm');location=('http://www.wenchangtv.com/home/pay.php');</script>");
        exit();
    }

    $_SGLOBAL['db']->query("UPDATE " . tname("space") .
        " set credit=credit-10*10 where uid=" . $_SGLOBAL['supe_uid']);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
        " set fb=fb+10 where uid=" . $_SGLOBAL['supe_uid']);
    echo "<script>alert('Bạn đã nhận 10 Gee bằng cách đổi 100 tiền vàng');history.go(-1)</script>";
    exit();
}
if ($_REQUEST['mod'] == "fb" && $_REQUEST['amount'] == "20") {
    $credit = $_SGLOBAL['db']->result($_SGLOBAL['db']->query('SELECT credit FROM ' .
        tname('space') . ' where uid=' . $_SGLOBAL['supe_uid']), 0);
    if (20 * 10 > $credit) {
        echo ("<script type='text/javascript'> alert('Bạn chưa đủ điểm');location=('http://www.wenchangtv.com/home/pay.php');</script>");
        exit();
    }

    $_SGLOBAL['db']->query("UPDATE " . tname("space") .
        " set credit=credit-10*20 where uid=" . $_SGLOBAL['supe_uid']);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
        " set fb=fb+20 where uid=" . $_SGLOBAL['supe_uid']);
    echo "<script>alert('Bạn đã nhận 20 Gee bằng cách đổi 200 tiền vàng');history.go(-1)</script>";
    exit();
}
if ($_REQUEST['mod'] == "fb" && $_REQUEST['amount'] == "50") {
    $credit = $_SGLOBAL['db']->result($_SGLOBAL['db']->query('SELECT credit FROM ' .
        tname('space') . ' where uid=' . $_SGLOBAL['supe_uid']), 0);
    if (50 * 10 > $credit) {
        echo ("<script type='text/javascript'> alert('Bạn chưa đủ điểm');location=('http://www.wenchangtv.com/home/pay.php');</script>");
        exit();
    }

    $_SGLOBAL['db']->query("UPDATE " . tname("space") .
        " set credit=credit-10*50 where uid=" . $_SGLOBAL['supe_uid']);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
        " set fb=fb+50 where uid=" . $_SGLOBAL['supe_uid']);
    echo "<script>alert('Bạn đã nhận 50 Gee bằng cách đổi 500 tiền vàng');history.go(-1)</script>";
    exit();
}
if ($_REQUEST['mod'] == "user" && $_REQUEST['act'] == "getLog") {
    $date = $_SGLOBAL['timestamp'] - 86400 * 7; //������־��ʾ����λ7�� ��������Щ�����־�Զ���ɾ��
    $sql = "SELECT * FROM " . tname("plug_newfarm_logs") . " WHERE uid = " . $_SGLOBAL['supe_uid'] .
        " ORDER BY time DESC";
    $query = $_SGLOBAL['db']->query($sql);
    $str = "[";
    $help = array();
    //type:1͵����,2��æ,3�򹷣�4��ҧ��5�򹷣�6���ۣ�7�����ӣ�8�򹤾ߣ�9���黯��

    //if ($count >20 ){ $count = 20;}
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        if ($value['time'] < $date) {
            //������־ɾ��
            $_SGLOBAL['db']->query("delete from " . tname("plug_newfarm_logs") .
                " where id=" . $value['id']);
            continue;
        }
        if ($value[type] == 1) {
            $query1 = $_SGLOBAL['db']->query("SELECT username FROM " . tname("plug_newfarm") .
                " WHERE uid = " . $value[fromid] . "");
            $value1 = $_SGLOBAL['db']->fetch_array($query1);
            $counts_ = explode(';', $value[counts]);
            $counts_all = "";
            foreach ($counts_ as $value_) {
                $counts_t = explode(':', $value_);
                $counts_all .= $counts_t[1] . " " . $crops[$counts_t[0]][cName] . ".";
            }
            if ($counts_all != "") {
                $counts_all = substr($counts_all, 0, -6);
            }
            $msg = "\"<a href=\\\"event:" . $value[fromid] . "\\\"><font color=\\\"#009900\\\"><b>" .
                unicode_encodegb($value1['username']) . "<\\/b><\\/font><\/a> Trang trại bị hái trộm {$counts_all}.\"";
            $str .= "{\"time\":" . $value['time'] . ",\"msg\":" . $msg . "},";
        }
        if ($value[type] == 2) {
            $query1 = $_SGLOBAL['db']->query("SELECT username FROM " . tname("plug_newfarm") .
                " WHERE uid = " . $value[fromid] . "");
            $value1 = $_SGLOBAL['db']->fetch_array($query1);
            $counts_all = "";
            $counts_ = explode(':', $value[counts]);
            if ($counts_[0] > 0) {
                $counts_all .= "Weeding" . $counts_[0] . "times";
            }
            if ($counts_[1] > 0) {
                $counts_all .= "Insecticide" . $counts_[1] . "times";
            }
            if ($counts_[2] > 0) {
                $counts_all .= "Watering" . $counts_[2] . "times";
            }
            if ($counts_all != "") {
                $counts_all = substr($counts_all, 0, -6);
            }
            $msg = "\"<a href=\\\"event:" . $value[fromid] . "\\\"><font color=\\\"#009900\\\"><b>" .
                unicode_encodegb($value1['username']) . "<\\/b><\\/font><\/a> Đến nông trại để giúp {$counts_all}!\"";
            $str .= "{\"time\":" . $value['time'] . ",\"msg\":" . $msg . "},";
        }
        if ($value[type] == 3) {
            $msg = "\"Mua thú cưng" .
                $dogs[$value['cropid']][tName] . "\\không rõ nghĩa 3\"";
            $str .= "{\"time\":" . $value['time'] . ",\"msg\":" . $msg . "},";
        }
        if ($value[type] == 4) {
            $query1 = $_SGLOBAL['db']->query("SELECT username FROM " . tname("plug_newfarm") .
                " WHERE uid = " . $value[fromid] . "");
            $value1 = $_SGLOBAL['db']->fetch_array($query1);
            $msg = "\"<a href=\\\"event:" . $value[fromid] . "\\\"><font color=\\\"#009900\\\"><b>" .
                unicode_encodegb($value1['username']) . "<\\/b><\\/font><\/a> Đến nông trại để hái trộm gì đó được" .
                $value[count] . "đồng.\"";
            $str .= "{\"time\":" . $value['time'] . ",\"msg\":" . $msg . "},";
        }
        if ($value[type] == 5) {
            $query1 = $_SGLOBAL['db']->query("SELECT username FROM " . tname("plug_newfarm") .
                " WHERE uid = " . $value[fromid] . "");
            $value1 = $_SGLOBAL['db']->fetch_array($query1);
            $msg = "\"<a href=\\\"event:" . $value[fromid] . "\\\"><font color=\\\"#009900\\\"><b>" .
                unicode_encodegb($value1['username']) . "<\\/b><\\/font><\/a> Đến với trang trại để thú cưng của bạn choáng váng, và sau đó đã không biết phải làm gì!\"";
            $str .= "{\"time\":" . $value['time'] . ",\"msg\":" . $msg . "},";
        }
        if ($value[type] == 6) {
            $msg = "\"Thu hoạch và bán " .
                $value[count] . " " . $crops[$value['cropid']][cName] . ".\"";
            $str .= "{\"time\":" . $value['time'] . ",\"msg\":" . $msg . "},";
        }
        if ($value[type] == 7) {
            $msg = "\"Mua hạt giống " . $value[count] . " " .
                $crops[$value['cropid']][cName] . ".\"";
            $str .= "{\"time\":" . $value['time'] . ",\"msg\":" . $msg . "},";
        }
        if ($value[type] == 8) {
            $msg = "\"Mua hạt giống " . $value[count] . " " .
                $tools[$value['cropid']][tName] . ".\"";
            $str .= "{\"time\":" . $value['time'] . ",\"msg\":" . $msg . "},";
        }
        if ($value[type] == 9) {
            $query1 = $_SGLOBAL['db']->query("SELECT username FROM " . tname("plug_newfarm") .
                " WHERE uid = " . $value[fromid] . "");
            $value1 = $_SGLOBAL['db']->fetch_array($query1);

            if (empty($help[$value[fromid]]) || ($help[$value[fromid]] > 0 && $help[$value[fromid]] -
                1800 > $value['time'])) {
                $msg = "\"<a href=\\\"event:" . $value[fromid] . "\\\"><font color=\\\"#009900\\\"><b>" .
                    unicode_encodegb($value1['username']) . "<\\/b><\\/font><\/a> Không rõ nghĩa 2\"";
                $str .= "{\"time\":" . $value['time'] . ",\"msg\":" . $msg . "},";
                $help[$value[fromid]] = $value['time'];
            }
        }

    }
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm_logs") .
        " set isread=1 where uid=" . $_SGLOBAL['supe_uid']);
    if ($str)
        $str = substr($str, 0, -1);
    $str .= "]";

    echo $str;
}
if ($_REQUEST['mod'] == "Dog" && $_REQUEST['act'] == "unWorkDog") {

    if (intval($_REQUEST['ownerId']) != $_SGLOBAL['supe_uid']) {
        $dog = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT dog FROM " . tname
            ("plug_newfarm") . " where uid=" . intval($_REQUEST['ownerId'])), 0);
        $dog = json_decode($dog);
        foreach ($dog as $key => $value) {
            if ($value->status == 1 && $value->id > 8) {
                exit();
            }
            if ($value->status == 1 && $value->id < 9) {
                $value->dogUnWorkTime = $_SGLOBAL['timestamp'] + 180;
                //��־
                $sql = "INSERT INTO " . tname("plug_newfarm_logs") .
                    " (`uid`, `type`, `count`, `fromid`, `time`, `cropid`, `isread` ) VALUES (" . $_REQUEST['ownerId'] .
                    ", 5, 0, " . $_SGLOBAL['supe_uid'] . ", " . $_SGLOBAL['timestamp'] . ", 0, 0);";
                $_SGLOBAL['db']->query($sql);
            }
        }
        $dog = json_encode($dog);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set dog='" . $dog .
            "' where uid=" . intval($_REQUEST['ownerId']));
        $query = $_SGLOBAL['db']->query("SELECT fertilizer FROM " . tname("plug_newfarm") .
            " where uid=" . $_SGLOBAL['supe_uid']);
        while ($value = $_SGLOBAL['db']->fetch_array($query)) {
            $list[] = $value;
        }
        $fertarr = json_decode($list[0][fertilizer]);
        if ($fertarr->$_REQUEST['tId'] == 0) {
            exit();
        }
        $fertarr->$_REQUEST['tId'] = $fertarr->$_REQUEST['tId'] - 1;
        $fertarr = json_encode($fertarr);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set  fertilizer='" .
            $fertarr . "' where uid=" . $_SGLOBAL['supe_uid']);
        echo "{\"code\":1,\"direction\":\"\",\"tId\":5,\"number\":-1,\"requestTime\":" .
            $_SGLOBAL['timestamp'] . ",\"dogUnWorkTime\":" . ($_SGLOBAL['timestamp'] + 180) .
            "}";
        include_once (S_ROOT . "./source/function_cp.php");
        $icon = "farm";
        $title_template = "{actor} ghé thăm <a href=\"newfarm.php\">nông trại</a> của {touser}";
        $touserspace = getspace(intval($_REQUEST['ownerId']));
        if (empty($touserspace[name])) {
            $touserspace[name] = $touserspace[username];
        }
        $title_data = array("touser" => "<a href=\"space.php?uid=" . intval($_REQUEST['ownerId']) .
            "\">" . $touserspace[username] . "</a>");
        $body_general = "Giúp đỡ nhau mới là nông dân Nhà Tui";
        feed_add($icon, $title_template, $title_data, null, null, null);
        exit();
    }

}
//�ǹ�����
if ($_REQUEST['mod'] == "shop" && $_REQUEST['act'] == "buy" && $_REQUEST['type'] ==
    "10") {
    $query = $_SGLOBAL['db']->query("SELECT money,fb,nosegay FROM " . tname("plug_newfarm") .
        " where uid=" . $_SGLOBAL['supe_uid']);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $_fb = 0;
    $_money = 0;
    if ($_REQUEST['useFB'] == "true") {
        $_fb = $tools[$_REQUEST['id']]['list'][1][FBPrice] * $_REQUEST['number'];
        if ($_REQUEST['number'] == 10) {
            $_fb = $tools[$_REQUEST['id']]['list'][10][FBPrice];
        }
        if ($_REQUEST['number'] == 100) {
            $_fb = $tools[$_REQUEST['id']]['list'][100][FBPrice];
        }
        if ($list[0][fb] < $_fb) {
            exit();
        }
        $list[0][fb] = $list[0][fb] - $_fb;
    } else {
        $_money = $tools[$_REQUEST['id']]['list'][1][price] * $_REQUEST['number'];
        if ($_REQUEST['number'] == 10) {
            $_money = $tools[$_REQUEST['id']]['list'][10][price];
        }
        if ($_REQUEST['number'] == 100) {
            $_money = $tools[$_REQUEST['id']]['list'][100][price];
        }
        if ($list[0][money] < $_money) {
            exit();
        }
        $list[0][money] = $list[0][money] - $_money;
    }
    $nosegay = json_decode($list[0][nosegay]);
    $nosegay->$_REQUEST['id'] = $nosegay->$_REQUEST['id'] + $_REQUEST['number'];
    //�Զ�ѹ�����
    foreach ($nosegay as $key => $value) {
        if ($value == 0) {
            unset($nosegay->$key);
        }
    }
    $nosegay = json_encode($nosegay);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set money=money-" .
        $_money . ",fb=fb-" . $_fb . ",nosegay='" . $nosegay . "' where uid=" . $_SGLOBAL['supe_uid']);
    $_fb = 0 - $_fb;
    $_money = 0 - $_money;
    echo "{\"code\":1,\"id\":" . $_REQUEST['id'] . ",\"name\":\"" . $tools[$_REQUEST['id']][tName] .
        "\",\"num\":" . $_REQUEST['number'] . ",\"direction\"Mua thành công..\",\"money\":" .
        $_money . ",\"FB\":" . $_fb . ",\"type\":10}";
    exit();
}
//���򻯷�
if ($_REQUEST['mod'] == "farmlandstatus" && $_REQUEST['act'] ==
    "flowerFertilize") {
    if (intval($_REQUEST['ownerId']) == $_SGLOBAL['supe_uid']) {
        $fertilizer = $_SGLOBAL['db']->query("SELECT fertilizer FROM " . tname("plug_newfarm") .
            " where uid=" . $_SGLOBAL['supe_uid']);
        while ($value = $_SGLOBAL['db']->fetch_array($fertilizer)) {
            $list[] = $value;
        }
        $fertarr = json_decode($list[0][fertilizer]);
        if ($fertarr->$_REQUEST['tId'] == 0) {
            exit();
        }
        $fertarr->$_REQUEST['tId'] = $fertarr->$_REQUEST['tId'] - 1;
        $fertarr = json_encode($fertarr);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set  fertilizer='" .
            $fertarr . "' where uid=" . $_SGLOBAL['supe_uid']);
        $farm = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT farmlandstatus FROM " .
            tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
        $farm = json_decode($farm);
        $curcId = $farm->farmlandstatus[$_REQUEST['place']]->a;
        $farm->farmlandstatus[$_REQUEST['place']]->a = floor(($curcId - 101) / 4) * 4 +
            rand(1, 4) + 100;
        $farmup = json_encode($farm);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set farmlandstatus='" . $farmup . "' where uid=" . $_SGLOBAL['supe_uid']);

        echo "{\"farmlandIndex\":" . $_REQUEST['place'] . ",\"code\":1,\"tId\":" . $_REQUEST['tId'] .
            ",\"status\":{\"cId\":" . $farm->farmlandstatus[$_REQUEST['place']]->a . ",\"cropStatus\":" .
            $farm->farmlandstatus[$_REQUEST['place']]->b . ",\"weed\":" . $farm->
            farmlandstatus[$_REQUEST['place']]->f . ",\"pest\":" . $farm->farmlandstatus[$_REQUEST['place']]->
            g . ",\"humidity\":" . $farm->farmlandstatus[$_REQUEST['place']]->h . ",\"killer\":" .
            json_encode($farm->farmlandstatus[$_REQUEST['place']]->i) . ",\"harvestTimes\":" .
            $farm->farmlandstatus[$_REQUEST['place']]->j . ",\"output\":" . $farm->
            farmlandstatus[$_REQUEST['place']]->k . ",\"min\":" . $farm->farmlandstatus[$_REQUEST['place']]->
            l . ",\"leavings\":" . $farm->farmlandstatus[$_REQUEST['place']]->m . ",\"thief\":2,\"fertilize\":" .
            $farm->farmlandstatus[$_REQUEST['place']]->o . ",\"action\":" . json_encode($farm->
            farmlandstatus[$_REQUEST['place']]->p) . ",\"plantTime\":" . $farm->
            farmlandstatus[$_REQUEST['place']]->q . ",\"updateTime\":" . $farm->
            farmlandstatus[$_REQUEST['place']]->r . ",\"pId\":" . $farm->farmlandstatus[$_REQUEST['place']]->
            s . ",\"nph\":" . $farm->farmlandstatus[$_REQUEST['place']]->t . ",\"mph\":" . $farm->
            farmlandstatus[$_REQUEST['place']]->u . "}}";

        include_once (S_ROOT . "./source/function_cp.php");
        $icon = "farm";
        $title_template = "{actor} thu hoạch <a href=\"newfarm.php\">nông sản</a> ở <a href=\"newfarm.php\">NHÀ TUI</a>";
        $touserspace = getspace(intval($_REQUEST['ownerId']));
        $touserspace[name] = $touserspace[username];
        $title_data = array("touser" => "<a href=\"space.php?uid=" . intval($_REQUEST['ownerId']) .
            "\">" . $touserspace[username] . "</a>");
        $body_general = "Vụ này tớ trúng to";
        feed_add($icon, $title_template, $title_data, null, null, null);
    } else {
        exit();
    }
}
?>