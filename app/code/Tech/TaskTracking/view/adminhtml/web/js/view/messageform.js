define([
	"ko",
	"jquery",
	'uiComponent',
	'mage/mage'
], function(ko, $, Component) {
	"use strict";
	
	return Component.extend({
		id: null,
		url: null,
		formKey: null,
		defaults: {
			template: 'Tech_TaskTracking/message_form'
		},
		initialize: function () {
			this._super();
			this.setIdAndFormKey(this.ticketId, this.formKey);
			this.submitInit();
		},
		setIdAndFormKey: function (id, formKey) {
			this.id      = id;
			this.formKey = formKey;
		},
		submitInit: function () {
			var context = this;
			context.url = '' + context.saveMsgAction;
			
			$(document).on('click','.ticket_btn', function () {
				var form = $("#ticket_message_form");
				form.mage('validation');
				if (form.valid()) {
					form.submit();
					
					
				}
				else{
					console.log(222);
				}
			});
		},
		renderErrorMSG: function (message) {
			console.log(message);
		}
	});
});