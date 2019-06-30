jQuery(function($) {
    var $ = jQuery;
    gallerySlick = $(".gallery").slick({
        dots:true,
        speed: 300,
        slidesToShow: 1,
        arrows: true,
        adaptiveHeight: true,
        nextArrow: '<i class="fa fa-angle-right"></i>',
        prevArrow: '<i class="fa fa-angle-left"></i>'
    });
});
function filterCategory(cat) {
    var $ = jQuery;
    $.ajax({
        url: "?ajax=filter_category&categoryid=" + cat,
        cache: false,
        success: function (response) {
            $(".project-tiles-wrapper").html(response).hide().fadeIn();
        }
    });
}