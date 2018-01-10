<?php
	header('Access-Control-Allow-Origin: *');
	parse_str($_SERVER['QUERY_STRING']);
	echo $type;
	echo $duration;
	$postdata = 'total_time,tunneltype='.$type.',sessionId='.$sessionId.',tunnelId='.$tunnelId.' value='.$duration;
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL,            "http://10.191.1.3:8086/write?db=tunneltime");
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt($curl, CURLOPT_POST,           1 );
	curl_setopt($curl, CURLOPT_POSTFIELDS,     $postdata ); 
	curl_setopt($curl, CURLOPT_HTTPHEADER,     array('Content-Type: text/plain'));
	$result=curl_exec ($curl);
	echo $result;
?>
<html>
<body>
</body>
</html>
