<?php
namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\StringTemplateTrait;
die('control 123');
class JeffAdminHelper extends Helper
{
    use StringTemplateTrait;

    protected $_defaultConfig = [
        'errorClass' => 'error',
        'templates' => [
            'label' => '<label for="{{for}}">{{content}}</label>',
        ],
    ];
}	
	
	

/*
namespace App\View\Helper;
use Cake\View\Helper\FormHelper as Helper;

class FormHelper extends Helper
{
    public function control($fieldName, array $options = [])
    {
        $options += [
            'label' => false,
            'class' => 'form-control'
        ];

		die('control 123');

        //[...]

        return parent::control($fieldName, $options);
    }
}
*/

?>
