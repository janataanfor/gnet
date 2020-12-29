$(document).ready(function(){

     
     
    $('.carousel').carousel({
        interval:2000,
        
    });

    $('.Carousel').on('slide.bs.carousel', function () {
        
      });

  
  
  
});



$('#sandh').hover(
    function (){
       document.getElementById("huser").className = 'hhh';
       document.getElementById("hlogout").className = 'nav-link sss'; 
    },function (){
        document.getElementById("huser").className = '';
        document.getElementById("hlogout").className = 'nav-link';
}
);

