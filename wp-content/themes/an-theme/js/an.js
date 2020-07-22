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
    var buttonText = filter.find('button#filterButton').text();
    $.ajax({
      url:filter.attr('action'),
      data:filter.serialize(), // form data
      type:filter.attr('method'), // POST
      beforeSend:function(xhr){
        filter.find('button#filterButton').text('Processing...'); // changing the button label
      },
      success:function(data){
        filter.find('button#filterButton').text(buttonText); // changing the button label back
        $('#response').html(data); // insert data
      }
    });
    return false;
  });

  $('.member-modal-open').click(function(e) {
    e.preventDefault()

    var img = $(this).attr('data-img')
    var title = $(this).attr('data-title')
    var desc = $(this).attr('data-desc')

    $('#member-modal .board-img').attr("style", 'background-image: url(' + img + ')')
    $('#member-modal .board-title').html(title)
    $('#member-modal .board-desc').html(desc)
    
    $('#member-modal-container').removeClass('hidden')
    $('#member-modal-container').addClass('flex')
    $('#member-modal').removeClass('hidden')
  })

  $('#member-modal-close', '#member-modal-container').click(function(e) {
    e.preventDefault()

    $('#member-modal-container').addClass('hidden')
    $('#member-modal-container').removeClass('flex')
    $('#member-modal').addClass('hidden')
  })
})

function loadjQuery(e, t) {
  var n = document.createElement('script')
  n.setAttribute('src', e)
  n.onload = t
  n.onreadystatechange = function () {
    if (this.readyState == 'complete' || this.readyState == 'loaded') t()
  }
  document.getElementsByTagName('head')[0].appendChild(n)
}
function main() {
  var $cr = jQuery.noConflict()
  var old_src
  $cr(document).ready(function () {
    $cr('.cr_form').submit(function () {
      $cr(this).find('.clever_form_error').removeClass('clever_form_error')
      $cr(this).find('.clever_form_note').remove()
      $cr(this)
        .find('.musthave')
        .find('input, textarea')
        .each(function () {
          if (
            jQuery.trim($cr(this).val()) == '' ||
            $cr(this).is(':checkbox') ||
            $cr(this).is(':radio')
          ) {
            if ($cr(this).is(':checkbox') || $cr(this).is(':radio')) {
              if (!$cr(this).parent().find(':checked').is(':checked')) {
                $cr(this).parent().addClass('clever_form_error')
              }
            } else {
              $cr(this).addClass('clever_form_error')
            }
          }
        })
      if (
        $cr(this).attr('action').search(document.domain) > 0 &&
        $cr('.cr_form').attr('action').search('wcs') > 0
      ) {
        var cr_email = $cr(this).find('input[name=email]')
        var unsub = false
        if ($cr("input['name=cr_subunsubscribe'][value='false']").length) {
          if (
            $cr("input['name=cr_subunsubscribe'][value='false']").is(':checked')
          ) {
            unsub = true
          }
        }
        if (cr_email.val() && !unsub) {
          $cr.ajax({
            type: 'GET',
            url:
              $cr('.cr_form').attr('action').replace('wcs', 'check_email') +
              $cr(this).find('input[name=email]').val(),
            success: function (data) {
              if (data) {
                cr_email
                  .addClass('clever_form_error')
                  .before(
                    "<div class='clever_form_note cr_font'>" + data + '</div>'
                  )
                return false
              }
            },
            async: false,
          })
        }
        var cr_captcha = $cr(this).find('input[name=captcha]')
        if (cr_captcha.val()) {
          $cr.ajax({
            type: 'GET',
            url:
              $cr('.cr_form').attr('action').replace('wcs', 'check_captcha') +
              $cr(this).find('input[name=captcha]').val(),
            success: function (data) {
              if (data) {
                cr_captcha
                  .addClass('clever_form_error')
                  .after(
                    "<div  class='clever_form_note cr_font'>" + data + '</div>'
                  )
                return false
              }
            },
            async: false,
          })
        }
      }
      if ($cr(this).find('.clever_form_error').length) {
        return false
      }
      return true
    })
    $cr('input[class*="cr_number"]').change(function () {
      if (isNaN($cr(this).val())) {
        $cr(this).val(1)
      }
      if ($cr(this).attr('min')) {
        if ($cr(this).val() * 1 < $cr(this).attr('min') * 1) {
          $cr(this).val($cr(this).attr('min'))
        }
      }
      if ($cr(this).attr('max')) {
        if ($cr(this).val() * 1 > $cr(this).attr('max') * 1) {
          $cr(this).val($cr(this).attr('max'))
        }
      }
    })
    old_src = $cr("div[rel='captcha'] img:not(.captcha2_reload)").attr('src')
    if ($cr("div[rel='captcha'] img:not(.captcha2_reload)").length != 0) {
      captcha_reload()
    }
  })
  function captcha_reload() {
    var timestamp = new Date().getTime()
    $cr("div[rel='captcha'] img:not(.captcha2_reload)").attr('src', '')
    $cr("div[rel='captcha'] img:not(.captcha2_reload)").attr(
      'src',
      old_src + '?t=' + timestamp
    )
    return false
  }
}
