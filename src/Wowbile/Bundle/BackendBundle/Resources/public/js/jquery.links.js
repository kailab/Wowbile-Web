(function($) {
 
var plugin_name = 'links';
 
$.fn[plugin_name] = function(options){
    if(typeof options == 'string'){
        var args = Array.prototype.slice.call(arguments,1);
        return $.fn[plugin_name][options].apply(this,args);
    }
    options = getOptions.call(this,options);
    
    $(this).each(function(){
        var links = $(this);
        var prototype = links.attr('data-prototype');
        if(prototype === undefined){
            return;
        }
        var append_row = function(){
            var n = links.children().length;
            var html = $(prototype.replace(/\$\$name\$\$/g,n));
            html.addClass(options.rowClass);
            links.append(html);
        };
        append_row();

        links.delegate('input','change',function(){
            var input = $(this);
            var last = links.children().last();
            var row = input.closest('.'+options.rowClass);
            var inputs = row.find('input');
            if(last.has(input).length > 0){
                if(inputs.val()){
                    append_row();
                }
            }else{
                if(!inputs.val()){
                    row.remove();
                }
            }
        });
    });

    return this;
};
 
$.fn[plugin_name].defaults = {
		rowClass: 'link_row'
};
 
var getOptions = function(options){
    options = $.extend({}, $.fn[plugin_name].defaults, $(this).data(plugin_name), options);
    $(this).data(plugin_name,options);
    return options;
};
 
})(jQuery);
