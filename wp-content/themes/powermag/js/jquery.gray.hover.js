/*
 * Adipoli jQuery Image Hover Plugin Customized by djwd
 * http://jobyj.in/adipoli
 *
 * Copyright 2012, Joby Joseph
 * Free to use under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 */
(function($) {
    $.fn.adipoli = function(options) {
        // Create some defaults, extending them with any options that were provided
        //hovereffect: normal,sliceDown,sliceDownLeft,sliceUp,sliceUpLeft
        var settings = $.extend( {
            'startEffect'   : 'grayscale',
            'hoverEffect'   : 'normal',
            'imageOpacity'  : 0.5,
            'animSpeed'     : 200,
            
        }, options);
        //wrap it with div
        //$(this).one('load',function(){
        $(this).one('load', function() {
            // do stuff

            $(this).wrap(function(){
                return '<div class="adipoli-wrapper '+$(this).attr('class')+'" style="width:'+$(this).width()+'px; height:'+$(this).height()+'px;"/>';
            });
            $(this).parent().append('<div class="adipoli-before '+$(this).attr('class')+'" style="display:none;width:'+$(this).width()+'px; height:'+$(this).height()+'px;"><img src="'+$(this).attr('src')+'"/></div>');
            $(this).parent().append('<div class="adipoli-after '+$(this).attr('class')+'" style="display:none;width:'+$(this).width()+'px; height:'+$(this).height()+'px;"></div>');
            //set start effect
            if(settings.startEffect=="transparent")
            {
                $(this).hide();
                $(this).siblings('.adipoli-before').css({
                    '-ms-filter': '"progid:DXImageTransform.Microsoft.Alpha(Opacity='+settings.imageOpacity*100+')"',
                    'filter': 'alpha(opacity='+settings.imageOpacity*100+')',
                    '-moz-opacity': settings.imageOpacity,
                    '-khtml-opacity': settings.imageOpacity,
                    'opacity': settings.imageOpacity
                }).show();
            }
            else if(settings.startEffect=="grayscale")
            {
                var element=$(this);
                element.hide();
                element.siblings('.adipoli-before').show();
                element.siblings('.adipoli-before').children('img').each(function(){
                    this.src = grayscale(this.src);
                });
            }

            //binding events for mouseover
            $(this).parent().bind('mouseenter',function(){
                if(settings.hoverEffect=='normal')
                {
                    var element=$(this);
                    element.children('.adipoli-after').html('<img src="'+element.children('img').attr('src')+'"/>').fadeIn(settings.animSpeed);
                }
     
            });
			
            //binding events for mouseleave
            $(this).parent().bind('mouseleave',function(){
                {
                    var element=$(this);
                    element.children('.adipoli-after').html('<img src="'+element.children('img').attr('src')+'"/>').fadeOut(settings.animSpeed);
                }
            });				

        }).each(function() {
            if(this.complete) $(this).load();
        });
        //});
        return $(this);

  
        // Shuffle an array
        function shuffle(arr){
            for(var j, x, i = arr.length; i; j = parseInt(Math.random() * i), x = arr[--i], arr[i] = arr[j], arr[j] = x);
            return arr;
        }
		
        // Grayscale w canvas method
        function grayscale(src) {
	var supportsCanvas = !!document.createElement('canvas').getContext;
	if (supportsCanvas) {
		var canvas = document.createElement('canvas'), 
		context = canvas.getContext('2d'), 
		imageData, px, length, i = 0, gray, 
		img = new Image();
		
			img.src = src;
			canvas.width = img.width;
			canvas.height = img.height;
			context.drawImage(img, 0, 0);
				
			imageData = context.getImageData(0, 0, canvas.width, canvas.height);
			px = imageData.data;
			length = px.length;
			
			for (; i < length; i += 4) {
				gray = px[i] * .3 + px[i + 1] * .70 + px[i + 2] * .11;
				px[i] = px[i + 1] = px[i + 2] = gray;
			}
				
		context.putImageData(imageData, 0, 0);
		return canvas.toDataURL(); 
			}
        }
    };
	
    $.fn._reverse = [].reverse;
})(jQuery);