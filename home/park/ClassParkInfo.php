<?php
include_once('../common.php');
date_default_timezone_set('Etc/GMT-8');

#---------------------------------------------------------------ÉèÖÃÀà----------------------------------------------------------------
class CParkCfg{
	public $cfgColor = array();//³µÑÕÉ«
	public $cfgCarType = array();//³µÀàÐÍ
	public $cfgCarLevel = array();//³µµÈ¼¶
	public $cfgStopLimit=array();//ÏµÍ³²ÎÊý¿ª¹Ø
	public $cfgBgfree=array();//Ãâ·Ñ±³¾°
	public $cfgBg=array();//µÀ¾ß±³¾°
	public $cfgXj=array();//Ñ²¾¯
	public $cfgEvent=array();//ÊÂ¼þ
	//¹¹Ôìº¯Êý
	public function CParkCfg(){
		$this->cfgColor = array(
		  1 => 'red', 2 => 'white', 3 => 'silver', 4 => 'black', 5 => 'blue',
		  6 => 'yellow', 7 => 'green', 8 => 'brown', 9 => 'ashen', 10 => 'other'
		);
		$this->cfgCarType = array(
		  1 => 'normal', 2 => 'jeep', 3 => 'SUV', 4 => 'GL', 5 => 'limo',
		  6 => 'large', 7 => 'tractor', 8 => 'motorbike', 9 => 'bike', 10 => 'other'
		);
		
		$this->cfgCarLevel = array(
		  1 => '100k', 2 => '100-200k', 3 => '200-300k', 4 => '300-400k', 5 => '400-500k',
		  6 => '500-600k', 7 => '600-700k', 8 => '700-800k', 9 => '900-1000k', 10 => '1m'
		);
		//ÏµÍ³²ÎÊý¿ª¹Ø
		$this->cfgStopLimit=array(
		  'stop'=>15,//¸ÕÍ£³µºó¶à¾Ã¿ÉÒÔÅ²³µ
		  'maxStopTime'=>720,//Í£³µÓÐÐ§×î³¤Ê±¼ä
		  'maxDriveTime'=>3600,//¿ÕÊ»ÊÕ·Ñ×î³¤Ê±¼ä
		  'DriveCredit'=>2,//¿ÕÊ»Ã¿·ÖÖÓ¿Û³ý»ý·Ö
		  'CarLimit'=>30,//¸öÈËÓµÓÐ³µÊýÉÏÏÞ
		  'LoginCredit=>500',//µÇÂ¼ËùµÃ»ý·Ö
		  'ExchangeOpen'=>0,//ÊÇ·ñ¿ªÆô»ý·Ö¶Ò»»
		  'ExchangePercent'=>1000,//»ý·Ö¶Ò»»±ÈÀý
		  'OpenCredit'=>1000,//¿ªÍ¨½±Àø»ý·Ö
		  'WarnNum'=>3,//¾¯¸æ¶àÉÙ´Îºó½«ÓÐ¿ÉÄÜ±»ÌùÌõ
		  'InviteCredit'=>6000,//ÑûÇëËùµÃ»ý·Ö
		  'DayInviteNum'=>10,//ÈÕÑûÇëÈËÊý
		  'TotalInviteNum'=>30,//×ÜÑûÇëÈËÊý
		  'MessPersent'=>50,//ÌùÌõËùµÃ°Ù·Ö±È
		  'WarnPersent'=>10,//±¨¾¯ËùµÃ°Ù·Ö±È
		  'NeighborNum'=>0//ºÃÓÑÊýÄ¿Ð¡ÓÚ´ËÖµÊ±ÐèÌí¼ÓÁÚ¾Ó,0Îª×Ô¶¯¼ÓÁ½¸ö
		  );	
		$this->cfgBgfree=array(
		   'bb0.jpg'=>'silver', 'bb1.jpg'=>'sunset', 'bb2.jpg'=>'square',  'bb3.jpg'=>'beach',  'bb4.jpg'=>'countryside', 'bb5.jpg'=>'city', 'bb6.jpg'=>'casino', 'bb7.jpg'=>'lake','bb8.jpg'=>'pigeon','bb16.jpg'=>'sea','bb20.jpg'=>'villa','bb21.jpg'=>'bridge','bb22.jpg'=>'sunglow','bb23.jpg'=>'sight');	
		$this->cfgBg=array(
		 '6'=>array('bb10.jpg','9'),//³Ç±¤1
		 '16'=>array('bb11.jpg','10'),//³Ç±¤2
		 '3'=>array('bb12.jpg','5'),//±ðÊû1
		 '4'=>array('bb13.jpg','6'),//±ðÊû2
		 '11'=>array('bb14.jpg','1'),//Ä¾ÎÝ1
		 '12'=>array('bb15.jpg','2'),//Ä¾ÎÝ2
		 '7'=>array('bb16.jpg','4'),//º£±õ
		 '15'=>array('bb17.jpg','8'),//Í¥Ôº2
		 '14'=>array('bb18.jpg','7'),//Í¥Ôº1
		 '9'=>array('bb19.jpg','3'),//¾Æ°É
		 );
		$this->cfgXj=array('1'=>'Optimus','2'=>'Terminator','3'=>'Leonidas','4'=>'Illidan',5=>'TANK');
		$this->cfgEvent=array('1'=>'đỗ xe thất bại, xe đã bị hư hỏng ','2'=>' hãy trả tiền cho việc làm sai trái của bạn ','3'=>' bạn lái xe trong khi say rượu, hãy thanh toán tiền nộp phạt ',
		  '4'=>' hit another car when looking at a chick, paid ','5'=>' xe của bạn bạn bị trầy xước khi đỗ, hãy sửa chữa nó ');
		
	}
}


