<?php

// https://stackoverflow.com/questions/31197051/beforemarshal-does-not-modify-request-data-when-validation-fails
// https://stackoverflow.com/questions/20334355/how-to-get-protected-property-of-object-in-php

namespace JeffAdmin5\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Core\Configure;
use Cake\Event\EventInterface;
use ArrayObject;
use Cake\Datasource\ConnectionManager;
//use Cake\I18n\FrozenDate;
//use Cake\I18n\FrozenTime;
use Cake\I18n\I18n;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\I18n\DateTime;

class DatepickerBehavior extends Behavior
{

    public function beforeMarshal(EventInterface $event, ArrayObject $data, ArrayObject $options)
	{	
		//$locale = Configure::read('App.defaultLocale');
		$locale = I18n::getLocale();
		$table = $event->getSubject()->getTable();
		$db = ConnectionManager::get('default');
		$collection = $db->getSchemaCollection();
		$tables = $collection->listTables();
		$tableSchema = $collection->describe($table);
		$columns = $tableSchema->columns();
		//$name = $tableSchema->name();
		
		foreach($data as $field => $value){	// Nincs benne a created és a modified mező. Hmm!
			$type = $tableSchema->getColumnType($field);
			if (in_array($type, ['date', 'time', 'datetime'])) {
				if (in_array($locale, ['hu', 'hu_HU'])) {
					if(trim($data[$field]) !== ''){
						switch( $type ){
							case 'date': 
								$date = $data[$field];
								$date = str_replace(" ", "", $date);
								$date = str_replace(".", "-", $date);
								if(substr($date, -1) == '-'){
									$date = substr($date, 0, strlen($date)-1);	
								}
								$data[$field] = $date;
								break;
							case 'time': 
								$data[$field] = trim(str_replace(" ", "", $data[$field]));
								if(strlen($data[$field]) == 5){
									$data[$field] .= ':00';
								}
								$data[$field] = (string) date('H:i:s', strtotime($data[$field]));
								$data[$field] = (string) DateTime::parseTime($data[$field], 'HH:mm:ss')->i18nFormat('HH:mm:ss');
								break;
							case 'datetime':
								// 0123 45 67 89 01 23
								// 2020 04 29 06 27 18
								
								//$datetime = $data[$field];
								//$datetime = str_replace(" ", "", $datetime);
								//$datetime = str_replace(".", "", $datetime);
								//$datetime = str_replace(":", "", $datetime);
								//dd($datetime);
								//$datetime = substr($datetime, 0, 4) . '-' . substr($datetime, 4, 2) . '-' . substr($datetime, 6, 2) . ' ' . substr($datetime, 8, 2) . ':' . substr($datetime, 10, 2) . ':' . substr($datetime, 12, 2) ;
								//$data[$field] = $datetime;
								$data[$field] = (string) DateTime::parseDateTime($data[$field], 'YYYY-MM-dd HH:mm:ss')->i18nFormat('YYYY-MM-dd HH:mm:ss');
								break;
						}
					}
				}
				
				//dd($data);
				
				/*
				if ($locale == 'en_GB') {
					list($d, $m, $y) = explode($separator, $data[$field]);
				}
				if ($locale == 'en_US') {
					list($d, $m, $y) = explode($separator, $data[$field]);
				}
				*/

			} // in_array types
		}	// /.foreach
		//dd($data);
		
	}
	
}