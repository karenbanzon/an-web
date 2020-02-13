<?php /* Template Name: Blog */ ?>

<?php get_header(); ?>
<main id="content" class="page-content flex flex-wrap justify-center w-full">
  <section class="flex w-full">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('w-full'); ?>>
      <?php if ( has_post_thumbnail() ) { ?>
      <header class="header page-hero p-6 hidden" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>)">
        <div class="overlay bg-anblue"></div>
        <div class="page-title"><h1 class="entry-title w-full ml-auto mr-auto mt-4 mb-4 pt-6 pb-6 text-white"><?php the_title(); ?></h1></div>
      </header>
      <?php } else { ?>
      <header class="header w-full m-auto p-6 hidden">
        <h1 class="entry-title pt-4 pb-4 text-grey-darkest"><?php the_title(); ?></h1>
      </header>
      <?php } ?>
      <div class="w-full m-auto p-6">
        <?php the_content(); ?>
      </div>
      <?php endwhile; endif; ?>

      <hr class="w-full border-b border-grey">
      
      <!-- Blog items -->
      <div class="flex flex-wrap w-full m-auto p-6">
      
      <?php

        $regular = new WP_Query( array(
          'post_type' => 'post',
          'posts_per_page' => 12,
          'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1
        ) );

        $temp_query = $wp_query;
        $wp_query   = NULL;
        $wp_query   = $regular;

        if ( $regular->have_posts() ) : ?>
        
        <?php while ( $regular->have_posts() ) : $regular->the_post(); ?>

        <div class="w-full md:w-1/2 lg:w-1/4 p-6 hover:shadow">
          <a href="<?php echo the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) { ?>
              <div class="bg-cover bg-center mb-2" style="background-image:url(<?php echo the_post_thumbnail_url(); ?>); height: 200px;">
              </div>
            <?php } ?>
            <h4 class="text-black"><?php the_title(); ?></h4>
            <small class="text-grey"><?php echo get_post_meta(get_the_ID(), 'author', true); ?></small>
          </a>
        </div>

        <?php endwhile; ?>
        <div class="w-full block m-auto p-6">
          <nav class="flex flex-wrap">
            <?php if ( $regular->max_num_pages > 1 ) {
              echo '<div class="nav-next w-1/2 text-right p-4">';
              if ( get_previous_posts_link() ) {
                echo previous_posts_link( '&larr; Newer' );
              } else {
                echo '<span class="text-grey">&larr; Newer</span>';
              }
              echo '</div>';

              echo '<div class="nav-previous w-1/2 p-4">';
              if ( get_next_posts_link() ) {
                echo next_posts_link( 'Older &rarr;' );
              } else {
                echo '<span class="text-grey">Older &rarr;</span>';
              }
              echo '</div>';
            } ?>
          </nav>
        </div>
        
        <?php
          $wp_query = NULL;
          $wp_query = $temp_query;

          endif;
          wp_reset_postdata();
        ?>
      </div>
    </article>
  </section>
</main>
<?php get_footer(); ?>