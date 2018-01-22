<?php
        header('Access-Control-Allow-Origin: *');
        parse_str($_SERVER['QUERY_STRING']);
        echo $type;
        echo $duration;
        $DB_Server = process.env.DB_HOST; //your MySQL Server
        $DB_Username = process.env.DB_USER; //your MySQL User Name
        $DB_Password = trim(file_get_contents('/opt/cbt/cbt_env/cbtdbpassword')); 
        $DB_DBName = process.env.DB_NAME; 

        $Connect = @mysql_pconnect($DB_Server, $DB_Username, $DB_Password)
        or die("Couldn't connect to DB Server.");

        //select database
        $Db = @mysql_select_db($DB_DBName, $Connect)
        or die("Couldn't select database.");

        $sql = "SELECT server_image_id, server_id from vnc_sessions where selenium_session_id = '".$sessionId."'";

        $res = mysql_query($sql) or die("err in query: $s " . mysql_error());
        while ($res_ar = mysql_fetch_assoc($res)) {

        $server_image_id = $res_ar["server_image_id"];
        $serverId = $res_ar["serverId"];
        }
        $postdata = 'total_time_comparison_new,tunneltype='.$type.',sessionId='.$sessionId.',serverImageId='.$serverImageId.',serverId='.$serverId.',browsers='.$browsers.',os='.$os.',tunnelId='.$tunnelId.' value='.$duration;
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