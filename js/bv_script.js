// $(document).ready(function() {

//     if (hasTouch()) {
//         $('.menu-btn').on('click', function(e) {
//             e.stopPropagation();
//             if ($('.animated-icon1').hasClass('open')) {
//                 $('.animated-icon1').removeClass('open');
//                 $('.slide_menu').removeClass('active');
//             } else {
//                 $('.animated-icon1').addClass('open');
//                 $('.slide_menu').addClass('active');
//             }
//         });
//     }
//     //  else {
//     //     $('.menu-btn').on('mouseover', function() {
//     //         // if (preventMenuOver) {
//     //         //     // preventMouseOver = false;
//     //         //     return;
//     //         // }
//     //         $('.animated-icon1').addClass('open');
//     //         $('.slide_menu').addClass('active');
//     //         //preventMenuOver = true;

//     //     });
//     // }
//     $('body').on('click', function(e) {

//         if ($('.animated-icon1').hasClass('open')) {
//             $('.animated-icon1').removeClass('open');
//             $('.slide_menu').removeClass('active');
//             $('.menu-btn').css('display', 'block');
//             // preventMenuOver = true;
//             // setTimeout(function() {
//             //     preventMenuOver = false;
//             // }, 1500);
//         }
//     });
// });

// function hasTouch() {
//     return 'ontouchstart' in document.documentElement ||
//         navigator.maxTouchPoints > 0 ||
//         navigator.msMaxTouchPoints > 0;
// }

jQuery(function($) {

    $('body').on('change', '.qty', function() { // поле с количеством имеет класс .qty
        $('[name="update_cart"]').trigger('click');
    });

});