define([
	"ko",
	"jquery",
	'uiComponent'
], function(ko, $, Component) {
	"use strict";
	
	return Component.extend({
		initialize: function () {
			this._super();
		},
		countInputs: 0,
		add: function () {
			var newInputBlock = this.addNewInputBlock();
			var inputContainer = $(".upload_inputs");
			
			inputContainer.append(newInputBlock);
		},
		addNewInputBlock: function () {
			var mainContainer = $(".upload_inputs");
			
			var container = $("<div />", {class:'input_wrap'});
			var newInput  = $("<input />", {type:'file', name:'attachment[]', class:'attachment'}).attr({"multiple": "multiple", "accept": "image"});
			var removeBtn = $("<span />", {class:'remove_attachment'});
			
			container.append(newInput);
			container.append(removeBtn);
			
			this.countInputs = mainContainer.children().size();
			
			if (this.countInputs >= 5) {
				return false;
			}
			else {
				return container;
			}
		}
	});
});