define([
	'jquery',
	'ko',
	'uiComponent',
	'Tech_TaskTracking/js/view/grid/link',
	'Tech_TaskTracking/js/view/grid/date',
	'underscore'
],
function ($, ko, component, linkRenderer, dateRenderer, _) {
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
			this.addColumn({headerText: "Ticket ID", rowText: "ticket_id", sortClass: 't_desc', renderer: ''});
			this.addColumn({headerText: "Department", rowText: "department_name", sortClass: '', renderer: ''});
			this.addColumn({headerText: "Last Updated", rowText: "updated_at", sortClass: '', renderer: dateRenderer()});
			this.addColumn({headerText: "Priority", rowText: "priority_value", sortClass: '', renderer: ''});
			this.addColumn({headerText: "Status", rowText: "status_value", sortClass: '', renderer: ''});
			this.addColumn({headerText: "Action", rowText: "action", sortClass: '', renderer: linkRenderer(this.ticketGridViewUrl)});
		},
		addItem: function (item) {
			item.columns = this.columns;
			this.items.push(item);
		},
		addItems: function (items) {
			for (var i in items) {
				if (items.hasOwnProperty(i)) {
					this.addItem(items[i]);
				}
				
			}
		},
		addColumn: function (column) {
			this.columns.push(column);
		},
		sortToggle: function(data) {
			var sortRowName  = data.rowText;
			if (sortRowName == 'action') {
				return;
			}
			var cloneItems   = _.clone(this.items());
			var cloneColumns = _.clone(this.columns());
			
			if (!data.sortClass) {
				$.each(cloneColumns, function (key, column) {
					if (column.rowText == sortRowName) {
						column.sortClass = column.sortClass == 't_desc' ? 't_asc' : 't_desc';
						data.sortClass = column.sortClass;
					}
					else {
						if (column.sortClass) {
							column.sortClass = '';
						}
					}
					
				});
				
				this._reRender(cloneColumns, cloneItems, data);
			}
			else {
				$.each(cloneColumns, function (key, column) {
					if (column.rowText == sortRowName) {
						column.sortClass = column.sortClass == 't_desc' ? 't_asc' : 't_desc';
						data.sortClass = column.sortClass;
					}
				});
				
				this._reRender(cloneColumns, cloneItems, data);
			}
		},
		_reRender: function (columns, items, sortRule) {
			var that = this;
			that._destroyData();
			$.each(columns, function (key, column) {
				that.addColumn(column);
			});
			
			var sorted = _.sortBy(items, sortRule.rowText);
			that.addItems(sorted);
			if (sortRule.sortClass == 't_desc') {
				that.items.reverse();
			}
		},
		_destroyData: function () {
			this.columns.removeAll();
			this.items.removeAll();
		}
	});
});