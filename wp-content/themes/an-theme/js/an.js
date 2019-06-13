jQuery(document).ready(function() {
  $('#main-nav .nav-item').mouseenter(function() {
    $(this)
      .children('.nav-dropdown')
      .stop()
      .slideDown()
  })
  $('#main-nav .nav-item').mouseleave(function() {
    $(this)
      .children('.nav-dropdown')
      .stop()
      .slideUp()
  })

  $('#responsive-toggle').click(function() {
    $('#responsive-nav')
      .stop()
      .slideToggle()
  })

  $('#responsive-nav .nav-item .nav-dropdown-toggle').click(function(e) {
    e.preventDefault()
    
    $(this)
      .parent()
      .next('.nav-dropdown')
      .stop()
      .slideToggle()

    if($(this).html() == '&darr;' || $(this).html() == '\u2193') {
      $(this).html('\u2191')
    } else {
      $(this).html('\u2193')
    }
  })

  $('.tab-nav a').click(function(e) {
    e.preventDefault()

    var tabView = $(this).attr('data-tab-name')

    var scrollPos = $(window).scrollTop()

    $('.tab-view, .tab-nav a').removeClass('active hidden')
    $('.tab-view').hide()
    $(
      '.tab-view[data-tab-view="' +
        tabView +
        '"], .tab-nav a[data-tab-name="' +
        tabView +
        '"]'
    ).show()
    $(
      '.tab-view[data-tab-view="' +
        tabView +
        '"], .tab-nav a[data-tab-name="' +
        tabView +
        '"]'
    ).addClass('active')
    $(window).scrollTop(scrollPos)
  })

  $('#filter').submit(function(){
    var filter = $('#filter');
    $.ajax({
      url:filter.attr('action'),
      data:filter.serialize(), // form data
      type:filter.attr('method'), // POST
      beforeSend:function(xhr){
        filter.find('button#filterButton').text('Processing...'); // changing the button label
      },
      success:function(data){
        filter.find('button#filterButton').text('Filter results'); // changing the button label back
        $('#response').html(data); // insert data
      }
    });
    return false;
  });
})
