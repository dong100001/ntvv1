<?php
/****************************************/
/*      Nông trại vui vẻ QQ Farm        */
/*  Version : 3.0.0      				*/
/*  Phát triển  : WWW.GoHooH.CoM		*/
/*  Phiên bản Nhà Tui 230210			*/
/*  http://www.gohooh.com  				*/
/****************************************/
# Modify by quannguyenphat@gmail.com
 
//ũӡ٫٦
function farmnotice ( )
{
	$str = 'Trang Trai Nha Tui GoHooH.CoM';
	return $str;
}
//֯ϯԉӤלǚ
function animaltime ( )
{
	$str = array(
				"1001" => array( 14400, 14400, 129600, 180, 21420, 158400 ),
				"1002" => array( 18000, 18000, 129600, 180, 28620, 165600 ),
				"1003" => array( 16200, 16200, 151200, 180, 25020, 183600 ),
				"1004" => array( 34200, 34200, 216000, 180, 32220, 284400 ),
				"1005" => array( 37800, 37800, 237600, 180, 43020, 313200 ),
				"1006" => array( 41400, 41400, 259200, 180, 53820, 342000 ),
				"1007" => array( 27000, 27000, 216000, 180, 35820, 313200 ),
				"1008" => array( 36000, 36000, 288000, 180, 39420, 360000 ),
				"1009" => array( 37800, 37800, 302400, 180, 43020, 378000 ),
				"1010" => array( 36000, 36000, 345600, 180, 43020, 417600 ),
				"1011" => array( 41400, 41400, 403200, 180, 50220, 486000 ),
				"1012" => array( 37800, 37800, 302400, 180, 43020, 378000 ),
				"1013" => array( 37800, 37800, 403200, 180, 50220, 478800 ),
	            "1014" => array( 43200, 43200, 345600, 180, 43020, 432000 ),
				"1015" => array( 32400, 32400, 270000, 180, 43020, 334800 ),
	            "1016" => array( 34200, 34200, 316800, 180, 39420, 385200 ),
		        "1501" => array( 27000, 27000, 172800, 180, 43020, 226800 ),
				"1502" => array( 32400, 32400, 216000, 180, 43020, 280800 ),
				"1503" => array( 36000, 36000, 216000, 180, 35820, 288000 ),
				"1504" => array( 39600, 39600, 237600, 180, 43020, 316800 ),
				"1505" => array( 32400, 32400, 216000, 180, 35820, 280800 ),
				"1507" => array( 39600, 39600, 331200, 180, 46620, 410400 ),
				"1508" => array( 43200, 43200, 432000, 180, 53820, 518400 ),
				"1509" => array( 36000, 36000, 345600, 180, 43020, 417600 ),
				"1510" => array( 39600, 39600, 406800, 180, 50220, 417600 ),
				"1511" => array( 37800, 37800, 334800, 180, 50220, 410400 ),
				"1512" => array( 57600, 57600, 810000, 180, 53820, 925200 )	
		);
	return $str;
}
//֯ϯ`эӎ˽