#--------------------------------------»áÔ±Àà---------------------------- 
class  CParkMember{
    public $uid=0;//»áÔ±ID
	public $P_bg=""; //±³¾°Í¼Æ¬
	public $P_bgdesc="";//±³¾°ÃèÊö
	public $P_credit=0;//»ý·Ö
	public $P_lot_free=0;//Ãâ·Ñ³µÎ»±àºÅ
	public $P_limittype=1;//Í£³µÏÞÖÆ·½Ê½
	public $P_lot_color=0;//Ãâ·ÑÍ£³µÑÕÉ«
	public $P_lot_type=0;//Ãâ·ÑÍ£³µÀàÐÍ
	public $P_lot_level=0;//Ãâ·ÑÍ£³µµÈ¼¶
	public $P_arrMember=array();
	public $P_arrMemberset=array();	
	public $P_lot=array();
	public $P_friendstr="";//ºÃÓÑID´®
	public $P_arrFriend=array();
	public $P_friendCarUrl="";//ºÃÓÑ³µ³¡µØÖ·
	public $P_username="";//Ãû×Ö
	public $P_photo="";//Í·Ïñ
	public $P_loginuid=0;//µÇÂ¼ÓÃ»§ID
	public $P_loginuser="";//µÇÂ¼ÓÃ»§Ãû
	public $P_fidphoto="";//µÇÂ¼Í·Ïñ
	public $P_logintime="";
	public $P_stageID=0;//µÀ¾ß±³¾°ID
	public $P_stageCredit=0;//±³¾°Ôö¼Ó»ý·Ö
	public $P_CreditAdd="";//±³¾°Ôö¼Ó»ý·ÖÃèÊö
	public $P_arrlot=array();
	public $nowtime="";


	 
  	//¹¹Ôìº¯Êý
	public function CParkMember($uid=0){
	   //¸ù¾Ý´«ÈëuidÈ¡park_member±íÊý¾Ý

	    $sql="select * from ".tname('park_member')." where uid='$uid'";	
		$value=getSqlResult($sql);		
		$this->P_arrMember=$value;
		//ÀàÊôÐÔ¸³Öµ
	    $this->uid=$uid;//»áÔ±ID£¬³µ³¡µÄËùÓÐÕß
	    $this->P_bg=$value[P_bg];//±³¾°Í¼Æ¬µØÖ·
		$this->P_bgdesc=$value[P_bgdesc];//±êÌâ
		$this->P_credit=$value[P_credit];//»ý·Ö
		$this->P_lot_free=$value[P_lot_free];//Ãâ·Ñ³µÎ»
		$this->P_limittype=$value[LimitType];//Ãâ·Ñ³µÎ»ÀàÐÍ
		$this->P_lot_type=$value[P_lot_type];//Ãâ·Ñ³µÎ»³µÐÍ
		$this->P_lot_level=$value[P_lot_level];//Ãâ·Ñ³µÎ»µÈ¼¶						
		$this->P_lot_color=$value[P_lot_color];//Ãâ·Ñ³µÎ»ÑÕÉ«
		$this->P_lot[0]=$value[P_lot_1];//1ºÅ³µÎ»
		$this->P_lot[1]=$value[P_lot_2];//2ºÅ³µÎ»
		$this->P_lot[2]=$value[P_lot_3];//3ºÅ³µÎ»
		$this->P_lot[3]=$value[P_lot_4];//4ºÅ³µÎ»
		$this->P_logintime=$value[P_logintime];
		$this->P_stageID=intval($value[P_stageID]);
		$parkCfg=new CParkCfg();
		$cfgBg=$parkCfg->cfgBg;
		$this->P_stageCredit=$cfgBg[$this->P_stageID][1];
		if($this->P_stageCredit==0){
		  $this->P_CreditAdd="Xin chào ! Đậu xe đúng quy định nha !";
		}else{
		  $this->P_CreditAdd=" nhận được ".$this->P_stageCredit." vàng mỗi phút đỗ xe.";
		}
		
		
	
		global $_SGLOBAL; 

		//µ÷ÓÃÀà·½·¨getFriendsÈ¡µÃ¿ªÍ¨³µÎ»ºÃÓÑUIDµÄ×Ö´®
		
		$this->arrFriend=$this->getFriends($_SGLOBAL['supe_uid']);
		foreach($this->arrFriend as $key=>$value){
		  $arrUid[]=$value[uid];
		}
		$friendStr=implode(",",$arrUid);
		$this->P_friendstr=$friendStr;
		$this->P_friendCarUrl="parkApp.php?ac=index&fId=".$uid;
		//ÓÃ»§Ãû
		$this->P_username=$this->getUserName($uid);
		//ÓÃ»§Ð¡Í·Ïñ
		$this->P_photo=$this->getPhoto($_SGLOBAL['supe_uid'],'small');
		$this->P_fidphoto=$this->getPhoto($uid,'small');		
		//µÇÂ¼ÓÃ»§ID
		$this->P_loginuid=$_SGLOBAL['supe_uid'];
		//µÇÂ¼ÓÃ»§Ãû
		$this->P_loginuser=$_SGLOBAL['supe_username'];
		//¸÷³µÎ»ÐÅÏ¢
		for($i=0;$i<4;$i++){
		  $this->P_arrlot[$i]=$this->getLotInfo($i+1,$this->P_lot[$i]);
		}
		//µ±Ç°Ê±¼ä
		$this->nowtime=date("Y-m-d H:i:s");

	
	}

	//·µ»Ø¿ªÍ¨³µÎ»ºÃÓÑ
	public function getMemberset($uid=0){
	  $sql="select * from ".tname('park_memberset')." where uid=".$uid;
	  $value=getSqlResult($sql);
	  $this->P_arrMemberset=$value;//³µÎ»»áÔ±±íÊý×é

	}
	//·µ»Ø¿ªÍ¨³µÎ»µÄºÃÓÑ
	private function getFriends($uid=0){
	    $parkCfg=new CParkCfg();
	    $cfgStopLimit=$parkCfg->cfgStopLimit;
        $sql="select * from ".tname('park_member')." where uid in (select fuid  from ".tname('friend')." where uid='$uid') order by uid";
        global $_SGLOBAL; 
        $query =$_SGLOBAL['db']->query($sql);
		$i=0;
        while ($value =$_SGLOBAL['db']->fetch_array( $query )){
		  $arrUid[]=$value;
		  $arrUid[$i][username]=$this->getUserName($value[uid]);//¼ÓÐÕÃûÔªËØ		  
		  $lot1=($value[P_lot_1]>0)?1:0;
		  $lot2=($value[P_lot_2]>0)?1:0;
		  $lot3=($value[P_lot_3]>0)?1:0;
		  $lot4=($value[P_lot_4]>0)?1:0;		  		  		  
		  $parkNum=$lot1+$lot2+$lot3+$lot4;//±»Õ¼ÓÃ³µÎ»Êý
		  $arrUid[$i][parkNum]=$parkNum;
		  $i++;
		}

		if($cfgStopLimit[NeighborNum]==0){
			$sql="select * from ".tname('park_member')." where (uid not in (select fuid  from ".tname('friend')." where uid='$uid')) and (uid<>'$uid')  order by rand() limit 0,2";
			$query =$_SGLOBAL['db']->query($sql);
			while ($value =$_SGLOBAL['db']->fetch_array( $query )){
			  $arrUid[]=$value;
			  $arrUid[$i][username]=$this->getUserName($value[uid]);//¼ÓÐÕÃûÔªËØ		  
			  $lot1=($value[P_lot_1]>0)?1:0;
			  $lot2=($value[P_lot_2]>0)?1:0;
			  $lot3=($value[P_lot_3]>0)?1:0;
			  $lot4=($value[P_lot_4]>0)?1:0;		  		  		  
			  $parkNum=$lot1+$lot2+$lot3+$lot4;//±»Õ¼ÓÃ³µÎ»Êý
			  $arrUid[$i][parkNum]=$parkNum;
			  $i++;
			}
		}else{
		  if($i<$cfgStopLimit[NeighborNum]){
			$sql="select * from ".tname('park_member')." where (uid not in (select fuid  from ".tname('friend')." where uid='$uid')) and (uid<>'$uid')  order by rand() limit 0,2";
			$query =$_SGLOBAL['db']->query($sql);
			while ($value =$_SGLOBAL['db']->fetch_array( $query )){
			  $arrUid[]=$value;
			  $arrUid[$i][username]=$this->getUserName($value[uid]);//¼ÓÐÕÃûÔªËØ		  
			  $lot1=($value[P_lot_1]>0)?1:0;
			  $lot2=($value[P_lot_2]>0)?1:0;
			  $lot3=($value[P_lot_3]>0)?1:0;
			  $lot4=($value[P_lot_4]>0)?1:0;		  		  		  
			  $parkNum=$lot1+$lot2+$lot3+$lot4;//±»Õ¼ÓÃ³µÎ»Êý
			  $arrUid[$i][parkNum]=$parkNum;
			  $i++;
			}	  
		  }
		
		}
		return 	$arrUid; 
	
	}
	//·µ»ØÍ·Ïñ
	public function getPhoto($uid, $size = 'small'){
	    $space=getspace($uid);
		if(empty($space['avatar'])){
		  return UC_API.'/images/'."noavatar_$size.gif";	
		} else{
			$size = in_array($size, array('big', 'middle', 'small')) ? $size : 'middle';
			$uid = abs(intval($uid));
			$uid = sprintf("%09d", $uid);
			$dir1 = substr($uid, 0, 3);
			$dir2 = substr($uid, 3, 2);
			$dir3 = substr($uid, 5, 2);
			return UC_API.'/data/avatar/'.$dir1.'/'.$dir2.'/'.$dir3.'/'.substr($uid, -2)."_avatar_$size.jpg";	
		}

	 
	}
	//·µ»ØÓÃ»§Ãû
	public function getUserName($uid=0){
	    $space=getspace($uid);
		return $space[username];
	}
 	
