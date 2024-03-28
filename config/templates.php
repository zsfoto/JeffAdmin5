<?php
return [
	'Templates' => [
		'paginator' => [
			'nextActive' => '<li class="page-item"><a class="page-link" href="{{url}}" title="' . __d('jeff_admin5', 'Next page') . '">{{text}}</a></li>',
			'nextDisabled' => '<li class="page-item disabled"><span class="page-link">{{text}}</span></li>',
			'prevActive' => '<li class="page-item prev"><a rel="prev" class="page-link" href="{{url}}">{{text}}</a></li>',
			'prevDisabled' => '<li class="page-item disabled"><span class="page-link">{{text}}</span></li>',
			'first' => '<li class="page-item first"><a href="{{url}}" class="page-link">{{text}}</a></li>',
			'last' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
			'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
			'current' => '<li class="page-item active" aria-current="page"><span class="page-link">{{text}}</span></li>',
			'ellipsis' => '<li class="page-item ellipsis"><span class="page-link"><i class="fa fa-ellipsis-h" title="' . __d('jeff_admin5', 'Lots of page') . '"></i></span></li>',
			//'counterRange' => '{{start}} - {{end}} of {{count}}',
			//'counterPages' => '{{page}} of {{pages}}',
			//'sort' => '<a href="{{url}}">{{text}}</a>',
			//'sortAsc' => '<a class="asc" href="{{url}}">{{text}}</a>',
			//'sortDesc' => '<a class="desc" href="{{url}}">{{text}}</a>',
			//'sortAscLocked' => '<a class="asc locked" href="{{url}}">{{text}}</a>',
			//'sortDescLocked' => '<a class="desc locked" href="{{url}}">{{text}}</a>',
		],
		'form' => [
			'label' 				=> '',


		/*
			'label' 				=> '<label{{attrs}}>{{text}}</label>',			
		
            'button' 				=> '<button{{attrs}}>{{text}}</button>',
            'checkbox' 				=> '<input type="checkbox" name="{{name}}" value="{{value}}"{{attrs}}>',
            'checkboxFormGroup' 	=> '{{label}}',
            'checkboxWrapper' 		=> '<div class="checkbox">{{label}}</div>',
            'error' 				=> '<div class="error-message" id="{{id}}">{{content}}</div>',
            'errorList' 			=> '<ul>{{content}}</ul>',
            'errorItem' 			=> '<li>{{text}}</li>',
            'file' 					=> '<input type="file" name="{{name}}"{{attrs}}>',
            'fieldset' 				=> '<fieldset{{attrs}}>{{content}}</fieldset>',
            'formStart' 			=> '<form{{attrs}}>',
            'formEnd' 				=> '</form>',
            'formGroup' 			=> '{{input}}',
            'hiddenBlock' 			=> '<div style="display:none;">{{content}}</div>',
            'input' 				=> '<input type="{{type}}" id="{{name}}"{{attrs}}>',
            'inputSubmit' 			=> '<input type="{{type}}"{{attrs}}>',			
            'inputContainer' 		=> '{{content}}',
            'inputContainerError' 	=> 'inputContainerError <div class="input {{type}}{{required}} error">{{content}}{{error}}</div>',
            'label' 				=> '<label{{attrs}}>{{text}}</label>',
            'nestingLabel' 			=> '{{hidden}}<label{{attrs}}>{{input}}{{text}}</label>',
            'legend' 				=> '<legend>{{text}}</legend>',
            'multicheckboxTitle' 	=> '<legend>{{text}}</legend>',
            'multicheckboxWrapper' 	=> '<fieldset{{attrs}}>{{content}}</fieldset>',
            'option' 				=> '<option value="{{value}}"{{attrs}}>{{text}}</option>',
            'optgroup' 				=> '<optgroup label="{{label}}"{{attrs}}>{{content}}</optgroup>',
            'select' 				=> '<select name="{{name}}"{{attrs}}>{{content}}</select>',
            'selectMultiple' 		=> '<select name="{{name}}[]" multiple="multiple"{{attrs}}>{{content}}</select>',
            'radio' 				=> '<input type="radio" name="{{name}}" value="{{value}}"{{attrs}}>',
            'radioWrapper' 			=> '{{label}}',
            'textarea' 				=> '<textarea name="{{name}}"{{attrs}}>{{value}}</textarea>',
            'submitContainer' 		=> '<div class="submit">{{content}}</div>',
            'confirmJs' 			=> '{{confirm}}',
            'selectedClass' 		=> 'selected',
            'requiredClass' 		=> 'required',
		*/
		],

	]

];

?>
