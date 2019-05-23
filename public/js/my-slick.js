$('.product-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    fade: true,
    asNavFor: '.product-slider-min'
});
$('.product-slider-min').slick({
    arrows: false,
    slidesToShow: 5,
    slidesToScroll: 1,
    asNavFor: '.product-slider',
    centerMode: true,
    focusOnSelect: true
});
$('.direction-blocks').slick(
    {
    autoplay:true,
    autoplaySpeed:3000,
    arrows:false,
    draggable:false,
    pauseOnHover:false,
    fade:true,
    speed:2000
    });
$('.stock-slider').slick(
    {
        autoplay:true,
        autoplaySpeed:3000,
        arrows:false,
        draggable:false,
        pauseOnHover:false,
        fade:true,
        speed:2000
    });