	//¸÷³µÎ»Í£³µ¼ÇÂ¼
	public function getLotInfo($lot=0,$RID=0){	     
		$intRID=$RID;//Í£³µ¼ÇÂ¼ºÅ
		
		//·µ»Ø´Ë³µÎ»Í£³µ¼ÇÂ¼
		$sql = "select * from ".tname('park_record')." where RID='$intRID'";
		$value=getSqlResult($sql);
		$intCarID=$value[CarID];//Æû³µ±àºÅ
		$intParkUid=$value[ParkUid];//Í£³µÈËID
		$dateParkStartTime=$value[ParkStartTime];//Í£³µ¿ªÊ¼Ê±¼ä
		$intParkWarned=$value[ParkWarned];//¾¯¸æ×´Ì¬
		$intParkMess=$value[ParkMess];//ÌùÌõ×´Ì¬	
		$sql = "select * from ".tname('park_carinfo')." where CarID='$intCarID'";
		$value=getSqlResult($sql);
		$strCarDesc=$value[CarDesc];//Æû³µÃèÊö
		$strCarImg=$value[CarImg];//Æû³µÍ¼Æ¬µØÖ·
		$strCarSign=$value[CarSign];//Æû³µ±êÖ¾µØÖ·
		$intCarPrice=$value[CarPrice];//Æû³µÔ­Ê¼¼Û¸ñ
		$intCarCredit=$value[CarCredit];//Í£³µÃ¿·ÖÖÓ»ý·Ö
		$intCarCredit=$intCarCredit+$this->P_stageCredit;//Ôö¼Ó±³¾°»ý·Ö
		$strUserName=$this->getUserName($intParkUid);//Í£³µÓÃ»§Ãû
		$strUserPhoto=$this->getPhoto($intParkUid,'small');//Í£³µÕßÍ·ÏñµØÖ·
		$strUserLink="fId=".$intParkUid;//Í£³µÕßÁ´½Ó
		//Ãâ·ÑºÍÏÞÍ£
		$tmpCparkcfg=new CParkCfg();
		$limitColor=$tmpCparkcfg->cfgColor;//ÏÞÉ«
		$limitType=$tmpCparkcfg->cfgCarType;//ÏÞÖÆ³µÐÍ		
		$limitLevel=$tmpCparkcfg->cfgCarLevel;//ÏÞÖÆ³µµÈ¼¶
		
        //³µÎ»ÏÞÖÆµÄÄÚÈÝ
		switch($this->P_limittype){
		   case 1://ÑÕÉ«	   
			if($lot==$this->P_lot_free){
			   $intCarType=0;
			   $strParklimit="".$limitColor[$this->P_lot_color]." ports";
			}else{
			   $intCarType=1;
			   $strParklimit="";
			}
			break;
		   case 2://³µÐÍ   
			if($lot==$this->P_lot_free){
			   $intCarType=0;
			   $strParklimit="".$limitType[$this->P_lot_type];
			}else{
			   $intCarType=1;
			   $strParklimit="";
			}
			break;
		   case 3://³µµÈ¼¶
			if($lot==$this->P_lot_free){
			   $intCarType=0;
			   $strParklimit="".$limitLevel[$this->P_lot_level];
			}else{
			   $intCarType=1;
			   $strParklimit="";
			}
			break;
		   default://È±Ê¡ÎªÑÕÉ«
			if($lot==$this->P_lot_free){
			   $intCarType=0;
			   $strParklimit="".$limitColor[$this->P_lot_color]." cars";
			}else{
			   $intCarType=1;
			   $strParklimit="";
			}
			break;

			
		}
		//ÊÇ·ñÓÐ³µÍ£ÔÚ´Ë³µÎ»
		if($this->P_lot[$lot-1]==0){
		   $strStop='none';
		}else{
		   $strStop='1';
		}
		//±¨¾¯ºÍÌùÌõÏÔÊ¾
		if($this->P_loginuid==$this->uid){
		  if($lot!=$this->P_lot_free)
		    $strCaroperation="mestip";
		}else{
		  $arrFuid=explode(',',$this->P_friendstr);
		  if($this->P_loginuid!=$intParkUid&&in_array($intParkUid,$arrFuid)&&$lot!=$this->P_lot_free)
		    $strCaroperation="waring";
		}
		//Ô¤¼ÆµÃµ½µÄ»ý·Ö
		$intMinute=getTimeDifference($dateParkStartTime);
		$intstopgold=$intCarCredit*$intMinute;


        //·µ»Ø´Ë³µÎ»Í£³µÐÅÏ¢Êý×é
		$arrlot=array(
			 cartype=>$intCarType,//ÊÇ·ñÃâ·Ñ
			 parkcolor=>$strParklimit,//ÏÞÍ£
			 stop=>$strStop,//ÊÇ·ñÒÑ¾­Í£³µ
			 caroperation=>$strCaroperation,//±¨¾¯»òÌùÌõ
			 stopPostionId=>$lot,//Í£³µÎ»ºÅ
			 stopuser=>$strUserName,//Í£³µÕßÓÃ»§Ãû
			 stopuid=>$intParkUid,
			 stopgold=>$intstopgold,//Ô¤¼ÆÊÕÈë
			 stoptimer=>$intMinute,//¿ªÊ¼Í£³µÊ±¼ä
			 caruserphoto=>$strUserPhoto,//Í£³µÕßÍ·Ïñ
			 carimg=>$strCarImg,//Æû³µÍ¼Æ¬µØÖ·
			 carid=>$lot,//³µÎ»ºÅ
			 stopuserLink=>$strUserLink,//Í£³µÕßÁ´½Ó
			 carImgDescript=>$strCarDesc,//Æû³µÃèÊö
			 carPrice=>$intCarPrice,//Ô­Ê¼³µ¼Û
			 carSignalName=>$strCarSign	//Æû³µ±êÖ¾Í¼Æ¬		 				 
			);
		return $arrlot;	

	}	
	
}
#-------------------------------------------------------------------------ÎÒµÄÆû³µÀà-----------------------------------------------------

