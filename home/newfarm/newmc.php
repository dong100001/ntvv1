<?php
//Ucenter Home GoHooH Full (full mod, full game, full skin) hack by GoHooH.CoM
//More mod, skin, game, plugins for Discuz!, Ucenter Home at http://www.gohooh.com/forum/
/*********************/
/*                   */
/*  Version : 3.2.0  */
/*  Author  : samɽķ*/
/*  Comment : 100124 */
/*                   */
/*********************/

include_once ("mc.php");
include_once ("config.php");
include_once ("vip.php");
function getLevel($exp)
{
    $sum = 0;
    $i = 1;
    while ($exp >= $sum) {
        $sum += $i * 200;
        $i++;
    }
    return $i - 2;
}
function avatarmc($uid, $size = 'small')
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
$space = getspace($_SGLOBAL['supe_uid']);
//$vipUpTime = array(450,1125,2025,3150,4500,6075);
if (empty($_SGLOBAL['supe_uid'])) {
    showmessage("���ȵ�¼���ٷ���", "do.php?ac=login");
}
$space = getspace($_SGLOBAL['supe_uid']);


function expToGrade($exp)
{
    return intval(sqrt(($exp + 25) / 100) - 0.5);
}
function strreplace($strs)
{
    return str_replace(array(",", "\\\"", "\\'", "\\", "\t", "\r\n", "\n", "\r"),
        array(';', '``', '`', '|', '', ' ', '', ''), $strs);
}
if ($_REQUEST['mod'] == "cgi_get_notice") {
    echo "{\"code\":1,\"content\":\"<br />\\u4EB2\\u7231\\u7684\\u519C\\u53CB\\u7267\\u53CB\\u4EEC\\uFF1A<br />    2010\\u5E74\\u7684\\u949F\\u58F0\\u5DF2\\u7ECF\\u6572\\u54CD\\uFF0C\\u65B0\\u5E74\\u65B0\\u6C14\\u8C61\\uFF0C\\u7267\\u573A\\u4E5F\\u8FCE\\u6765\\u4E86\\u516C\\u6D4B\\uFF0C\\u60A8\\u5C06\\u53EF\\u4EE5\\u4E0E\\u66F4\\u591A\\u7684\\u597D\\u53CB\\u5C3D\\u60C5\\u7684\\u6C90\\u6D74\\u5728\\u7267\\u573A\\u5E26\\u6765\\u7684\\u4E50\\u8DA3\\u4E2D\\u3002<br />    \\u7267\\u573A\\u4E5F\\u6362\\u4E0A\\u4E86\\u5168\\u65B0\\u7684\\u88C5\\u626E\\uFF0C\\u4EE5\\u7115\\u7136\\u4E00\\u65B0\\u7684\\u9762\\u8C8C\\u6B22\\u5E86\\u516C\\u6D4B\\uFF01<br />    \\u540C\\u65F6\\uFF0C\\u7267\\u573A\\u7A9D\\u68DA\\u4F53\\u7CFB\\u5DF2\\u7ECF\\u5168\\u9762\\u5347\\u7EA7\\uFF0C\\u65B0\\u7248\\u7684\\u7A9D\\u68DA\\u4E0D\\u4F46\\u5916\\u5F62\\u66F4\\u4E30\\u5BCC\\uFF0C\\u4EF7\\u683C\\u4E5F\\u66F4\\u52A0\\u5408\\u7406\\u54E6\\uFF01<br /> <br />    \\u5173\\u4E8E\\u672C\\u6B21\\u516C\\u6D4B\\u66F4\\u65B0\\u66F4\\u8BE6\\u7EC6\\u7684\\u8BF4\\u660E\\u8BF7\\u67E5\\u770B\\u6E38\\u620F\\u5E2E\\u52A9\\u3002\",\"id\":" .
        $_SGLOBAL['supe_uid'] . ",\"time\":" . $_SGLOBAL['timestamp'] . "}";
}
if ($_REQUEST['mod'] == "cgi_compen") {
    echo "{\"code\":1,\"direction\":\"\\u9886\\u53D6\\u6210\\u529F\\uFF0C\\u611F\\u8C22\\u60A8\\u5BF9\\u7D2B\\u8D1D\\u7267\\u573A\\u7684\\u652F\\u6301\\u3002\",\"money\":0}";
}
if ($_REQUEST['mod'] == "cgi_clear_log" || $_REQUEST['mod'] == "cgi_clear_log?") {
    $sql = "DELETE FROM " . tname("plug_newfarm_mclogs") . " where uid = " . $_SGLOBAL['supe_uid'];
    $query = $_SGLOBAL['db']->query($sql);
}

