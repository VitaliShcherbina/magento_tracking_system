define([
	'jquery',
	'ko',
	'uiComponent',
	'Tech_TaskTracking/js/view/grid/link'
],
function ($, ko, component, linkRenderer) {
	"use strict";
	
	return component.extend({
		items: ko.observableArray([]),
		columns: ko.observableArray([]),
		message: '',
		defaults: {
			template: 'Tech_TaskTracking/grid'
		},
		initialize: function () {
			this._super();
			this._render();
		},
		_render: function() {
			this._prepareColumns();
			this._prepareItems();
		},
		_prepareItems: function () {
			if (!this.ticketsGridData || this.ticketsGridData.length < 0) {
				this.message = 'We could not find any records.';
			}
			else {
				var items = this.ticketsGridData;
				var data = [];
				if (items.length > 0) {
					$.each(items, function(index, value) {
						data.push(JSON.parse(value));
					});
				}
				
				this.addItems(data);
			}
		},
		_prepareColumns: function () {
			
			this.addColumn({headerText: "Ticket ID", rowText: "ticket_id", renderer: ''});
			this.addColumn({headerText: "Department", rowText: "department_name", renderer: ''});
			this.addColumn({headerText: "Last Updated", rowText: "updated_at", renderer: ''});
			this.addColumn({headerText: "Priority", rowText: "priority_value", renderer: ''});
			this.addColumn({headerText: "Status", rowText: "status_value", renderer: ''});
			this.addColumn({headerText: "Action", rowText: "action", renderer: linkRenderer(this.ticketGridViewUrl)});
		},
		addItem: function (item) {
			item.columns = this.columns;
			this.items.push(item);
		},
		addItems: function (items) {
			for (var i in items) {
				this.addItem(items[i]);
			}
		},
		addColumn: function (column) {
			this.columns.push(column);
		},
		sortToggle: function() {
			this.items.reverse();
			this._render();
		}
	});
});