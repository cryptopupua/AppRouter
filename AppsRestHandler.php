<?php
require_once("SimpleRest.php");
require_once("Apps.php");

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppsRestHandler
 *
 * @author god
 */
class AppsRestHandler extends SimpleRest {

        function getAllApps(){       
                $apps = new Apps();
		$rawData = $apps->getAllApps();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No apps found!');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
                
                switch ($requestContentType) {
                    case 'application/json':
                        $response = $this->encodeJson($rawData);
			break;
                    case 'application/xml':
                        $response = $this->encodeXml($rawData);
                        break;
                    default:
                        // 'text/html'
			$response = $this->encodeHtml($rawData);
                        break;
                }
                echo $response;
	}
	
        function getApp($name) {

		$app = new Apps();
		$rawData = $app->getApp($name);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No apps found!');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this->setHttpHeaders($requestContentType, $statusCode);
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeHtml($rawData);
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeXml($rawData);
			echo $response;
		}
	}
        
	public function encodeHtml($responseData) {
	
		$htmlResponse = "<table border='1'>";
		foreach($responseData as $key=>$value) {
    			$htmlResponse .= \sprintf('<tr><td><a href="%s">%s</a></td></tr>', $value, $key);
		}
		$htmlResponse .= "</table>";
		return $htmlResponse;		
	}
	
	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}
	
	public function encodeXml($responseData) {
		// creating object of SimpleXMLElement
		$xml = new SimpleXMLElement('<?xml version="1.0"?><app></app>');
		foreach($responseData as $key=>$value) {
			$xml->addChild($key, $value);
		}
		return $xml->asXML();
	}
}
