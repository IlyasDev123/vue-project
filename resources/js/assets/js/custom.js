
$('.open_search').on('click', function(event){
    event.stopPropagation();
  
    $('.search_block').toggleClass('visible');
    $('.search_block .search_input').focus();
});
  
$('body').on('click', function(){
    $('.search_block').removeClass('visible');
});
  
$('.search_box').on('click', function(event){
    event.stopPropagation();
});
  
$('.search_input').on('keyup', function(event){
    if($(this).val() !== ''){
        $(this).addClass('typing');
    } else {
        $(this).removeClass('typing');
    }
});







// Input Placeholder
$(document).ready(function (){
    if ($(".form__field[placeholder]")[0]){
        $('.form__field[placeholder]').placeholderLabel({
            labelSize: "12px",
            fontStyle:"normal",
            timeMove: 200
        });
    }
})


$('.user__profile-img').click(function(){
    $('.user__popup').toggleClass('show');
})

// Notification Dropdown
$('.notification__icon').click(function(){
    $('.notification__dropdown').toggleClass('show');
})


// User Popup
$('.user__popup-btn').click(function(){
    $('.user__popup').addClass('visible');
})
$('.user__popup-overlay').click(function(){
    $('.user__popup').removeClass('visible');
})

// Send Notification
$('.send__notification').click(function(){
    $('.notification__popup').addClass('visible');
})
$('.notification__overlayer').click(function(){
    $('.notification__popup').removeClass('visible');
})

// Burger Menu
$('.burger__menu-strip').click(function(){
    $('.side__bar').addClass('visible');
})
$('.side__bar-cross').click(function(){
    $('.side__bar').removeClass('visible');
})


// Filter Menu
$('.filter__btn').click(function(){
    $('.filter__dropdown').toggleClass('visible');
});