class CmyCar{
    public $uid=0;//ÓÃ»§ID
	public $arrMyCar=array();//ÎÒµÄÆû³µÊý×é
	public $loginuser="";//µÇÂ¼ÓÃ»§
	public $buyTime;    //×îºó×´Ì¬µÄÊ±¼ä
	public $CarCount=0; //Æû³µÊýÁ¿
	public $isExitCar=0;
	//¹¹Ôìº¯Êý
	public function CmyCar($uid=0){
	  global $_SGLOBAL; 
	  $this->loginuser=$_SGLOBAL['supe_username'];//µÇÂ¼ÓÃ»§Ãû	
	  $sql="select count(*) as intNum from ".tname('park_mycar')." where uid='$uid'";
      $query =$_SGLOBAL['db']->query($sql);	
	  $intNum = $_SGLOBAL['db']->result($query,0);	  
	  $this->CarCount=$intNum;//·µ»Ø³µµÄÊýÁ¿
	  	  
	  //·µ»ØÎÒµÄÆû³µ¼ÇÂ¼
	  
      //ÅÅÐò£º¿ÕÊ»¡¢ÉÏÒ»¸ö×´Ì¬µÄÊ±¼ä
	  $sql="select *,(select count(*) from ".tname('park_record')." where ParkUid='$uid' and CarID=m.CarID and ParkStatus=1) as status from ".tname('park_mycar')." m where uid='$uid' order by status,BuyTime ";
	  
    
	  $value=getTableResult($sql);//ÎÒµÄÆû³µ±íÊý×é
	  //¸øÊý×é¸³Öµ
	  for($i=0;$i<count($value);$i++){
	    $tempCparkcarInfo=new CparkcarInfo($value[$i][CarID]);//µÃµ½Æû³µÐÅÏ¢
		$buyTime=$value[$i][BuyTime];//ÉÏ´Î×´Ì¬Ê±¼ä                     
		$intMinute=$this->getTimeOfmycar($uid,$value[$i][CarID],$buyTime);
		$strMinute=$this->getTimeOfmycarStay($uid,$value[$i][CarID],$buyTime);	
		$intCarCredit=$tempCparkcarInfo->CarCredit;
		$parkMember=new CParkMember($value[$i][ParkWhoUid]);
		$intCarCredit=$intCarCredit+$parkMember->P_stageCredit;//Ôö¼Ó±³¾°»ý·Ö
		$lotInfo=getLotinfo($value[$i][ParkLot],$value[$i][ParkWhoUid]);		
		if($lotInfo=='PayPort'){
		   $intstopgold=$intCarCredit*$intMinute;
		}else{
		   $intstopgold=0;
		}
		$parkCfg=new CparkCfg(); 
		$cfgStopLimit=$parkCfg->cfgStopLimit;
		$DriveCredit=$cfgStopLimit[DriveCredit];//¿ÕÊ»Ã¿·ÖÖÓ¿Û³ý»ý·Ö		
		if($value[$i][ParkLot]==0){
		   $intstopgold=-$intMinute;
		   $roadtoll=$intMinute*intval($DriveCredit);		   
           $parkCredit="Ước tính bạn sẽ nhận được ".$roadtoll." vàng sau khi đậu.";	  		   
		   $parkStatus="Hãy đỗ xe ngay bây giờ";		   
		}else{
		   $parkStatus="Bãi đậu xe tại ". CParkMember::getUserName($value[$i][ParkWhoUid])."'s ".$lotInfo;
		   $parkCredit="Ước tính đến :".$intstopgold." vàng";		  
		}
	    $this->arrMyCar[$i]=array(
		  carimg=>$tempCparkcarInfo->CarImg,//Æû³µÍ¼Æ¬µØÖ·
		  carimgbig=>$tempCparkcarInfo->CarImgBig,//Æû³µÍ¼Æ¬µØÖ·		  
		  carsign=>$tempCparkcarInfo->CarSign,//Æû³µ±êÖ¾
		  cardesc=>$tempCparkcarInfo->CarDesc,//Æû³µÃèÊö
		  parkwholot=>CParkMember::getUserName($value[$i][ParkWhoUid]),//³µ³¡Ö÷ÈË
		  parktime=>$strMinute,//Í£ÁôÊ±¼ä
		  parklotinfo=>$lotInfo,//³µÎ»ÐÅÏ¢
		  parkCredit=>$intstopgold,//Ô¤¼ÆÊÕÈë
		  roadtoll=>$roadtoll,//ÑøÂ··Ñ 
		  carid=>$tempCparkcarInfo->CarID,
		  buyTime=>$buyTime,
		  parkCredit=>$parkCredit,//Í£³µÃ¿·ÖÖÓ»ý·Ö
		  parkStatus=>$parkStatus,
		  parkWhoID=>$value[$i][ParkWhoUid],//Í£³µ³¡Ö÷ÈËuid
		  isSale=>$value[$i][isSale],//ÊÇ·ñ³öÊÛ
		);
	  }   
	}
	//ÅÐ¶ÏÊÇ·ñÒÑ¾­ÓµÓÐÏàÍ¬ÐÍºÅµÄ³µ
    public function isExitOfCar($CarID,$uid){
	  global $_SGLOBAL; 
	  $sql="select count(*)  from ".tname('park_mycar')." where uid='$uid' and CarID='$CarID'";
      $query =$_SGLOBAL['db']->query($sql);	
	  $intNum = $_SGLOBAL['db']->result($query,0);	  
	  $this->isExitCar=$intNum;	  
	}