function animaltype ( )
{
	$str = array(
	"1001" => array("byproductprice"=>17,"cId"=>1001,"cLevel"=>0,"cName"=>"\u9E21","consum"=>1,"cub"=>14400,"cycle"=>21600,"expect"=>0,"growing"=>"14400,14400,129600,180","growthCycle"=>0,"harvestbExp"=>6,"harvestpExp"=>26,"maturingTime"=>28800,"output"=>20,"price"=>700,"procreation"=>129600,"productime"=>180,"productprice"=>860,"sinfo"=>""),
	"1002" => array("byproductprice"=>39,"cId"=>1002,"cLevel"=>1,"cName"=>"\u5154\u5B50","consum"=>2,"cub"=>18000,"cycle"=>28800,"expect"=>0,"growing"=>"18000,18000,129600,180","growthCycle"=>0,"harvestbExp"=>8,"harvestpExp"=>28,"maturingTime"=>36000,"output"=>12,"price"=>1200,"procreation"=>129600,"productime"=>180,"productprice"=>1460,"sinfo"=>"\u5582\u98DF\u80E1\u841D\u535C\u53EF\u4EE5\u51CF\u5C115\u5206\u949F\u751F\u957F\u65F6\u95F4"),
	"1501" => array("byproductprice"=>29,"cId"=>1501,"cLevel"=>2,"cName"=>"\u7F8A","consum"=>3,"cub"=>27000,"cycle"=>43200,"expect"=>0,"growing"=>"27000,27000,172800,180","growthCycle"=>0,"harvestbExp"=>16,"harvestpExp"=>38,"maturingTime"=>54000,"output"=>24,"price"=>2000,"procreation"=>172800,"productime"=>180,"productprice"=>2860,"sinfo"=>""),
	"1003" => array("byproductprice"=>19,"cId"=>1003,"cLevel"=>3,"cName"=>"\u9E45","consum"=>3,"cub"=>16200,"cycle"=>25200,"expect"=>0,"growing"=>"16200,16200,151200,180","growthCycle"=>0,"harvestbExp"=>11,"harvestpExp"=>36,"maturingTime"=>32400,"output"=>20,"price"=>900,"procreation"=>151200,"productime"=>180,"productprice"=>1060,"sinfo"=>""),
	"1502" => array("byproductprice"=>55,"cId"=>1502,"cLevel"=>4,"cName"=>"\u725B","consum"=>4,"cub"=>32400,"cycle"=>43200,"expect"=>0,"growing"=>"32400,32400,216000,180","growthCycle"=>0,"harvestbExp"=>17,"harvestpExp"=>40,"maturingTime"=>64800,"output"=>12,"price"=>3000,"procreation"=>216000,"productime"=>180,"productprice"=>4260,"sinfo"=>""),
	"1004" => array("byproductprice"=>56,"cId"=>1004,"cLevel"=>5,"cName"=>"\u732B","consum"=>2,"cub"=>34200,"cycle"=>32400,"expect"=>0,"growing"=>"34200,34200,216000,180","growthCycle"=>0,"harvestbExp"=>14,"harvestpExp"=>37,"maturingTime"=>68400,"output"=>12,"price"=>3200,"procreation"=>216000,"productime"=>180,"productprice"=>4060,"sinfo"=>""),
	"1503" => array("byproductprice"=>58,"cId"=>1503,"cLevel"=>6,"cName"=>"\u7334\u5B50","consum"=>3,"cub"=>36000,"cycle"=>36000,"expect"=>0,"growing"=>"36000,36000,216000,180","growthCycle"=>0,"harvestbExp"=>14,"harvestpExp"=>38,"maturingTime"=>72000,"output"=>12,"price"=>4000,"procreation"=>216000,"productime"=>180,"productprice"=>5260,"sinfo"=>""),
	"1005" => array("byproductprice"=>35,"cId"=>1005,"cLevel"=>7,"cName"=>"\u5B54\u96C0","consum"=>3,"cub"=>37800,"cycle"=>43200,"expect"=>0,"growing"=>"37800,37800,237600,180","growthCycle"=>0,"harvestbExp"=>16,"harvestpExp"=>39,"maturingTime"=>75600,"output"=>24,"price"=>5000,"procreation"=>237600,"productime"=>180,"productprice"=>6060,"sinfo"=>""),
	"1504" => array("byproductprice"=>64,"cId"=>1504,"cLevel"=>8,"cName"=>"\u888B\u9F20","consum"=>4,"cub"=>39600,"cycle"=>43200,"expect"=>0,"growing"=>"39600,39600,237600,180","growthCycle"=>0,"harvestbExp"=>16,"harvestpExp"=>40,"maturingTime"=>79200,"output"=>12,"price"=>8000,"procreation"=>237600,"productime"=>180,"productprice"=>9860,"sinfo"=>""),
	"1006" => array("byproductprice"=>68,"cId"=>1006,"cLevel"=>9,"cName"=>"\u4F01\u9E45","consum"=>3,"cub"=>41400,"cycle"=>54000,"expect"=>0,"growing"=>"41400,41400,259200,180","growthCycle"=>0,"harvestbExp"=>22,"harvestpExp"=>44,"maturingTime"=>82800,"output"=>16,"price"=>10000,"procreation"=>259200,"productime"=>180,"productprice"=>11860,"sinfo"=>""),
	"1007" => array("byproductprice"=>69,"cId"=>1007,"cLevel"=>10,"cName"=>"\u4E4C\u9F9F","consum"=>3,"cub"=>27000,"cycle"=>36000,"expect"=>0,"growing"=>"27000,27000,216000,180","growthCycle"=>0,"harvestbExp"=>14,"harvestpExp"=>26,"maturingTime"=>54000,"output"=>12,"price"=>11000,"procreation"=>216000,"productime"=>180,"productprice"=>12000,"sinfo"=>""),
	"1505" => array("byproductprice"=>70,"cId"=>1505,"cLevel"=>11,"cName"=>"\u6885\u82B1\u9E7F","consum"=>3,"cub"=>32400,"cycle"=>36000,"expect"=>0,"growing"=>"32400,32400,216000,180","growthCycle"=>0,"harvestbExp"=>14,"harvestpExp"=>27,"maturingTime"=>64800,"output"=>12,"price"=>12000,"procreation"=>216000,"productime"=>180,"productprice"=>13330,"sinfo"=>""),
	"1008" => array("byproductprice"=>71,"cId"=>1008,"cLevel"=>12,"cName"=>"\u677E\u9F20","consum"=>4,"cub"=>36000,"cycle"=>39600,"expect"=>0,"growing"=>"36000,36000,288000,180","growthCycle"=>0,"harvestbExp"=>16,"harvestpExp"=>29,"maturingTime"=>72000,"output"=>13,"price"=>12640,"procreation"=>288000,"productime"=>180,"productprice"=>14570,"sinfo"=>""),
	"1009" => array("byproductprice"=>72,"cId"=>1009,"cLevel"=>13,"cName"=>"\u6CE2\u65AF\u732B","consum"=>4,"cub"=>37800,"cycle"=>43200,"expect"=>0,"growing"=>"37800,37800,302400,180","growthCycle"=>0,"harvestbExp"=>17,"harvestpExp"=>30,"maturingTime"=>75600,"output"=>14,"price"=>13000,"procreation"=>302400,"productime"=>180,"productprice"=>14790,"sinfo"=>""),
	"1012" => array("byproductprice"=>73,"cId"=>1012,"cLevel"=>14,"cName"=>"\u9E2D","consum"=>3,"cub"=>37800,"cycle"=>43200,"expect"=>0,"growing"=>"37800,37800,302400,180","growthCycle"=>0,"harvestbExp"=>17,"harvestpExp"=>29,"maturingTime"=>75600,"output"=>14,"price"=>13200,"procreation"=>302400,"productime"=>180,"productprice"=>14910,"sinfo"=>""),
	"1015" => array("byproductprice"=>72,"cId"=>1015,"cLevel"=>14,"cName"=>"\u4E4C\u9AA8\u9E21","consum"=>2,"cub"=>32400,"cycle"=>43200,"expect"=>0,"growing"=>"32400,32400,270000,180","growthCycle"=>0,"harvestbExp"=>15,"harvestpExp"=>22,"maturingTime"=>64800,"output"=>12,"price"=>13100,"procreation"=>270000,"productime"=>180,"productprice"=>14890,"sinfo"=>""),
	"1507" => array("byproductprice"=>77,"cId"=>1507,"cLevel"=>15,"cName"=>"\u7F9A\u7F8A","consum"=>2,"cub"=>39600,"cycle"=>46800,"expect"=>0,"growing"=>"39600,39600,331200,180","growthCycle"=>0,"harvestbExp"=>19,"harvestpExp"=>31,"maturingTime"=>79200,"output"=>15,"price"=>13470,"procreation"=>331200,"productime"=>180,"productprice"=>15020,"sinfo"=>""),
	"1510" => array("byproductprice"=>77,"cId"=>1510,"cLevel"=>16,"cName"=>"\u957F\u9888\u9E7F","consum"=>3,"cub"=>39600,"cycle"=>50400,"expect"=>0,"growing"=>"39600,39600,327600,180","growthCycle"=>0,"harvestbExp"=>18,"harvestpExp"=>33,"maturingTime"=>79200,"output"=>16,"price"=>13630,"procreation"=>327600,"productime"=>180,"productprice"=>15110,"sinfo"=>""),
	"1010" => array("byproductprice"=>78,"cId"=>1010,"cLevel"=>17,"cName"=>"\u4ED3\u9F20","consum"=>2,"cub"=>41400,"cycle"=>50400,"expect"=>0,"growing"=>"41400,41400,403200,180","growthCycle"=>0,"harvestbExp"=>20,"harvestpExp"=>32,"maturingTime"=>82800,"output"=>16,"price"=>14100,"procreation"=>403200,"productime"=>180,"productprice"=>16940,"sinfo"=>""),
	"1013" => array("byproductprice"=>78,"cId"=>1013,"cLevel"=>18,"cName"=>"\u9F39\u9F20","consum"=>3,"cub"=>37800,"cycle"=>50400,"expect"=>0,"growing"=>"37800,37800,403200,180","growthCycle"=>0,"harvestbExp"=>19,"harvestpExp"=>31,"maturingTime"=>75600,"output"=>16,"price"=>14200,"procreation"=>403200,"productime"=>180,"productprice"=>17030,"sinfo"=>""),
	"1508" => array("byproductprice"=>79,"cId"=>1508,"cLevel"=>19,"cName"=>"\u9E35\u9E1F","consum"=>2,"cub"=>43200,"cycle"=>54000,"expect"=>0,"growing"=>"43200,43200,432000,180","growthCycle"=>0,"harvestbExp"=>21,"harvestpExp"=>33,"maturingTime"=>86400,"output"=>17,"price"=>14430,"procreation"=>432000,"productime"=>180,"productprice"=>17610,"sinfo"=>""),
	"1011" => array("byproductprice"=>72,"cId"=>1011,"cLevel"=>21,"cName"=>"\u523A\u732C","consum"=>2,"cub"=>36000,"cycle"=>43200,"expect"=>0,"growing"=>"36000,36000,345600,180","growthCycle"=>0,"harvestbExp"=>14,"harvestpExp"=>34,"maturingTime"=>72000,"output"=>15,"price"=>15230,"procreation"=>345600,"productime"=>180,"productprice"=>18000,"sinfo"=>""),
	"1014" => array("byproductprice"=>73,"cId"=>1014,"cLevel"=>22,"cName"=>"\u632A\u5A01\u68EE\u6797\u732B","consum"=>3,"cub"=>43200,"cycle"=>43200,"expect"=>0,"growing"=>"43200,43200,345600,180","growthCycle"=>0,"harvestbExp"=>14,"harvestpExp"=>34,"maturingTime"=>86400,"output"=>16,"price"=>15550,"procreation"=>345600,"productime"=>180,"productprice"=>18100,"sinfo"=>""),
	"1509" => array("byproductprice"=>73,"cId"=>1509,"cLevel"=>23,"cName"=>"\u6D63\u718A","consum"=>2,"cub"=>36000,"cycle"=>43200,"expect"=>0,"growing"=>"36000,36000,345600,180","growthCycle"=>0,"harvestbExp"=>13,"harvestpExp"=>35,"maturingTime"=>72000,"output"=>16,"price"=>15940,"procreation"=>345600,"productime"=>180,"productprice"=>18120,"sinfo"=>""),
	"1016" => array("byproductprice"=>74,"cId"=>1016,"cLevel"=>24,"cName"=>"\u7F8E\u56FD\u77ED\u6BDB\u732B","consum"=>3,"cub"=>34200,"cycle"=>39600,"expect"=>0,"growing"=>"34200,34200,316800,180","growthCycle"=>0,"harvestbExp"=>12,"harvestpExp"=>28,"maturingTime"=>68400,"output"=>15,"price"=>16300,"procreation"=>316800,"productime"=>180,"productprice"=>18210,"sinfo"=>""),
	"1511" => array("byproductprice"=>75,"cId"=>1511,"cLevel"=>25,"cName"=>"\u4E39\u9876\u9E64","consum"=>3,"cub"=>37800,"cycle"=>50400,"expect"=>0,"growing"=>"37800,37800,334800,180","growthCycle"=>0,"harvestbExp"=>13,"harvestpExp"=>30,"maturingTime"=>75600,"output"=>16,"price"=>16430,"procreation"=>334800,"productime"=>180,"productprice"=>18350,"sinfo"=>""),
	"1512" => array("byproductprice"=>100,"cId"=>1512,"cLevel"=>50,"cName"=>"\u8C94\u8C85","consum"=>0,"cub"=>57600,"cycle"=>54000,"expect"=>0,"growing"=>"57600,57600,810000,180","growthCycle"=>0,"harvestbExp"=>14,"harvestpExp"=>30,"maturingTime"=>115200,"output"=>20,"price"=>30000,"procreation"=>810000,"productime"=>180,"productprice"=>32000,"sinfo"=>"")
	);
	return $str;
}

