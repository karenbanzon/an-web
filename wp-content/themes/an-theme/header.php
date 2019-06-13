<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width" />
  <link href="<?php echo get_template_directory_uri() ?>/styles/font-hurme.css" rel="stylesheet">
  <link href="<?php echo get_template_directory_uri() ?>/styles/style.css" rel="stylesheet">
  <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo get_template_directory_uri() ?>/assets/favicons/apple-touch-icon-57x57.png" />
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri() ?>/assets/favicons/apple-touch-icon-114x114.png" />
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri() ?>/assets/favicons/apple-touch-icon-72x72.png" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri() ?>/assets/favicons/apple-touch-icon-144x144.png" />
  <link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php echo get_template_directory_uri() ?>/assets/favicons/apple-touch-icon-60x60.png" />
  <link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo get_template_directory_uri() ?>/assets/favicons/apple-touch-icon-120x120.png" />
  <link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo get_template_directory_uri() ?>/assets/favicons/apple-touch-icon-76x76.png" />
  <link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo get_template_directory_uri() ?>/assets/favicons/apple-touch-icon-152x152.png" />
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri() ?>/assets/favicons/favicon-196x196.png" sizes="196x196" />
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri() ?>/assets/favicons/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri() ?>/assets/favicons/favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri() ?>/assets/favicons/favicon-16x16.png" sizes="16x16" />
  <link rel="icon" type="image/png" href="<?php echo get_template_directory_uri() ?>/assets/favicons/favicon-128.png" sizes="128x128" />
  <meta name="application-name" content="Accountable Now"/>
  <meta name="msapplication-TileColor" content="#F2B520" />
  <meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri() ?>/assets/favicons/mstile-144x144.png" />
  <meta name="msapplication-square70x70logo" content="<?php echo get_template_directory_uri() ?>/assets/favicons/mstile-70x70.png" />
  <meta name="msapplication-square150x150logo" content="<?php echo get_template_directory_uri() ?>/assets/favicons/mstile-150x150.png" />
  <meta name="msapplication-wide310x150logo" content="<?php echo get_template_directory_uri() ?>/assets/favicons/mstile-310x150.png" />
  <meta name="msapplication-square310x310logo" content="<?php echo get_template_directory_uri() ?>/assets/favicons/mstile-310x310.png" />

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <div id="wrapper" class="hfeed">
    <header>
      <nav class="flex items-center justify-between flex-wrap bg-white border-b-4 border-anblue px-2 py-2">
        <div id="branding" class="flex flex-wrap items-center w-3/4 sm:w-3/4 md:w-3/4">
          <a href="<?php echo get_home_url() ?>"><img id="logo" src="<?php echo get_template_directory_uri() ?>/assets/images/an-logo.svg"></a>
          <a href="<?php echo get_home_url() ?>" id="site-title" class="flex font-semibold text-xl lg:text-lg text-grey-darkest tracking-tight pl-2 lg:pl-1 pr-2">Accountable Now</a>
          <nav id="main-nav" class="hidden lg:block">
            <ul class="list-reset">
              <li class="nav-item group inline-block px-1 py-4">
                <a href="<?php echo get_home_url() ?>/about-us/" class="block w-full lg:w-auto lg:flex pt-6 lg:pt-1 lg:pl-2 text-grey hover:text-anblue group-hover:text-anblue">About us &darr;</a>
                <ul class="nav-dropdown list-reset ml-2 p-2 z-10 bg-white shadow hidden">
                  <!-- <a href="<?php echo get_home_url() ?>/about-us/dynamic-accountability/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Dynamic Accountability</a> -->
                  <a href="<?php echo get_home_url() ?>/about-us/our-strategy/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Our strategy</a>
                  <a href="<?php echo get_home_url() ?>/about-us/our-members/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Our members</a>
                  <!-- <a href="<?php echo get_home_url() ?>/about-us/governance/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Governance</a> -->
                  <a href="<?php echo get_home_url() ?>/about-us/team-and-governance/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Team</a>
                  <!-- <a href="<?php echo get_home_url() ?>/about-us/annual-general-meeting/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Annual general meeting</a> -->
                </ul>
              </li>
              <li class="nav-item group inline-block px-1 py-4">
                <a href="<?php echo get_home_url() ?>/our-work/" class="block w-full lg:w-auto lg:flex pt-6 lg:pt-1 lg:pl-2 text-grey hover:text-anblue group-hover:text-anblue">Our work &darr;</a>
                <ul class="nav-dropdown list-reset ml-2 p-2 z-10 bg-white shadow hidden">
                  <a href="<?php echo get_home_url() ?>/our-work/our-approach-to-accountability/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Our approach to accountability</a>
                  <a href="<?php echo get_home_url() ?>/our-work/12-accountability-commitments/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">12 accountability commitments</a>
                  <a href="<?php echo get_home_url() ?>/our-work/reporting/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Reporting</a>
                  <!-- <a href="<?php echo get_home_url() ?>/our-work/feedback-and-complaints/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Feedback & complaints</a> -->
                  <a href="<?php echo get_home_url() ?>/our-work/projects-and-partnerships/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Projects & partnerships</a>
                </ul>
              </li>
              <li class="nav-item group inline-block px-1 py-4">
                <a href="<?php echo get_home_url() ?>/our-accountability/" class="block w-full lg:w-auto lg:flex pt-6 lg:pt-1 lg:pl-2 text-grey hover:text-anblue group-hover:text-anblue">Our accountability &darr;</a>
                <ul class="nav-dropdown list-reset ml-2 p-2 z-10 bg-white shadow hidden">
                  <a href="<?php echo get_home_url() ?>/our-accountability/our-policies-and-finance/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Our policies &amp; finance</a>
                  <a href="<?php echo get_home_url() ?>/our-accountability/audits-finances-reports/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Audits, finances &amp; reports</a>
                  <a href="<?php echo get_home_url() ?>/our-accountability/feedback-and-complaints/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Feedback & complaints</a>
                </ul>
              </li>
              <li class="nav-item group inline-block px-1 py-4">
                <a href="<?php echo get_home_url() ?>/members-corner/" class="block w-full lg:w-auto lg:flex pt-6 lg:pt-1 lg:pl-2 text-grey hover:text-anblue group-hover:text-anblue">Member's corner &darr;</a>
                <ul class="nav-dropdown list-reset ml-2 p-2 z-10 bg-white shadow hidden">
                  <a href="<?php echo get_home_url() ?>/members-corner/webinars/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Webinars</a>
                  <a href="<?php echo get_home_url() ?>/members-corner/workshops/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Workshops</a>
                  <a href="<?php echo get_home_url() ?>/members-corner/peer-advice-groups/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Peer advice groups</a>
                  <a href="<?php echo get_home_url() ?>/members-corner/good-practice-library/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Good practice library</a>
                  <a href="<?php echo get_home_url() ?>/members-corner/annual-general-meeting/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Annual General Meeting</a>
                  <a href="<?php echo get_home_url() ?>/join-us/" class="bg-anblue border border-anblue hover:border-anblue-dark hover:bg-anblue-dark text-white font-semibold block text-center mt-2 py-1 px-2 rounded">
                    Join us
                  </a>
                </ul>
              </li>
              <!-- <li class="nav-item group inline-block px-1 py-4">
                <a href="<?php echo get_home_url() ?>/latest/" class="block w-full lg:w-auto lg:flex pt-6 lg:pt-1 lg:pl-2 text-grey hover:text-anblue group-hover:text-anblue">The latest</a>
              </li> -->
            </ul>
          </nav>
        </div>
        <div class="text-right w-1/4 hidden lg:block">
          <a href="<?php echo get_home_url() ?>/feedback-and-complaints/" class="bg-transparent hover:bg-grey-lightest hover:border-anblue-dark hover:text-anblue-dark text-anblue border rounded border-anblue font-semibold text-sm lg:py-2 lg:px-2 mr-2 rounded">
            Feedback &amp; complaints
          </a>
          <a href="<?php echo get_home_url() ?>/join-us/" class="bg-anblue border border-anblue hover:border-anblue-dark hover:bg-anblue-dark text-white font-semibold text-sm lg:py-2 lg:px-2 rounded">
            Join us
          </a>
        </div>
        <div class="flex w-1/4 block lg:hidden">
          <button id="responsive-toggle" class="flex ml-auto items-center px-3 py-2 rounded text-anblue hover:bg-grey-lighter">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
          </button>
        </div>
        <div class="flex w-full">
          <nav id="responsive-nav" class="hidden w-full">
            <ul class="list-reset">
              <li class="nav-item group block px-2">
                <a href="<?php echo get_home_url() ?>/about-us/" class="flex justify-between block w-full lg:w-auto lg:flex px-2 py-2 text-grey-darker hover:text-anblue group-hover:text-anblue"><strong>About us</strong><span class="nav-dropdown-toggle text-anblue px-2">&darr;</span></a>
                <ul class="nav-dropdown list-reset ml-2 bg-white text-sm hidden">
                  <!-- <a href="<?php echo get_home_url() ?>/about-us/dynamic-accountability/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Dynamic Accountability</a> -->
                  <a href="<?php echo get_home_url() ?>/about-us/our-strategy/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Our strategy</a>
                  <a href="<?php echo get_home_url() ?>/about-us/our-members/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Our members</a>
                  <!-- <a href="<?php echo get_home_url() ?>/about-us/governance/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Governance</a> -->
                  <a href="<?php echo get_home_url() ?>/about-us/team-and-governance/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Team</a>
                  <!-- <a href="<?php echo get_home_url() ?>/about-us/annual-general-meeting/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Annual general meeting</a> -->
                </ul>
              </li>
              <li class="nav-item group block px-2">
                <a href="<?php echo get_home_url() ?>/our-work/" class="flex justify-between block w-full lg:w-auto lg:flex px-2 py-2 text-grey-darker hover:text-anblue group-hover:text-anblue"><strong>Our work</strong><span class="nav-dropdown-toggle text-anblue px-2">&darr;</span></a>
                <ul class="nav-dropdown list-reset ml-2 bg-white text-sm hidden">
                  <a href="<?php echo get_home_url() ?>/our-work/our-approach-to-accountability/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Our approach to accountability</a>
                  <a href="<?php echo get_home_url() ?>/our-work/12-accountability-commitments/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">12 accountability commitments</a>
                  <a href="<?php echo get_home_url() ?>/our-work/reporting/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Reporting</a>
                  <!-- <a href="<?php echo get_home_url() ?>/our-work/feedback-and-complaints/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Feedback & complaints</a> -->
                  <a href="<?php echo get_home_url() ?>/our-work/projects-and-partnerships/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Projects & partnerships</a>
                </ul>
              </li>
              <li class="nav-item group block px-2">
                <a href="<?php echo get_home_url() ?>/our-accountability/" class="flex justify-between block w-full lg:w-auto lg:flex px-2 py-2 text-grey-darker hover:text-anblue group-hover:text-anblue"><strong>Our accountability</strong><span class="nav-dropdown-toggle text-anblue px-2">&darr;</span></a>
                <ul class="nav-dropdown list-reset ml-2 bg-white text-sm hidden">
                  <a href="<?php echo get_home_url() ?>/our-accountability/our-policies-and-finance/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Our policies &amp; finance</a>
                  <a href="<?php echo get_home_url() ?>/our-accountability/audits-finances-reports/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Audits, finances &amp; reports</a>
                  <a href="<?php echo get_home_url() ?>/our-accountability/feedback-and-complaints/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Feedback & complaints</a>
                </ul>
              </li>
              <li class="nav-item group block px-2">
                <a href="<?php echo get_home_url() ?>/members-corner/" class="flex justify-between block w-full lg:w-auto lg:flex px-2 py-2 text-grey-darker hover:text-anblue group-hover:text-anblue"><strong>Member's corner</strong><span class="nav-dropdown-toggle text-anblue px-2">&darr;</span></a>
                <ul class="nav-dropdown list-reset ml-2 bg-white text-sm hidden">
                  <a href="<?php echo get_home_url() ?>/members-corner/webinars/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Webinars</a>
                  <a href="<?php echo get_home_url() ?>/members-corner/workshops/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Workshops</a>
                  <a href="<?php echo get_home_url() ?>/members-corner/peer-advice-groups/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Peer advice groups</a>
                  <a href="<?php echo get_home_url() ?>/members-corner/good-practice-library/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Good practice library</a>
                  <a href="<?php echo get_home_url() ?>/members-corner/annual-general-meeting/" class="block p-2 text-grey hover:text-anblue hover:bg-grey-lighter">Annual General Meeting</a>
                </ul>
              </li>
              <a href="<?php echo get_home_url() ?>/join-us/" class="bg-anblue border border-anblue hover:border-anblue-dark hover:bg-anblue-dark text-white font-semibold block text-center mt-2 py-2 px-2 rounded">
                Join us
              </a>
              <!-- <li class="nav-item group block px-2 py-2">
                <a href="<?php echo get_home_url() ?>/latest/" class="block w-full lg:w-auto lg:flex pt-6 lg:pt-1 lg:pl-2 text-grey hover:text-anblue group-hover:text-anblue">The latest</a>
              </li> -->
            </ul>
          </nav>
        </div>
      </nav>
    </header>
  </div>

  <section id="container" class="flex">