    //·µ»ØÍ£³µÊ±³¤
	public function getTimeOfmycar($uid=0,$CarID=0,$buyTime){
	   $value=getrecordOfmycar($uid,$CarID);//Í£³µ¼ÇÂ¼Êý×é
	   if(empty($value[ParkUid])){//ÅÐ¶ÏÊÇ·ñÊÇ¿ÕÊ»×´Ì¬
	     $startTime=$buyTime;    //·µ»Ø¿ÕÊ»¿ªÊ¼Ê±¼ä
	   }else{
	     $startTime=$value[ParkStartTime];//Í£³µÊ±¼ä
	   }
	   $totalTime=getTimeDifference($startTime);//Óëµ±Ç°Ê±¼äÏà²î·ÖÖÓÊý£¬×î³¤ÎªcfgÀïÉèÖÃ
	   return $totalTime;	   	  
	  	
	}
	//Í£³µÊ±³¤£¬·µ»ØÖµÎª×Ö´®
	public function getTimeOfmycarStay($uid=0,$CarID=0,$buyTime){
	   $value=getrecordOfmycar($uid,$CarID);
	   if(empty($value[ParkUid])){
	     $startTime=$buyTime;
	   }else{
	     $startTime=$value[ParkStartTime];
	   }
	   
	   $totalTime=getStayTime($startTime);//Óëµ±Ç°Ê±¼äÏà²îµÄ×Ö´®±íÊ¾
	   return $totalTime;	   	  
	  	
	}	
	
}
#-----------------------------------------------------------------------------Í£³µÀà----------------------------------------------------
class CstopCar{
    public $oldRecNo=0;//Ô­¼ÇÂ¼ºÅ
	public $oldUid=0;  //Ô­³µ³¡Ö÷ÈËuid
	public $oldParktime;//Ô­À´Í£³µÊ±¼ä
	public $carmessages="";//Í£³µµ¯³öÐÅÏ¢
	public $carerrorstr="";//Í£³µÊ§°Üµ¯³öÐÅÏ¢
	public $oldLot=0;  //Ô­Í£³µ³µÎ»ºÅ 
	public $carColor=0;//³µÑÕÉ«
	public $carType=0;//³µÐÍ
	public $carLevel=0;//µÈ¼¶
	//¹¹Ôìº¯Êý
	public function CstopCar($uid,$fID,$lot,$carID){

	   $value=getrecordOfmycar($uid,$carID);//Í£³µ¼ÇÂ¼Êý×é
	   $this->oldRecNo=empty($value[RID])?0:$value[RID];//Ô­¼ÇÂ¼ºÅ
	   $this->oldUid=empty($value[ParkWhoUid])?0:$value[ParkWhoUid];//Ô­Í£³µ³¡Ö÷ÈË

	   $arrMyCar=getMyCar($uid,$carID);//·µ»ØÎÒµÄÆû³µÊý×é
	   if(empty($value[RID])){
	      $this->oldParktime=$arrMyCar[BuyTime];//¿ÕÊ»×´Ì¬£¬¼ÇÂ¼×´Ì¬¿ªÊ¼Ê±¼ä
	   }else{

    	   $this->oldParktime=$value[ParkStartTime];//Í£³µ×´Ì¬£¬¼ÇÂ¼×´Ì¬¿ªÊ¼Ê±¼ä
	   }
	   $carInfo=new CparkcarInfo($carID);//Æû³µÀàÊµÀý
	   $this->carColor=$carInfo->CarColor;//³µÑÕÉ«ÊôÐÔ¸³Öµ	   	   
	   $this->carType=$carInfo->CarType;  //³µÐÍÊôÐÔ	   	   
	   $this->carLevel=$carInfo->CarLevel;//³µµÈ¼¶	   	   
	   
	   $this->oldLot=empty($value[Parklot])?0:$value[Parklot];//Ô­Í£³µ³µÎ»ºÅ£¬¿ÕÊ»Îª0
       $message=$this->isPermitStop($fID,$lot); //ÅÐ¶ÏÊÇ·ñÔÊÐíÍ£³µ
	   $this->carmessages=$message; //ÏûÏ¢ÊôÐÔ
	   if($message=='stop'){//stopÎªÔÊÐíÍ£³µ
	      $this->finishStopCar($fID,$lot,$carID); //Ö´ÐÐÍ£³µº¯Êý    
	   }

	}
	//ÅÐ¶ÏÊÇ·ñÔÊÐíÍ£³µ
	public function isPermitStop($fID,$lot){
	   $subTime=getTimeDifference($this->oldParktime);//µ½µ±Ç°µÄ·ÖÖÓÊý	   
	   $retStr="stop"; //·µ»ØÈ±Ê¡Öµ
	   $parkMember=new CParkMember($fID);//»áÔ±ÀàÊµÀý
	   if($lot==$parkMember->P_lot_free){//ÅÐ¶ÏÊÇ·ñÎªÃâ·Ñ³µÎ»
	     switch ($parkMember->P_limittype){
		    case 1://ÑÕÉ«
			  if($this->carColor!=$parkMember->P_lot_color){
				$this->carerrorstr="Màu chiếc xe của bạn không đáp ứng đúng yêu cầu của bãi đỗ.";
				$retStr="forbid";	  
			  }
			  break;
			case 2://³µÐÍ
			  if($this->carType!=$parkMember->P_lot_type){
				$this->carerrorstr="Các loại xe của bạn không đáp ứng đúng yêu cầu của bãi đỗ";
				$retStr="forbid";	  
			  }
			  break;
			case 3://µÈ¼¶  			
			  if($this->carLevel!=$parkMember->P_lot_level){
				$this->carerrorstr="Cấp độ của chiếc xe này không đáp ứng yêu cầu của bãi đỗ";
				$retStr="forbid";	  
			  }
			  break;
		    default://È±Ê¡ÎªÑÕÉ«
			  if($this->carColor!=$parkMember->P_lot_color){
				$this->carerrorstr="Màu chiếc xe của bạn không đáp ứng đúng yêu cầu của bãi đỗ";
				$retStr="forbid";	  
			  }
			  break;			  
			    
		 } 
	   }
	  $parkCfg=new CparkCfg(); //ÉèÖÃÀà
	  $cfgStopLimit=$parkCfg->cfgStopLimit;//ÏµÍ³ÉèÖÃ
	  $limitTime=$cfgStopLimit[stop];	   //Í£³µºó¶à³¤Ê±¼ä²»ÄÜÅ²³µ
	   if($this->oldLot!=0){//Ç°×´Ì¬·Ç¿ÕÊ»
		   if($subTime<intval($limitTime)){
			 $this->carerrorstr="không thể thay đổi ".$limitTime." phút đỗ";
			 $retStr="forbid";//¾Ü¾øÍ£³µ
		   }
	   }
	   if($this->oldUid==$fID){
	     $this->carerrorstr="không thể thay đổi nền của bãi đỗ";
		 $retStr="forbid";
	   }
	   if($retStr!='forbid'){
	   //Ëæ»ú´¥·¢ÊÂ¼þ
		   $parkCfg=new CParkCfg();
		   $cfgEvent=$parkCfg->cfgEvent;//ÊÂ¼þÊý×é
		   $i=rand(1,100);
		   $credit=rand(1000,2000);
		   if(in_array($i,array(1,2,3,4,5))){
			 $this->carerrorstr=$cfgEvent[$i].$credit." vàng";
			 $retStr="forbid";
			 $icon='park';
			 $title="{actor}".$cfgEvent[$i].$credit." vàng";
			 sendMessage($icon,$title,'StopFeed'); 			
			 updateCredit($credit) ;
		   }
	   }

	   return $retStr;
	}
	//Í£³µº¯Êý
	public function finishStopCar($fID,$lot,$carID){

		$parkCfg=new CparkCfg(); //ÉèÖÃÀà
		$cfgStopLimit=$parkCfg->cfgStopLimit;//ÏµÍ³²ÎÊýÉèÖÃ
		$DriveCredit=$cfgStopLimit[DriveCredit];//¿ÕÊ»Ã¿·ÖÖÓ»ý·Ö
        global $_SGLOBAL;  
	    $tempCparkcarInfo=new CparkcarInfo($carID);//µÃµ½Æû³µÐÅÏ¢
		$intMinute=getTimeDifference($this->oldParktime);//·ÖÖÓ±íÊ¾Ê±¼ä²î
		$strMinute=getStayTime($this->oldParktime);	//×Ö´®±íÊ¾Ê±¼ä²î			
		$intCarCredit=$tempCparkcarInfo->CarCredit;//´Ë³µÃ¿·ÖÖÓµÄÊÕÈë
		$parkMember=new CParkMember($this->oldUid);//»áÔ±Àà
		$intCarCredit=$intCarCredit+$parkMember->stageCredit;//Ôö¼Ó±³¾°»ý·Ö		
		$lotInfo=getLotinfo($this->oldLot,$this->oldUid);	//·µ»ØÉÏ´Î¸ö³µÎ»ÐÅÏ¢	
		if($lotInfo=='PayPort'){
		   $intstopgold=$intCarCredit*$intMinute;//ÊÕÈë
		}else{
		   $intstopgold=0;
		}
		
		if($this->oldLot==0){//Ç°×´Ì¬Îª¿ÕÊ»
		   $intstopgold=-$intMinute;
		   $roadtoll=$intMinute*intval($DriveCredit);		   
			//ÊÂ¼þfeed
			$fs = array();
			$fs['icon'] ="drive";
			$fs['title_template'] = "{actor} lái xe ".$tempCparkcarInfo->CarDesc." đỗ ".$strMinute.",và được ".$roadtoll." vàng sau khi đậu ".CParkMember::getUserName($fID)."tại bãi đỗ số".$lot."";	
			$fs['note_template'] = "'s ".$tempCparkcarInfo->CarDesc." đã được định hướng cho ".$strMinute.",và được ".$roadtoll." vàng sau khi đậu".CParkMember::getUserName($fID)." tại bãi đỗ số".$lot."";	
            sendMessage($fs['icon'],$fs['title_template'],'StopFeed');
			 	   
		}else{
			//ÊÂ¼þfeed
			$fs = array();
			$fs['icon'] ="park";
			$fs['title_template'] = "{actor} chưa sử dụng ".$tempCparkcarInfo->CarDesc." tại ".CParkMember::getUserName($this->oldUid)." và nhận được ".$lot."điểm cho ".$strMinute.", thu được ".$intstopgold." vàng, sau đó chuyển đến <a href='parkApp.php?ac=index&fId=$fID'>".CParkMember::getUserName($fID)."</a> và nhận được ".$lot." điểm";	
			$fs['note_template'] = " đỗ xe ".$tempCparkcarInfo->CarDesc." tại ".CParkMember::getUserName($this->oldUid)." và nhận được".$lot." điểm cho ".$strMinute.',earned '.$intstopgold."vàng, sau đó chuyển đến.".$lot." điểm";	
            sendMessage($fs['icon'],$fs['title_template'],'StopFeed',$fID); 	   		
            sendMessage($fs['icon'],$fs['note_template'],'StopNote',$fID); 	   					
		}
		if($this->oldLot!=0){//¸üÐÂÉÏ´Î³µÎ»ÐÅÏ¢
			$sql="update ".tname('park_member')." set P_lot_".$this->oldLot."=0 where uid=".$this->oldUid;
			$query =$_SGLOBAL['db']->query($sql);
		}
		

        //ÐÞ¸Ä»ý·Ö
		$sql="update ".tname('park_member')." set P_credit=P_credit+".$intstopgold." where uid=".$_SGLOBAL['supe_uid'];
		$query =$_SGLOBAL['db']->query($sql);	
		$nowtime=date("Y-m-d H:i:s");
		//ÐÞ¸ÄÍ£³µ¼ÇÂ¼
		$sql="update ".tname('park_record')." set ParkStartTime='$nowtime',ParkEndTime='$nowtime',ParkCredit='$intstopgold',ParkStatus=0 where RID='$this->oldRecNo'";
        $query =$_SGLOBAL['db']->query($sql);
		//ÐÞ¸ÄÎÒµÄÆû³µÐÅÏ¢
		$sql="update ".tname('park_mycar')." set ParkWhoUid='$fID',ParkLot='$lot',BuyTime='$nowtime' where uid=".$_SGLOBAL['supe_uid']." and CarID='$carID'";
		$query =$_SGLOBAL['db']->query($sql);
		$arrRec = array(
			"CarID" => $carID,
			"ParkUid" => $_SGLOBAL['supe_uid'],
			"ParkWhoUid" => $fID,
			"Parklot" => $lot,
			"ParkStartTime" => $nowtime,
			"ParkStatus"=>1,
		);
		//Ôö¼ÓÐÂ¼ÇÂ¼
		$newRID=inserttable( "park_record", $arrRec,1);				 
		//¸üÐÂÐÂ³µÎ»ÐÅÏ¢
		$sql="update ".tname('park_member')." set P_lot_".$lot."=".$newRID."  where uid='$fID'";		
        $query =$_SGLOBAL['db']->query($sql);	
	}
}
#----------------------------------------------------------Æû³µÀà-----------------------------------------------------------------------
class  CparkcarInfo{
	public $CarID=0;//Æû³µID
	public $CarSID=0;//Æû³µ±àºÅ	
	public $CarDesc="";//Æû³µÃèÊö
	public $CarImg="";//Æû³µÍ¼Æ¬µØÖ·
	public $CarImgBig="";//Æû³µÍ¼Æ¬µØÖ·	
	public $CarColor=0;//Æû³µÑÕÉ«
	public $CarPrice=0;//Æû³µ¼Û¸ñ
	public $CarNum=0;//Æû³µÊýÁ¿
	public $CarType=0;//Æû³µÀà±ð
	public $CarMaxSpeed=0;//Æû³µ×î´óËÙ¶È
	public $CarLevel=0;//Æû³µµÈ¼¶
	public $CarCredit=0;//Í£³µÃ¿·ÖÖÓµÃµ½µÄ»ý·Ö
	public $CarSign="";//±êÖ¾
	public $arrCar=array();//Êý×é

