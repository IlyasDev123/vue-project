// slider//
$('.partner-slider').owlCarousel({
    loop: true,
    margin: 10,
    nav: false,
    autoplay: true,
    autoplayTimeout: 5000,
    dots: false,
    arrow: false,
    responsive: {
        0: {
            items: 2
        },
        600: {
            items: 3
        },
        1000: {
            items: 5
        }
    }
});


// faq //
// FAQ HIDE AND SHOW
$(document).ready(function () {    
    $('.question').click(function(){
        $(this).siblings('.answer').slideToggle();
        $(this).toggleClass('active')
        $(this).parent().siblings().children('.answer').slideUp();
        $(this).parent().siblings().children('.question').removeClass('active');
    })
});

 // Menu Js - ham burger //
 $(document).ready(function(){
    $(".hamburger").click(function(){
      $(this).toggleClass("is-active");
      $('.menusflex').toggleClass('active');
    });
  });

  $('.testimonials-sleder').slick({
    infinite: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: true,
    autoplay: true,
    autoplaySpeed: 3000,
    responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 2
          }
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1
          }
        }
      ]
  });