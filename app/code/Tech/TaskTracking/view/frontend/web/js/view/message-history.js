define([
	'jquery',
	'ko',
	'uiComponent',
	'underscore',
	'Tech_TaskTracking/js/date-converter'
],
function ($, ko, component, _, dateConverter) {
	"use strict";
	
	return component.extend({
		customer: '',
		messages: ko.observableArray([]),
		defaults: {
			template: 'Tech_TaskTracking/message'
		},
		initialize: function () {
			this._super();
			this._render();
		},
		_render: function () {
			this._prepare();
		},
		_prepare: function () {
			var that = this;
			that.customer = that.customerName;
			
			$.each(that.messagesData, function (key, value) {
				that.messages.push(value);
			});
		},
		setTitle: function (name, title) {
			return name + ' (' + title + ')';
		},
		convertDate: function (dateStr, format) {
			return dateConverter(dateStr, format);
		}
	});
});