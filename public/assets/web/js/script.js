//------------------------------- Trang Index ----------------------------------

// -------------- slider
$(document).ready(function(){
  $('.slider-noibat').slick({
  	dots: true,
		infinite: true,
		speed: 500,
		fade: true,
		arrows: false
		// nextArrow:'<i class="fa fa-chevron-left" aria-hidden="true">'
  });
  $('.slider-news').slick({
		infinite: true,
		speed: 500,
		fade: true,
		arrows: true,
		prevArrow:'<a href="#" title=""><i class="fa fa-chevron-left" aria-hidden="true"></i></a>',
		nextArrow:'<a href="#" title=""><i class="fa fa-chevron-right" aria-hidden="true"></i></a>'
  });
});

//----------- plugin Facebook

$(document).ready(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.2';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));





// ----------------- Video
// $(document).on('click','.video-big',function(){
$('.video-big').click(function(event) {  
    var id = $(this).children('img').attr("data-id");
    $('.video-big img').remove();
    $('.video-big').append('<iframe src="https://www.youtube.com/embed/' + id + '?rel=0&amp;autoplay=1&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>');
    $(this).find('img').remove();
});
$('.video-small').click(function(event) {
	var id = $(this).children('img').attr("data-id");
    $('.video-big img').remove();
    $('.video-big').append('<iframe src="https://www.youtube.com/embed/' + id + '?rel=0&amp;autoplay=1&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>');
   
});





$(document).ready(function(){
  $('.menu-btn').click(function(){
    $(this).children('i').toggleClass('fa-bars').toggleClass('fa-close');
    $('.menu').children('ul').slideToggle(200);

  });

  $('.menu').find("ul li").each(function() {
    if($(this).find("ul>li").length > 0){
      $(this).prepend('<i class="fa fa-angle-down drop-btn " aria-hidden="true"></i>');
    }
  });
  $('.drop-btn').click(function(){
    $(this).toggleClass('fa-angle-up').toggleClass('fa-angle-down');
    $(this).parent('li').children('ul').slideToggle(200);
  });
});

//-------------------------------End Trang Index ----------------------------------




//-------------------------------Trang Product ----------------------------------
$(document).ready(function(){
  $('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    nextArrow: false,
    prevArrow: false,
    fade: true,
    asNavFor: '.slider-nav'
  });
  $('.slider-nav').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    nextArrow: false,
    prevArrow: false,
    asNavFor: '.slider-for',
    centerMode: true,
    focusOnSelect: true,
    adaptiveHeight: true,
    vertical: true
  });
});
//-------------------------------End Trang Product ----------------------------------