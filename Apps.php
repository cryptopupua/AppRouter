<?php

require_once('common.php');
/**
 * Description of Apps
 *
 * @author god
 */
class Apps {

	private $apps = [];
        /*
		you should hookup the DAO here
	*/
       public function __construct() {
           $rawdata = Common::readDirectory(BASE_PATH);
           $server_name = \filter_input( INPUT_SERVER,"SERVER_NAME");
           foreach ($rawdata as $value){
               $this->apps += [$value => \sprintf("http://%s.%s",  $value , $server_name ) ]; 
           } 
       }
        
	public function getAllApps(){
		return $this->apps;
	}

        public function getApp($name){
                if (\array_key_exists($name, $this->apps)) {
                    $app = array($name => $this->apps[$name]);
                }
		return \is_set($app) ? $app : null;
	}
        
}
