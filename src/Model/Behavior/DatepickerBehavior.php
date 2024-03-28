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
				if ($locale == 'hu_HU') {
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
								$data[$field] = str_replace(" ", "", $data[$field]);
								$data[$field] = (string) date('H:i:s', strtotime($data[$field]));
								$data[$field] = (string) DateTime::parseTime($data[$field], 'HH:mm:ss')->i18nFormat('HH:mm:ss');
								break;
							case 'datetime':
								$date = trim(substr($data[$field], 0, strlen($data[$field])-8));
								if(substr($date, -1) == '-'){
									$date = substr($date, 0, strlen($date)-1);
								}
								$date = str_replace(" ", "", $date);
								$date = str_replace(".", "-", $date);
								$time = substr($data[$field], -8);							
								$data[$field] = $date . ' ' .  $time;
								break;
						}
					}
				}
				
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
		
	}
	
}