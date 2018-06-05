<?
	if(isset ($_POST['title'])) {$title=$_POST['title'];}
	if(isset ($_POST['name'])) {$name=$_POST['name'];}
	if(isset ($_POST['phone'])) {$phonenum=$_POST['phone'];}
	if(isset ($_POST['ready'])) {$ready=$_POST['ready'];}
	if(isset ($_POST['area'])) {$area=$_POST['area'];}
	if(isset ($_POST['floor'])) {$floor=$_POST['floor'];}
	if(isset ($_POST['tech'])) {$tech=$_POST['tech'];}

	$to = "mashtalir_sasha@ukr.net"; // Замениь на емаил клиента

	$message = "Форма: $title <br><br>";
	if ( $name || $phonenum || $ready || $area || $floor || $tech ) {
		$message .= ""
			. ( $name ? "Имя:  $name <br>" : "")
			. ( $phonenum ? "Телефон:  $phonenum <br>" : "")
			. ( $ready  ? "Уже есть готовый проект, интересует стоимость строительства <br>" : "")
			. ( $area  ? "Площадь дома: $area <br>" : "")
			. ( $floor  ? "Кол-во этажей: $floor <br>" : "")
			. ( $tech  ? "Технология стоительства: $tech <br>" : "");
	}

	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=UTF-8\r\n";
	$headers .= "From: no-reply@alfaproject.com"; // Заменить домен на домен клиента

	if (!$title && !$phonenum) {
	} else {
		mail($to,"New lead(alfaproject.com)",$message,$headers); // Заменить домен на домен клиента
	}
?>