//1͵��2���3����Ӳݣ�4�Լ���ݣ�5�������ݣ�6���ã�7���ã�8�����㣻9���ۣ�10����
if ($_REQUEST['mod'] == "cgi_get_user_info" || $_REQUEST['mod'] ==
    "cgi_get_user_info?") {
    $log_str = "";
    $query = $_SGLOBAL['db']->query("SELECT money,mc_exp FROM " . tname("plug_newfarm") .
        " where uid=" . intval($_REQUEST['uId']));
    $space_user = getspace($_REQUEST['uId']);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $count1 = $count = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT COUNT(*) FROM " .
        tname("plug_newfarm_mclogs") . " WHERE uid = " . intval($_REQUEST['uId'])), 0);
    $sql = "SELECT * FROM " . tname("plug_newfarm_mclogs") . " WHERE uid = " .
        intval($_REQUEST['uId']) . " ORDER BY time DESC limit 0,20";
    $query = $_SGLOBAL['db']->query($sql);
    $str = "[";
    if ($count > 20) {
        $count = 20;
    }
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        if ($value[type] == 1) {
            $query1 = $_SGLOBAL['db']->query("SELECT username FROM " . tname("plug_newfarm") .
                " WHERE uid = " . $value[fromid] . "");
            $value1 = $_SGLOBAL['db']->fetch_array($query1);
            $scrids = array();
            $scrids = explode(",", $value[iid]);
            $scrcots = array();
            $scrcots = explode(",", $value[count]);
            $scrougestr = "";
            for ($i = 0; $i < count($scrids); $i++) {
                $scrougestr = $scrougestr . $scrcots[$i] . $animalname[$scrids[$i]][liangci] . $animalname[$scrids[$i]][name];
                if ($i + 1 < count($scrids)) {
                    $scrougestr = $scrougestr . "\\uff0c";
                } else {
                    $scrougestr = $scrougestr . "\\u3002";
                }
            }
            $msg = "\"<font color=\\\\\"#009900\\\\\"><b>" . unicode_encode($value1['username']) .
                "<\\/b><\\/font> \\u6765\\u7267\\u573a\\u5077\\u8d70\\u4e86" . $scrougestr . "\"";
            $msg = str_replace("\\u", "\\\\u", $msg);
            $str = $str . "{\"domain\":2,\"msg\":" . $msg . ",\"time\":" . $value['time'] .
                "}";
            $count--;
        }
        if ($value[type] == 2) {
            $query1 = $_SGLOBAL['db']->query("SELECT username FROM " . tname("plug_newfarm") .
                " WHERE uid = " . $value[fromid] . "");
            $value1 = $_SGLOBAL['db']->fetch_array($query1);
            $helpids = array();
            $helpids = explode(",", $value[iid]);
            $helpcots = array();
            $helpcots = explode(",", $value[count]);
            $helpstr = "";

            for ($i = 0; $i < count($helpids); $i++) {
                $helpstr = $helpstr . $helpcots[$i] . $animalname[10000 + $helpids[$i]][liangci] .
                    $animalname[10000 + $helpids[$i]][name] . "\\u8d76\\u53bb" . $animalname[10000 +
                    $helpids[$i]][act];
                if ($i + 1 < count($helpids)) {
                    $helpstr = $helpstr . "\\uff0c";
                } else {
                    $helpstr = $helpstr . "\\u3002";
                }
            }

            $msg = "\"<font color=\\\\\"#009900\\\\\"><b>" . unicode_encode($value1['username']) .
                "<\\/b><\\/font> \\u5e2e\\u5fd9\\u628a" . $helpstr . "\"";
            $msg = str_replace("\\u", "\\\\u", $msg);
            $str = $str . "{\"domain\":2,\"msg\":" . $msg . ",\"time\":" . $value['time'] .
                "}";
            $count--;
        }
        if ($value[type] == 3) {
            $query1 = $_SGLOBAL['db']->query("SELECT username FROM " . tname("plug_newfarm") .
                " WHERE uid = " . $value[fromid] . "");
            $value1 = $_SGLOBAL['db']->fetch_array($query1);
            $msg = "\"<font color=\\\\\"#009900\\\\\"><b>" . unicode_encode($value1['username']) .
                "<\\/b><\\/font> \\u6765\\u7267\\u573A\\u4ECE\\u81EA\\u5DF1\\u5305\\u88F9\\u91CC\\u7684" .
                $value[count] . "\\u68F5\\u8349\\u6599\\u6DFB\\u52A0\\u5230\\u9972\\u6599\\u673A\\u5185\\u3002\"";
            $msg = str_replace("\\u", "\\\\u", $msg);
            $str = $str . "{\"domain\":2,\"msg\":" . $msg . ",\"time\":" . $value['time'] .
                "}";
            $count--;
        }
        if ($value[type] == 4) {
            $msg = "\"\\u5171\\u82B1\\u4E86" . $value[money] . "\\u91D1\\u5E01\\u8D2D\\u4E70" .
                $value[count] . "\\u68F5\\u8349\\u6599\\u653E\\u5165\\u9972\\u6599\\u673A\\u5185\"";
            $msg = str_replace("\\u", "\\\\u", $msg);
            $str = $str . "{\"domain\":2,\"msg\":" . $msg . ",\"time\":" . $value['time'] .
                "}";
            $count--;
        }
        if ($value[type] == 5) {
            $query1 = $_SGLOBAL['db']->query("SELECT username FROM " . tname("plug_newfarm") .
                " WHERE uid = " . $value[fromid] . "");
            $value1 = $_SGLOBAL['db']->fetch_array($query1);
            $msg = "\"<font color=\\\\\"#009900\\\\\"><b>" . unicode_encode($value1['username']) .
                "<\\/b><\\/font> \\u6765\\u7267\\u573A\\u5E2E\\u5FD9\\u5171\\u82B1\\u4E86" . $value[money] .
                "\\u91D1\\u5E01\\u8D2D\\u4E70" . $value[count] . "\\u68F5\\u8349\\u6599\\u653E\\u5165\\u9972\\u6599\\u673A\\u5185\"";
            $msg = str_replace("\\u", "\\\\u", $msg);
            $str = $str . "{\"domain\":2,\"msg\":" . $msg . ",\"time\":" . $value['time'] .
                "}";
            $count--;
        }
        if ($value[type] == 6) {
            $query1 = $_SGLOBAL['db']->query("SELECT username FROM " . tname("plug_newfarm") .
                " WHERE uid = " . $value[fromid] . "");
            $value1 = $_SGLOBAL['db']->fetch_array($query1);
            $msg = "\"<font color=\\\\\"#009900\\\\\"><b>" . unicode_encode($value1['username']) .
                "<\\/b><\\/font> \\u6765\\u7267\\u573A\\u653E\\u4E86" . $value[count] . "\\u53EA\\u868A\\u5B50\\uFF0C\\u771F\\u4E0D\\u662F\\u597D\\u4EBA\\uFF01\"";
            $msg = str_replace("\\u", "\\\\u", $msg);
            $str = $str . "{\"domain\":2,\"msg\":" . $msg . ",\"time\":" . $value['time'] .
                "}";
            $count--;
        }
        if ($value[type] == 7) {
            $query1 = $_SGLOBAL['db']->query("SELECT username FROM " . tname("plug_newfarm") .
                " WHERE uid = " . $value[fromid] . "");
            $value1 = $_SGLOBAL['db']->fetch_array($query1);
            $msg = "\"<font color=\\\\\"#009900\\\\\"><b>" . unicode_encode($value1['username']) .
                "<\\/b><\\/font> \\u6765\\u7267\\u573A\\u5E2E\\u5FD9\\u62CD\\u4E86" . $value[count] .
                "\\u53EA\\u868A\\u5B50\\uFF01\"";
            $msg = str_replace("\\u", "\\\\u", $msg);
            $str = $str . "{\"domain\":2,\"msg\":" . $msg . ",\"time\":" . $value['time'] .
                "}";
            $count--;
        }
        if ($value[type] == 8) {
            $query1 = $_SGLOBAL['db']->query("SELECT username FROM " . tname("plug_newfarm") .
                " WHERE uid = " . $value[fromid] . "");
            $value1 = $_SGLOBAL['db']->fetch_array($query1);
            $msg = "\"<font color=\\\\\"#009900\\\\\"><b>" . unicode_encode($value1['username']) .
                "<\\/b><\\/font> \\u6765\\u7267\\u573A\\u5E2E\\u5FD9\\u6E05\\u626B\\u4E86" . $value[count] .
                "\\u4E2A\\u4FBF\\u4FBF\\uFF01\"";
            $msg = str_replace("\\u", "\\\\u", $msg);
            $str = $str . "{\"domain\":2,\"msg\":" . $msg . ",\"time\":" . $value['time'] .
                "}";
            $count--;
        }
        if ($value[type] == 9) {
            $scrids = array();
            $scrids = explode(",", $value[iid]);
            $scrcots = array();
            $scrcots = explode(",", $value[count]);
            $scrougestr = "";
            for ($i = 0; $i < count($scrids); $i++) {
                $scrougestr = $scrougestr . $scrcots[$i] . $animalname[$scrids[$i]][liangci] . $animalname[$scrids[$i]][name];
                if ($i + 1 < count($scrids)) {
                    $scrougestr = $scrougestr . "\\uff0c";
                } else {
                    $scrougestr = $scrougestr . "\\uff0c";
                }
            }
            $msg = "\"\\u5356\\u51FA\\u4E86\\u4ED3\\u5E93\\u91CC\\u7684" . $scrougestr . "\\u5171\\u6536\\u5165" .
                $value[money] . "\\u91D1\\u5E01\\u3002\"";
            $msg = str_replace("\\u", "\\\\u", $msg);
            $str = $str . "{\"domain\":2,\"msg\":" . $msg . ",\"time\":" . $value['time'] .
                "}";
            $count--;
        }
        if ($value[type] == 10) {
            $scrids = array();
            $scrids = explode(",", $value[iid]);
            $scrcots = array();
            $scrcots = explode(",", $value[count]);
            $scrougestr = "";
            for ($i = 0; $i < count($scrids); $i++) {
                $scrougestr = $scrougestr . $scrcots[$i] . $animalname[$scrids[$i]][liangci] . $animalname[$scrids[$i]][name];
                if ($i + 1 < count($scrids)) {
                    $scrougestr = $scrougestr . "\\uff0c";
                } else {
                    $scrougestr = $scrougestr . "\\uff0c";
                }
            }
            $msg = "\"\\u4ECE\\u5546\\u5E97\\u8D2D\\u4E70\\u4E86" . $scrougestr . "\\u5171\\u4ED8\\u51FA" .
                $value[money] . "\\u91D1\\u5E01\\u3002\"";
            $msg = str_replace("\\u", "\\\\u", $msg);
            $str = $str . "{\"domain\":2,\"msg\":" . $msg . ",\"time\":" . $value['time'] .
                "}";
            $count--;
        }
        if (($count - 1) >= 0) {
            $str = $str . ",";
        }
    }
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm_mclogs") .
        " set isread=1 where uid=" . $_SGLOBAL['supe_uid']);
    $str = $str . "]";
    //�ɹ�
    $tempecho = "";
    $repertory = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT repertory FROM " .
        tname("plug_newfarm") . " where uid=" . $_REQUEST['uId']), 0);
    $repertory = json_decode($repertory);
    $tempRep = $repertory->r;
    foreach ($tempRep as $val) {
        $tempecho = json_encode($val) . "," . $tempecho;
    }
    $tempecho = substr($tempecho, 0, -1);
    $tempecho = str_replace("\\u", "\\\\u", $tempecho);
    //�ɹ�
    echo stripslashes("{\"log\":" . $str . ",\"repertory\":[" . $tempecho . "],\"user\":{\"homePage\":\"" .
        space_domain($space_user) . "\",\"money\":" . $list[0][money] . ",\"uExp\":" . $list[0][mc_exp] .
        ",\"uId\":" . $_REQUEST['uId'] . ",\"uLevel\":" . expToGrade($list[0][mc_exp]) .
        ",\"uName\":\"" . str_replace("\\u", "\\\\u", unicode_encode($space_user['name'])) .
        "\"}}");

}
if ($_REQUEST['mod'] == "cgi_enter" || $_REQUEST['mod'] == "cgi_enter?") {
    if (0 < intval($_REQUEST['uId'])) {
        $touarr = array("1001" => 0, "1002" => 0, "1003" => 0, "1004" => 0, "1005" => 0,
            "1006" => 0, "1007" => 0, "1008" => 0, "1009" => 0, "1010" => 0, "1011" => 0,
            "1501" => 0, "1502" => 0, "1503" => 0, "1504" => 0, "1505" => 0, "1507" => 0,
            "1508" => 0, "1509" => 0);
        $query = $_SGLOBAL['db']->query("SELECT username,money,animal,mc_exp,wenzi,parade,dabian FROM " .
            tname("plug_newfarm") . " where uid=" . intval($_REQUEST['uId']));
        while ($value = $_SGLOBAL['db']->fetch_array($query)) {
            $list[] = $value;
        }
        $animal = (array )json_decode($list[0][animal]);
        //wenzi
        $wenzi_num = 0;
        $wenzi_mynum = 0;
        $dabian_mynum = 0;
        $dabian_num = $list[0][dabian];
        if ($list[0][wenzi] != "") {
            $wenzi = explode(",", $list[0][wenzi]);
            $wenzi_num = count($wenzi);
            for ($i = 0; $i < $wenzi_num - 1; $i++) {
                if ($wenzi[$i] == $_SGLOBAL['supe_uid']) {
                    $wenzi_mynum = $wenzi_mynum + 1;
                }
            }
            if ($wenzi_mynum > 0) {
                $wenzi_mynum = 8;
            }
        }
        //wenzi
        //�����ж�
        $parade = (array )json_decode($list[0][parade]);
        if (empty($parade['pid'])) {
            $parade['pid'] = 0;
        }
        //�����ж�
        $needfood = 0;
        $hungry = 0;
        foreach ($animal[animal] as $key => $value) {
            if (0 < $value->cId) {
                if ($touarr[$value->cId] = 3) {
                    $touarr[$value->cId] = 3;
                    if (stristr($value->tou, "," . $_SGLOBAL['supe_uid'] . ",")) {
                        $touarr[$value->cId] = 2;
                    }
                    if ($value->totalCome <= $shop[$value->cId][output] / 2) {
                        $touarr[$value->cId] = 1;
                    }
                }
                //*********************************************
                $value->feedtime == null && $value->feedtime = $animal[animalfeedtime];
                if ($_SGLOBAL['timestamp'] - $value->feedtime > $animaltime[$value->cId][5]) {
                    $value_feedtime = $animaltime[$value->cId][5];
                    $value->feedtime = $_SGLOBAL['timestamp'] - $animaltime[$value->cId][5];
                } else {
                    $value_feedtime = $_SGLOBAL['timestamp'] - $value->feedtime;
                }
                $needfood = $value_feedtime / 3600 * $shop[$value->cId][consum] / 4;
                if ($needfood <= $animal[animalfood]) {
                    $value->feedtime = $_SGLOBAL['timestamp'];
                    $animal[animalfood] -= $needfood;
                    $hungry = 0;
                } else {
                    $value->feedtime += round($animal[animalfood] * 4 / $shop[$value->cId][consum] *
                        3600);
                    $hungry = 1;
                    $animal[animalfood] = 0;
                }
                //*********************************************
                if ($value->postTime == 0) {
                    $time = $_SGLOBAL['timestamp'] - $value->buyTime;
                    if ($animaltime[$value->cId][0] + $animaltime[$value->cId][1] <= $time) {
                        $status = 3;
                        $growTimeNext = 12993;
                        $statusNext = 6;
                    }
                    if ($animaltime[$value->cId][0] <= $time && $time < $animaltime[$value->cId][0] +
                        $animaltime[$value->cId][1]) {
                        $status = 2;
                        $growTimeNext = $animaltime[$value->cId][0] + $animaltime[$value->cId][1] - $time;
                        $statusNext = 3;
                    }
                    if ($time < $animaltime[$value->cId][0]) {
                        $status = 1;
                        $growTimeNext = $animaltime[$value->cId][0] - $time;
                        $statusNext = 2;
                    }
                    if ($animaltime[$value->cId][5] < $time) {
                        $status = 6;
                        $growTimeNext = 0;
                        $statusNext = 6;
                    }
                    $newanimal[] = "{\"buyTime\":" . $value->buyTime . ",\"cId\":" . $value->cId .
                        ",\"growTime\":" . $time . ",\"growTimeNext\":" . $growTimeNext . ",\"hungry\":" .
                        $hungry . ",\"serial\":" . $key . ",\"status\":" . $status . ",\"statusNext\":" .
                        $statusNext . ",\"totalCome\":" . $value->totalCome . "}";
                } else {
                    $totalCome = $value->totalCome;
                    $time = $_SGLOBAL['timestamp'] - $value->buyTime;
                    if ($animaltime[$value->cId][5] < $time) {
                        $status = 6;
                        $statusNext = 6;
                        $growTimeNext = 0;
                    }
                    if ($animaltime[$value->cId][4] < $_SGLOBAL['timestamp'] - $value->postTime) {
                        $status = 3;
                        $statusNext = 6;
                        $growTimeNext = 12993;
                    }
                    if ($_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][4]) {
                        $status = 5;
                        $statusNext = 3;
                        $growTimeNext = $animaltime[$value->cId][4] - ($_SGLOBAL['timestamp'] - $value->
                            postTime);
                    }
                    if ($_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][3]) {
                        $status = 4;
                        $statusNext = 5;
                        $growTimeNext = $animaltime[$value->cId][3] - ($_SGLOBAL['timestamp'] - $value->
                            postTime);
                        $totalCome -= $shop[$value->cId][output];
                    }
                    if ($value->buyTime + $animaltime[$value->cId][5] - $animaltime[$value->cId][3] -
                        $animaltime[$value->cId][4] < $_SGLOBAL['timestamp']) {
                        $status = 5;
                        $statusNext = 6;
                        $growTimeNext = $animaltime[$value->cId][5] - $time;
                    }
                    $newanimal[] = "{\"buyTime\":" . $value->buyTime . ",\"cId\":" . $value->cId .
                        ",\"growTime\":" . $time . ",\"growTimeNext\":" . $growTimeNext . ",\"hungry\":" .
                        $hungry . ",\"serial\":" . $key . ",\"status\":" . $status . ",\"statusNext\":" .
                        $statusNext . ",\"totalCome\":" . $totalCome . "}";
                }
            }
        }
        $newanimal = json_encode($newanimal);
        $newanimal = str_replace("\"{", "{", $newanimal);
        $newanimal = str_replace("}\"", "}", $newanimal);
        $newanimal = str_replace("null", "[]", $newanimal);
        $animal[animalfeedtime] = $_SGLOBAL['timestamp'];
        $stranimal = json_encode($animal);
        $animal[animalfood] = floor($animal[animalfood]);
        $touyes = ">";
        foreach ($touarr as $key => $value) {
            if (0 < $value) {
                $touyes = $touyes . ",\"" . $key . "\":" . $value . "";
            }
        }
        $touyes = str_replace(">,", "", $touyes);
        $touyes = str_replace(">", "", $touyes);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set animal='" . $stranimal .
            "' where uid=" . intval($_REQUEST['uId']));
        //�������
        $animal[item2] = "\"2\":{\"id\":102,\"lv\":" . $animal[item2] . "},";
        if ($animal[item3] == 0) {
            $animal[item3] = "";
        } else {
            $animal[item3] = "\"3\":{\"id\":103,\"lv\":" . $animal[item3] . "},";
        }
        echo stripslashes("{\"animal\":" . $newanimal . ",\"animalFood\":" . $animal[animalfood] .
            ",\"badinfo\":[{\"mynum\":" . $wenzi_mynum . ",\"num\":" . $wenzi_num . ",\"type\":1},{\"mynum\":" .
            $dabian_mynum . ",\"num\":" . $dabian_num . ",\"type\":2}],\"items\":{\"1\":{\"id\":101,\"lv\":" .
            $animal[item1] . "}," . $animal[item2] . $animal[item3] . "\"4\":{\"id\":104,\"lv\":" .
            $animal[item4] . "}},\"notice\":\"\",\"serverTime\":{\"time\":" . $_SGLOBAL['timestamp'] .
            "},\"stealflag\":{" . $touyes . "},\"task\":{\"taskFlag\":1,\"taskId\":8},\"user\":{\"exp\":" .
            $list[0][mc_exp] . ",\"headPic\":\"" . avatarmc($_SGLOBAL[supe_uid], "small", true) .
            "\",\"money\":" . $list[0][money] . ",\"uId\":" . $_SGLOBAL['supe_uid'] . ",\"userName\":\"" .
            unicode_encode($list[0][username]) . "\",\"yellowlevel\":7,\"yellowstatus\":0},\"weather\":{\"weatherDesc\":\"����\",\"weatherId\":1},\"parade\":{\"i\":\"" .
            $parade[pinfo] . "\",\"p\":" . $parade[pid] . ",\"v\":1}}");
        exit();
    }
    $query = $_SGLOBAL['db']->query("SELECT username,money,animal,mc_exp,mc_taskid,wenzi,parade,dabian FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $animal = (array )json_decode($list[0][animal]);
    //wenzi
    $wenzi_num = 0;
    $wenzi_mynum = 0;
    $dabian_mynum = 0;
    $dabian_num = $list[0][dabian];
    if ($list[0][wenzi] != "") {
        $wenzi = explode(",", $list[0][wenzi]);
        $wenzi_num = count($wenzi);
    }
    //wenzi

    //�����ж�
    $parade = (array )json_decode($list[0][parade]);
    if (empty($parade['pid'])) {
        $parade['pid'] = 0;
    }
    //�����ж�
    $needfood = 0;
    $hungry = 0;
    foreach ($animal[animal] as $key => $value) {
        if (0 < $value->cId) {
            //*********************************************
            $value->feedtime == null && $value->feedtime = $animal[animalfeedtime];
            if ($_SGLOBAL['timestamp'] - $value->feedtime > $animaltime[$value->cId][5]) {
                $value_feedtime = $animaltime[$value->cId][5];
                $value->feedtime = $_SGLOBAL['timestamp'] - $animaltime[$value->cId][5];
            } else {
                $value_feedtime = $_SGLOBAL['timestamp'] - $value->feedtime;
            }
            $needfood = $value_feedtime / 3600 * $shop[$value->cId][consum] / 4;
            if ($needfood <= $animal[animalfood]) {
                $value->feedtime = $_SGLOBAL['timestamp'];
                $animal[animalfood] -= $needfood;
                $hungry = 0;
            } else {
                $value->feedtime += round($animal[animalfood] * 4 / $shop[$value->cId][consum] *
                    3600);
                $hungry = 1;
                $animal[animalfood] = 0;
            }
            //*********************************************
            if ($value->postTime == 0) {
                $time = $_SGLOBAL['timestamp'] - $value->buyTime;
                if ($animaltime[$value->cId][0] + $animaltime[$value->cId][1] <= $time) {
                    $status = 3;
                    $growTimeNext = 12993;
                    $statusNext = 6;
                }
                if ($animaltime[$value->cId][0] <= $time && $time < $animaltime[$value->cId][0] +
                    $animaltime[$value->cId][1]) {
                    $status = 2;
                    $growTimeNext = $animaltime[$value->cId][0] + $animaltime[$value->cId][1] - $time;
                    $statusNext = 3;
                }
                if ($time < $animaltime[$value->cId][0]) {
                    $status = 1;
                    $growTimeNext = $animaltime[$value->cId][0] - $time;
                    $statusNext = 2;
                }
                if ($animaltime[$value->cId][5] < $time) {
                    $status = 6;
                    $growTimeNext = 0;
                    $statusNext = 6;
                }
                $newanimal[] = "{\"buyTime\":" . $value->buyTime . ",\"cId\":" . $value->cId .
                    ",\"growTime\":" . $time . ",\"growTimeNext\":" . $growTimeNext . ",\"hungry\":" .
                    $hungry . ",\"serial\":" . $key . ",\"status\":" . $status . ",\"statusNext\":" .
                    $statusNext . ",\"totalCome\":" . $value->totalCome . "}";
            } else {
                $time = $_SGLOBAL['timestamp'] - $value->buyTime;
                $totalCome = $value->totalCome;
                if ($animaltime[$value->cId][5] < $time) {
                    $status = 6;
                    $statusNext = 6;
                    $growTimeNext = 0;
                }
                if ($animaltime[$value->cId][4] < $_SGLOBAL['timestamp'] - $value->postTime) {
                    $status = 3;
                    $statusNext = 6;
                    $growTimeNext = 12993;
                }
                if ($_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][4]) {
                    $status = 5;
                    $statusNext = 3;
                    $growTimeNext = $animaltime[$value->cId][4] - ($_SGLOBAL['timestamp'] - $value->
                        postTime);
                }
                if ($_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][3]) {
                    $status = 4;
                    $statusNext = 5;
                    $growTimeNext = $animaltime[$value->cId][3] - ($_SGLOBAL['timestamp'] - $value->
                        postTime);
                    $totalCome -= $shop[$value->cId][output];
                }
                if ($value->buyTime + $animaltime[$value->cId][5] - $animaltime[$value->cId][3] -
                    $animaltime[$value->cId][4] < $_SGLOBAL['timestamp']) {
                    $status = 5;
                    $statusNext = 6;
                    $growTimeNext = $animaltime[$value->cId][5] - $time;
                }
                $newanimal[] = "{\"buyTime\":" . $value->buyTime . ",\"cId\":" . $value->cId .
                    ",\"growTime\":" . $time . ",\"growTimeNext\":" . $growTimeNext . ",\"hungry\":" .
                    $hungry . ",\"serial\":" . $key . ",\"status\":" . $status . ",\"statusNext\":" .
                    $statusNext . ",\"totalCome\":" . $totalCome . "}";
            }
        }
    }
    $newanimal = json_encode($newanimal);
    $newanimal = str_replace("\"{", "{", $newanimal);
    $newanimal = str_replace("}\"", "}", $newanimal);
    $newanimal = str_replace("null", "[]", $newanimal);
    $animal[animalfeedtime] = $_SGLOBAL['timestamp'];
    $stranimal = json_encode($animal);
    $animal[animalfood] = floor($animal[animalfood]);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set animal='" . $stranimal .
        "' where uid=" . $_SGLOBAL['supe_uid']);
    //�������
    $animal[item2] = "\"2\":{\"id\":102,\"lv\":" . $animal[item2] . "},";
    if ($animal[item3] == 0) {
        $animal[item3] = "";
    } else {
        $animal[item3] = "\"3\":{\"id\":103,\"lv\":" . $animal[item3] . "},";
    }
    $taskFlag = 1;
    if ($list[0][mc_taskid] == 10) {
        $taskFlag = 0;
    }
    $isread = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT COUNT(*) FROM " .
        tname('plug_newfarm_mclogs') . " WHERE uid = " . $_SGLOBAL['supe_uid'] .
        " and isread = 0"), 0);
    if ($isread) {
        $a = 1;
    } else {
        $a = 0;
    }
    //VIP���꿪ʼ
    $queryVip = $_SGLOBAL['db']->query("SELECT uid,coalesce(vipstatus,0) as vipstatus,coalesce(validtime,0) as validtime,coalesce(jointime,0) as jointime,coalesce(vippoint,0) as vippoint,coalesce(level,1) as level,coalesce(endtime,0) as endtime,coalesce(rsign,0) as rsign FROM " .
        tname("plug_newfarm_vip") . " WHERE uid = " . $_SGLOBAL['supe_uid']);
    while ($valueVip = $_SGLOBAL['db']->fetch_array($queryVip)) {
        $listVip[] = $valueVip;
    }
    $rs = split(",", verifyVip($_SGLOBAL['db'], $_SGLOBAL['timestamp'], $listVip[0]));
    $dt1 = date('Y' . 'z');
    if ($rs[0] && $listVip[0][rsign] < $dt1) {
        getVipGift($rs[1], $_SGLOBAL['supe_uid'], $dt1, $_SGLOBAL['db']);
    }
    if ($listVip[0][level] == "" || $listVip[0][vipstatus] == "") {
        $listVip[0][level] = 7;
        $listVip[0][vipstatus] = 0;
    }
    //VIP�������
    echo stripslashes("{\"a\":" . $a . ",\"c\":0,\"animal\":" . $newanimal . ",\"animalFood\":" .
        $animal[animalfood] . ",\"badinfo\":[{\"mynum\":" . $wenzi_mynum . ",\"num\":" .
        $wenzi_num . ",\"type\":1},{\"mynum\":" . $dabian_mynum . ",\"num\":" . $dabian_num .
        ",\"type\":2}],\"items\":{\"1\":{\"id\":101,\"lv\":" . $animal[item1] . "}," . $animal[item2] .
        $animal[item3] . "\"4\":{\"id\":104,\"lv\":" . $animal[item4] . "}},\"notice\":\"\",\"serverTime\":{\"time\":" .
        $_SGLOBAL['timestamp'] . "},\"stealflag\":{},\"task\":{\"taskFlag\":" . $taskFlag .
        ",\"taskId\":" . $list[0][mc_taskid] . "},\"user\":{\"exp\":" . $list[0][mc_exp] .
        ",\"headPic\":\"" . avatarmc($_SGLOBAL[supe_uid], "small", true) . "\",\"money\":" .
        $list[0][money] . ",\"uId\":" . $_SGLOBAL['supe_uid'] . ",\"userName\":\"" .
        str_replace("\\u", "\\\\u", unicode_encode($list[0][username])) . "\",\"yellowlevel\":" .
        $listVip[0][level] . ",\"yellowstatus\":" . $listVip[0][vipstatus] . "},\"weather\":{\"weatherDesc\":\"����\",\"weatherId\":1},\"parade\":{\"i\":\"" .
        $parade[pinfo] . "\",\"p\":" . $parade[pid] . ",\"v\":1},\"wp\":{\"bq\":0,\"f\":0,\"lp\":0,\"lq\":0,\"lv\":0,\"lw\":0,\"xp\":0,\"xq\":0,\"xw\":0}}");

    exit();
}
if ($_REQUEST['mod'] == "cgi_get_animals") { //�̵�
    foreach ($shop as $key => $value) {
        $shop_list[] = $value;
    }
    $shop_list_str = json_encode($shop_list);
    $shop_list_str = str_replace("\\\u", "\u", $shop_list_str);
    echo $shop_list_str;
    exit();
}
if ($_REQUEST['mod'] == "cgi_get_food") {
    echo "[{\"FBPrice\":0,\"consume\":\"\\u4E00\\u53EA\\u52A8\\u7269\\u6BCF 4 \\u5C0F\\u65F6\\u6D88\\u8017 1~5 \\u7C92\\u9972\\u6599\",\"depict\":\"\\u5582\\u517B\\u52A8\\u7269(\\u6328\\u997F\\u4F1A\\u505C\\u6B62\\u6210\\u957F\\u6216\\u751F\\u4EA7)\",\"effect\":0,\"price\":60,\"store\":\"\\u5546\\u5E97\\u8D2D\\u4E70\\u7267\\u8349\\u540E\\u4F1A\\u81EA\\u52A8\\u653E\\u5165\\u9972\\u6599\\u673A\\u4E2D\",\"tId\":1,\"tName\":\"\\u7267\\u8349\",\"timeLimit\":0,\"tip\":\"\\u9AD8\\u4EF7\\u8D2D\\u4E70\\u7267\\u8349\\u4F1A\\u6D88\\u8017\\u8F83\\u591A\\u91D1\\u5E01\\u4E0D\\u5408\\u7B97\\uFF0C\\u5EFA\\u8BAE\\u53BB\\u519C\\u573A\\u79CD\\u690D\\u3002\",\"type\":25}]";
}
if ($_REQUEST['mod'] == "friend") {
    if ($_REQUEST['false'] == "refresh") {
        echo "{\"code\":0}";
        exit();
    }
    if (!empty($space[friend])) {
        $space[friend] = $space[friend] . ",";
    }
    //vipbegin
    $queryVip = $_SGLOBAL['db']->query("SELECT uid,coalesce(vipstatus,0) as vipstatus,coalesce(validtime,0) as validtime,coalesce(jointime,0) as jointime,coalesce(vippoint,0) as vippoint,coalesce(level,1) as level,coalesce(endtime,0) as endtime FROM " .
        tname("plug_newfarm_vip") . " WHERE uid IN (" . $space[friend] . $_SGLOBAL['supe_uid'] .
        ")");
    while ($valueVip = $_SGLOBAL['db']->fetch_array($queryVip)) {
        $listVip[] = $valueVip;
    }
    foreach ($listVip as $valueVip1) {
        verifyVip($_SGLOBAL['db'], $_SGLOBAL['timestamp'], $valueVip1);
    }
    //vipend
    $query = $_SGLOBAL['db']->query("SELECT n.uid,n.mc_exp,n.username,n.money,coalesce(v.vippoint,0) as vippoint,coalesce(v.vipstatus,0) as vipstatus,coalesce(v.validtime,0) as validtime,coalesce(v.level,1) as level FROM " . tname("plug_newfarm") . " n left join " . tname("plug_newfarm_vip") ." v on n.uid=v.uid WHERE n.uid IN (" . $space[friend] . $_SGLOBAL['supe_uid'] . ")limit 0,300");
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $jishu = 0;
    foreach ($list as $value) {
        ++$jishu;
        if ($jishu > 300) {
            break;
        }
        $friendavatarimage = avatarmc($value[uid], 'small', true);
        $friend_str[] = "{\"userId\":" . $value[uid] . ",\"userName\":\"" .
            unicode_encode($value[username]) . "\",\"headPic\":\"" . $friendavatarimage .
            "\",\"yellowlevel\":\"" . $value[level] . "\",\"yellowstatus\":" . $value[vipstatus] .
            ",\"exp\":" . $value[mc_exp] . ",\"money\":" . $value[money] . ",\"pf\":1}";
    }
    $friend_str = json_encode($friend_str);
    $friend_str = str_replace("\\u", "\\\\u", $friend_str);
    $friend_str = str_replace("\"{", "{", $friend_str);
    $friend_str = str_replace("}\"", "}", $friend_str);
    $friend_str = str_replace("\\/", "\\\\/", $friend_str);
    $friend_str = str_replace(",null,", ",", $friend_str);
    echo stripslashes($friend_str);
    exit();
}
if ($_REQUEST['mod'] == "cgi_get_Exp") {
    if (!empty($space[friend])) {
        $space[friend] = $space[friend] . ",";
    }
    $query = $_SGLOBAL['db']->query("SELECT uid,mc_exp,animal,badtime,dabian FROM " .
        tname("plug_newfarm") . " WHERE uid IN (" . $space[friend] . $_SGLOBAL['supe_uid'] .
        ")");
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[$value['uid']] = $value[mc_exp];
        //���ѿɶ�����ʾ��ʼ
        $animal = (array )json_decode($value[animal]);
        $userflag[$value['uid']]["b"] = $value[dabian];
        $userflag[$value['uid']]["g"] = 0;
        $userflag[$value['uid']]["p"] = $value[badtime];
        $userflag[$value['uid']]["t"] = 0;

        foreach ($animal[animal] as $key => $value_1) {
            $cId = intval($value_1->cId);
            if ($cId > 0) {
                $time1 = $animaltime[$value_1->cId][0] + $animaltime[$value_1->cId][1];
                $time2 = $animaltime[$value_1->cId][2];
                $time3 = $_SGLOBAL['timestamp'] - $value_1->buyTime;
                $time4 = $_SGLOBAL['timestamp'] - $value_1->postTime;

                if ($time3 > $time1 && $time3 < $time2) {
                    if ($time4 > $animaltime[$value_1->cId][4] or $value_1->postTime == 0) {
                        $temp = $value_1->buyTime + $time1;
                        if ($temp < $g or $g == 0) {
                            $userflag[$value['uid']]["g"] = $temp;
                        }
                    }
                }
                if (!stristr($value_1->tou, "," . $_SGLOBAL['supe_uid'] . ",")) {
                    if ($value_1->totalCome > $animaltype[$cId][output] / 2 + 1) {
                        $userflag[$value['uid']]["t"] = $value_1->postTime;
                    }
                }
            }
        }
    }
    $userflag = json_encode($userflag);
    $int = strlen($userflag);
    $str = substr($userflag, $int - 1, 1);
    if ($str == ",") {
        $userflag = substr($userflag, 0, $int - 1);
    }
    //���ѿɶ�����ʾ����
    $list = json_encode($list);
    echo "{\"msg\":\"success\",\"result\":0,\"serverTime\":" . $_SGLOBAL['timestamp'] .
        ",\"userExp\":" . $list . ",\"userFlag\":" . $userflag . "}";
    exit();
}
if ($_REQUEST['mod'] == "cgi_buy_animal") //������
    {
    $query = $_SGLOBAL['db']->query("SELECT money,animal FROM " . tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $animal = (array )json_decode($list[0][animal]);
    if ($list[0][money] < $shop[$_REQUEST['cId']][price] * $_REQUEST['number']) {
        exit();
    }
    $anicount = 0;
    $item2count = 0;
    $item3count = 0;
    if ( 3 > $animal[item2] ){ $item2 = $animal[item2] + 1; }else{ $item2 = $animal[item2] + 2; }
	if ( 0 == $animal[item3] ){ $item3 = 0; }else{ $item3 = $animal[item3] + 2; }
    $animalnum = $item2 + $item3;
    $gradea = 0;
    foreach ($animal[animal] as $key => $value) {
        if ($value->cId != 0) {
            ($value->cId > 1500) ? $item3count++ : $item2count++;
        }
        //�Զ�ѹ�����
        if ($key >= $animalnum) {
            unset($animal[animal][$key]);
        } else {
            $gradea++;
        }
    }
    for ($i = 0; $i < $animalnum - $gradea; $i++) {
        $gradea <= 20 && $animal[animal][] = json_decode("{\"buyTime\":0,\"cId\":0,\"postTime\":0,\"totalCome\":0,\"tou\":\"\",\"feedtime\":0}");
    }
    $anicount = $item2count + $item3count;
    //echo "{\"errorContent\":\"".($item3)."\",\"errorType\":\"1011\"}";
    if ($_REQUEST['number'] > $animalnum) {
        echo "{\"errorContent\":\"\\u4F60\\u73B0\\u5728\\u7684\\u7B49\\u7EA7\\u53EA\\u80FD\\u518D\\u9972\\u517B" . ($animalnum -
            $anicount) . "\\u53EA\\u52A8\\u7269\\uFF01\",\"errorType\":\"1011\"}";
        exit();
    }
    if ($_REQUEST['cId'] > 1500 && $_REQUEST['number'] > ($item3 - $item3count)) {
        echo "{\"errorContent\":\"\\u4F60\\u7684\\u68DA\\u53EA\\u80FD\\u518D\\u517B" . ($item3 -
            $item3count) . "\\u53EA\\u52A8\\u7269\\uFF01\",\"errorType\":\"1011\"}";
        exit();
    }
    if ($_REQUEST['cId'] > 1000 && $_REQUEST['cId'] < 1500 && $_REQUEST['number'] >
        ($item2 - $item2count)) {
        echo "{\"errorContent\":\"\\u4F60\\u7684\\u7A9D\\u53EA\\u80FD\\u518D\\u517B" . ($item2 -
            $item2count) . "\\u53EA\\u52A8\\u7269\\uFF01\",\"errorType\":\"1011\"}";
        exit();
    }
    $number = 0;
    foreach ($animal[animal] as $key => $value) {
        if (($value->cId == 0) && ($number < $_REQUEST['number'])) {
            $value->buyTime = $_SGLOBAL['timestamp'];
            $value->cId = $_REQUEST['cId'];
            $value->tou = "";
            ++$number;
            $buyanimal[] = (("{\"buyTime\":" . $_SGLOBAL['timestamp'] . ",\"cId\":" . $_REQUEST['cId'] .
                ",\"createTime\":0,\"feedTime\":" . ($_SGLOBAL['timestamp'] - 14400)) . ",\"growTime\":0,\"growTimeNext\":" .
                ($animaltime[$_REQUEST['cId']][0] - 1)) . ",\"postTime\":" . $_SGLOBAL['timestamp'] .
                ",\"productNum\":0,\"serial\":" . $key . ",\"status\":1,\"statusNext\":2,\"totalCome\":0}";
        }
    }
    $animal = json_encode($animal);
    $animal = str_replace("\"{", "{", $animal);
    $animal = str_replace("}\"", "}", $animal);
    $_SGLOBAL['db']->query(("UPDATE " . tname("plug_newfarm") . " set animal='" . $animal .
        "',money=money-" . $shop[$_REQUEST['cId']][price] * $_REQUEST['number'] .
        ",mc_exp=mc_exp+" . $_REQUEST['number'] * 5) . " where uid=" . $_SGLOBAL['supe_uid']);
    $buyanimal = json_encode($buyanimal);
    $buyanimal = str_replace("\"{", "{", $buyanimal);
    $buyanimal = str_replace("}\"", "}", $buyanimal);
    //������־
    $sql = "SELECT * FROM " . tname("plug_newfarm_mclogs") . " WHERE uid = " .
        intval($_SGLOBAL['supe_uid']) . " AND type = 10 AND time > " . ($_SGLOBAL['timestamp'] -
        3600) . " AND fromid =" . $_SGLOBAL['supe_uid'];
    $query = $_SGLOBAL['db']->query($sql);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        if (($value[type] == 10) && ($value[fromid] == $_SGLOBAL['supe_uid']) && ($_REQUEST['number'] >
            0)) {
            // && ($value[iid]) && ($value[count])
            $list = $value[iid];
            $money = $value[money];
            $scount = $value[count];
            $stime = $value[time];
            $list = $list . "," . $_REQUEST['cId'];
            $scount = $scount . "," . $_REQUEST['number'];
            $money = $money + ($shop[$_REQUEST['cId']][price] * $_REQUEST['number']);
            $sql1 = "UPDATE " . tname("plug_newfarm_mclogs") . " set iid = '" . $list .
                "', money = '" . $money . "', count ='" . $scount . "', time = " . $_SGLOBAL['timestamp'] .
                ", isread = 0 where uid = " . intval($_SGLOBAL['supe_uid']) .
                " AND type = 10 AND time > " . ($_SGLOBAL['timestamp'] - 3600) . " AND fromid =" .
                $_SGLOBAL['supe_uid'];
        }
    }
    if ((!$sql1) && ($_REQUEST['number'] > 0)) {
        $sql1 = "INSERT INTO " . tname("plug_newfarm_mclogs") .
            " (`uid`, `type`, `count`, `fromid`, `time`, `iid`, `isread`, `money` ) VALUES (" .
            $_SGLOBAL['supe_uid'] . ", 10," . $_REQUEST['number'] . ", " . $_SGLOBAL['supe_uid'] .
            ", " . $_SGLOBAL['timestamp'] . ", " . $_REQUEST['cId'] . ", 0, " . $shop[$_REQUEST['cId']][price] *
            $_REQUEST['number'] . ");";
    }
    $query = $_SGLOBAL['db']->query($sql1);
    echo stripslashes(("{\"addExp\":" . $_REQUEST['number'] * 5) . ",\"animal\":" .
        $buyanimal . ",\"code\":0,\"money\":" . $shop[$_REQUEST['cId']][price] * $_REQUEST['number'] .
        ",\"msg\":\"success\",\"num\":" . $_REQUEST['number'] . ",\"uin\":\"\"}");
    exit();
}
if ($_REQUEST['mod'] == "cgi_post_product") {
    $needlog = 1;
    if ($_REQUEST['uId'] == null) {
        $GLOBALS['_REQUEST']['uId'] = $_SGLOBAL['supe_uid'];
        $needlog = 0;
    }
    $GLOBALS['_REQUEST']['serial'] = intval($_REQUEST['serial']);
    $query = $_SGLOBAL['db']->query("SELECT animal FROM " . tname("plug_newfarm") .
        " where uid=" . intval($_REQUEST['uId']));
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $animal = json_decode($list[0][animal]);
    if ($animal->animalfood == 0) {
        echo "{\"errorContent\":\"\\u52A8\\u7269\\u6328\\u997F\\u5566\\uFF0C\\u7F3A\\u5C11\\u7267\\u8349\\u4F1A\\u505C\\u6B62\\u751F\\u4EA7\\uFF0C\\u5FEB\\u53BB\\u6DFB\\u52A0\",\"errorType\":\"1011\"}";
        exit();
    }
    if (($animal->animal[$_REQUEST['serial']]->postTime + 3600) > $_SGLOBAL['timestamp']) {
        echo "{\"errorContent\":\"\\u8BF7\\u4E0D\\u8981\\u91C7\\u7528\\u975E\\u6CD5\\u624B\\u6BB5\\uFF01\",\"errorType\":\"1011\"}";
        exit();
    }
    if ($animal->animal[$_REQUEST['serial']]->postTime == 0) 
	{
		$chk_time = $_SGLOBAL['timestamp'] - $animal->animal[$_REQUEST['serial']]->buyTime;
        if ($chk_time < $animaltime[$animal->animal[$_REQUEST['serial']]->cId][0] + $animaltime[$animal-> animal[$_REQUEST['serial']]->cId][1]) 
		{
            echo "{\"errorContent\":\"\\u8FD8\\u6CA1\\u5230\\u751F\\u4EA7\\u7684\\u65F6\\u95F4\\u5462\\uFF0C\\u8BF7\\u4E0D\\u8981\\u7740\\u6025\",\"errorType\":\"1011\"}";
            exit();
        }
    } else {
        if ($_SGLOBAL['timestamp'] - $animal->animal[$_REQUEST['serial']]->postTime < $shop[$animal->animal[$_REQUEST['serial']]->cId][4]) {
            echo "{\"errorContent\":\"\\u8FD8\\u6CA1\\u5230\\u751F\\u4EA7\\u7684\\u65F6\\u95F4\\u5462\\uFF0C\\u8BF7\\u4E0D\\u8981\\u7740\\u6025\",\"errorType\":\"1011\"}";
            exit();
        }
    } //����ٳ���
    $animal->animal[$_REQUEST['serial']]->postTime = $_SGLOBAL['timestamp'];
    $animal->animal[$_REQUEST['serial']]->tou = "";
    $animal->animal[$_REQUEST['serial']]->totalCome = $animal->animal[$_REQUEST['serial']]->
        totalCome + $shop[$animal->animal[$_REQUEST['serial']]->cId][output];
    $stranimal = json_encode($animal);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set animal='" . $stranimal .
        "' where uid=" . intval($_REQUEST['uId']));
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
        " set mc_exp=mc_exp+5 where uid=" . $_SGLOBAL['supe_uid']);
    //�����־
    if ($_SGLOBAL['supe_uid'] != $_REQUEST['uId']) {
        $sql = "SELECT * FROM " . tname("plug_newfarm_mclogs") . " WHERE uid = " .
            intval($_REQUEST['uId']) . " AND type = 2 AND time > " . ($_SGLOBAL['timestamp'] -
            3600) . " AND fromid =" . $_SGLOBAL['supe_uid'];
        $query = $_SGLOBAL['db']->query($sql);
        while ($value = $_SGLOBAL['db']->fetch_array($query)) {
            if (($value[type] == 2) && ($value[fromid] == $_SGLOBAL['supe_uid'])) {
                // && ($value[iid]) && ($value[count])
                $list = explode(",", $value[iid]);
                $scount = explode(",", $value[count]);
                $stime = $value[time];
                $listo = "";
                $scounto = "";
                $flag = 0;
                for ($i = 0; $i < count($list); $i++) {
                    if ($list[$i] == $animal->animal[$_REQUEST['serial']]->cId) {
                        $flag = 1;
                        $scount[$i] = $scount[$i] + 1;
                    }
                }
                if ($flag == 0) {
                    $list[count($list)] = $animal->animal[$_REQUEST['serial']]->cId;
                    $scount[count($list)] = 1;
                }
                for ($i = 0; $i < (count($list)) - 1; $i++) {
                    $listo = $listo . $list[$i] . ",";
                    $scounto = $scounto . $scount[$i] . ",";
                }
                $listo = $listo . $list[count($list) - 1];
                $scounto = $scounto . $scount[count($list) - 1];
                $sql1 = "UPDATE " . tname("plug_newfarm_mclogs") . " set iid = '" . $listo .
                    "', count = '" . $scounto . "', time = " . $_SGLOBAL['timestamp'] .
                    ", isread = 0 where uid = " . intval($_REQUEST['uId']) .
                    " AND type = 2 AND time > " . ($_SGLOBAL['timestamp'] - 3600) . " AND fromid =" .
                    $_SGLOBAL['supe_uid'];
            }
        }
        if (($listo == "") || ($scounto == "")) {
            $listo = $animal->animal[$_REQUEST['serial']]->cId;
            $scounto = 1;
        }
        if (!$sql1) {
            $sql1 = "INSERT INTO " . tname("plug_newfarm_mclogs") .
                " (`uid`, `type`, `count`, `fromid`, `time`, `iid`, `isread`, `money` ) VALUES (" .
                $_REQUEST['uId'] . ", 2, " . $scounto . ", " . $_SGLOBAL['supe_uid'] . ", " . $_SGLOBAL['timestamp'] .
                ", " . $listo . ", 0, 0);";
        }
        $query = $_SGLOBAL['db']->query($sql1);
    }
    //�����־
    echo "{\"addExp\":5,\"animal\":{\"buyTime\":" . $animal->animal[$_REQUEST['serial']]->
        buyTime . ",\"cId\":" . $animal->animal[$_REQUEST['serial']]->cId . ",\"createTime\":0,\"feedTime\":" . ($_SGLOBAL['timestamp'] -
        $animaltime[$animal->animal[$_REQUEST['serial']]->cId][0]) . ",\"growTime\":" . ($_SGLOBAL['timestamp'] -
        $animal->animal[$_REQUEST['serial']]->buyTime) . ",\"growTimeNext\":" . $animaltime[$animal->
        animal[$_REQUEST['serial']]->cId][3] . ",\"postTime\":" . $_SGLOBAL['timestamp'] .
        ",\"productNum\":2,\"serial\":" . $_REQUEST['serial'] . ",\"status\":4,\"statusNext\":5,\"totalCome\":" .
        $shop[$animal->animal[$_REQUEST['serial']]->cId][output] . "}}";
    exit();
}
if ($_REQUEST['mod'] == "cgi_harvest_product") {
    if ($_REQUEST['harvesttype'] == "1") {
        $query = $_SGLOBAL['db']->query("SELECT animal,mc_package FROM " . tname("plug_newfarm") .
            " where uid=" . $_SGLOBAL['supe_uid']);
        while ($value = $_SGLOBAL['db']->fetch_array($query)) {
            $list[] = $value;
        }
        $animal = (array )json_decode($list[0][animal]);
        $totalCome = 0;
        $exp = 0;
        foreach ($animal[animal] as $key => $value) {
            if ($value->cId == $_REQUEST['type']) {
                $totalCome += $value->totalCome;
                //�ɹ�
                $mc_repertory = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT repertory FROM " .
                    tname("plug_newfarm") . " where uid=" . intval($_SGLOBAL['supe_uid'])), 0);
                $mc_repertory = json_decode($mc_repertory);
                $flag = false;
                foreach ($mc_repertory->r as $key => $val) {
                    if ($_REQUEST['type'] == $val->cId) {
                        $flag = true;
                        $mc_repertory->r[$key]->harvest = $mc_repertory->r[$key]->harvest + $value->
                            totalCome;
                    }
                }
                if (!$flag) {
                    $cName = $animalname[$_REQUEST['type']][name];
                    $mc_repertory->r[] = "{\"cId\":" . $_REQUEST['type'] . ",\"cName\":\"" . $cName .
                        "\",\"harvest\":" . $value->totalCome . ",\"scrounge\":0}";
                }
                $mc_repertory = json_encode($mc_repertory);
                $mc_repertory = str_replace("\"{", "{", $mc_repertory);
                $mc_repertory = str_replace("}\"", "}", $mc_repertory);
                $mc_repertory = str_replace("\\u", "\\\\u", $mc_repertory);
                $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set repertory='" .
                    $mc_repertory . "' where uid=" . $_SGLOBAL['supe_uid']);
                //�ɹ�
                $value->totalCome = 0;
                $value->tou = "";
                ++$exp;
            }
        }
        if ($totalCome == 0) {
            exit();
        }
        $animal = json_encode($animal);
        $mc_package = json_decode($list[0][mc_package]);
        $mc_package->$_REQUEST['type'] = $mc_package->$_REQUEST['type'] + $totalCome;
        $mc_package = json_encode($mc_package);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set animal='" . $animal .
            "',mc_exp=mc_exp+" . $exp * $animalname[$_REQUEST['type']][exp] .
            ",mc_package='" . $mc_package . "' where uid=" . $_SGLOBAL['supe_uid']);
        echo "{\"addExp\":" . $exp * $animalname[$_REQUEST['type']][exp] . ",\"cId\":" .
            $_REQUEST['type'] . ",\"code\":0,\"harvestnum\":" . $totalCome . ",\"msg\":\"success\",\"serial\":-1}";
        exit();
    }
    if ($_REQUEST['harvesttype'] == "2") {
        $query = $_SGLOBAL['db']->query("SELECT animal,mc_package FROM " . tname("plug_newfarm") .
            " where uid=" . $_SGLOBAL['supe_uid']);
        while ($value = $_SGLOBAL['db']->fetch_array($query)) {
            $list[] = $value;
        }
        $animal = (array )json_decode($list[0][animal]);
        if ($_SGLOBAL['timestamp'] - $animal[animal][$_REQUEST['serial']]->buyTime < $animaltime[$animal[animal][$_REQUEST['serial']]->
            cId][5]) {
            echo "{\"errorContent\":\"\\u8FD8\\u6CA1\\u5230\\u6536\\u83B7\\u65F6\\u95F4\\u5462\\uFF0C\\u8BF7\\u4E0D\\u8981\\u7740\\u6025\",\"errorType\":\"1011\"}";
            exit();
        } //����ٳ���
        if (floor($animal[animalfood]) == 0) {
            echo "{\"errorContent\":\"\\u7F3A\\u5C11\\u7267\\u8349\\u4E0D\\u80FD\\u6536\\u83B7\\uFF0C\\u5FEB\\u53BB\\u6DFB\\u52A0\",\"errorType\":\"1011\"}";
            exit();
        } //����ڼ�1��ݼ��ɲ����BUG�޸�
        $cid = "1" . $animal[animal][$_REQUEST['serial']]->cId;
        $cid1 = $animal[animal][$_REQUEST['serial']]->cId;
        $animal[animal][$_REQUEST['serial']]->totalCome > 0 && exit("{\"errorContent\":\"\\u8BF7\\u5148\\u6536\\u83B7\\u526F\\u4EA7\\u54C1\\u201C" .
            $animalname[$cid1][name] . "\\u201D\",\"errorType\":\"1011\"}");
        $mc_package = json_decode($list[0][mc_package]);
        $mc_package->$cid = $mc_package->$cid + 1;
        $mc_package = json_encode($mc_package);
        $animal[animal][$_REQUEST['serial']]->buyTime = 0;
        $animal[animal][$_REQUEST['serial']]->cId = 0;
        $animal[animal][$_REQUEST['serial']]->postTime = 0;
        $animal[animal][$_REQUEST['serial']]->totalCome = 0;
        $animal[animal][$_REQUEST['serial']]->tou = "";
        $animal = json_encode($animal);

        //�ɹ�
        $mc_repertory = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT repertory FROM " .
            tname("plug_newfarm") . " where uid=" . intval($_SGLOBAL['supe_uid'])), 0);
        $mc_repertory = json_decode($mc_repertory);
        $flag = false;
        foreach ($mc_repertory->r as $key => $val) {
            if ($cid == $val->cId) {
                $flag = true;
                $mc_repertory->r[$key]->harvest = $mc_repertory->r[$key]->harvest + 1;
            }
        }
        if (!$flag) {
            $cName = $animalname[$cid][name];
            $mc_repertory->r[] = "{\"cId\":" . $cid . ",\"cName\":\"" . $cName . "\",\"harvest\":1,\"scrounge\":0}";
        }
        $mc_repertory = json_encode($mc_repertory);
        $mc_repertory = str_replace("\"{", "{", $mc_repertory);
        $mc_repertory = str_replace("}\"", "}", $mc_repertory);
        $mc_repertory = str_replace("\\u", "\\\\u", $mc_repertory);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set repertory='" .
            $mc_repertory . "' where uid=" . $_SGLOBAL['supe_uid']);
        //�ɹ�
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set animal='" . $animal .
            "',mc_exp=mc_exp+" . $animalname[$cid][exp] . ",mc_package='" . $mc_package .
            "' where uid=" . $_SGLOBAL['supe_uid']);
        echo "{\"addExp\":" . $animalname[$cid][exp] . ",\"cId\":" . $cid1 . ",\"code\":0,\"harvestnum\":0,\"msg\":\"success\",\"serial\":" .
            $_REQUEST['serial'] . "}";
        exit();
    }
}
if ($_REQUEST['mod'] == "cgi_steal_product") {
    $query = $_SGLOBAL['db']->query("SELECT animal FROM " . tname("plug_newfarm") .
        " where uid=" . intval($_REQUEST['uId']));
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $animal = (array )json_decode($list[0][animal]);
    $tounum = 0;
    foreach ($animal[animal] as $key => $value) {
        if ($_REQUEST['type'] == $value->cId) {
            if (!stristr($value->tou, "," . $_SGLOBAL['supe_uid'] . ",")) {
                if ($shop[$_REQUEST['type']][output] / 2 < $value->totalCome) {
                    $value->totalCome--;
                    ++$tounum;
                    $value->tou = $value->tou . "," . $_SGLOBAL['supe_uid'] . ",";
                    //�ɹ�
                    $mc_repertory = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT repertory FROM " .
                        tname("plug_newfarm") . " where uid=" . intval($_SGLOBAL['supe_uid'])), 0);
                    $mc_repertory = json_decode($mc_repertory);
                    $flag = false;
                    foreach ($mc_repertory->r as $key => $val) {
                        if ($_REQUEST['type'] == $val->cId) {
                            $flag = true;
                            $mc_repertory->r[$key]->scrounge++;
                            //�����Ϊ ++ �Ǽ�һ���Ҳ��ˣ����͵���ɹ������ʾ���6�����1+2+3 ��������������Ǵ���ģ�˳���޸�һ�£�
                        }
                    }
                    if (!$flag) {
                        $cName = $animalname[$_REQUEST['type']][name];
                        $mc_repertory->r[] = "{\"cId\":" . $_REQUEST['type'] . ",\"cName\":\"" . $cName .
                            "\",\"harvest\":0,\"scrounge\":" . $tounum . "}";
                    }
                    $mc_repertory = json_encode($mc_repertory);
                    $mc_repertory = str_replace("\"{", "{", $mc_repertory);
                    $mc_repertory = str_replace("}\"", "}", $mc_repertory);
                    $mc_repertory = str_replace("\\u", "\\\\u", $mc_repertory);
                    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set repertory='" .
                        $mc_repertory . "' where uid=" . $_SGLOBAL['supe_uid']);
                    //�ɹ�
                }
            }
        }
    }
    $tounum == 0 && exit("{\"errorContent\":\"\\u4F60\\u6765\\u7684\\u4E5F\\u592A\\u665A\\u4E86\\u5427...\",\"errorType\":\"1011\"}");
    $mc_package = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT mc_package FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
    $mc_package = json_decode($mc_package);
    $mc_package->$_REQUEST['type'] = $mc_package->$_REQUEST['type'] + $tounum;
    $animal = json_encode($animal);
    $mc_package = json_encode($mc_package);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set animal='" . $animal .
        "' where uid=" . intval($_REQUEST['uId']));
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set mc_package='" .
        $mc_package . "' where uid=" . $_SGLOBAL['supe_uid']);
    //͵��־
    $sql = "SELECT * FROM " . tname("plug_newfarm_mclogs") . " WHERE uid = " .
        intval($_REQUEST['uId']) . " AND type = 1 AND time > " . ($_SGLOBAL['timestamp'] -
        3600) . " AND fromid =" . $_SGLOBAL['supe_uid'];
    $query = $_SGLOBAL['db']->query($sql);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        if (($value[type] == 1) && ($value[fromid] == $_SGLOBAL['supe_uid']) && ($tounum >
            0)) {
            // && ($value[iid]) && ($value[count])
            $list = $value[iid];
            $scount = $value[count];
            $stime = $value[time];
            $list = $list . "," . $_REQUEST['type'];
            $scount = $scount . "," . $tounum;
            $sql1 = "UPDATE " . tname("plug_newfarm_mclogs") . " set iid = '" . $list .
                "', count ='" . $scount . "', time = " . $_SGLOBAL['timestamp'] .
                ", isread = 0 where uid = " . intval($_REQUEST['uId']) .
                " AND type = 1 AND time > " . ($_SGLOBAL['timestamp'] - 3600) . " AND fromid =" .
                $_SGLOBAL['supe_uid'];
        }
    }
    if ((!$sql1) && ($tounum > 0)) {
        $sql1 = "INSERT INTO " . tname("plug_newfarm_mclogs") .
            " (`uid`, `type`, `count`, `fromid`, `time`, `iid`, `isread`, `money` ) VALUES (" .
            $_REQUEST['uId'] . ", 1," . $tounum . ", " . $_SGLOBAL['supe_uid'] . ", " . $_SGLOBAL['timestamp'] .
            ", " . $_REQUEST['type'] . ", 0, 0);";
    }
    $query = $_SGLOBAL['db']->query($sql1);
    echo "{\"cId\":" . $_REQUEST['type'] . ",\"harvestnum\":" . $tounum . "}";
    exit();
}
if ($_REQUEST['mod'] == "cgi_get_repertory?target=animal") {
    $mc_package = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT mc_package FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
    $mc_package = json_decode($mc_package);
    foreach ($mc_package as $key => $value) {
        if (0 < $value) {
            $package[] = "{\"amount\":" . $value . ",\"cId\":" . $key . ",\"cName\":\"" . $animalname[$key][name] .
                "\",\"price\":" . $animalname[$key][price] . "}";
        }
    }
    $package = json_encode($package);
    $package = str_replace("\\u", "\\\\u", $package);
    $package = str_replace("\"{", "{", $package);
    $package = str_replace("}\"", "}", $package);
    $package = str_replace("null", "[]", $package);
    echo stripslashes($package);
}
if ($_REQUEST['mod'] == "cgi_sale_product") {
    if ($_REQUEST['saleAll'] == "1") {
        $mc_package = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT mc_package FROM " .
            tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
        $mc_package = json_decode($mc_package);
        $money = 0;
        foreach ($mc_package as $key => $value) {
            if (0 < $value) {
                $money += $animalname[$key][price] * $value;
                $mc_package->$key = 0;
            }
            unset($mc_package->$key);
        }
        $mc_package = json_encode($mc_package);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set mc_package='" .
            $mc_package . "',money=money+" . $money . " where uid=" . $_SGLOBAL['supe_uid']);
        echo "{\"direction\":\"\\u64CD\\u4F5C\\u6210\\u529F\\uFF0C\\u5171\\u83B7\\u5F97\\u6536\\u5165\\u548C\\u611F\\u8C22\\u91D1<font color=\\\"#FF6600\\\"> <b>" .
            $money . "</b> </font>\\u91D1\\u5E01\",\"money\":" . $money . "}";
    } else {
        $mc_package = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT mc_package FROM " .
            tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
        $mc_package = json_decode($mc_package);
        if ($mc_package->$_REQUEST['cId'] < $_REQUEST['num']) {
            exit();
        }
        $mc_package->$_REQUEST['cId'] = $mc_package->$_REQUEST['cId'] - $_REQUEST['num'];
        //�Զ�ѹ�����
        foreach ($mc_package as $key => $value) {
            if ($value == 0) {
                unset($mc_package->$key);
            }
        }
        $mc_package = json_encode($mc_package);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set mc_package='" .
            $mc_package . "',money=money+" . $animalname[$_REQUEST['cId']][price] * $_REQUEST['num'] .
            " where uid=" . $_SGLOBAL['supe_uid']);
        //������־
        $sql = "SELECT * FROM " . tname("plug_newfarm_mclogs") . " WHERE uid = " .
            intval($_SGLOBAL['supe_uid']) . " AND type = 9 AND time > " . ($_SGLOBAL['timestamp'] -
            3600) . " AND fromid =" . $_SGLOBAL['supe_uid'];
        $query = $_SGLOBAL['db']->query($sql);
        while ($value = $_SGLOBAL['db']->fetch_array($query)) {
            if (($value[type] == 9) && ($value[fromid] == $_SGLOBAL['supe_uid']) && ($_REQUEST['num'] >
                0)) {
                // && ($value[iid]) && ($value[count])
                $list = $value[iid];
                $moneyt = $value[money];
                $scount = $value[count];
                $stime = $value[time];
                $list = $list . "," . $_REQUEST['cId'];
                $scount = $scount . "," . $_REQUEST['num'];
                $moneyt = $moneyt + ($animalname[$_REQUEST['cId']][price] * $_REQUEST['num']);
                $sql1 = "UPDATE " . tname("plug_newfarm_mclogs") . " set iid = '" . $list .
                    "', money = '" . $moneyt . "', count ='" . $scount . "', time = " . $_SGLOBAL['timestamp'] .
                    ", isread = 0 where uid = " . intval($_SGLOBAL['supe_uid']) .
                    " AND type = 9 AND time > " . ($_SGLOBAL['timestamp'] - 3600) . " AND fromid =" .
                    $_SGLOBAL['supe_uid'];
            }
        }
        if ((!$sql1) && ($_REQUEST['num'] > 0)) {
            $sql1 = "INSERT INTO " . tname("plug_newfarm_mclogs") .
                " (`uid`, `type`, `count`, `fromid`, `time`, `iid`, `isread`, `money` ) VALUES (" .
                $_SGLOBAL['supe_uid'] . ", 9," . $_REQUEST['num'] . ", " . $_SGLOBAL['supe_uid'] .
                ", " . $_SGLOBAL['timestamp'] . ", " . $_REQUEST['cId'] . ", 0, " . $animalname[$_REQUEST['cId']][price] *
                $_REQUEST['num'] . ");";
        }
        $query = $_SGLOBAL['db']->query($sql1);
        echo "{\"cId\":" . $_REQUEST['cId'] . ",\"direction\":\"\\u6210\\u529F\\u5356\\u51FA<font color=\\\"#0099FF\\\"> <b>" .
            $_REQUEST['num'] . "</b> </font>\\u4E2A" . $animalname[$_REQUEST['cId']][name] .
            "��\\u8D5A\\u5230\\u91D1\\u5E01<font color=\\\"#FF6600\\\"> <b>" . $animalname[$_REQUEST['cId']][price] *
            $_REQUEST['num'] . "</b> </font>\",\"money\":" . $animalname[$_REQUEST['cId']][price] *
            $_REQUEST['num'] . "}";
    }
}
if ($_REQUEST['mod'] == "cgi_get_repertory?target=package") {
    $fruit = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT fruit FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
    $fruit = json_decode($fruit);
    $id = 40;
    $id2 = 3;
    echo "[{\"amount\":" . intval($fruit->$id) . ",\"tId\":40,\"tName\":\"\\u7267\\u8349\",\"type\":4},{\"aidlist\":[1002],\"amount\":" .
        intval($fruit->$id2) . ",\"tDesc\":\"\\u7279\\u6B8A\\u4F5C\\u7269\\uFF0C\\u4F9B\\u5154\\u5B50\\u4F7F\\u7528\\u53EF\\u51CF\\u5C11\\u751F\\u957F\\u65F6\\u95F45\\u5206\\u949F\\u3002\",\"tId\":3,\"tName\":\"\\u80E1\\u841D\\u535C\",\"type\":4}]";
}
if ($_REQUEST['mod'] == "cgi_feed_food") {
    // һ�����200�ò�
    if (!is_numeric($_REQUEST['foodnum']) || $_REQUEST['foodnum'] < 1) {
        exit();
    }
    $_REQUEST['foodnum'] > 200 && $_REQUEST['foodnum'] = 200;
    // һ�����200�ò�

    if ($_REQUEST['type'] == "0") {
        $fruit = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT fruit FROM " .
            tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
        $fruit = json_decode($fruit);
        $id = 40;
        if ($fruit->$id < 1 || $fruit->$id < $_REQUEST['foodnum']) {
            echo "{\"errorContent\":\"\\u80CC\\u5305\\u4E2D\\u7267\\u8349\\u6570\\u91CF\\u4E0D\\u8DB3\\uFF0C\\u8BF7\\u5237\\u65B0\\u67E5\\u770B\\u4F60\\u5B9E\\u9645\\u7267\\u8349\\u6570\\uFF01\",\"errorType\":\"1011\"}";
            exit();
        } else {
            if ($_REQUEST['uId'] == null) {
                $GLOBALS['_REQUEST']['uId'] = $_SGLOBAL['supe_uid'];
            }
            $fruit = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT fruit FROM " .
                tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
            $fruit = json_decode($fruit);
            $mucaoid = 40;
            $query = $_SGLOBAL['db']->query("SELECT animal FROM " . tname("plug_newfarm") .
                " where uid=" . intval($_REQUEST['uId']));
            while ($value = $_SGLOBAL['db']->fetch_array($query)) {
                $list[] = $value;
            }
            $animal = (array )json_decode($list[0][animal]);
            if (201 < $animal[animalfood] + $_REQUEST['foodnum']) {
                $GLOBALS['_REQUEST']['foodnum'] = floor(200 - $animal[animalfood]);
            }
            $animal[animalfood] = $animal[animalfood] + $_REQUEST['foodnum'];
            $fruit->$mucaoid = $fruit->$mucaoid - $GLOBALS['_REQUEST']['foodnum'];
            if ($GLOBALS['_REQUEST']['foodnum'] == 0) {
                echo "{\"errorContent\":\"\\u5927\\u54E5\\uFF5E\\u5DF2\\u7ECF\\u52A0\\u5230\\u4E0A\\u9650\\u4E86\\uFF0C\\u6709\\u591A\\u7684\\u8349\\u7ED9\\u670B\\u53CB\\u52A0\\u70B9\\u5427\\u2026\\u2026\",\"errorType\":\"1011\"}";
                exit();
            }
            $needfood = 0;
            $hungry = 0;
            foreach ($animal[animal] as $key => $value) {
                if (0 < $value->cId) {
                    //*********************************************
                    $value->feedtime == null && $value->feedtime = $animal[animalfeedtime];
                    if ($_SGLOBAL['timestamp'] - $value->feedtime > $animaltime[$value->cId][5]) {
                        $value_feedtime = $animaltime[$value->cId][5];
                        $value->feedtime = $_SGLOBAL['timestamp'] - $animaltime[$value->cId][5];
                    } else {
                        $value_feedtime = $_SGLOBAL['timestamp'] - $value->feedtime;
                    }
                    $needfood = $value_feedtime / 3600 * $shop[$value->cId][consum] / 4;
                    if ($needfood <= $animal[animalfood]) {
                        $value->feedtime = $_SGLOBAL['timestamp'];
                        $animal[animalfood] -= $needfood;
                        $hungry = 0;
                    } else {
                        $value->feedtime += round($animal[animalfood] * 4 / $shop[$value->cId][consum] *
                            3600);
                        $hungry = 1;
                        $animal[animalfood] = 0;
                    }
                    //*********************************************
                    $needfood += $shop[$value->cId][consum];
                    if ($value->postTime == 0) {
                        $time = $_SGLOBAL['timestamp'] - $value->buyTime;
                        if ($animaltime[$value->cId][0] + $animaltime[$value->cId][1] <= $time) {
                            $status = 3;
                            $growTimeNext = 12993;
                            $statusNext = 6;
                        }
                        if ($animaltime[$value->cId][0] <= $time && $time < $animaltime[$value->cId][0] +
                            $animaltime[$value->cId][1]) {
                            $status = 2;
                            $growTimeNext = $animaltime[$value->cId][0] + $animaltime[$value->cId][1] - $time;
                            $statusNext = 3;
                        }
                        if ($time < $animaltime[$value->cId][0]) {
                            $status = 1;
                            $growTimeNext = $animaltime[$value->cId][0] - $time;
                            $statusNext = 2;
                        }
                        if ($animaltime[$value->cId][5] < $time) {
                            $status = 6;
                            $growTimeNext = 0;
                            $statusNext = 6;
                        }
                        $newanimal[] = "{\"buyTime\":" . $value->buyTime . ",\"cId\":" . $value->cId .
                            ",\"growTime\":" . $time . ",\"growTimeNext\":" . $growTimeNext . ",\"hungry\":" .
                            $hungry . ",\"serial\":" . $key . ",\"status\":" . $status . ",\"statusNext\":" .
                            $statusNext . ",\"totalCome\":" . $value->totalCome . "}";
                    } else {
                        $totalCome = $value->totalCome;
                        $time = $_SGLOBAL['timestamp'] - $value->buyTime;
                        if ($animaltime[$value->cId][5] < $time) {
                            $status = 6;
                            $statusNext = 6;
                            $growTimeNext = 0;
                        }
                        if ($animaltime[$value->cId][4] < $_SGLOBAL['timestamp'] - $value->postTime) {
                            $status = 3;
                            $statusNext = 6;
                            $growTimeNext = 12993;
                        }
                        if ($_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][4]) {
                            $status = 5;
                            $statusNext = 3;
                            $growTimeNext = $animaltime[$value->cId][4] - ($_SGLOBAL['timestamp'] - $value->
                                postTime);
                        }
                        if ($_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][3]) {
                            $status = 4;
                            $statusNext = 5;
                            $growTimeNext = $animaltime[$value->cId][3] - ($_SGLOBAL['timestamp'] - $value->
                                postTime);
                            $totalCome -= $shop[$value->cId][output];
                        }
                        if ($value->buyTime + $animaltime[$value->cId][5] - $animaltime[$value->cId][3] -
                            $animaltime[$value->cId][4] < $_SGLOBAL['timestamp']) {
                            $status = 5;
                            $statusNext = 6;
                            $growTimeNext = $animaltime[$value->cId][5] - $time;
                        }
                        $newanimal[] = "{\"buyTime\":" . $value->buyTime . ",\"cId\":" . $value->cId .
                            ",\"growTime\":" . $time . ",\"growTimeNext\":" . $growTimeNext . ",\"hungry\":" .
                            $hungry . ",\"serial\":" . $key . ",\"status\":" . $status . ",\"statusNext\":" .
                            $statusNext . ",\"totalCome\":" . $totalCome . "}";
                    }
                }
            }
            $newanimal = json_encode($newanimal);
            $newanimal = str_replace("\"{", "{", $newanimal);
            $newanimal = str_replace("}\"", "}", $newanimal);
            $newanimal = str_replace("null", "[]", $newanimal);
            $stranimal = json_encode($animal);
            $addExp = 0;
            if ($_POST['uId'] != $_SGLOBAL['supe_uid']) {
                $addExp = floor($GLOBALS['_REQUEST']['foodnum'] / 10);
            }
            $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set animal='" . $stranimal .
                "' where uid=" . intval($_REQUEST['uId']));
            $fruit = json_encode($fruit);
            $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set mc_exp=mc_exp+" .
                $addExp . ",fruit='" . $fruit . "' where uid=" . $_SGLOBAL['supe_uid']);
            //���ڼӲ���־
            if ($_SGLOBAL['supe_uid'] != $_REQUEST['uId']) {
                $sql = "SELECT * FROM " . tname("plug_newfarm_mclogs") . " WHERE uid = " .
                    intval($_REQUEST['uId']) . " AND type = 3 AND time > " . ($_SGLOBAL['timestamp'] -
                    3600) . " AND fromid =" . $_SGLOBAL['supe_uid'];
                $query = $_SGLOBAL['db']->query($sql);
                while ($value = $_SGLOBAL['db']->fetch_array($query)) {
                    if (($value[type] == 3) && ($value[fromid] == $_SGLOBAL['supe_uid']) && ($_REQUEST['foodnum'] >
                        0)) {
                        // && ($value[iid]) && ($value[count])
                        $scount = $value[count];
                        $stime = $value[time];
                        $scount = $scount + $_REQUEST['foodnum'];
                        $sql1 = "UPDATE " . tname("plug_newfarm_mclogs") . " set count ='" . $scount .
                            "', time = " . $_SGLOBAL['timestamp'] . ", isread = 0 where uid = " . intval($_REQUEST['uId']) .
                            " AND type = 3 AND time > " . ($_SGLOBAL['timestamp'] - 3600) . " AND fromid =" .
                            $_SGLOBAL['supe_uid'];
                    }
                }
                if ((!$sql1) && ($_REQUEST['foodnum'] > 0)) {
                    $sql1 = "INSERT INTO " . tname("plug_newfarm_mclogs") .
                        " (`uid`, `type`, `count`, `fromid`, `time`, `iid`, `isread`, `money` ) VALUES (" .
                        $_REQUEST['uId'] . ", 3," . $_REQUEST['foodnum'] . ", " . $_SGLOBAL['supe_uid'] .
                        ", " . $_SGLOBAL['timestamp'] . ", 40, 0, 0);";
                }
                $query = $_SGLOBAL['db']->query($sql1);
            }
            //���ڼӲ���־
            echo stripslashes("{\"addExp\":" . $addExp . ",\"added\":" . $_REQUEST['foodnum'] .
                ",\"animal\":" . $newanimal . ",\"alert\":\"\\\\u6210\\\\u529F\\\\u6DFB\\\\u52A0" .
                $_REQUEST['foodnum'] . "\\\\u68F5\\\\u7267\\\\u8349\",\"money\":0,\"total\":" .
                $animal[animalfood] . ",\"type\":0,\"uId\":" . intval($_REQUEST['uId']) . "}");
            exit();
        }
    }
    if ($_REQUEST['type'] == "1") {
        $mc_price = 60;
        $mc_id = 40;
        $money = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT money FROM " .
            tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
        if ($money < $mc_price * $_REQUEST['foodnum']) {
            echo "{\"errorContent\":\"\\u4F60\\u7684\\u91D1\\u5E01\\u4E0D\\u8DB3\\uFF0C\\u8D2D\\u4E70" .
                $_REQUEST['foodnum'] . "\\u68F5\\u7267\\u8349\\uFF0C\\u5171\\u9700\\u8981" . ($mc_price *
                $_REQUEST['foodnum']) . "\\u4E2A\\u91D1\\u5E01\\u3002\",\"errorType\":\"1011\"}";
            exit();
        }
        $fruit->$mc_id = $fruit->$mc_id + $_POST['foodnum'];
        $fruit = json_encode($fruit);
        $money = $money - ($mc_price * $_REQUEST['foodnum']);
        $query = $_SGLOBAL['db']->query("SELECT animal FROM " . tname("plug_newfarm") .
            " where uid=" . intval($_SGLOBAL['supe_uid']));
        while ($value = $_SGLOBAL['db']->fetch_array($query)) {
            $list[] = $value;
        }
        $animal = (array )json_decode($list[0]['animal']);
        $animal[animalfood] = $animal[animalfood] + $_REQUEST['foodnum'];
        $fruit->$mucaoid = $fruit->$mucaoid - $GLOBALS['_REQUEST']['foodnum'];
        $needfood = 0;
        $hungry = 0;
        foreach ($animal['animal'] as $key => $value) {
            if (0 < $value->cId) {
                //*********************************************
                $value->feedtime == null && $value->feedtime = $animal[animalfeedtime];
                if ($_SGLOBAL['timestamp'] - $value->feedtime > $animaltime[$value->cId][5]) {
                    $value_feedtime = $animaltime[$value->cId][5];
                    $value->feedtime = $_SGLOBAL['timestamp'] - $animaltime[$value->cId][5];
                } else {
                    $value_feedtime = $_SGLOBAL['timestamp'] - $value->feedtime;
                }
                $needfood = $value_feedtime / 3600 * $shop[$value->cId][consum] / 4;
                if ($needfood <= $animal[animalfood]) {
                    $value->feedtime = $_SGLOBAL['timestamp'];
                    $animal[animalfood] -= $needfood;
                    $hungry = 0;
                } else {
                    $value->feedtime += round($animal[animalfood] * 4 / $shop[$value->cId][consum] *
                        3600);
                    $hungry = 1;
                    $animal[animalfood] = 0;
                }
                //*********************************************
                if ($value->postTime == 0) {
                    $time = $_SGLOBAL['timestamp'] - $value->buyTime;
                    if ($animaltime[$value->cId][0] + $animaltime[$value->cId][1] <= $time) {
                        $status = 3;
                        $growTimeNext = 12993;
                        $statusNext = 6;
                    }
                    if ($animaltime[$value->cId][0] <= $time && $time < $animaltime[$value->cId][0] +
                        $animaltime[$value->cId][1]) {
                        $status = 2;
                        $growTimeNext = $animaltime[$value->cId][0] + $animaltime[$value->cId][1] - $time;
                        $statusNext = 3;
                    }
                    if ($time < $animaltime[$value->cId][0]) {
                        $status = 1;
                        $growTimeNext = $animaltime[$value->cId][0] - $time;
                        $statusNext = 2;
                    }
                    if ($animaltime[$value->cId][5] < $time) {
                        $status = 6;
                        $growTimeNext = 0;
                        $statusNext = 6;
                    }
                    $newanimal[] = "{\"buyTime\":" . $value->buyTime . ",\"cId\":" . $value->cId .
                        ",\"growTime\":" . $time . ",\"growTimeNext\":" . $growTimeNext . ",\"hungry\":" .
                        $hungry . ",\"serial\":" . $key . ",\"status\":" . $status . ",\"statusNext\":" .
                        $statusNext . ",\"totalCome\":" . $value->totalCome . "}";
                } else {
                    $totalCome = $value->totalCome;
                    $time = $_SGLOBAL['timestamp'] - $value->buyTime;
                    if ($animaltime[$value->cId][5] < $time) {
                        $status = 6;
                        $statusNext = 6;
                        $growTimeNext = 0;
                    }
                    if ($animaltime[$value->cId][4] < $_SGLOBAL['timestamp'] - $value->postTime) {
                        $status = 3;
                        $statusNext = 6;
                        $growTimeNext = 12993;
                    }
                    if ($_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][4]) {
                        $status = 5;
                        $statusNext = 3;
                        $growTimeNext = $animaltime[$value->cId][4] - ($_SGLOBAL['timestamp'] - $value->
                            postTime);
                    }
                    if ($_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][3]) {
                        $status = 4;
                        $statusNext = 5;
                        $growTimeNext = $animaltime[$value->cId][3] - ($_SGLOBAL['timestamp'] - $value->
                            postTime);
                        $totalCome -= $shop[$value->cId][output];
                    }
                    if ($value->buyTime + $animaltime[$value->cId][5] - $animaltime[$value->cId][3] -
                        $animaltime[$value->cId][4] < $_SGLOBAL['timestamp']) {
                        $status = 5;
                        $statusNext = 6;
                        $growTimeNext = $animaltime[$value->cId][5] - $time;
                    }
                    $newanimal[] = "{\"buyTime\":" . $value->buyTime . ",\"cId\":" . $value->cId .
                        ",\"growTime\":" . $time . ",\"growTimeNext\":" . $growTimeNext . ",\"hungry\":" .
                        $hungry . ",\"serial\":" . $key . ",\"status\":" . $status . ",\"statusNext\":" .
                        $statusNext . ",\"totalCome\":" . $totalCome . "}";
                }
            }
        }
        $newanimal = json_encode($newanimal);
        $newanimal = str_replace("\"{", "{", $newanimal);
        $newanimal = str_replace("}\"", "}", $newanimal);
        $newanimal = str_replace("null", "[]", $newanimal);
        $stranimal = json_encode($animal);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set money=" . $money .
            ",animal='" . $stranimal . "' where uid=" . $_SGLOBAL['supe_uid']);
        //���Լ������־
        $sql = "SELECT * FROM " . tname("plug_newfarm_mclogs") . " WHERE uid = " .
            intval($_SGLOBAL['supe_uid']) . " AND type = 4 AND time > " . ($_SGLOBAL['timestamp'] -
            3600) . " AND fromid =" . $_SGLOBAL['supe_uid'];
        $query = $_SGLOBAL['db']->query($sql);
        while ($value = $_SGLOBAL['db']->fetch_array($query)) {
            if (($value[type] == 4) && ($value[fromid] == $_SGLOBAL['supe_uid']) && ($_REQUEST['foodnum'] >
                0)) {
                // && ($value[iid]) && ($value[count])
                $money = $value[money];
                $scount = $value[count];
                $stime = $value[time];
                $money = $money + ($mc_price * $_REQUEST['foodnum']);
                $scount = $scount + $_REQUEST['foodnum'];
                $sql1 = "UPDATE " . tname("plug_newfarm_mclogs") . " set money = '" . $money .
                    "', count ='" . $scount . "', time = " . $_SGLOBAL['timestamp'] .
                    ", isread = 0 where uid = " . intval($_SGLOBAL['supe_uid']) .
                    " AND type = 4 AND time > " . ($_SGLOBAL['timestamp'] - 3600) . " AND fromid =" .
                    $_SGLOBAL['supe_uid'];
            }
        }
        if ((!$sql1) && ($_REQUEST['foodnum'] > 0)) {
            $sql1 = "INSERT INTO " . tname("plug_newfarm_mclogs") .
                " (`uid`, `type`, `count`, `fromid`, `time`, `iid`, `isread`, `money` ) VALUES (" .
                $_SGLOBAL['supe_uid'] . ", 4," . $_REQUEST['foodnum'] . ", " . $_SGLOBAL['supe_uid'] .
                ", " . $_SGLOBAL['timestamp'] . ", 40, 0, " . ($mc_price * $_REQUEST['foodnum']) .
                ");";
        }
        $query = $_SGLOBAL['db']->query($sql1);
        echo stripslashes("{\"addExp\":0,\"added\":" . $_REQUEST['foodnum'] . ",\"animal\":" .
            $newanimal . ",\"alert\":\"\\\\u6210\\\\u529f\\\\u8d2d\\\\u4e70" . $_REQUEST['foodnum'] .
            "\\\\u68f5\\\\u7267\\\\u8349\\\\uff0c\\\\u5171\\\\u82b1\\\\u8d39\\\\u91d1\\\\u5e01" .
            ($mc_price * $_REQUEST['foodnum']) . "\\\\uff0c\\\\u5df2\\\\u653e\\\\u5165\\\\u60a8\\\\u7684\\\\u9972\\\\u6599\\\\u673A\\\\u5185\\\\u3002\",\"money\":" .
            ($mc_price * $_REQUEST['foodnum']) . ",\"total\":" . $animal[animalfood] . ",\"type\":1,\"uId\":" .
            intval($_SGLOBAL['supe_uid']) . "}");
        exit();
    }
    if ($_REQUEST['type'] == "2") {
        $mc_price = 60;
        $money = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT money FROM " .
            tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
        if ($money < $mc_price * $_REQUEST['foodnum']) {
            echo "{\"errorContent\":\"\\u4F60\\u7684\\u91D1\\u5E01\\u4E0D\\u8DB3\\uFF0C\\u8D2D\\u4E70" .
                $_REQUEST['foodnum'] . "\\u68F5\\u7267\\u8349\\uFF0C\\u5171\\u9700\\u8981" . ($mc_price *
                $_REQUEST['foodnum']) . "\\u4E2A\\u91D1\\u5E01\\u3002\",\"errorType\":\"1011\"}";
            exit();
        }
        $money = $money - ($mc_price * $_REQUEST['foodnum']);
        $query = $_SGLOBAL['db']->query("SELECT animal FROM " . tname("plug_newfarm") .
            " where uid=" . intval($_REQUEST['uId']));
        while ($value = $_SGLOBAL['db']->fetch_array($query)) {
            $list[] = $value;
        }
        $animal = (array )json_decode($list[0]['animal']);
        if ($animal[animalfood] >= 200) {
            echo "{\"errorContent\":\"\\u5927\\u54E5\\uFF5E\\u5DF2\\u7ECF\\u52A0\\u5230\\u4E0A\\u9650\\u4E86\\uFF0C\\u6709\\u591A\\u7684\\u8349\\u7ED9\\u522B\\u7684\\u670B\\u53CB\\u52A0\\u70B9\\u5427\\u2026\\u2026\",\"errorType\":\"1011\"}";
            exit();
        }
        $animal[animalfood] = $animal[animalfood] + $_REQUEST['foodnum'];
        $needfood = 0;
        $hungry = 0;
        foreach ($animal['animal'] as $key => $value) {
            if (0 < $value->cId) {
                //*********************************************
                $value->feedtime == null && $value->feedtime = $animal[animalfeedtime];
                if ($_SGLOBAL['timestamp'] - $value->feedtime > $animaltime[$value->cId][5]) {
                    $value_feedtime = $animaltime[$value->cId][5];
                    $value->feedtime = $_SGLOBAL['timestamp'] - $animaltime[$value->cId][5];
                } else {
                    $value_feedtime = $_SGLOBAL['timestamp'] - $value->feedtime;
                }
                $needfood = $value_feedtime / 3600 * $shop[$value->cId][consum] / 4;
                if ($needfood <= $animal[animalfood]) {
                    $value->feedtime = $_SGLOBAL['timestamp'];
                    $animal[animalfood] -= $needfood;
                    $hungry = 0;
                } else {
                    $value->feedtime += round($animal[animalfood] * 4 / $shop[$value->cId][consum] *
                        3600);
                    $hungry = 1;
                    $animal[animalfood] = 0;
                }
                //*********************************************
                if ($value->postTime == 0) {
                    $time = $_SGLOBAL['timestamp'] - $value->buyTime;
                    if ($animaltime[$value->cId][0] + $animaltime[$value->cId][1] <= $time) {
                        $status = 3;
                        $growTimeNext = 12993;
                        $statusNext = 6;
                    }
                    if ($animaltime[$value->cId][0] <= $time && $time < $animaltime[$value->cId][0] +
                        $animaltime[$value->cId][1]) {
                        $status = 2;
                        $growTimeNext = $animaltime[$value->cId][0] + $animaltime[$value->cId][1] - $time;
                        $statusNext = 3;
                    }
                    if ($time < $animaltime[$value->cId][0]) {
                        $status = 1;
                        $growTimeNext = $animaltime[$value->cId][0] - $time;
                        $statusNext = 2;
                    }
                    if ($animaltime[$value->cId][5] < $time) {
                        $status = 6;
                        $growTimeNext = 0;
                        $statusNext = 6;
                    }
                    $newanimal[] = "{\"buyTime\":" . $value->buyTime . ",\"cId\":" . $value->cId .
                        ",\"growTime\":" . $time . ",\"growTimeNext\":" . $growTimeNext . ",\"hungry\":" .
                        $hungry . ",\"serial\":" . $key . ",\"status\":" . $status . ",\"statusNext\":" .
                        $statusNext . ",\"totalCome\":" . $value->totalCome . "}";
                } else {
                    $totalCome = $value->totalCome;
                    $time = $_SGLOBAL['timestamp'] - $value->buyTime;
                    if ($animaltime[$value->cId][5] < $time) {
                        $status = 6;
                        $statusNext = 6;
                        $growTimeNext = 0;
                    }
                    if ($animaltime[$value->cId][4] < $_SGLOBAL['timestamp'] - $value->postTime) {
                        $status = 3;
                        $statusNext = 6;
                        $growTimeNext = 12993;
                    }
                    if ($_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][4]) {
                        $status = 5;
                        $statusNext = 3;
                        $growTimeNext = $animaltime[$value->cId][4] - ($_SGLOBAL['timestamp'] - $value->
                            postTime);
                    }
                    if ($_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][3]) {
                        $status = 4;
                        $statusNext = 5;
                        $growTimeNext = $animaltime[$value->cId][3] - ($_SGLOBAL['timestamp'] - $value->
                            postTime);
                        $totalCome -= $shop[$value->cId][output];
                    }
                    if ($value->buyTime + $animaltime[$value->cId][5] - $animaltime[$value->cId][3] -
                        $animaltime[$value->cId][4] < $_SGLOBAL['timestamp']) {
                        $status = 5;
                        $statusNext = 6;
                        $growTimeNext = $animaltime[$value->cId][5] - $time;
                    }
                    $newanimal[] = "{\"buyTime\":" . $value->buyTime . ",\"cId\":" . $value->cId .
                        ",\"growTime\":" . $time . ",\"growTimeNext\":" . $growTimeNext . ",\"hungry\":" .
                        $hungry . ",\"serial\":" . $key . ",\"status\":" . $status . ",\"statusNext\":" .
                        $statusNext . ",\"totalCome\":" . $totalCome . "}";
                }
            }
        }
        $newanimal = json_encode($newanimal);
        $newanimal = str_replace("\"{", "{", $newanimal);
        $newanimal = str_replace("}\"", "}", $newanimal);
        $newanimal = str_replace("null", "[]", $newanimal);
        $stranimal = json_encode($animal);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set money=" . $money .
            " where uid=" . $_SGLOBAL['supe_uid']);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set animal='" . $stranimal .
            "' where uid=" . intval($_REQUEST['uId']));
        //����������־
        if ($_SGLOBAL['supe_uid'] != $_REQUEST['uId']) {
            $sql = "SELECT * FROM " . tname("plug_newfarm_mclogs") . " WHERE uid = " .
                intval($_REQUEST['uId']) . " AND type = 5 AND time > " . ($_SGLOBAL['timestamp'] -
                3600) . " AND fromid =" . $_SGLOBAL['supe_uid'];
            $query = $_SGLOBAL['db']->query($sql);
            while ($value = $_SGLOBAL['db']->fetch_array($query)) {
                if (($value[type] == 5) && ($value[fromid] == $_SGLOBAL['supe_uid']) && ($_REQUEST['foodnum'] >
                    0)) {
                    // && ($value[iid]) && ($value[count])
                    $money = $value[money];
                    $scount = $value[count];
                    $stime = $value[time];
                    $money = $money + ($mc_price * $_REQUEST['foodnum']);
                    $scount = $scount + $_REQUEST['foodnum'];
                    $sql1 = "UPDATE " . tname("plug_newfarm_mclogs") . " set money = '" . $money .
                        "', count ='" . $scount . "', time = " . $_SGLOBAL['timestamp'] .
                        ", isread = 0 where uid = " . intval($_REQUEST['uId']) .
                        " AND type = 5 AND time > " . ($_SGLOBAL['timestamp'] - 3600) . " AND fromid =" .
                        $_SGLOBAL['supe_uid'];
                }
            }
            if ((!$sql1) && ($_REQUEST['foodnum'] > 0)) {
                $sql1 = "INSERT INTO " . tname("plug_newfarm_mclogs") .
                    " (`uid`, `type`, `count`, `fromid`, `time`, `iid`, `isread`, `money` ) VALUES (" .
                    $_REQUEST['uId'] . ", 5," . $_REQUEST['foodnum'] . ", " . $_SGLOBAL['supe_uid'] .
                    ", " . $_SGLOBAL['timestamp'] . ", 40, 0, " . ($mc_price * $_REQUEST['foodnum']) .
                    ");";
            }
            $query = $_SGLOBAL['db']->query($sql1);
        } //����������־
        echo stripslashes("{\"addExp\":0,\"added\":" . $_REQUEST['foodnum'] . ",\"animal\":" .
            $newanimal . ",\"alert\":\"\\\\u6210\\\\u529f\\\\u8d2d\\\\u4e70" . $_REQUEST['foodnum'] .
            "\\\\u68f5\\\\u7267\\\\u8349\\\\uff0c\\\\u5171\\\\u82b1\\\\u8d39\\\\u91d1\\\\u5e01" .
            ($mc_price * $_REQUEST['foodnum']) . "\\\\uff0c\\\\u5df2\\\\u653e\\\\u5165\\\\u60a8\\\\u7684\\\\u9972\\\\u6599\\\\u673A\\\\u5185\\\\u3002\",\"money\":" .
            ($mc_price * $_REQUEST['foodnum']) . ",\"total\":" . $animal[animalfood] . ",\"type\":2,\"uId\":" .
            intval($_REQUEST['uId']) . "}");
        exit();
    }

}
if ($_REQUEST['mod'] == "cgi_up_animalhouse") {
    //����Խ������
    $query = $_SGLOBAL['db']->query("SELECT money,animal,mc_exp FROM " . tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $animal = (array )json_decode($list[0][animal]);

    if ($_REQUEST['type'] == "1") {
        $item = "item2";
    } else {
        $item = "item3";
    }
    //����Խ������
    if ($_REQUEST['act'] == "query") {
        if ($_REQUEST['type'] == "1") {
            switch ($_REQUEST['level']) {
                case 0:
                    echo "{\"level\":0,\"money\":0}";
                    break;
                case 1:
                    echo "{\"level\":1,\"money\":3000}";
                    break;
                case 2:
                    echo "{\"level\":4,\"money\":20000}";
                    break;
                case 3:
                    echo "{\"level\":8,\"money\":60000}";
                    break;
                case 4:
                    echo "{\"level\":12,\"money\":120000}";
                    break;
                case 5:
                    echo "{\"level\":16,\"money\":210000}";
                    break;
                case 6:
                    echo "{\"level\":20,\"money\":300000}";
                    break;
                case 7:
                    echo "{\"level\":24,\"money\":400000}";
            }
        } else {
            switch ($_REQUEST['level']) {
                case 0:
                    echo "{\"level\":2,\"money\":5000}";
                    break;
                case 1:
                    echo "{\"level\":6,\"money\":40000}";
                    break;
                case 2:
                    echo "{\"level\":10,\"money\":90000}";
                    break;
                case 3:
                    echo "{\"level\":14,\"money\":160000}";
                    break;
                case 4:
                    echo "{\"level\":18,\"money\":250000}";
                    break;
                case 5:
                    echo "{\"level\":22,\"money\":350000}";
                    break;
                case 6:
                    echo "{\"level\":26,\"money\":500000}";
                    break;
                case 7:
                    echo "{\"level\":28,\"money\":700000}";
            }
        }
    } else {
        $query = $_SGLOBAL['db']->query("SELECT money,animal FROM " . tname("plug_newfarm") .
            " where uid=" . $_SGLOBAL['supe_uid']);
        while ($value = $_SGLOBAL['db']->fetch_array($query)) {
            $list[] = $value;
        }
        $animal = (array )json_decode($list[0][animal]);
        if ($_REQUEST['type'] == "1") {
            $item = "item2";
            $itemarr = array("1" => 0, "2" => 3000, "3" => 20000, "4" => 60000, "5" => 120000, "6" => 210000, "7" => 300000, "8" => 400000);
        } else {
            $item = "item3";
            $itemarr = array("1" => 5000, "2" => 40000, "3" => 90000, "4" => 160000, "5" => 250000, "6" => 350000, "7" => 500000, "8" => 700000);
        }
        $animal[$item] = $animal[$item] + 1;
        if ($list[0][money] < $itemarr[$animal[$item]] || $animal[$item] > 8) {
            exit();
        }
        $list[0][money] = $list[0][money] - $itemarr[$animal[$item]];
        $money = $itemarr[$animal[$item]];
        $srtanimal = json_encode($animal);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set animal='" . $srtanimal . "',money=" . $list[0][money] . " where uid=" . $_SGLOBAL['supe_uid']);
        $animal[item2] = "\"2\":{\"id\":102,\"lv\":" . $animal[item2] . "},";
        if ($animal[item3] == 0) {
            $animal[item3] = "";
        } else {
            $animal[item3] = "\"3\":{\"id\":103,\"lv\":" . $animal[item3] . "},";
        }
        echo "{\"1\":{\"id\":101,\"lv\":" . $animal[item1] . "}," . $animal[item2] . $animal[item3] . "\"4\":{\"id\":104,\"lv\":" . $animal[item4] . "},\"code\":1,\"money\":-" . $money . "}";
    }
}
if ($_REQUEST['mod'] == "cgi_up_task") {
    $mc_taskid = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT mc_taskid FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
    if ($_REQUEST['act'] == "1") {
        echo "{\"taskFlag\":1,\"taskId\":" . $mc_taskid . "}";
        exit();
    }
    if ($mc_taskid == 0) {
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set mc_exp=mc_exp+50,money=money+50,mc_taskid=1 where uid=" . $_SGLOBAL['supe_uid']);
        echo "{\"addExp\":50,\"item\":[{\"num\":50,\"type\":7},{\"num\":50,\"type\":6}],\"money\":50,\"task\":{\"taskDesc\":\"\\u606D\\u559C\\u60A8\\u5B8C\\u6210\\u4EFB\\u52A1\\uFF0C\\u83B7\\u5F9750\\u4E2A\\u7ECF\\u9A8C\\u548C50\\u4E2A\\u91D1\\u5E01��\",\"taskFlag\":1,\"taskId\":1}}";
    }
    if ($mc_taskid == 1) {
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set mc_exp=mc_exp+100,money=money+100,mc_taskid=2 where uid=" . $_SGLOBAL['supe_uid']);
        echo "{\"addExp\":100,\"item\":[{\"num\":100,\"type\":7},{\"num\":100,\"type\":6}],\"money\":100,\"task\":{\"taskDesc\":\"\\u606D\\u559C\\u60A8\\u5B8C\\u6210\\u4EFB\\u52A1\\uFF0C\\u83B7\\u5F97100\\u4E2A\\u7ECF\\u9A8C\\u548C100\\u4E2A\\u91D1\\u5E01��\",\"taskFlag\":1,\"taskId\":2}}";
    }
    if ($mc_taskid == 2) {
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set mc_exp=mc_exp+100,money=money+150,mc_taskid=3 where uid=" . $_SGLOBAL['supe_uid']);
        echo "{\"addExp\":100,\"item\":[{\"num\":100,\"type\":7},{\"num\":150,\"type\":6}],\"money\":150,\"task\":{\"taskDesc\":\"\\u606D\\u559C\\u60A8\\u5B8C\\u6210\\u4EFB\\u52A1\\uFF0C\\u83B7\\u5F97100\\u4E2A\\u7ECF\\u9A8C\\u548C150\\u4E2A\\u91D1\\u5E01��\",\"taskFlag\":1,\"taskId\":3}}";
    }
    if ($mc_taskid == 3) {
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set mc_exp=mc_exp+100,money=money+200,mc_taskid=4 where uid=" . $_SGLOBAL['supe_uid']);
        echo "{\"addExp\":100,\"item\":[{\"num\":100,\"type\":7},{\"num\":200,\"type\":6}],\"money\":200,\"task\":{\"taskDesc\":\"\\u606D\\u559C\\u60A8\\u5B8C\\u6210\\u4EFB\\u52A1\\uFF0C\\u83B7\\u5F97100\\u4E2A\\u7ECF\\u9A8C\\u548C200\\u4E2A\\u91D1\\u5E01��\",\"taskFlag\":1,\"taskId\":4}}";
    }
    if ($mc_taskid == 4) {
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set mc_exp=mc_exp+100,money=money+250,mc_taskid=5 where uid=" . $_SGLOBAL['supe_uid']);
        echo "{\"addExp\":100,\"item\":[{\"num\":100,\"type\":7},{\"num\":250,\"type\":6}],\"money\":250,\"task\":{\"taskDesc\":\"\\u606D\\u559C\\u60A8\\u5B8C\\u6210\\u4EFB\\u52A1\\uFF0C\\u83B7\\u5F97100\\u4E2A\\u7ECF\\u9A8C\\u548C250\\u4E2A\\u91D1\\u5E01��\",\"taskFlag\":1,\"taskId\":5}}";
    }
    if ($mc_taskid == 5) {
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set mc_exp=mc_exp+100,money=money+300,mc_taskid=6 where uid=" . $_SGLOBAL['supe_uid']);
        echo "{\"addExp\":100,\"item\":[{\"num\":100,\"type\":7},{\"num\":300,\"type\":6}],\"money\":300,\"task\":{\"taskDesc\":\"\\u606D\\u559C\\u60A8\\u5B8C\\u6210\\u4EFB\\u52A1\\uFF0C\\u83B7\\u5F97100\\u4E2A\\u7ECF\\u9A8C\\u548C300\\u4E2A\\u91D1\\u5E01��\",\"taskFlag\":1,\"taskId\":6}}";
    }
    if ($mc_taskid == 6) {
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set mc_exp=mc_exp+100,money=money+350,mc_taskid=7 where uid=" . $_SGLOBAL['supe_uid']);
        echo "{\"addExp\":100,\"item\":[{\"num\":100,\"type\":7},{\"num\":350,\"type\":6}],\"money\":350,\"task\":{\"taskDesc\":\"\\u606D\\u559C\\u60A8\\u5B8C\\u6210\\u4EFB\\u52A1\\uFF0C\\u83B7\\u5F97100\\u4E2A\\u7ECF\\u9A8C\\u548C350\\u4E2A\\u91D1\\u5E01��\",\"taskFlag\":1,\"taskId\":7}}";
    }
    if ($mc_taskid == 7) {
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set mc_exp=mc_exp+100,money=money+400,mc_taskid=8 where uid=" . $_SGLOBAL['supe_uid']);
        echo "{\"addExp\":100,\"item\":[{\"num\":100,\"type\":7},{\"num\":400,\"type\":6}],\"money\":400,\"task\":{\"taskDesc\":\"\\u606D\\u559C\\u60A8\\u5B8C\\u6210\\u4EFB\\u52A1\\uFF0C\\u83B7\\u5F97100\\u4E2A\\u7ECF\\u9A8C\\u548C400\\u4E2A\\u91D1\\u5E01��\",\"taskFlag\":1,\"taskId\":8}}";
    }
    if ($mc_taskid == 8) {
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set mc_exp=mc_exp+100,money=money+450,mc_taskid=9 where uid=" . $_SGLOBAL['supe_uid']);
        echo "{\"addExp\":100,\"item\":[{\"num\":100,\"type\":7},{\"num\":450,\"type\":6}],\"money\":450,\"task\":{\"taskDesc\":\"\\u606D\\u559C\\u60A8\\u5B8C\\u6210\\u4EFB\\u52A1\\uFF0C\\u83B7\\u5F97100\\u4E2A\\u7ECF\\u9A8C\\u548C450\\u4E2A\\u91D1\\u5E01��\",\"taskFlag\":1,\"taskId\":9}}";
    }
    if ($mc_taskid == 9) {
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set mc_exp=mc_exp+100,money=money+500,mc_taskid=10 where uid=" . $_SGLOBAL['supe_uid']);
        echo "{\"addExp\":100,\"item\":[{\"num\":100,\"type\":7},{\"num\":500,\"type\":6}],\"money\":500,\"task\":{\"taskDesc\":\"\\u606D\\u559C\\u60A8\\u5B8C\\u6210\\u4EFB\\u52A1\\uFF0C\\u83B7\\u5F97100\\u4E2A\\u7ECF\\u9A8C\\u548C500\\u4E2A\\u91D1\\u5E01��\",\"taskFlag\":1,\"taskId\":10}}";
    }
}
if ($_REQUEST['mmod'] == "chat" && $_REQUEST['mod'] == "common" && $_REQUEST['act'] ==
    "getChat") {
    $tempecho = "";
    $chat = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT mc_chat FROM " .
        tname("plug_newfarm") . " where uid=" . intval($_REQUEST['uId'])), 0);
    $chat = json_decode($chat);
    $tempChat = $chat->c;
    foreach ($tempChat as $val) {
        $tempecho = json_encode($val) . "," . $tempecho;
    }
    $tempecho = substr($tempecho, 0, -1);
    echo "{\"chat\":[" . $tempecho . "]}";
}
if ($_REQUEST['mmod'] == "chat" && $_REQUEST['mod'] == "common" && $_REQUEST['act'] ==
    "sendChat") {
    $username = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT username FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
    $query = $_SGLOBAL['db']->query("SELECT mc_chat,username FROM " . tname("plug_newfarm") .
        " where uid=" . intval($_REQUEST['toId']), 0);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $chatarr = json_decode($list[0][mc_chat]);
    $REQUEST_msg = strreplace($_REQUEST['msg']);
    if ($_REQUEST['toId'] == $_REQUEST['uIdx'] && $_REQUEST['isReply'] == 0) {
        $chatarr->c[] = "{\"color\":\"#000000\",\"domain\":0,\"fromId\":" . $_REQUEST['uIdx'] .
            ",\"fromName\":\"\\u4E3B\\u4EBA\",\"isReply\":false,\"msg\":\"" . $REQUEST_msg .
            "\",\"time\":" . $_SGLOBAL['timestamp'] . ",\"toId\":" . $_REQUEST['toId'] . ",\"toName\":\"" .
            $_REQUEST['tName'] . "\"}";
    } elseif ($_REQUEST['toId'] != $_REQUEST['uIdx'] && $_REQUEST['isReply'] == 0) {
        $chatarr->c[] = "{\"color\":\"\",\"domain\":0,\"fromId\":" . $_SGLOBAL['supe_uid'] .
            ",\"fromName\":\"" . unicode_encode($username) . "\",\"isReply\":false,\"msg\":\"" .
            $REQUEST_msg . "\",\"time\":" . $_SGLOBAL['timestamp'] . ",\"toId\":" . $_REQUEST['toId'] .
            ",\"toName\":\"" . unicode_encode($list[0][username]) . "\"}";
    } else {
        $chatarr->c[] = "{\"color\":\"\",\"domain\":0,\"fromId\":" . $_SGLOBAL['supe_uid'] .
            ",\"fromName\":\"" . unicode_encode($username) . "\",\"isReply\":true,\"msg\":\"" .
            $REQUEST_msg . "\",\"time\":" . $_SGLOBAL['timestamp'] . ",\"toId\":" . $_REQUEST['toId'] .
            ",\"toName\":\"" . unicode_encode($list[0][username]) . "\"}";
    }
    $chatarr = json_encode($chatarr);
    $chatarr = str_replace("\"{", "{", $chatarr);
    $chatarr = str_replace("}\"", "}", $chatarr);
    $chatarr = str_replace("\\u", "\\\\u", $chatarr);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set mc_chat='" . $chatarr .
        "' where uid=" . intval($_REQUEST['toId']));
    $tempecho = "";
    $chat = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT mc_chat FROM " .
        tname("plug_newfarm") . " where uid=" . intval($_REQUEST['toId'])), 0);
    $chat = json_decode($chat);
    $tempChat = $chat->c;
    foreach ($tempChat as $val) {
        $tempecho = json_encode($val) . "," . $tempecho;
    }
    $tempecho = substr($tempecho, 0, -1);
    echo "{\"code\":1,\"chat\":[" . $tempecho . "]}";
    exit();
}
if ($_REQUEST['mmod'] == "chat" && $_REQUEST['mod'] == "common" && $_REQUEST['act'] ==
    "clearChat") {
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
        " set mc_chat='' where uid=" . $_SGLOBAL['supe_uid']);
    echo "{\"code\":1}";
    exit();
}
if ($_REQUEST['mod'] == "cgi_demolish_pasture") {
    //������Ҫ��д������ݲ��������
    $query = $_SGLOBAL['db']->query("SELECT money,mc_exp,bad FROM " . tname("plug_newfarm") .
        " where uid=" . $_SGLOBAL['supe_uid']);
    while ($value_me = $_SGLOBAL['db']->fetch_array($query)) {
        $list_me[] = $value_me;
    }
    if ($list_me[0][bad] > 24) {
        echo "{\"errorContent\":\"\\u6BCF\\u5929\\u6700\\u591A\\u4F7F\\u574F25\\u6B21\",\"errorType\":\"-2005\"}";
        //�˴����ʹ������������ʾ
        exit;
    }
    $query = $_SGLOBAL['db']->query("SELECT money,mc_exp,wenzi FROM " . tname("plug_newfarm") .
        " where uid=" . intval($_REQUEST['uId']));
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $wenzi_num = 0;
    $wenzi_mynum = 0;
    $num = 0;
    $wenzi_all = $list[0][wenzi];
    if ($wenzi_all != "") {
        $wenzi = explode(",", $list[0][wenzi]);
        $wenzi_num = count($wenzi);
    }
    if ((intval($_REQUEST['num']) + $wenzi_num) < 9) {
        $num = intval($_REQUEST['num']);
    } else {
        $num = 8 - $wenzi_num;
    }
    for ($i = 0; $i < $num; $i++) {
        if ($wenzi_all == "") {
            $wenzi_all = $_SGLOBAL['supe_uid'];
        } else {
            $wenzi_all = $wenzi_all . "," . $_SGLOBAL['supe_uid'];
        }
    }
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set wenzi='" . $wenzi_all .
        "',badtime = " . $_SGLOBAL['timestamp'] . "  where uid=" . intval($_REQUEST['uId']));
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set bad=bad+'" . $num .
        "'   where uid=" . $_SGLOBAL['supe_uid']);
    //��������־
    $sql = "SELECT * FROM " . tname("plug_newfarm_mclogs") . " WHERE uid = " .
        intval($_REQUEST['uId']) . " AND type = 6 AND time > " . ($_SGLOBAL['timestamp'] -
        3600) . " AND fromid =" . $_SGLOBAL['supe_uid'];
    $query = $_SGLOBAL['db']->query($sql);
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        if (($value[type] == 6) && ($value[fromid] == $_SGLOBAL['supe_uid']) && ($num >
            0)) {
            $scount = $value[count];
            $stime = $value[time];
            $scount = $scount + $num;
            $sql1 = "UPDATE " . tname("plug_newfarm_mclogs") . " set count ='" . $scount .
                "', time = " . $_SGLOBAL['timestamp'] . ", isread = 0 where uid = " . intval($_REQUEST['uId']) .
                " AND type = 6 AND time > " . ($_SGLOBAL['timestamp'] - 3600) . " AND fromid =" .
                $_SGLOBAL['supe_uid'];
        }
    }
    if ((!$sql1) && ($num > 0)) {
        $sql1 = "INSERT INTO " . tname("plug_newfarm_mclogs") .
            " (`uid`, `type`, `count`, `fromid`, `time`, `iid`, `isread`, `money` ) VALUES (" .
            $_REQUEST['uId'] . ", 6," . $num . ", " . $_SGLOBAL['supe_uid'] . ", " . $_SGLOBAL['timestamp'] .
            ", 0, 0, 0);";
    }
    $query = $_SGLOBAL['db']->query($sql1);
    echo "{\"cId\":1,\"leftnum\":11,\"num\":" . $num . ",\"total\":" . ($wenzi_num +
        $num) . "}";
}
//������
if ($_REQUEST['mod'] == "cgi_help_pasture") {
    if ($_REQUEST['type'] == 1) {
        $query = $_SGLOBAL['db']->query("SELECT money,mc_exp,wenzi FROM " . tname("plug_newfarm") .
            " where uid=" . intval($_REQUEST['uId']));
        while ($value = $_SGLOBAL['db']->fetch_array($query)) {
            $list[] = $value;
        }
        //wenzi
        $wenzi_num = 0;
        $wenzi_mynum = 0;
		$list[0][wenzi] == '' && exit("{\"errorContent\":\"\\u6CA1\\u6709\\u868A\\u5B50\\uFF0C\\u4F60\\u662F\\u4E0D\\u662F\\u641E\\u9519\\u4E86\\uFF1F\",\"errorType\":\"1011\"}");//��ֹ�ര��
		strpos(','.$list[0][wenzi].',',','.$_SGLOBAL['supe_uid'].',') !== false  && exit("{\"errorContent\":\"\\u8BC1\\u636E\\u662F\\u4E0D\\u80FD\\u6BC1\\u706D\\u7684\",\"errorType\":\"1011\"}");
        if ($list[0][wenzi] != "") {
            //����з������Լ��ɴ��BUG
            $list[0][wenzi] == '' && exit("{\"errorContent\":\"\\u6CA1\\u6709\\u6587\\u5B57\\uFF0C\\u4F60\\u662F\\u4E0D\\u662F\\u641E\\u9519\\u4E86\\uFF1F\",\"errorType\":\"1011\"}");
            strpos(',' . $list[0][wenzi] . ',', ',' . $_SGLOBAL['supe_uid'] . ',') !== false &&
                exit("{\"errorContent\":\"\\u8BC1\\u636E\\u662F\\u4E0D\\u80FD\\u6BC1\\u706D\\u7684\",\"errorType\":\"1011\"}");
            $wenzi = explode(",", $list[0][wenzi], 2);
            $wenzi_all = $wenzi[1];
        }
        //ʱ�俪ʼ
        $int = strlen($wenzi_all);
        if ($int == 0) {
            $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
                " set badtime=0 where uid=" . intval($_REQUEST['uId']));
        }
        //ʱ�����
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set wenzi='" . $wenzi_all .
            "'  where uid=" . intval($_REQUEST['uId']));
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") .
            " set mc_exp=mc_exp+4   where uid=" . $_SGLOBAL['supe_uid']);
        //��������־
        if ($_SGLOBAL['supe_uid'] != $_REQUEST['uId']) {
            $sql = "SELECT * FROM " . tname("plug_newfarm_mclogs") . " WHERE uid = " .
                intval($_REQUEST['uId']) . " AND type = 7 AND time > " . ($_SGLOBAL['timestamp'] -
                3600) . " AND fromid =" . $_SGLOBAL['supe_uid'];
            $query = $_SGLOBAL['db']->query($sql);
            while ($value = $_SGLOBAL['db']->fetch_array($query)) {
                if (($value[type] == 7) && ($value[fromid] == $_SGLOBAL['supe_uid'])) {
                    $scount = $value[count];
                    $stime = $value[time];
                    $scount = $scount + 1;
                    $sql1 = "UPDATE " . tname("plug_newfarm_mclogs") . " set count ='" . $scount .
                        "', time = " . $_SGLOBAL['timestamp'] . ", isread = 0 where uid = " . intval($_REQUEST['uId']) .
                        " AND type = 7 AND time > " . ($_SGLOBAL['timestamp'] - 3600) . " AND fromid =" .
                        $_SGLOBAL['supe_uid'];
                }
            }
            if ((!$sql1)) {
                $sql1 = "INSERT INTO " . tname("plug_newfarm_mclogs") .
                    " (`uid`, `type`, `count`, `fromid`, `time`, `iid`, `isread`, `money` ) VALUES (" .
                    $_REQUEST['uId'] . ", 7,1, " . $_SGLOBAL['supe_uid'] . ", " . $_SGLOBAL['timestamp'] .
                    ", 0, 0, 0);";
            }
            $query = $_SGLOBAL['db']->query($sql1);
        } //��������־
        echo "{\"addExp\":4,\"cId\":1,\"num\":1,\"pos\":" . $_REQUEST['pos'] . "}";
    }
    if ($_REQUEST['type'] == 2) {
        $cId = "1506";
        $bb = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT dabian FROM " .
            tname("plug_newfarm") . " where uid=" . intval($_REQUEST['uId'])), 0);
        $mc_package = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT mc_package FROM " .
            tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
        $mc_package = json_decode($mc_package);
        if ($bb <= 0) {
            echo "{\"errorContent\":\"\\u60A8\\u4E0B\\u624B\\u592A\\u6162\\uFF0C\\u4FBF\\u4FBF\\u5DF2\\u7ECF\\u88AB\\u6E05\\u7406\\u4E86\",\"errorType\":\"1004\"}";
            exit();
        }
        //���ɹ�
        $mc_repertory = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT repertory FROM " .
            tname("plug_newfarm") . " where uid=" . intval($_SGLOBAL['supe_uid'])), 0);
        $mc_repertory = json_decode($mc_repertory);
        $flag = false;
        foreach ($mc_repertory->r as $key => $val) {
            if (1506 == $val->cId) {
                $flag = true;
                $mc_repertory->r[$key]->harvest = $mc_repertory->r[$key]->harvest + 1;
            }
        }
        if (!$flag) {
            $mc_repertory->r[] = "{\"cId\":1506,\"cName\":\"\\u4FBF\\u4FBF\",\"harvest\":1,\"scrounge\":0}";
        }
        $mc_repertory = json_encode($mc_repertory);
        $mc_repertory = str_replace("\"{", "{", $mc_repertory);
        $mc_repertory = str_replace("}\"", "}", $mc_repertory);
        $mc_repertory = str_replace("\\u", "\\\\u", $mc_repertory);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set repertory='" .
            $mc_repertory . "' where uid=" . $_SGLOBAL['supe_uid']);
        //���ɹ�
        $bb = $bb - 1;
        $mc_package->$cId = $mc_package->$cId + 1;
        $mc_package = json_encode($mc_package);
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set dabian=" . $bb .
            "  where uid=" . intval($_REQUEST['uId']));
        $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set mc_package='" .
            $mc_package . "' where uid=" . $_SGLOBAL['supe_uid']);
        //��æɨ����־
        if ($_SGLOBAL['supe_uid'] != $_REQUEST['uId']) {
            $sql = "SELECT * FROM " . tname("plug_newfarm_mclogs") . " WHERE uid = " .
                intval($_REQUEST['uId']) . " AND type = 8 AND time > " . ($_SGLOBAL['timestamp'] -
                3600) . " AND fromid =" . $_SGLOBAL['supe_uid'];
            $query = $_SGLOBAL['db']->query($sql);
            while ($value = $_SGLOBAL['db']->fetch_array($query)) {
                if (($value[type] == 8) && ($value[fromid] == $_SGLOBAL['supe_uid'])) {
                    $scount = $value[count];
                    $stime = $value[time];
                    $scount = $scount + 1;
                    $sql1 = "UPDATE " . tname("plug_newfarm_mclogs") . " set count ='" . $scount .
                        "', time = " . $_SGLOBAL['timestamp'] . ", isread = 0 where uid = " . intval($_REQUEST['uId']) .
                        " AND type = 8 AND time > " . ($_SGLOBAL['timestamp'] - 3600) . " AND fromid =" .
                        $_SGLOBAL['supe_uid'];
                }
            }
            if ((!$sql1)) {
                $sql1 = "INSERT INTO " . tname("plug_newfarm_mclogs") .
                    " (`uid`, `type`, `count`, `fromid`, `time`, `iid`, `isread`, `money` ) VALUES (" .
                    $_REQUEST['uId'] . ", 8,1, " . $_SGLOBAL['supe_uid'] . ", " . $_SGLOBAL['timestamp'] .
                    ", 0, 0, 0);";
            }
            $query = $_SGLOBAL['db']->query($sql1);
        } //��æɨ����־
        echo "{\"num\":1,\"pos\":" . $_REQUEST['pos'] . ",\"repNum\":1,\"type\":2}";
    }
}
//�����ж�
if ($_REQUEST['mod'] == "cgi_set_parade") {
    $parade['pinfo'] = strreplace($_REQUEST['pinfo']);
    $parade['pid'] = $_REQUEST['pid'];
    $parade = json_encode($parade);
    $parade = str_replace("\"{", "{", $parade);
    $parade = str_replace("}\"", "}", $parade);
    $parade = str_replace("\\u", "\\\\u", $parade);

    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set parade='" . $parade .
        "' where uid=" . intval($_REQUEST['uIdx']));
    echo "{\"code\":1}";
}

