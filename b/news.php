<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
<title>律动阅读 </title>
<meta name="generator" content="Geany 2.0" />

<style>
	body{ color: #555;font-size:16px;background:#fff;}
	a {
  text-decoration: none;
  line-height:24px;
}
a:link {
 
}

</style>
</head>

<body>
	
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);


$page = $_GET['p']; 

function getWeb($url){
	
			$retries = 4;
	        $curl = curl_init($url);

	 
	        if(is_resource($curl) === true){
		    $useragent = "Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.80 Safari/537.36";
	        //return the transfer as a string
	        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	        //curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($curl, CURLOPT_TIMEOUT,20); 
			curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
			curl_setopt($curl, CURLOPT_USERAGENT,$useragent);
			curl_setopt($curl, CURLOPT_COOKIEFILE,"/home/wwwroot/invelite/api/push/cookie.txt");
			curl_setopt($curl, CURLOPT_REFERER, 'https://public.zsxq.com/groups/881254448182.html');
			 
			//定义伪造IP来源段，这里我找的是百度的IP地址
			$cip = '123.125.68.'.mt_rand(0,254);
			$xip = '125.90.88.'.mt_rand(0,254);
			
			$header = array(
			'CLIENT-IP:'.$cip,
			'X-FORWARDED-FOR:'.$xip,
			'Accept-Language: zh-CN',
			'Accept-Language: en',
			);
			
			curl_setopt ($curl, CURLOPT_HTTPHEADER, $header);
	 
	        $httpCode = 500;
	        while(($httpCode !== 200) && (--$retries > 0)){
	            	//echo "retrying...";
	                $result = curl_exec($curl);
	                $httpCode = curl_getinfo($curl,CURLINFO_HTTP_CODE);
	                //echo $httpCode."<br/>";echo $retries."<br/>";
	                if($retries <= 2){
		                echo $url." connect failing...pause 5 secs...<br/>";
		                sleep(5);
		            }
	        }

	        curl_close($curl);
        }


        return $result;
}


function news($data){

// 访问每条新闻的标题
foreach ($data['newsList'] as $news) {
	if($news['type']==1){
		$normalTime = date("Y-m-d", $news['add_time']);
		
		
    echo "<a href=\"https://www.theblockbeats.info/news/".$news['data_id']."\" target=\"_blank\">" . $news['title'] . "</a> - ".$normalTime."<br/>";
    
    
}
}
}
function disnews1($p){
$jsonData = getWeb("https://api.theblockbeats.info/v5/home/select?page=".$p);
$data = json_decode($jsonData, true);
news($data);
}

function disnews2($p){
disnews1($p+1);
disnews1($p+2);
disnews1($p+3);
disnews1($p+4);
disnews1($p+5);
disnews1($p+6);
disnews1($p+7);
disnews1($p+8);
disnews1($p+9);
disnews1($p+10);
}

//disnews2(10);

if (isset($page)) {
	if($page==="0"){
		disnews2(0);
		}else{
	disnews2(10*$page);
	}
	}else{
		disnews2(0);
		}

echo "<a href='?p=0'> 主页 </a> | | ";

$a=intval($page)-1;
$b=intval($page)+1;
echo("<a href='?p=".$a."'>上一页</a> | ");
echo("当前页：".$page." ");
echo("<a href='?p=".$b."'>下一页</a> <hr/>");

/*
echo "<a href='?p=0'> 主页 </a> | ";
for ($i = 1; $i <= 100; $i++) {
	

	
    echo "<a href='?p=$i'>" . $i . "</a> | ";
}
*/
?>


</body>

</html>
