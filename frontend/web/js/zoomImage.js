$(document).ready(function () {
		$('.zoomImage').click(zoomImage);
	}
);

var img_popup_border = 8;


function showImgDesc(alt) {
	
	$(".img_dst").append("<div class=\"desc_image\"><div class=\"in\">"+alt+"</div></div>");
	
	$(".img_dst .desc_image").css('position', 'absolute');
	$(".img_dst .desc_image").css('opacity', '0');
	$(".img_dst .desc_image").css('z-index', '4');

	var imgBorderWidth = parseInt($('.img_dst .big_img').css('border-width'));

	var top = $('.img_dst .big_img').offset().top+$('.big_img').height()+imgBorderWidth*2;
	
	var left = $('.img_dst .big_img').offset().left;
	
	$(".img_dst .desc_image").css('top', top+'px');
	$(".img_dst .desc_image").css('left', left+'px');
	$(".img_dst .desc_image").css('width', ($('.big_img').width()+imgBorderWidth*2)+'px');
	
	$(".img_dst .desc_image").animate( {'opacity': 1}, 400);
	
}

function showCloseBut(but) {
	
	$(".img_dst").append('<div class="close"><svg class="i"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#clear"></use></svg></div>');

    $('.img_dst .close').css('top', ($('.big_img').offset().top)+4+'px').css('left',($('.big_img').offset().left+$('.big_img').width()+'px'));

	$('.img_dst .close').click(function(){
		closePopup(but);
	});
}

function showImage(but) {
	
	$(but).find('img.image_loader').remove();
	$(but).find('img').animate({'opacity':1},200);
	
	$("body").append("<div class=\"img_dst\"><img class=\"big_img\" src=\""+but.attr("href")+"\" alt=\""+but.find('img').attr("alt")+"\" /></div>");
	
	$(".img_dst .big_img").css('position', 'absolute');
	$(".img_dst .big_img").css('opacity', '0');
	$(".img_dst .big_img").css('z-index', '4');
	
	$(".img_dst .big_img").css('width', but.find('img').width()+'px');
	$(".img_dst .big_img").css('height', but.find('img').height()+'px');
	
	$(".img_dst .big_img").css('left', but.find('img').offset().left+"px");
	$(".img_dst .big_img").css('top', but.find('img').offset().top+"px");
	
	var offsetTop = $(document).scrollTop() + $(window).height()/2 - (cache_img.height+40)/2;
    var offsetLeft = $(window).width()/2 - $(document).scrollLeft() - cache_img.width/2;

    if(offsetTop<0) offsetTop=0;
	
	$(".img_dst .big_img").animate( {
			'width':cache_img.width+"px", 
			'height':cache_img.height+"px",
			'left':offsetLeft+"px", 
			'top':offsetTop+"px",
			'opacity': 1
		}, 400, function () { 
			
			showCloseBut(but);
			
			if(but.find('img').attr("alt")) {
				showImgDesc(but.find('img').attr("alt"));
			}
		} 
	);
	
	
	$(".big_img").click(function(){ closePopup(but) });

}

function closePopup(but) {	
	$('.img_dst .desc_image').remove();
	$('.img_dst .close').remove();

	$('.img_dst .big_img').animate(
		{
			width:but.find('img').width()+'px', 
			height:but.find('img').height()+'px', 
			left:but.find('img').offset().left+'px', 
			top: but.find('img').offset().top, 'opacity':0
		}, 300, function() {
			$('.img_dst').remove(); 
		}
	);
}

function zoomImage() {

    $(".img_dst").remove();
    $('.big_img').remove();
    $('.image_loader').remove();
    $('.zoomImage img').css('opacity',1);

    cache_img = new Image();
    cache_img.src = $(this).attr("href");

    // show loading
    $(this).find('> img').animate({'opacity':0.5},500);

    if(cache_img.complete) {
        showImage($(this));
    } else {
        var self = $(this);
        cache_img.onload = function () {
            showImage(self);
        }
    }

    return false;
}