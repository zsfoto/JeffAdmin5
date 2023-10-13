/*!
  * Tempus Dominus v6.7.10 (https://getdatepicker.com/)
  * Copyright 2013-2023 Jeff Shoeameker
  * Licensed under MIT (https://github.com/Eonasdan/tempus-dominus/blob/master/LICENSE)
  */
(function(g,f){typeof exports==='object'&&typeof module!=='undefined'?f(exports):typeof define==='function'&&define.amd?define(['exports'],f):(g=typeof globalThis!=='undefined'?globalThis:g||self,f((g.tempusDominus=g.tempusDominus||{},g.tempusDominus.locales=g.tempusDominus.locales||{},g.tempusDominus.locales.hu={})));})(this,(function(exports){'use strict';const name = 'hu';
const localization = {
	today: 'Ma',
	clear: 'Töröl',
	close: 'Bezár',
    dateFormats: {
        LTS: 'HH:mm:ss',
        LT: 'HH:mm',
        L: 'yyyy.MM.DD.',
        LL: 'yyyy MMMM d.',
        LLL: 'yyyy MMMM d. HH:mm',
        LLLL: 'yyyy. MMMM d. HH:mm',
    },	
	dayViewHeaderFormat: { month: 'long', year: '2-digit' },
	decrementHour: 'Óra csökkentés',
	decrementMinute: 'Perc csökkentés',
	decrementSecond: 'Másodperc csökkentés',
	format: 'L LTS',
	//hourCycle: DefaultFormatLocalization$1.hourCycle,
	incrementHour: 'Óra növelés',
	incrementMinute: 'Perc növelés',
	incrementSecond: 'Másodperc növelés',
	locale: 'hu',
	nextCentury: 'Következő század',
	nextDecade: 'Következő negyedév',
	nextMonth: 'Következő hónap',
	nextYear: 'Következő év',
	ordinal: (n) => `${n}.`,
	pickHour: 'Óra választás',
	pickMinute: 'Perc választás',
	pickSecond: 'Másodperc választás',
	previousCentury: 'Előző század',
	previousDecade: 'Előző negyedév',
	previousMonth: 'Előző hónap',
	previousYear: 'Előző év',
	selectDate: 'Dátum választás',
	selectDecade: 'Negyedév választás',
	selectMonth: 'Hónap választás',
	selectTime: 'Idő választás',
	selectYear: 'Év választása',
	startOfTheWeek: 1,
	today: 'Ugrás a mai napra',
	toggleMeridiem: 'Napszak váltás',	
};
exports.localization=localization;exports.name=name;Object.defineProperty(exports,'__esModule',{value:true});}));