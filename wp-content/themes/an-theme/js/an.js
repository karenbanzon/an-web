$(document).ready(function() {
  $('#main-nav .nav-item').mouseenter(function(){
      $(this).children('.nav-dropdown').slideDown();
    }
  );
  $('#main-nav .nav-item').mouseleave(function(){
      $(this).children('.nav-dropdown').slideUp();
    }
  );

  $('#menu-header-menu .menu-item').mouseenter(function(){
      $(this).children('.sub-menu').slideDown();
    }
  );
  $('#menu-header-menu .menu-item').mouseleave(function(){
      $(this).children('.sub-menu').slideUp();
    }
  );
});