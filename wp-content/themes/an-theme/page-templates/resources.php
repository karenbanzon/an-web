<?php /* Template Name: Good Practice Library */ ?>

<?php get_header(); ?>
<main id="content" class="page-content flex flex-wrap justify-center w-full">
  <section class="flex w-full">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('w-full'); ?>>
      <?php if ( has_post_thumbnail() ) { ?>
      <header class="header page-hero p-6" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>)">
        <div class="overlay bg-anblue"></div>
        <div class="page-title"><h1 class="entry-title w-full lg:w-2/3 ml-auto mr-auto mt-4 mb-4 pt-6 pb-6 text-white"><?php the_title(); ?></h1></div>
      </header>
      <?php } else { ?>
      <header class="header w-full lg:w-2/3 m-auto p-6">
        <h1 class="entry-title pt-4 pb-4 text-grey-darkest"><?php the_title(); ?></h1>
      </header>
      <?php } ?>
      <div class="w-full lg:w-2/3 m-auto p-6">
        <?php the_content(); ?>
      </div>
      <?php endwhile; endif; ?>

      <hr class="w-full lg:w-2/3 border-b border-grey">

      <!-- Regular events -->
      <div class="flex flex-wrap w-full lg:w-2/3 m-auto p-6">
      <?php
        $webinar = get_category_by_slug( 'webinar' );
        $webinar_id = $webinar->term_id;

        $workshop = get_category_by_slug( 'workshop' );
        $workshop_id = $workshop->term_id;

        $regular = new WP_Query( array(
          'post_type' => 'events',
          'category_name' => 'events',
          'category__not_in' => array($webinar_id, $workshop_id)
        ) );

        if ( $regular->have_posts() ) : ?>
        <div class="w-full">
          <h2 class="text-grey-darkest">Events</h2>
        </div>
        
        <?php while ( $regular->have_posts() ) : $regular->the_post(); ?>

        <div class="w-full lg:w-1/3 p-6">
          <h4><?php the_title(); ?></h4>
        </div>

        <?php endwhile; ?>

        <div class="w-full text-center mt-6">
          <a href="<?php echo get_home_url() ?>/events-all/" class="bg-transparent hover:bg-grey-lightest hover:border-anblue-dark hover:text-anblue-dark text-anblue border rounded border-anblue font-semibold py-2 px-4 mr-2 rounded">
            View all events &rarr;
          </a>
        </div>
        
        <?php endif; wp_reset_postdata();?>
      </div>

      <hr class="w-full lg:w-2/3 border-b border-grey">
        
      <!-- Webinars -->
      <div class="flex flex-wrap w-full lg:w-2/3 m-auto p-6">
      <?php
        $regular = new WP_Query( array(
          'post_type' => 'events',
          'category_name' => 'webinar'
        ) );

        if ( $regular->have_posts() ) : ?>
        <div class="w-full">
          <h2 class="text-grey-darkest">Webinars</h2>
        </div>
        
        <?php while ( $regular->have_posts() ) : $regular->the_post(); ?>

        <div class="w-full lg:w-1/3 p-6">
          <h4><?php the_title(); ?></h4>
        </div>

        <?php endwhile; ?>

        <div class="w-full text-center mt-6">
          <a href="<?php echo get_home_url() ?>/webinars/" class="bg-transparent hover:bg-grey-lightest hover:border-anblue-dark hover:text-anblue-dark text-anblue border rounded border-anblue font-semibold py-2 px-4 mr-2 rounded">
            View all webinars &rarr;
          </a>
        </div>
        
        <?php endif; wp_reset_postdata();?>
      </div>

      <hr class="w-full lg:w-2/3 border-b border-grey">

      <!-- Workshops -->
      <div class="flex flex-wrap w-full lg:w-2/3 m-auto p-6">
      <?php

        $regular = new WP_Query( array(
          'post_type' => 'events',
          'category_name' => 'workshop'
        ) );

        if ( $regular->have_posts() ) : ?>
        <div class="w-full">
          <h2 class="text-grey-darkest">Workshops</h2>
        </div>
        
        <?php while ( $regular->have_posts() ) : $regular->the_post(); ?>

        <div class="w-full lg:w-1/3 p-6">
          <h4><?php the_title(); ?></h4>
        </div>

        <?php endwhile; ?>

        <div class="w-full text-center mt-6">
          <a href="<?php echo get_home_url() ?>/workshops/" class="bg-transparent hover:bg-grey-lightest hover:border-anblue-dark hover:text-anblue-dark text-anblue border rounded border-anblue font-semibold py-2 px-4 mr-2 rounded">
            View all workshops &rarr;
          </a>
        </div>
        
        <?php endif; wp_reset_postdata();?>
      </div>
    </article>
  </section>
</main>
<?php get_footer(); ?>