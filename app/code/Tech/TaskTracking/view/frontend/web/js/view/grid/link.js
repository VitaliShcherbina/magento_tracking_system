define([
	'jquery',
	'ko',
	'uiComponent'
],
function ($, ko, component) {
	"use strict";
	
	return component.extend({
		url: null,
		initialize: function (url) {
			this._super();
			this.setUrl(url);
		},
		setUrl: function (url) {
			this.url = url;
		},
		render: function (item) {
			if (this.url && this.url != '') {
				return '<a href="' + this.url + 'id/' + item.ticket_id + '">View</a>';
			}
			else {
				return 'No view url';
			}
		}
	});
});