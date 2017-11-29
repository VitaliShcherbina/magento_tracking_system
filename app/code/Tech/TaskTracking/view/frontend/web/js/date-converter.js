define([
	'moment'
],
function (moment) {
	"use strict";
	
	return function (dateStr, format) {
		var date   = moment(dateStr);
		var result = date.format(format);
		
		return result;
	};
});