if ($_REQUEST['mod'] == "cgi_get_parade") {
    $parade = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("select parade from  " .
        tname("plug_newfarm") . " where uid=" . intval($_SGLOBAL['supe_uid'])), 0);
    $parade = (array )json_decode($parade);
    if (empty($parade[pid]))
        $parade[pid] = 0;
    echo "{\"i\":\"" . $parade[pinfo] . "\",\"p\":" . $parade[pid] . ",\"v\":1}";
}
//�����ж�

//�ܲ�����ʼ
if ($_REQUEST['mod'] == "cgi_feed_special") {
    if ($_REQUEST['uId'] == null) {
        $GLOBALS['_REQUEST']['uId'] = $_SGLOBAL['supe_uid'];
    }
    $fruit = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT fruit FROM " .
        tname("plug_newfarm") . " where uid=" . $_SGLOBAL['supe_uid']), 0);
    $fruit = json_decode($fruit);
    $luoboid = 3;
    $query = $_SGLOBAL['db']->query("SELECT animal,sfeedleft FROM " . tname("plug_newfarm") .
        " where uid=" . intval($_REQUEST['uId']));
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        $list[] = $value;
    }
    $animal = (array )json_decode($list[0][animal]);
    $sfeedleft = json_decode($list[0][sfeedleft]);
    if ($animal[animal][$_REQUEST['serial']]->postTime == 0) {
        $animal[animal][$_REQUEST['serial']]->buyTime = $animal[animal][$_REQUEST['serial']]->
            buyTime - 300;
    } else {
        $animal[animal][$_REQUEST['serial']]->postTime = $animal[animal][$_REQUEST['serial']]->
            postTime - 300;
    }
    $fruit->$luoboid = $fruit->$luoboid - 1;
    $sfeedleft = $sfeedleft - 1;
    if ($list[0][sfeedleft] == 0) {
        echo "{\"errorContent\":\"\\u5F53\\u524D\\u7267\\u573A\\u4ECA\\u5929\\u5DF2\\u88AB\\u558210\\u4E2A\\u7279\\u6B8A\\u4F5C\\u7269\\uFF0C\\u660E\\u5929\\u518D\\u6765\",\"errorType\":\"1001\",\"serial\":" .
            $GLOBALS['_REQUEST']['serial'] . ",\"sfeedleft\":" . $list[0][sfeedleft] . "}";
        exit();
    }
    foreach ($animal[animal] as $key => $value) {
        if ($key == $_REQUEST['serial']) {
            if ($value->postTime == 0) {
                $time = $_SGLOBAL['timestamp'] - $value->buyTime;
                if ($animaltime[$value->cId][0] + $animaltime[$value->cId][1] <= $time) {
                    $status = 3;
                    $growTimeNext = 12993;
                    $statusNext = 6;
                }
                if ($animaltime[$value->cId][0] <= $time && $time < $animaltime[$value->cId][0] +
                    $animaltime[$value->cId][1]) {
                    $status = 2;
                    $growTimeNext = $animaltime[$value->cId][0] + $animaltime[$value->cId][1] - $time;
                    $statusNext = 3;
                }
                if ($time < $animaltime[$value->cId][0]) {
                    $status = 1;
                    $growTimeNext = $animaltime[$value->cId][0] - $time;
                    $statusNext = 2;
                }
                if ($animaltime[$value->cId][5] < $time) {
                    $status = 6;
                    $growTimeNext = 0;
                    $statusNext = 6;
                }
                $newanimal = "{\"animal\":{\"buyTime\":" . $value->buyTime . ",\"cId\":" . $value->
                    cId . ",\"growTime\":" . $time . ",\"growTimeNext\":" . $growTimeNext . ",\"hungry\":0,\"serial\":" .
                    $GLOBALS['_REQUEST']['serial'] . ",\"status\":" . $status . ",\"statusNext\":" .
                    $statusNext . ",\"totalCome\":" . $value->totalCome . "},\"serial\":" . $GLOBALS['_REQUEST']['serial'] .
                    ",\"sfeedleft\":" . $list[0][sfeedleft] . "}";
            } else {
                $totalCome = $value->totalCome;
                $time = $_SGLOBAL['timestamp'] - $value->buyTime;
                if ($animaltime[$value->cId][5] < $time) {
                    $status = 6;
                    $statusNext = 6;
                    $growTimeNext = 0;
                }
                if ($animaltime[$value->cId][4] < $_SGLOBAL['timestamp'] - $value->postTime) {
                    $status = 3;
                    $statusNext = 6;
                    $growTimeNext = 12993;
                }
                if ($_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][4]) {
                    $status = 5;
                    $statusNext = 3;
                    $growTimeNext = $animaltime[$value->cId][4] - ($_SGLOBAL['timestamp'] - $value->
                        postTime);
                }
                if ($_SGLOBAL['timestamp'] - $value->postTime <= $animaltime[$value->cId][3]) {
                    $status = 4;
                    $statusNext = 5;
                    $growTimeNext = $animaltime[$value->cId][3] - ($_SGLOBAL['timestamp'] - $value->
                        postTime);
                    $totalCome -= $shop[$value->cId][output];
                }
                if ($value->buyTime + $animaltime[$value->cId][5] - $animaltime[$value->cId][3] -
                    $animaltime[$value->cId][4] < $_SGLOBAL['timestamp']) {
                    $status = 5;
                    $statusNext = 6;
                    $growTimeNext = $animaltime[$value->cId][5] - $time;
                }
                $newanimal = "{\"animal\":{\"buyTime\":" . $value->buyTime . ",\"cId\":" . $value->
                    cId . ",\"growTime\":" . $time . ",\"growTimeNext\":" . $growTimeNext . ",\"hungry\":0,\"serial\":" .
                    $GLOBALS['_REQUEST']['serial'] . ",\"status\":" . $status . ",\"statusNext\":" .
                    $statusNext . ",\"totalCome\":" . $totalCome . "},\"serial\":" . $GLOBALS['_REQUEST']['serial'] .
                    ",\"sfeedleft\":" . $list[0][sfeedleft] . "}";
            }
        }
    }
    $newanimal = json_encode($newanimal);
    $newanimal = str_replace("\"{", "{", $newanimal);
    $newanimal = str_replace("}\"", "}", $newanimal);
    $newanimal = str_replace("null", "[]", $newanimal);
    $stranimal = json_encode($animal);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set animal='" . $stranimal .
        "',sfeedleft='" . $sfeedleft . "' where uid=" . intval($_REQUEST['uId']));
    $fruit = json_encode($fruit);
    $_SGLOBAL['db']->query("UPDATE " . tname("plug_newfarm") . " set fruit='" . $fruit .
        "' where uid=" . $_SGLOBAL['supe_uid']);
    echo stripslashes("" . $newanimal . "");
    exit();
}
//�ܲ��������

