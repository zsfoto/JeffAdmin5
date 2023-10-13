$(document).ready(function() {
    $(function() {  
		$('[data-bs-toggle="tooltip"]').tooltip()


		$('#collapseSearch').on('shown.bs.collapse', function () {
			$("#search").focus();
		});
		
		$(".card-body").animate({opacity: 1}, 500);

	});
});


function jeffAdminInitShowMore(content){

}


function old_jeffAdminInitShowMore(minHeight, txtMore, txtLess, speed){
	if(minHeight === undefined){
		minHeight = 100
	}
	if(txtMore === undefined){
		txtMore = 'more content'
	}
	if(txtLess === undefined){
		txtLess = 'less content'
	}
	if(speed === undefined){
		speed = 250
	}

	$('.show-more').showMore({
		minheight: minHeight,
		buttontxtmore: '&darr;&nbsp;' + txtMore + '&nbsp;&darr;',
		buttontxtless: '&uarr;&nbsp;' + txtLess + '&nbsp;&uarr;',
		//buttoncss: 'my-button-css',
		animationspeed: speed
	});
}


function jeffAdminSwalAlert(title, text, icon, buttonText){
	if(title === undefined){
		title = ''
	}
	if(text === undefined){
		text = ''
	}
	if(icon === undefined){
		icon = 'info'
	}
	if(buttonText === undefined){
		buttonText = 'O.k.'
	}

	Swal.fire({
	  title: title,
	  text: text,
	  icon: icon,
	  confirmButtonText: buttonText
	})

}

// https://github.com/akquinet/jquery-toastmessage-plugin
function jeffAdminToastMessage(text, type, stayTime, position, sticky){
	if(text === undefined){
		text = ''
	}
	if(type === undefined){
		type = 'success'
	}
	if(stayTime === undefined){
		stayTime = 5000
	}
	if(position === undefined){
		position = 'top-right'
	}
	if(sticky === undefined){
		sticky = false
	}

	$().toastmessage('showToast', {
		text     : text,
		type     : type,		// notice, success, warning, error
		stayTime : stayTime,
		position : position,
		sticky   : sticky,
		close    : function () {
			//console.log("toast is closed ...");
		}
	});	
}

// https://summernote.org/getting-started/#installation
function jeffAdminInitSummerNote(field, height, placeholder, lang, tabsize){
	
	if(field === undefined){
		field = 'missing-field'
	}
	if(height === undefined){
		height = 400
	}
	if(height === undefined){
		placeholder = ''
	}
	if(height === undefined){
		lang = 'hu-HU' // default: 'en-US' 
	}
	if(tabsize === undefined){
		tabsize = 2
	}
	
	$('#' + field).summernote({
		placeholder: placeholder,
		tabsize: tabsize,
		height: height,
		lang: lang
	});
}

// Show More text
function jeffAdminShowMore(height, moreText, lessText){
	if(height === undefined){
		height = 70
	}
	if(moreText === undefined){
		moreText = "több..."
	}
	if(lessText === undefined){
		lessText = "...kevesebb"
	}
	$('.read-more').readMore({
		readMoreHeight: height,
		readMoreText: moreText,
		readLessText: lessText
	});
}

// file:///D:/www/My/www/PikeAdmin/src/assets/plugins/bootstrap-input-spinner-bs-5/index.html
function jeffAdminInitInputSpinner(){
	$("input[type='number']").inputSpinner()
}

function jeffAdminInitSelectPicker(){
	$('select').selectpicker();
}

// Date picker
function jeffAdminInitDatePicker(field, value){
	const datepicker = new tempusDominus.TempusDominus(document.getElementById(field), {		
		localization: {locale: 'hu', format: 'L', dayViewHeaderFormat: { month: 'long', year: 'numeric' } },
		display: {
			icons: {type: 'icons', time: 'fa fa-clock-o', date: 'fa fa-calendar', up: 'fa fa-arrow-up', down: 'fa fa-arrow-down', previous: 'fa fa-chevron-left', next: 'fa fa-chevron-right', today: 'fa fa-calendar-check-o', clear: 'fa fa-times', close: 'fa fa-check'},
			buttons: {today: true, clear: true,close: true},
			components: { calendar: true, date: true, month: true, year: true, decades: true, clock: false, hours: false, minutes: false, seconds: false, useTwentyfourHour: undefined},
		},
	});
	if(value !== undefined){
		datepicker.dates.setValue(datepicker.dates.parseInput(new Date(moment(value, 'YYYY-MM-DD'))), datepicker.dates.lastPickedIndexs);		
	}
}

// DateTime picker
function jeffAdminInitDateTimePicker(field, value){
	const datetimepicker = new tempusDominus.TempusDominus(document.getElementById(field), {
		localization: { locale: 'hu', format: 'L LTS', dayViewHeaderFormat: { month: 'long', year: 'numeric' }},
		display: {
			//dayViewHeaderFormat: { month: 'long', year: '4-digit' },	
			icons: {type: 'icons', time: 'fa fa-clock-o', date: 'fa fa-calendar', up: 'fa fa-arrow-up', down: 'fa fa-arrow-down', previous: 'fa fa-chevron-left', next: 'fa fa-chevron-right', today: 'fa fa-calendar-check-o', clear: 'fa fa-times', close: 'fa fa-check'},
			sideBySide: true,
	        buttons: { today: true, clear: true, close: true},
			components: {calendar: true, date: true, month: true, year: true, decades: true, clock: true, hours: true, minutes: true, seconds: true, useTwentyfourHour: true},
		},
	});
	if(value !== undefined){
		datetimepicker.dates.setValue(datetimepicker.dates.parseInput(new Date(moment(value, 'YYYY-MM-DD HH:mm:ss'))), datetimepicker.dates.lastPickedIndexs);
	}
}


// Time picker
function jeffAdminInitTimePicker(field, value){
	const timepicker = new tempusDominus.TempusDominus(document.getElementById(field), {
		localization: {locale: 'hu', format: 'LTS'},
		display: {
			//viewMode: 'clock',
			icons: { type: 'icons', time: 'fa fa-clock-o', date: 'fa fa-calendar', up: 'fa fa-arrow-up', down: 'fa fa-arrow-down', previous: 'fa fa-chevron-left', next: 'fa fa-chevron-right', today: 'fa fa-clock-o', clear: 'fa fa-times', close: 'fa fa-check' },
			buttons: {today: true, clear: true, close: true},
			components: {decades: false, year: false, month: false, date: false, hours: true, minutes: true, seconds: true},			
		},		
	});
	//const parsedDate = timepicker.dates.parseInput(new Date(0, 0, 0, 12, 23, 45));
	if(value !== undefined){
		timepicker.dates.setValue(timepicker.dates.parseInput(new Date(moment('2000-01-01 ' + value, 'YYYY-MM-DD HH:mm:ss'))), timepicker.dates.lastPickedIndexs);
	}
}





/*
//	$(function () {
$(document).ready(function() {
		
		// --------------------- FORM --------------------------
		// Select2:
		$('.select2').select2({
			theme: 'bootstrap-5',
			placeholder: 'Kérem válasszon...'
		});		
		
		$('.select-multi').select2({	// A multinál nem jó a bootstrap css, ezért marad az alap.
			//theme: 'bootstrap',	// Itt nem kell a stílus, mert eddig nincs jó az 5-öshöz...
			placeholder: 'Kérem válasszon...'
		});		

		$('.select2').on('select2:open', function (e) {
			//console.log('Open');
			//$('.select2-container .select2-selection--multiple').css('height', 75);
		});		


	});
*/