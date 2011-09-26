(function($) {
 
var plugin_name = 'slidemenu';
 
$.fn[plugin_name] = function(options){
    if(typeof options == 'string'){
        var args = Array.prototype.slice.call(arguments,1);
        return $.fn[plugin_name][options].apply(this,args);
    }
    options = getOptions.call(this,options);
    var obj = $(this);
	var list = obj.find(options.listSelector);
	var sel = options.listElementSelector;
    list.delegate(sel,'click', function(){
		selectItem.call(obj, $(this));
	});
    list.delegate(sel+' a','click', function(){
    	$(this).closest(sel).click();
    	return false;
    });
    var next = obj.find(options.nextSelector);
    next.click(function(){
    	var item = getNextItem.call(obj);
    	if(item !== undefined && item.length > 0){
    		selectItem.call(obj, item);
    	}
    });
    var prev = obj.find(options.previousSelector);
    prev.click(function(){
    	var item = getPreviousItem.call(obj);
    	if(item !== undefined && item.length > 0){
    		selectItem.call(obj,item);
    	}
    });
    var item = getLocationItem.call(obj);
    if(item.length == 0){
    	item = getCurrentItem.call(obj);
    }
    selectItem.call(obj, item);
    return this;
};

var selectItem = function(item){
	var obj = $(this);
    var options = getOptions.call(this);
    var sections = $(options.sectionSelector);
	var list = obj.find(options.listSelector);
	var items = list.find(options.listElementSelector);
	var section = undefined;
	items.removeClass(options.listElementSelectedClass);
	if(item !== undefined && item.length > 0){
		item.addClass(options.listElementSelectedClass);
		moveItemToCenter.call(obj, item);
		section = getItemSection.call(obj, item);
		setItemAnchor.call(obj, item);
	}
	sections.hide();
	if(section !== undefined){
		section.show();
	}
};

var setItemAnchor = function(item){
	var url = item.find('a[href]').attr('href');
	if(url !== undefined){
		var anchor = url.split('#')[1];
	    var elem = $('a[name="'+anchor+'"]');
	    elem.attr('name',anchor+'-tmp');
		window.location.hash = anchor;
	    elem.attr('name',anchor);
	}
};

var moveItemToCenter = function(item){
	var obj = $(this);
    var options = getOptions.call(this);
	var list = obj.find(options.listSelector);
	var wrapper = list.parent();
	var x = wrapper.innerWidth()/2;;
	list.find(options.listElementSelector).each(function(){
		if($(this).hasClass(options.listElementSelectedClass)){
			x -= $(this).outerWidth()/2;
			return false;
		}
		x -= $(this).outerWidth();
	});
	list.animate({left: x});
};

var getCurrentItem = function(){
	var obj = $(this);
    var options = getOptions.call(this);
	var list = obj.find(options.listSelector);
	return list.find('.'+options.listElementSelectedClass);
};

var getNextItem = function(){
    var options = getOptions.call(this);
	var item = getCurrentItem.call(this);
	if(item === undefined){
		return item;
	}
	return item.next(options.listElementSelector);
};

var getPreviousItem = function(){
    var options = getOptions.call(this);
	var item = getCurrentItem.call(this);
	if(item === undefined){
		return item;
	}
	return item.prev(options.listElementSelector);
};

var getLocationItem = function(){
	var obj = $(this);
	var options = getOptions.call(this);
	var url = document.location.href;
	var anchor = url.split('#')[1];
	var list = obj.find(options.listSelector);
	var a = list.find('a[href="#'+anchor+'"]');
	return a.closest(options.listElementSelector);
};

var getItemSection = function(item){
    var options = getOptions.call(this);
	var url = item.find('a').attr('href');
	if(url === undefined){
		return url;
	}
	var anchor = url.split('#')[1];
    var sections = $(options.sectionSelector);
	var section = undefined;
	sections.each(function(){
		if($(this).find('a[name="'+anchor+'"]').length > 0){
			section = $(this);
			return false;
		}
	})
	return section;
};
 
$.fn[plugin_name].defaults = {
	sectionSelector: '.section',
	listSelector: 'ul',
	listElementSelector: 'li',
	listElementSelectedClass: 'selected',
	previousSelector: '.previous',
	nextSelector: '.next'
};
 
var getOptions = function(options){
    options = $.extend({}, $.fn[plugin_name].defaults, $(this).data(plugin_name), options);
    $(this).data(plugin_name,options);
    return options;
};
 
})(jQuery);