//��ѿ�ʼ,���������־�ķ�ʽ��ʾ���ɣ�û��Ҫ������ֶ��ظ���д��
if ($_REQUEST['mod'] == "user" && $_REQUEST['act'] == "exchange") {
    $count1 = $count = $_SGLOBAL['db']->result($_SGLOBAL['db']->query("SELECT COUNT(*) FROM " .
        tname("plug_newfarm_mclogs") . " WHERE uid = " . intval($_REQUEST['uIdx'])), 0);
    $sql = "SELECT * FROM " . tname("plug_newfarm_mclogs") . " WHERE uid = " .
        intval($_REQUEST['uIdx']) . " ORDER BY time DESC limit 0,20";
    $query = $_SGLOBAL['db']->query($sql);
    $str = "[";
    if ($count > 20) {
        $count = 20;
    }
    while ($value = $_SGLOBAL['db']->fetch_array($query)) {
        if ($value[type] == 10) {
            $scrids = array();
            $scrids = explode(",", $value[iid]);
            $scrcots = array();
            $scrcots = explode(",", $value[count]);
            $scrougestr = "";
            for ($i = 0; $i < count($scrids); $i++) {
                $scrougestr = $scrougestr . $scrcots[$i] . $animalname[$scrids[$i]][liangci] . $animalname[$scrids[$i]][name];
                if ($i + 1 < count($scrids)) {
                    $scrougestr = $scrougestr . "\\uff0c";
                } else {
                    $scrougestr = $scrougestr . "\\uff0c";
                }
            }
            $msg = "\"\\u4ECE\\u5546\\u5E97\\u8D2D\\u4E70\\u4E86" . $scrougestr . "\\u5171\\u4ED8\\u51FA" .
                $value[money] . "\\u91D1\\u5E01\\u3002\"";
            $str = $str . "{\"msg\":" . $msg . ",\"time\":" . $value['time'] . "}";
            $count--;
        }
        $str = str_replace("}{", "},{", $str);
    } //��־����
    echo "{\"code\":1,\"cost\":" . $str . "]}";
}
//��ѽ���

?>