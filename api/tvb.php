<?php
/*
    .php?id=0&hq �o����̨1080P
    .php?id=0 �o����̨720P
    .php?id=1 �o����̨360P
    .php?id=2&hq �o��ؔ�����w�����YӍ̨1080P
    .php?id=2 �o��ؔ�����w�����YӍ̨720P
    .php?id=3 �o��ؔ�����w�����YӍ̨360P
    .php?id=4&hq �¼�ֱ���l��1 1080P��ȫ�����ȣ�
    .php?id=4 �¼�ֱ���l��1 720P
    .php?id=5 �¼�ֱ���l��1 576P
    .php?id=6&hq �¼�ֱ���l��2 1080P��ȫ�����ȣ�
    .php?id=6 �¼�ֱ���l��2 720P
    .php?id=7 �¼�ֱ���l��2 576P
*/
$id = $_GET['id'];
$ids = ['I-NEWS','I-NEWS','I-FINA','I-FINA','NEVT1','NEVT1','NEVT2','NEVT2'];
$hq = $_GET['hq'];
if(!isset($ids[$id])) {
    exit();
};
$header[] = 'CLIENT-IP:127.0.0.1';
$header[] = 'X-FORWARDED-FOR:127.0.0.1';
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,'https://inews-api.tvb.com/news/checkout/live/hd/ott_'.$ids[$id].'_h264?profile=safari');
curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
$data = curl_exec($ch);
curl_close($ch);
$json = json_decode($data);
$url = $json->content->url;
if(isset($hq)) {
    if($id == '4' || $id == '5' || $id == '6' || $id == '7') {
        header('location:'.preg_replace('/&p=(.*?)$/','',$url->hd));
    } else {
        header('location:'.preg_replace('/&p=(.*?)$/','&p=3000',$url->hd));
    };
} else if($id == '0' || $id == '2' || $id == '4' || $id == '6') {
    header('location:'.$url->hd);
} else {
    header('location:'.$url->sd);
};
