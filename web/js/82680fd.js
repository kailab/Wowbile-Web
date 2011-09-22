(function($) {
 
var plugin_name = 'wowkipedia';
 
$.fn[plugin_name] = function(options){
    if(typeof options == 'string'){
        var args = Array.prototype.slice.call(arguments,1);
        return $.fn[plugin_name][options].apply(this,args);
    }
    options = getOptions.call(this,options);
    var obj = $(this);

	obj.click(function(){
		showItemGroup.call(obj, this);
		selectItem.call(obj, this);
	});

	var group = getLocationGroup.call(obj);
	var item = getLocationItem.call(obj);
	selectItem.call(obj, item);
	if(group !== undefined){
		group.show();
	}
};

var showItemGroup = function(item){
	var group = getItemGroup.call(this, item);
	showGroup.call(this,group);
};

var getItemGroup = function(item){
    var url = $(item).attr('href');
    if(url === undefined){
    	return url;
    }
	var options = getOptions.call(this);
	var anchor = url.split('#')[1];
	return $('a[name="'+anchor+'"]').closest(options.groupSelector);
};

var showGroup = function(group){
	if(group === undefined){
		return group;
	}
	var obj = $(this);
	var options = getOptions.call(this);
	var groups = $(options.groupSelector).filter(':visible');
	if(group.length == 0){
		group = $(options.emptyGroupSelector);
	}
	var show_group = function(){
		var item = getGroupItem.call(obj, group);
		group.slideDown();
	};
	if(groups.length>0){
		groups.slideUp(show_group);
	}else{
		show_group();
	}
};

var selectItem = function(item){
	if(item === undefined){
		return item;
	}
	var obj = $(this);
	var options = getOptions.call(this);
	obj.removeClass(options.selectedClass);
	$(item).addClass(options.selectedClass);
};

var getGroupItem = function(group){
	if(group === undefined){
		return group;
	}
	var obj = $(this);
	var options = getOptions.call(this);
	var anchor = group.find('a[name]').attr('name');
	if(anchor === undefined){
		return anchor;
	}
	return obj.filter('a[href="#'+anchor+'"]');
};

var getLocationAnchor = function(){
	var url = document.location.href;
	return url.split('#')[1];
};

var getLocationGroup = function(){
	var obj = $(this);
	var options = getOptions.call(this);
	var anchor = getLocationAnchor.call(obj);
	if(anchor === undefined){
		return anchor;
	}
	var sel = 'a[name="'+anchor+'"]';
	var groups = $(options.groupSelector);
	var group = groups.has(sel);
	if(group.length == 0){
		group = $(options.emptyGroupSelector);
	}
	return group;
};

var getLocationItem = function(){
	var obj = $(this);
	var options = getOptions.call(this);
	var anchor = getLocationAnchor.call(obj);
	var sel = 'a[href="#'+anchor+'"]';
	var item = obj.filter(sel);
	if(item.length == 0){
		var group = getLocationGroup.call(obj);
		item = getGroupItem.call(obj, group);
	}
	return item;
};

$.fn[plugin_name].defaults = {
	groupSelector: '.group',
	emptyGroupSelector: '#empty_group',
	selectedClass: 'selected'
};
 
var getOptions = function(options){
    options = $.extend({}, $.fn[plugin_name].defaults, $(this).data(plugin_name), options);
    $(this).data(plugin_name,options);
    return options;
};
 
})(jQuery);