<?php
//Ucenter Home GoHooH Full (full mod, full game, full skin) hack by GoHooH.CoM
//More mod, skin, game, plugins for Discuz!, Ucenter Home at http://www.gohooh.com/forum/
/*********************/
/*                   */
/*  Version : 3.0.0  */
/*  Author  : SAMɽķ*/
/*  Comment : 091223 */
/*                   */
/*********************/

include_once( "../common.php" );
//include_once( "../json.php" );//�Ե�PHP���
header("Cache-Control: no-cache, must-revalidate"); 

//ת��-UTF-8
function unicode_encode($str)
{
    $str =iconv('UTF-8', 'UCS-2BE', $str);
    $len = strlen($str);
    $newstr = '';
    for($i = 0; $i < $len - 1; $i = $i + 2)
    {
        $c = $str[$i];
        $c2 = $str[$i+1];
        if (ord($c) > 0)
        {
            //tow byte
            $s = base_convert(ord($c), 10, 16);
            if(hexdec($s) > 0xF)
                $newstr .='\\u'.$s;
            else
                $newstr .='\\u'.'0'.$s;
            $s = base_convert(ord($c2), 10, 16);
            if(hexdec($s) > 0xF)
                $newstr .=$s;
            else
                $newstr .='0'.$s;
        }
		 elseif(ord($c2)<127) 

        {
            $newstr .= $c2;
        }
    }
    return $newstr;
}

function unicode_encodegb($str)
{
    $str =iconv('GBK', 'UCS-2BE', $str);
    $len = strlen($str);
    $newstr = '';
    for($i = 0; $i < $len - 1; $i = $i + 2)
    {
        $c = $str[$i];
        $c2 = $str[$i+1];
        if (ord($c) > 0)
        {
            //tow byte
            $s = base_convert(ord($c), 10, 16);
            if(hexdec($s) > 0xF)
                $newstr .='\\u'.$s;
            else
                $newstr .='\\u'.'0'.$s;
            $s = base_convert(ord($c2), 10, 16);
            if(hexdec($s) > 0xF)
                $newstr .=$s;
            else
                $newstr .='0'.$s;
        }
		 elseif(ord($c2)<127) 

        {
            $newstr .= $c2;
        }
    }
    return $newstr;
}

function unicode_encodebig5($str)
{
    $str =iconv('big5', 'UCS-2BE', $str);
    $len = strlen($str);
    $newstr = '';
    for($i = 0; $i < $len - 1; $i = $i + 2)
    {
        $c = $str[$i];
        $c2 = $str[$i+1];
        if (ord($c) > 0)
        {
            //tow byte
            $s = base_convert(ord($c), 10, 16);
            if(hexdec($s) > 0xF)
                $newstr .='\\u'.$s;
            else
                $newstr .='\\u'.'0'.$s;
            $s = base_convert(ord($c2), 10, 16);
            if(hexdec($s) > 0xF)
                $newstr .=$s;
            else
                $newstr .='0'.$s;
        }
		 elseif(ord($c2)<127) 

        {
            $newstr .= $c2;
        }
    }
    return $newstr;
}



?>
