<?php

header("Content-Type:text/html;charset=gb2312");

$ip=$_SERVER["REMOTE_ADDR"];

echo $ip;

$url='http://www.ip138.com/ips138.asp?ip='.$ip.'&action=2';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
//����URL�����Է���curl_init������
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/14.0.835.202 Safari/535.1");
//����UA
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//��curl_exec()��ȡ����Ϣ���ļ�������ʽ���أ�������ֱ������� ������ӣ���ʹû��echo,Ҳ���Զ����
$content = curl_exec($ch);
//ִ��
curl_close($ch);
//�ر�


//echo $content;


preg_match('/��վ���ݣ�(.*)<\/li><li>�ο�����1/',$content,$arr);

//var_dump($arr[1]);


header("Content-Type:text/html;charset=utf-8");

$utf8Html = mb_convert_encoding($arr[1], 'utf-8', 'gb2312');

echo ":".$utf8Html;

?>