	//¹¹Ôìº¯Êý
	public function CparkcarInfo($CarID){
	  $sql="select * from ".tname('park_carinfo')." where CarID='$CarID'";
	  $value=getSqlResult($sql);//Æû³µÐÅÏ¢
	  $this->CarID=$CarID;
	  $this->CarSID=$value[CarSID];	  
	  $this->CarDesc=$value[CarDesc];
	  $this->CarImg=$value[CarImg];
	  $this->CarImgBig=$value[CarImgBig];	  
	  $this->CarColor=$value[CarColor];
	  $this->CarPrice=$value[CarPrice];
	  $this->CarNum=$value[CarNum];
	  $this->CarType=$value[CarType];
	  $this->CarMaxSpeed=$value[CarMaxSpeed];
	  $this->CarLevel=$value[CarLevel];
	  $this->CarCredit=$value[CarCredit];
	  $this->CarSign=$value[CarSign];
	  //Æû³µÊý×é
	  $this->arrCar=array(
		  CarID=>$CarID,
		  CarSID=>$value[CarSID],
		  CarDesc=>$value[CarDesc],
		  CarImg=>$value[CarImg],
		  CarImgMid=>$value[CarImgMid],		  
		  CarImgBig=>$value[CarImgBig],
		  CarColor=>$value[CarColor],
		  CarPrice=>$value[CarPrice],
		  CarNum=>$value[CarNum],
		  CarType=>$value[CarType],
		  CarMaxSpeed=>$value[CarMaxSpeed],
		  CarLevel=>$value[CarLevel],
		  CarCredit=>$value[CarCredit],
		  CarSign=>$value[CarSign],
	  );
	}

}
#--------------------------------------------------------µÀ¾ßÀà---------------------------------------------------------------------
class Cparkstage{
   public $StageID=0;//µÀ¾ßID
   public $StageName="";//µÀ¾ßÃû
   public $StagePrice=0;//µÀ¾ß¼Û¸ñ
   public $StageIntr="";//µÀ¾ß½éÉÜ
   public $StageScript="";//µÀ¾ß½Å±¾
   public $StageImg="";//Í¼Æ¬
   public $arrStage=array();//µÀ¾ßÊý×é
   //¹¹Ôìº¯Êý
   public function Cparkstage($stageid){
	   $sql="select * from ".tname('park_stage')." where StageID='$stageid'";
	   $value=getSqlResult($sql); //µÀ¾ß±í·µ»ØÊý×é  
       $this->StageID=$value[StageID];
	   $this->StageName=$value[StageName];
	   $this->StagePrice=$value[StagePrice];
	   $this->StageName=$value[StageName];
	   $this->StagePrice=$value[StagePrice];
	   $this->StageIntr=$value[StageIntr];
	   $this->StageScript=$value[StageScript];
	   $this->StageImg=$value[StageImg];
	   $this->arrStage=$value;

   }
   //¸ù¾ÝIDºÅ·µ»ØÎÒµÄµÀ¾ßµ¥Ìõ¼ÇÂ¼
   public function getMyStageByID($ID){
	   $sql="select * from ".tname('park_mystage')." where ID='$ID'";
	   $value=getSqlResult($sql);   
	   return $value;   
   } 
}
#-----------------------------------------------------------------Í£³µ¼ÇÂ¼Àà-----------------------------------------------------------
class  Cpark_record{
	public $RID=0;//¼ÇÂ¼ID
	public $CarID=0;//Æû³µID
	public $ParkUid=0;//Í£³µÕßID
	public $ParkWhoUid=0;//±»Í£³µÕßID
	public $Parklot=0;//³µÎ»±àºÅ
	public $ParkStartTime="";//´Ë´ÎÍ£³µ¿ªÊ¼Ê±¼ä
	public $ParkEndTime="";//´Ë´ÎÍ£³µ½áÊøÊ±¼ä
	public $ParkCredit=0;//Í£³µËùµÃ»ý·Ö
	public $ParkStatus=0;//Í£³µ×´Ì¬
	public $ParkWarned=0;//ÊÇ·ñ±»¾¯¸æ
	public $ParkMess=0;//ÊÇ·ñ±»ÌùÌõ
	public $ParkPunish=0;//³Í·£·½Ê½	
	public function Cpark_record($RID){	
	} 
	public function setPark_record($key){
	}

}

