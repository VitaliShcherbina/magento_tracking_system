define([
	'jquery',
	'Magento_Ui/js/modal/modal'
],
function ($) {
	"use strict";
	
	$.widget('Tech_TaskTracking.popup', {
		imagePath: window.attachmentUrl,
		options: {
			modalForm: '#attachment_popup',
			modalButton: '.show_attachment'
		},
		_create: function () {
			this.options.modalOption = this._getModalOptions();
			this._bind();
		},
		_getModalOptions: function () {
			var options = {
				type: 'popup',
				responsive: true,
				title: 'Attachment',
				buttons: [{
					text: $.mage.__('Close'),
					class: '',
					click: function () {
						this.closeModal();
					}
				}]
			};
			
			return options;
		},
		_bind: function () {
			var modalOption = this.options.modalOption;
			var modalForm = this.options.modalForm;
			
			var context = this;
			
			$(document).on('click', this.options.modalButton, function () {
				context.setImage(context.imagePath, this);
				
				$(modalForm).modal(modalOption);
				$(modalForm).trigger('openModal');
			});
		},
		closeModal: function () {
			this.closeModal();
			this.destroyImages();
		},
		setImage: function (path, elem) {
			var popupWrap = $(this.options.modalForm);
			if (popupWrap.children().length > 0) {
				this.destroyImages();
			}
			var data;
			if (!path) {
				data = $("<div />", {class:'message error'}).text("Error loading attachment");
			}
			else {
				var imageName = elem.text;
				path += imageName;
				
				data = $("<img />", {class:'attachment_image'}).attr({"src": path});
			}
			
			popupWrap.append(data);
		},
		destroyImages: function () {
			var popupWrap = $(this.options.modalForm);
			popupWrap.empty();
		}
	});
	
	return $.Tech_TaskTracking.popup;
});