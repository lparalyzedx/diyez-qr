$(window).ready(function () {
    $('#preloader').delay(200).fadeOut('fade');
});

$(document).ready(function(){

    $(".v2_header").sticky({topSpacing:0});
    
    $('.v2_src_btn').click(function() {
        $(this).toggleClass('v2_src_btn_act');
        $('.v2_src_outer').toggleClass('v2_src_outer_act');
        $('.v2_logo, .v2_menu_btn').toggleClass('v2_hidden_class');
        
        if($('.v2_src_outer ').hasClass('v2_src_outer_act')){
        
            setTimeout(function(){ 
                $('.v2_src_outer input').focus()
            }, 300);
    
        }					
        
    });
    
    var xx_slider = new Swiper('.xx_slider',{
        slidesPerView: 1,
        spaceBetween: 0,
        navigation: {
            nextEl: '.ds_right',
            prevEl: '.ds_left',
        },
        loop:false
    });
    
    $('.v2_drop_action').click(function() {
        $(this).next('ul').toggleClass('dropShow');
    });
    
    $('.v2_menu_btn').click(function() {
        $(this).toggleClass('v2_menu_close_btn');
        $('.v2_category_menu').toggleClass('v2_category_menu_act');
        $('html').toggleClass('htmlFixed');
    });

});

document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("languageModal");
    const body = document.body;

   
        modal.style.display = "flex"; 
        body.classList.add("modal-open"); 

    const links = document.querySelectorAll("#languageModal a");
    links.forEach(link => {
        link.addEventListener("click", () => {
            localStorage.setItem("languageSelected", "true");
            body.classList.remove("modal-open"); 
        });
    });
});

