/**
 * Created by Sasha on 01.04.2017.
 */
$( document ).ready(function() {
    var $iphoneCat = $('#iphone-cat');
    var $ipadCat = $('#ipad-cat');

    $iphoneCat.click(function (e) {
        var $ipadSubcat = $('#ipad-subcat');
        var $iphoneSubcat = $('#iphone-subcat');

        if($ipadSubcat.css("display") != "none") {
            $ipadSubcat.fadeOut("slow", function () {
                $iphoneSubcat.fadeIn("slow");
            });
        }
        else {
            $iphoneSubcat.fadeIn("slow");
        }

        if($ipadCat.hasClass('active')) {
            $ipadCat.removeClass('active');
        }
        $iphoneCat.toggleClass('active');

    });

    $ipadCat.click(function (e) {
        var $ipadSubcat = $('#ipad-subcat');
        var $iphoneSubcat = $('#iphone-subcat');

        if($iphoneSubcat.css("display") != "none") {
            $iphoneSubcat.fadeOut("slow", function () {
                $ipadSubcat.fadeIn("slow");
            });
        }
        else {
            $ipadSubcat.fadeIn("slow");
        }

        if($iphoneCat.hasClass('active')) {
            $iphoneCat.removeClass('active');
        }
        $ipadCat.toggleClass('active');
    });

    $('.bxslider').bxSlider();

    $('.footer').fadeIn(500);
});