function animalname ( )
{
     $str = array(
				"1001" => array( "name" => "\u9E21\u86CB", "price" => 17, "exp" => 6, "liangci" =>"\u4e2a"),
				"1002" => array( "name" => "\u5154\u4ED4", "price" => 39, "exp" => 8, "liangci" =>"\u53ea" ),
				"1003" => array( "name" => "\u9E45\u86CB", "price" => 19, "exp" => 11, "liangci" =>"\u4e2a" ),
				"1004" => array( "name" => "\u5C0F\u732B\u4ED4", "price" => 56, "exp" => 14, "liangci" =>"\u53ea" ),
				"1005" => array( "name" => "\u5B54\u96C0\u6BDB", "price" => 35, "exp" => 16, "liangci" =>"\u4e2a" ),
				"1006" => array( "name" => "\u5C0F\u4F01\u9E45", "price" => 68, "exp" => 22, "liangci" =>"\u53ea" ),
				"1007" => array( "name" => "\u5C0F\u4E4C\u9F9F", "price" => 69, "exp" => 14, "liangci" =>"\u53ea" ),
				"1008" => array( "name" => "\u677E\u9F20\u5D3D", "price" => 71, "exp" => 16, "liangci" =>"\u53ea" ),
				"1009" => array( "name" => "\u6CE2\u65AF\u732B\u5D3D", "price" => 72, "exp" => 17, "liangci" =>"\u53ea" ),
				"1010" => array( "name" => "\u4ED3\u9F20\u5D3D", "price" => 78, "exp" => 20, "liangci" =>"\u53ea" ),
				"1011" => array( "name" => "\u523A\u732C\u5D3D", "price" => 72, "exp" => 13, "liangci" =>"\u53ea" ),
				"1012" => array( "name" => "\u9E2D\u86CB", "price" => 73, "exp" => 17, "liangci" =>"\u53ea" ),
				"1013" => array( "name" => "\u9F39\u9F20\u5D3D", "price" => 78, "exp" => 14, "liangci" =>"\u53ea" ),
				"1014" => array( "name" => "\u632A\u5A01\u68EE\u6797\u732B\u5D3D", "price" => 73, "exp" => 14, "liangci" =>"\u53ea" ),
				"1015" => array( "name" => "\u4E4C\u9AA8\u9E21\u86CB", "price" => 72, "exp" => 15, "liangci" =>"\u53ea" ),
				"1016" => array( "name" => "\u7F8E\u56FD\u77ED\u6BDB\u732B\u5D3D", "price" => 74, "exp" => 12, "liangci" =>"\u53ea" ),
				"1501" => array( "name" => "\u7F8A\u6BDB", "price" => 29, "exp" => 16, "liangci" =>"\u5377" ),
				"1502" => array( "name" => "\u725B\u5976", "price" => 55, "exp" => 17, "liangci" =>"\u74f6" ),
				"1503" => array( "name" => "\u5C0F\u7334\u4ED4", "price" => 58, "exp" => 14, "liangci" =>"\u53ea" ),
				"1504" => array( "name" => "\u5C0F\u888B\u9F20", "price" => 64, "exp" => 16, "liangci" =>"\u53ea" ),
				"1505" => array( "name" => "\u6885\u82B1\u9E7F\u5D3D", "price" => 70, "exp" => 22, "liangci" =>"\u53ea" ),
				"1506" => array( "name" => "\\u4FBF\\u4FBF", "price" => 30, "exp" => 0 ),
	            "1507" => array( "name" => "\u7F9A\u7F8A\u5D3D", "price" => 77, "exp" => 18, "liangci" =>"\u53ea" ),
				"1508" => array( "name" => "\u9E35\u9E1F\u5D3D", "price" => 79, "exp" => 21, "liangci" =>"\u53ea" ),
				"1509" => array( "name" => "\u6D63\u718A\u5D3D", "price" => 73, "exp" => 13, "liangci" =>"\u53ea" ),
				"1510" => array( "name" => "\u957F\u9888\u9E7F\u5D3D", "price" => 77, "exp" => 18, "liangci" =>"\u53ea" ),
				"1511" => array( "name" => "\u4E39\u9876\u9E64\u5D3D", "price" => 75, "exp" => 13, "liangci" =>"\u53ea" ),
				"1512" => array( "name" => "\u7EA2\u5B9D\u77F3", "price" => 100, "exp" => 14, "liangci" =>"\u4E2A" ),
				"11001" => array( "name" => "\u9E21", "price" => 860, "exp" => 26, "liangci" =>"\u53ea", "act" =>"\u4e0b\u86cb" ),
				"11002" => array( "name" => "\u5154\u5B50", "price" => 1460, "exp" => 28, "liangci" =>"\u53ea", "act" =>"\u4ea7\u5d3d" ),
				"11003" => array( "name" => "\u9E45", "price" => 1060, "exp" => 36, "liangci" =>"\u53ea", "act" =>"\u4e0b\u86cb" ),
				"11004" => array( "name" => "\u732B", "price" => 4060, "exp" => 37, "liangci" =>"\u53ea", "act" =>"\u4ea7\u5d3d" ),
				"11005" => array( "name" => "\u5B54\u96C0", "price" => 6060, "exp" => 39, "liangci" =>"\u53ea", "act" =>"\u751f\u4ea7" ),
				"11006" => array( "name" => "\u4F01\u9E45", "price" => 11860, "exp" => 44, "liangci" =>"\u53ea", "act" =>"\u751f\u4ea7" ),
				"11007" => array( "name" => "\u4E4C\u9F9F", "price" => 12000, "exp" => 26, "liangci" =>"\u53ea", "act" =>"\u751f\u4ea7" ),
				"11008" => array( "name" => "\u677E\u9F20", "price" => 14570, "exp" => 29, "liangci" =>"\u53ea", "act" =>"\u751f\u4ea7" ),
				"11009" => array( "name" => "\u6CE2\u65AF\u732B", "price" => 14790, "exp" => 30, "liangci" =>"\u53ea", "act" =>"\u751f\u4ea7" ),
				"11010" => array( "name" => "\u4ED3\u9F20", "price" => 16940, "exp" => 32, "liangci" =>"\u53ea", "act" =>"\u751f\u4ea7" ),
				"11011" => array( "name" => "\u523A\u732C", "price" => 18000, "exp" => 34, "liangci" =>"\u53ea", "act" =>"\u751f\u4ea7" ),
				"11012" => array( "name" => "\u9E2D", "price" => 14910, "exp" => 29, "liangci" =>"\u53ea", "act" =>"\u751f\u4ea7" ),
				"11013" => array( "name" => "\u9F39\u9F20", "price" => 14910, "exp" => 34, "liangci" =>"\u53ea", "act" =>"\u751f\u4ea7" ),
				"11014" => array( "name" => "\u632A\u5A01\u68EE\u6797\u732B", "price" => 14910, "exp" => 34, "liangci" =>"\u53ea", "act" =>"\u751f\u4ea7" ),
				"11015" => array( "name" => "\u4E4C\u9AA8\u9E21", "price" => 13100, "exp" => 22, "liangci" =>"\u53ea", "act" =>"\u751f\u4ea7" ),
				"11016" => array( "name" => "\u7F8E\u56FD\u77ED\u6BDB\u732B", "price" => 16300, "exp" => 28, "liangci" =>"\u53ea", "act" =>"\u751f\u4ea7" ),
				"11501" => array( "name" => "\u7F8A", "price" => 2860, "exp" => 38, "liangci" =>"\u5934", "act" =>"\u526a\u7f8a\u6bdb" ),
				"11502" => array( "name" => "\u725B", "price" => 4260, "exp" => 40, "liangci" =>"\u5934", "act" =>"\u4ea7\u5976" ),
				"11503" => array( "name" => "\u7334\u5B50", "price" => 5260, "exp" => 38, "liangci" =>"\u53ea", "act" =>"\u4ea7\u5d3d" ),
				"11504" => array( "name" => "\u888B\u9F20", "price" => 9860, "exp" => 40, "liangci" =>"\u53ea", "act" =>"\u4ea7\u5d3d" ),
				"11505" => array( "name" => "\u6885\u82B1\u9E7F", "price" => 13330, "exp" => 44, "liangci" =>"\u53ea", "act" =>"\u4ea7\u5d3d" ),
				"11507" => array( "name" => "\u7F9A\u7F8A", "price" => 13470, "exp" => 40, "liangci" =>"\u53ea", "act" =>"\u4ea7\u5d3d" ),
				"11508" => array( "name" => "\u9E35\u9E1F", "price" => 17610, "exp" => 33, "liangci" =>"\u53ea", "act" =>"\u4ea7\u5d3d" ),
				"11509" => array( "name" => "\u6D63\u718A", "price" => 18120, "exp" => 35, "liangci" =>"\u53ea", "act" =>"\u4ea7\u5d3d" ),
				"11510" => array( "name" => "\u957F\u9888\u9E7F", "price" => 15110, "exp" => 33, "liangci" =>"\u53ea", "act" =>"\u4ea7\u5d3d" ),
				"11511" => array( "name" => "\u4E39\u9876\u9E64", "price" => 15110, "exp" => 30, "liangci" =>"\u53ea", "act" =>"\u4ea7\u5d3d" ),
				"11512" => array( "name" => "\u8C94\u8C85", "price" => 32000, "exp" => 30, "liangci" =>"\u53ea", "act" =>"\u4ea7\u5d3d" )
);
	return $str;
}
//̇
function get_food ( )
{
	$str = array(
	/* "һֻ֯ϯÿ 4 Сʱлۄ 1~5 ċ", "ιҸ֯ϯ(Ф׶ܡֹͣԉӤܲʺӺ) ", "ʌ֪ٺòŁӝ۳ܡؔ֯؅ɫ̇ܺא", "ٟݛٺòŁӝܡлۄޏנްҒһۏ̣ìݨөȥũӡזֲc" */
		"40" => array( "FBPrice" => 0, "consume" => "\u4E00\u53EA\u52A8\u7269\u6BCF 4 \u5C0F\u65F6\u6D88\u8017 1~5 \u7C92\u9972\u6599", "depict" => "\u5582\u517B\u52A8\u7269(\u6328\u997F\u4F1A\u505C\u6B62\u6210\u957F\u6216\u751F\u4EA7)", "effect" => 0, "price" => 60, "store" => "\u5546\u5E97\u8D2D\u4E70\u7267\u8349\u540E\u4F1A\u81EA\u52A8\u653E\u5165\u9972\u6599\u673A\u4E2D", "tId" => 1, "tName" => "\u7267\u8349", "timeLimit" => 0, "tip" => "\u9AD8\u4EF7\u8D2D\u4E70\u7267\u8349\u4F1A\u6D88\u8017\u8F83\u591A\u91D1\u5E01\u4E0D\u5408\u7B97\uFF0C\u5EFA\u8BAE\u53BB\u519C\u573A\u79CD\u690D\u3002", "type" => 25),

		);
	return $str;
}
?>