//¸üÐÂ³µÎ»»ý·Ö
function updateCredit($credit){
  global $_SGLOBAL; 
  $_SGLOBAL['db']->query("update ".tname('park_member')." set P_credit=P_credit-".$credit." where uid=".$_SGLOBAL['supe_uid']);
}
//feedºÍÍ¨Öª
function sendMessage($icon,$title_template,$type,$fID){
  global $_SGLOBAL; 
  $parkMember=new CparkMember($_SGLOBAL['supe_uid']);
  $parkMember->getMemberset($_SGLOBAL['supe_uid']); 
  $arrMemberset=$parkMember->P_arrMemberset;
  if($arrMemberset[$type]){
     include_once(S_ROOT.'./source/function_cp.php');
     if(substr($type,-4,4)=='Feed'){
	     feed_add($icon, $title_template);
	 }
     if(substr($type,-4,4)=='Note'){
	     notification_add($fID, app, $title_template);
	 }	 
   }	
}
//ÎÒµÄÆû³µ¼ÇÂ¼
function getMyCar($uid,$carID){
  $sql="select * from ".tname('park_mycar')." where uid='$uid' and CarID='$carID'";
  $value=getSqlResult($sql); 
  return $value;
  
}
//Ä³ÈËÄ³³µÎ»µÄÐÅÏ¢
function getLotinfo($lot,$uid){
  	$sql="select P_lot_free from ".tname('park_member')." where uid='$uid'";	
	$value=getSqlResult($sql);
	if($lot==$value[P_lot_free]){
	  $retStr="FreePort";
	}else{
	  $retStr="PayPort";
	}
	return $retStr;
}
//·µ»Ø±íµ¥Ìõ¼ÇÂ¼Êý×é
function getSqlResult($sql){
    global $_SGLOBAL; 
    $query =$_SGLOBAL['db']->query($sql);
    $value =$_SGLOBAL['db']->fetch_array( $query );
	return $value;

}  
//·µ»Ø±í¶àÌõ¼ÇÂ¼Êý×é
function getTableResult($sql){
    global $_SGLOBAL; 
    $query =$_SGLOBAL['db']->query($sql);
	$list=array();
    while($value =$_SGLOBAL['db']->fetch_array( $query )){
	  $list[]=$value;
	}
	return $list;
}
//·µ»ØÎÒµÄÆû³µ¼ÇÂ¼
function getrecordOfmycar($uid=0,$CarID=0){

  $sql="select * from ".tname('park_record')." where parkuid='$uid' and CarID='$CarID' and ParkStatus=1";  
  $value=getSqlResult($sql);
  return $value;  	
}
//Ê±²î
function getTimeDifference($dateParkStartTime){
  $parkCfg=new CparkCfg(); 
  $cfgStopLimit=$parkCfg->cfgStopLimit;
  $maxTime=$cfgStopLimit[maxStopTime];
  $nowtime=date("Y-m-d H:i:s"); 
  $addtime=abs(strtotime($nowtime)-strtotime($dateParkStartTime));	  
  if($addtime>intval($maxTime)*60){//³¬¹ýÏÞ¶¨Ê±¼ä
	$intMinute=intval($maxTime);
  }else{
	$intMinute=floor($addtime/60);
  }
  return $intMinute;

}
//ÌùÌõ
function setMessage($uid,$lot){
    global $_SGLOBAL; 
    $sql="select P_lot_".$lot." from ".tname('park_member')." where uid=".$uid;
    $value=getSqlResult($sql);
	$strField='P_lot_'.$lot;
    $recNo=$value[$strField];
    $sql="select * from ".tname('park_record')." where RID=".$recNo;
    $value=getSqlResult($sql);
	$carID=$value[CarID];
	$ParkUid=$value[ParkUid];
	$ParkSpace=getspace($ParkUid);
	$username=$ParkSpace[username];
    $parkMember=new CParkMember($uid);
	$arrlot=$parkMember->P_arrlot;
	$money=intval($arrlot[$lot-1][stopgold]);	
	$sql="update ".tname('park_member')." set P_lot_".$lot."=0,P_credit=P_credit+".$money." where uid=".$uid;
	$query =$_SGLOBAL['db']->query($sql);
	
	$sql="update ".tname('park_member')." set P_lot_".$lot."=0 where uid=".$uid;
	$_SGLOBAL['db']->query($sql);
	$nowtime=date("Y-m-d H:i:s");
	$sql="update ".tname('park_record')." set ParkStartTime='$nowtime',ParkEndTime='$nowtime',ParkCredit=0,ParkStatus=0 where RID='$recNo'";
	$_SGLOBAL['db']->query($sql);
	$sql="update ".tname('park_mycar')." set ParkWhoUid=0,ParkLot=0,BuyTime='$nowtime' where uid=".$ParkUid." and CarID='$carID'";
	$_SGLOBAL['db']->query($sql);
	
	$fs = array();
	$fs['icon'] ="stick";
	$fs['title_template'] = "{actor} cho một vé phạt do để xe tại bãi đỗ <a href='parkApp.php?ac=index&fId=".$ParkUid."'> của ".$username."</a> số ".$lot." , và tịch thu của người ấy  ".$money." vàng";
	$fs['note_template'] = " cho một vé phạt do bạn để xe tại bãi đỗ số".$lot." của họ và tịch thu của bạn ".$money." vàng";
    sendMessage($fs['icon'],$fs['title_template'],'MessFeed',$ParkUid);
    sendMessage($fs['icon'],$fs['note_template'],'MessNote',$ParkUid);
} 
//Ê±²î£¨×Ö´®£©
function getStayTime($dateParkStartTime)  //0Äê0ÔÂ1ÈÕ10Ê±0·Ö
{
  $nowtime=date("Y-m-d H:i:s"); 
  $time_diff=abs(strtotime($nowtime)-strtotime($dateParkStartTime));
  $diff_time = array(); 
  $diff_time["year"] = 0;
  if($time_diff > 31536000) //Ò»Äê31536000Ãë
    $diff_time["year"] = floor($time_diff / 31536000);
  $time_diff = $time_diff - $diff_time["year"] * 31536000;
  $diff_time["month"] = 0;
  if($time_diff > 2592000) //Ò»ÔÂ2592000Ãë
    $diff_time["month"] = floor($time_diff / 2592000);
  $time_diff = $time_diff - $diff_time["month"] * 2592000;
  $diff_time["day"] = 0;
  if($time_diff > 86400) //Ò»Ìì86400Ãë
    $diff_time["day"] = floor($time_diff / 86400);
  $time_diff = $time_diff - $diff_time["day"] * 86400;  
  $diff_time["hour"] = 0;
  if($time_diff > 3600) //Ò»Ð¡Ê±3600Ãë
    $diff_time["hour"] = floor($time_diff / 3600);
  $time_diff = $time_diff - $diff_time["hour"] * 3600;    
  $diff_time["minute"] = 0;
  if($time_diff > 60) //Ò»·Ö60Ãë
    $diff_time["minute"] = floor($time_diff / 60);
  $time_diff = $time_diff - $diff_time["minute"] * 60;     
   $diff_time["sencond"] = floor($time_diff);
   
  if($diff_time["day"]==0) {
      $diff_time["strday"]="";
	  if($diff_time["hour"]==0){
	    $diff_time["strhour"]="";
	    if($diff_time["minute"]==0){
		   $diff_time["strminute"]="";
	       if($diff_time["second"]==0 ){
		      $diff_time["strsecond"]=""; 
			}else{
			   $diff_time["strsecond"]=$diff_time["second"].'giây';
			} 		   
		 }else{
		   $diff_time["strminute"]=$diff_time["minute"].'phút'; 
		 }		
	  }else{
	    $diff_time["strhour"]=$diff_time["hour"].'giờ';
	  }
	}else {
 	  $diff_time["strday"]=$diff_time["day"].'ngày';
	}
  $retStr=$diff_time["strday"].$diff_time["strhour"].$diff_time["strminute"].$diff_time["strsencond"];	
  $retStr=empty($retStr)?'0 giây':$retStr;
  return $retStr;
} 
//Ê¹ÓÃµÀ¾ß
function setMyUse($arrMyuse,$arrStage){
global $_SGLOBAL;

 if($arrStage[StageType]==1){
    $retStr=1;
    if($arrMyuse[MyUse]<$arrStage[StageUse]){
	  $_SGLOBAL['db']->query("update ".tname('park_mystage')." set MyUse=MyUse+1 where ID=".$arrMyuse[ID]);
	}else{
	  $retStr=0;	  
      $_SGLOBAL['db']->query("delete from ".tname('park_mystage')." where ID=".$arrMyuse[ID]);
	}
  }
 if($arrStage[StageType]==2){
    $intMinute=getTimeofstage($arrMyuse[BuyTime]);
	$retStr=1;
    if($intMinute>$arrStage[StageUse]){
      $_SGLOBAL['db']->query("delete from ".tname('park_mystage')." where ID=".$arrMyuse[ID]);	
	  $retStr=0;
	}else{
	  $_SGLOBAL['db']->query("update ".tname('park_mystage')." set MyUse=MyUse+1 where ID=".$arrMyuse[ID]);
	}
  }
 if($arrStage[StageType]==0){  
      $_SGLOBAL['db']->query("delete from ".tname('park_mystage')." where ID=".$arrMyuse[ID]);	
	  $retStr=1;
 }
 if($arrMyuse[MyUse]==$arrStage[StageUse]-1){
      $_SGLOBAL['db']->query("delete from ".tname('park_mystage')." where ID=".$arrMyuse[ID]);	
	  $retStr=1;
 }
  return $retStr;
  
  
}
//ÎÞÏÞÖÆÊ±²î
function getTimeofstage($dateParkStartTime){
  $nowtime=date("Y-m-d H:i:s"); 
  $addtime=abs(strtotime($nowtime)-strtotime($dateParkStartTime));	  
  $intMinute=floor($addtime/60);
  return $intMinute;

} 
//setMessage(277,3);
//$stage=new CparkStage(1);
//echo '<pre>';
//print_r($stage->arrStage);
//echo '</pre>';


