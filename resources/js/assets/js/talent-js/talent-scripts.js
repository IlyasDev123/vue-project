$(document).ready(function(){
    $('#show_password').click(function(e){
        e.preventDefault();
        $('.eye_icon').removeClass('hide__this');
        $(this).addClass('hide__this');
        $('#login__password').attr("type", "text");
    });
});
$(document).ready(function(){
    $('#hide_password').click(function(e){
        e.preventDefault();
        $('.eye_icon').removeClass('hide__this');
        $(this).addClass('hide__this');
        $('#login__password').attr("type", "password");
    });
});
// ========== fiel upload ========
$("#FileInput").on('change',function (e) {
    var labelVal = $(".title").text();
    var oldfileName = $(this).val();
        fileName = e.target.value.split( '\\' ).pop();

        if (oldfileName == fileName) {return false;}
        var extension = fileName.split('.').pop();

    if ($.inArray(extension,['jpg','jpeg','png']) >= 0) {
        $(".filelabel i").removeClass().addClass('fa fa-file-image-o');
        $(".filelabel i, .filelabel .title").css({'color':'#578BFF'});
        $(".filelabel").css({'border':' 2px solid #578BFF'});
    }
    else if(extension == 'pdf'){
        $(".filelabel i").removeClass().addClass('fa fa-file-pdf-o');
        $(".filelabel i, .filelabel .title").css({'color':'#578BFF'});
        $(".filelabel").css({'border':' 2px solid #578BFF'});

    }
else if(extension == 'doc' || extension == 'docx'){
    $(".filelabel i").removeClass().addClass('fa fa-file-word-o');
    $(".filelabel i, .filelabel .title").css({'color':'#578BFF'});
    $(".filelabel").css({'border':' 2px solid #578BFF'});
}
    else{
        $(".filelabel i").removeClass().addClass('fa fa-file-o');
        $(".filelabel i, .filelabel .title").css({'color':'#578BFF'});
        $(".filelabel").css({'border':' 2px solid #578BFF'});
    }

    if(fileName ){
        if (fileName.length > 10){
            $(".filelabel .title").text(fileName.slice(0,10)+'...'+extension);
            $('.sub_title').hide();
        }
        else{
            $(".filelabel .title").text(fileName);
            $('.sub_title').hide();
        }
    }
    else{
        $(".filelabel .title").text(labelVal);
        $('.sub_title').hide();
    }
});
// ============= form tabbing js ==========
$(document).ready(function(){
    $('fieldset[data-behaviour=toggle] .hieen__fieldsLabel').click(function(){
        $(this).parent().toggleClass('active__fieldSets');
        $('.hidden__fieldsWrapper').hide();
        $('fieldset[data-behaviour=toggle].active__fieldSets .hidden__fieldsWrapper').fadeIn(300);
    });
});
// =========== sidebar height ====
var t=0; // the height of the highest element (after the function runs)
var elem;
var t_elem;  // the highest element (after the function runs)
$("*",elem).each(function () {
    $this = $(this);
    if ( $this.outerHeight() > t ) {
        t_elem=this;
        t=$this.outerHeight();
    }
});

var totalHeight = $('body').height();
totalHeight = totalHeight + 133;
totalHeight = $(t_elem).height();
$('aside').css('height', totalHeight+'px');