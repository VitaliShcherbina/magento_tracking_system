define([
	'jquery',
	'uiComponent',
	'Tech_TaskTracking/js/date-converter'
],
function ($, component, dateConverter) {
	"use strict";
	
	return component.extend({
		format: 'DD.MM.YYYY',
		initialize: function () {
			this._super();
		},
		render: function (item) {
			var format = this.format;
			
			return dateConverter(item.updated_at, format);
		}
	});
});