<?php
namespace JeffAdmin5\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\Core\Configure;
use Cake\Event\EventInterface;
use ArrayObject;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\DateTime;
use Cake\I18n\Date;
use Cake\I18n\Time;
use Cake\I18n\I18n;

class DatepickerBehavior extends Behavior
{

	public function beforeMarshal(EventInterface $event, ArrayObject $data, ArrayObject $options)
	{
		//$locale = Configure::read('App.defaultLocale');
		//$locale = I18n::getLocale();
		$table = $event->getSubject()->getTable();
		$db = ConnectionManager::get('default');
		$collection = $db->getSchemaCollection();
		$tables = $collection->listTables();
		$tableSchema = $collection->describe($table);
		$columns = $tableSchema->columns();

		//$name = $tableSchema->name();
		
		//debug($tableSchema);
		
		foreach ($data as $field => $value) {
			
			$type = $tableSchema->getColumnType($field);
			$column = $tableSchema->getColumn($field);

			//debug($column);
			//debug($type);

			try{
				
				switch($type){
					case 'date':
						if (trim( (string) $value) !== '') {
							$data[$field] = DateTime::parseDateTime($data[$field], 'yyyy-MM-dd')->i18nFormat('yyyy-MM-dd');
						}
						break;
					case 'time':
						if (trim( (string) $value) !== '') {
							$data[$field] = DateTime::parseDateTime($data[$field], 'HH:mm:ss')->i18nFormat('HH:mm:ss');
						}
						break;
					case 'datetime':
						if (trim( (string) $value) !== '') {
							$data[$field] = DateTime::parseDateTime($data[$field], 'yyyy-MM-dd HH:mm:ss')->i18nFormat('yyyy-MM-dd HH:mm:ss');
						}
						break;
				} // switch
					
			}catch(\Exception $e){
				//echo 'Error:'.$e->getMessage();
				return;
			}
						
			
		} // foreach
		
		//die('behavior');		

	}

}