//$uid,$fID,$lot,$carID
//$stopcar=new CstopCar(277,429,2,403);
//echo $stopcar->carmessages;
//echo '</br>';
//echo $stopcar->carerrorstr;

//$mycar=new CmyCar(29516);
//$mycar->isExitOfCar(206,277);
//echo $mycar->isExitCar;
//echo '<pre>';
//print_r($mycar->arrMyCar);
//echo '</pre>';

//$myparkinfo=new CParkMember(1);
////echo '<pre>';
////print_r($myparkinfo->arrFriend);
////echo '</pre>';
////echo $myparkinfo->P_CreditAdd;
//
////$myparkinfo->getMemberset(1);
////print_r($myparkinfo->P_arrMemberset);
////echo '</br>';
////$arrm=$myparkinfo->P_arrMemberset;
////echo $arrm[StopFeed];
//for($i=0;$i<4;$i++){
//echo '<pre>';
//print_r($myparkinfo->P_arrlot[$i]);
//echo '</pre>';
//}

//echo $myparkinfo->P_friendstr;
//sendMessage($icon,$title_template,$type)
//sendMessage('park',"{actor}ÄãºÃ",'StopNote');

//setMessageXJ($uid,$lot)
//setMessageXJ(277,4)
//$parkCfg=new CParkCfg();
//$cfgbg=$parkCfg->cfgBg;
////print_r($cfgbg);
//echo $cfgbg[11];
?>