<?
$user=array(
  'USER_LOGIN'=>'office@pmg.kiev.ua',
  'USER_HASH'=>'0c6b12207c887f5f11802a9268311ec8'
);
$subdomain='alfap';
$link='https://'.$subdomain.'.amocrm.com/private/api/auth.php?type=json';
$curl=curl_init();
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
curl_setopt($curl,CURLOPT_URL,$link);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($user));
curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
curl_setopt($curl,CURLOPT_HEADER,false);
curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt');
curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt');
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
$out=curl_exec($curl);
$code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
curl_close($curl);

// Обьявляем переменные
$lead_tite = $_POST['title']; //Здесь вписать название форм
if (isset($_POST['name'])) {
	$name = $_POST['name'];
} else {
	$name = 'без имени';
}
$mobile =  $_POST['phone'];

$comments = "";
	if ( $ready || $area || $floor || $tech ) {
		$comments .= ""
			. ( $ready  ? "Уже есть готовый проект, интересует стоимость строительства \n" : "")
			. ( $area  ? "Площадь дома: $area \n" : "")
			. ( $floor  ? "Кол-во этажей: $floor \n" : "")
			. ( $tech  ? "Технология стоительства: $tech \n" : "");
	}

$leads['request']['leads']['add']=array(
  array(
    'name'=>$lead_tite,
    'tags'=>'landing_building',
    //'date_create'=>1298904164, //optional
    //'status_id'=>15070879,
    'custom_fields'=>array(
      array(
        #commnets
        'id'=>946263,
        'values'=>array(
          array(
            'value'=>$comments,
          )
        )
      ),
    )
  ),
);
$link='https://'.$subdomain.'.amocrm.com/private/api/v2/json/leads/set';
$curl=curl_init(); #Сохраняем дескриптор сеанса cURL
#Устанавливаем необходимые опции для сеанса cURL
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
curl_setopt($curl,CURLOPT_URL,$link);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($leads));
curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
curl_setopt($curl,CURLOPT_HEADER,false);
curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
$out=curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
$code=curl_getinfo($curl,CURLINFO_HTTP_CODE);
$sll0 = json_decode($out, true); 
$leads_id = $sll0['response']['leads']['add'][0]['id'];
$contacts['request']['contacts']['add']=array(
  array(
    'name'=>$name, #Имя контакта
    'linked_leads_id'=>$leads_id, #ID сделки
    'custom_fields'=>array(
      array(
        #Телефоны
        'id'=>566584,
        'values'=>array(
          array(
            'value'=>$mobile,
            'enum'=>'MOB'
          )
        )
      ),
    )
  )
);

$link='https://'.$subdomain.'.amocrm.com/private/api/v2/json/contacts/set';
$curl=curl_init();
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-API-client/1.0');
curl_setopt($curl,CURLOPT_URL,$link);
curl_setopt($curl,CURLOPT_CUSTOMREQUEST,'POST');
curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($contacts));
curl_setopt($curl,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));
curl_setopt($curl,CURLOPT_HEADER,false);
curl_setopt($curl,CURLOPT_COOKIEFILE,dirname(__FILE__).'/cookie.txt');
curl_setopt($curl,CURLOPT_COOKIEJAR,dirname(__FILE__).'/cookie.txt');
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,0);
$out=curl_exec($curl);
?>