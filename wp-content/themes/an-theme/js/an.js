$(document).ready(function() {
  $('#main-nav .nav-item').mouseenter(function() {
    $(this)
      .children('.nav-dropdown')
      .slideDown()
  })
  $('#main-nav .nav-item').mouseleave(function() {
    $(this)
      .children('.nav-dropdown')
      .slideUp()
  })

  $('#menu-header-menu .menu-item').mouseenter(function() {
    $(this)
      .children('.sub-menu')
      .slideDown()
  })
  $('#menu-header-menu .menu-item').mouseleave(function() {
    $(this)
      .children('.sub-menu')
      .slideUp()
  })

  $('.tab-nav a').click(function(e) {
    e.preventDefault()

    var tabView = $(this).attr('data-tab-name')

    $('.tab-view, .tab-nav a').removeClass('active hidden')
    $('.tab-view').slideUp()
    $(
      '.tab-view[data-tab-view="' +
        tabView +
        '"], .tab-nav a[data-tab-name="' +
        tabView +
        '"]'
    ).slideDown()
    $(
      '.tab-view[data-tab-view="' +
        tabView +
        '"], .tab-nav a[data-tab-name="' +
        tabView +
        '"]'
    ).addClass('active')
  })
})
