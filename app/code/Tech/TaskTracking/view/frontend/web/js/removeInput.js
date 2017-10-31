define([
	"jquery"
], function($) {
	"use strict";
	
	$(document).on('click','.remove_attachment',function(){
		$(this).parent().remove();
	});
});