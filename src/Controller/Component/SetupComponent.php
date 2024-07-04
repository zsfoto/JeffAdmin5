<?php
/*
    public function initialize(): void
    {
        parent::initialize();
		$this->loadComponent('Setup');

	}

	#in function:
	
		$setup = $this->Setup->getValue( 'dev_mode', [
			'name' => 'Teszt DEV mode',
			'type' => 'bool',
			'value' => '0'
		]);

		//dd($setup);

*/


declare(strict_types=1);

//namespace App\Controller\Component;
namespace JeffAdmin5\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\Http\Exception\NotFoundException;
use Cake\I18n\DateTime;
use Cake\I18n\Date;
use Cake\I18n\Time;

use Cake\Datasource\FactoryLocator;

//use Cake\ORM\Locator\LocatorAwareTrait;

/**
 * Setup component
 * USE: https://stackoverflow.com/questions/63053131/how-to-use-tableregistry-in-cakephp-component
 */
class SetupComponent extends Component
{
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected array $_defaultConfig = [];

	protected $setupTable;


    /**
     * Initialize controller
     *
     * @return void
     */
	public function initialize(array $config): void
    {
		$this->setupTable = FactoryLocator::get('Table')->get('JeffAdmin5.Setups');
		
	}

	/*	
    * (string) - Converts to data type String
    * (int) - Converts to data type Integer
    * (float) - Converts to data type Float
    * (bool) - Converts to data type Boolean
    * (array) - Converts to data type Array
    * (object) - Converts to data type Object
    * (unset) - Converts to data type NULL

    * (date) - 
    * (time) - 
    * (datetime) - 
	*/
	
    public function getValue($slug, $newValue)
    {
		$setup = $this->setupTable->find('all')->where(['slug' => $slug])->first();
		
		if($setup === null){			
			$setup = $this->setValue($slug, $newValue);
		}
		
		if($setup !== null){
			
			switch($setup->type){

				case "string": 
				case "text": 
				case "richtext": 
					$value = (string) $setup->value;
					break;
					
				case "number": 
				case "integer": 
				case "int": 
					$value = (int) $setup->value;
					break;
					
				case "float": 
					$value = (float) $setup->value;
					break;
					
				case "bool":
				case "boolean":
					$value = (bool) $setup->value;
					break;
					
				case "array": 
					$value = (array) json_decode($setup->value);
					break;
					
				case "json": 
					$value = (array) json_decode($setup->value);
					break;
					
				case "date": 
					$value = new Date($setup->value, 'Europe/Budapest');
					break;
					
				case "time": 
					$value = new Time($setup->value, 'Europe/Budapest');
					break;
					
				case "datetime": 
					$value = new DateTime($setup->value, 'Europe/Budapest');
					break;

				case "object": 
					$value = (object) json_decode($setup->value);
					break;
					
				default:
					$value = "N/A.";
			}
		} else {
			$value = null;
		}
		
        return $value;
		
    }

	
    public function setValue($slug, $data)
    {
		$ret = null;		

		// Add or Update
		$setup = $this->setupTable->find('all')->where(['slug' => $slug])->first();
		if($setup === null){
			$setup = $this->setupTable->newEmptyEntity();
			//$circularletter = $this->Circularletters->patchEntity($circularletter, $data);
			$setup->user_id	= 'default';
			$setup->slug 	= $slug;
			$setup->name 	= $data['name'] 	?? __('New value');
			$setup->type 	= $data['type'] 	?? 'string';
			$setup->editable= $data['editable']	?? true;
		}else{
			$setup = $this->setupTable->patchEntity($setup, $data);
		}
		
		// TypeCasting types
		$setup->value 	= $data['value'];
		if($setup->type == 'array'){
			
		}		

		/*
		if($setup !== null){
			
			switch($setup->type){
				case "string": 
					$setup->value = (string) (string) $setup->value;
					break;
					
				case "number": 
				case "integer": 
				case "int": 
					$setup->value = (string) (int) $setup->value;
					break;
					
				case "float": 
					$setup->value = (string) (float) $setup->value;
					break;
					
				case "bool":
				case "boolean":
					$setup->value = (string) (bool) $setup->value;
					break;
					
				case "array": 
					$setup->value = (string) json_encode($data['value']);
					break;
					
				case "date": 
					$setup->value = (string) new Date($setup->value, 'Europe/Budapest');
					break;
					
				case "time": 
					$setup->value = (string) new Time($setup->value, 'Europe/Budapest');
					break;
					
				case "datetime": 
					$setup->value = (string) new DateTime($setup->value, 'Europe/Budapest');
					break;

				//case "object": 
				//	$setup->value = (object) json_decode($setup->value);
				//	break;
					
				default:
					$value = "N/A.";
			}
		} else {
			$value = null;
		}
		*/

		switch($setup->type){
			case "array": 
				$setup->value = (string) json_encode($data['value']);			
				break;

			case "json": 
				$setup->value = (string) json_encode(json_decode($data['value']));
				break;
				
			case "bool": 
			case "boolean": 
				$setup->value = (string) (int) $data['value'];
				break;

			default:
				$setup->value = (string) $data['value'];
		}

		// Save the Setup record
		if ($this->setupTable->save($setup)) {
			$ret = $setup;
		}

        return $ret;
    }
	
	
}
