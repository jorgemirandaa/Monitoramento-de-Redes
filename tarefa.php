<?php
	//$arquivo_xml = simplexml_load_file("mapmarkers.xml");
	$arquivo_xml = new DOMDocument();

	$arquivo_xml->load('/var/www/html/monitoramento/mapmarkers.xml');

	$port = 445;

	for($i=0; $i < $arquivo_xml->getElementsByTagName('marker')->length; $i++){
		$num_ip = $arquivo_xml->getElementsByTagName('marker')->item($i)->getAttribute('ip');
		$conectado = false;
		exec("ping -c 2 ".$num_ip, $conectado, $status);
		
		if ($status ==0) {
			$arquivo_xml->getElementsByTagName('marker')->item($i)->setAttribute('status','positivo.png');
		}else{
			$arquivo_xml->getElementsByTagName('marker')->item($i)->setAttribute('status','negativo.png');
		}
	}

	$arquivo_xml->save('mapmarkers.xml');
?>