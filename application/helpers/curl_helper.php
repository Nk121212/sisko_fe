<?php

function cURL($url, $params=array(), $type='get', $headers=array(), $method_used='POST'){
		
    $pu = parse_url($url);
    $cookie = false;

    $header = array(
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Safari/537.36" 
    );

    if(!empty($headers['cookie'])){
        $cookie = true;
        unset($headers['cookie']);
    }

    if(!empty($headers)){
        if(isset($headers['referer']) && $headers['referer']==false) unset($headers['referer']);
        foreach($headers as $key=>$val){
            $header[] = $key.': '.$val;
        }
    }
    
    $ch = curl_init(); 
    
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    
    if(strtolower($type)=='post'){
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    }elseif(strtolower($type)=='custom'){
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method_used);
    }
    
    if($params){
        if(strtolower($type)=='custom'){
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        }else{
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
    }

    if($cookie){
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
    }

    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_VERBOSE, true);

    $verbose = fopen('log/curl_log.txt', 'w+');
    curl_setopt($ch, CURLOPT_STDERR, $verbose);

    $response = curl_exec($ch); 
    
    if($response == false)
    {
        $ch_error = curl_error($ch);
        curl_close($ch); 
        return $ch_error;

    }else{

        curl_close($ch); 
        return $response;

    }
    
}

function simplePost($url, $headers, $body){

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $body);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $verbose = fopen('log/curl_log.txt', 'w+');
    curl_setopt($curl, CURLOPT_STDERR, $verbose);

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;

}

?>