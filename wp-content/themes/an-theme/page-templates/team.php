<?php /* Template Name: Team */ ?>

<?php get_header(); ?>
<main id="content" class="page-content flex flex-wrap justify-center w-full">
  <section class="flex w-full p-6">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('w-full p-6'); ?>>
      <?php if ( has_post_thumbnail() ) { ?>
      <header class="header page-hero p-6" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>)">
        <div class="overlay"></div>
        <div class="page-title"><h1 class="entry-title w-full lg:w-2/3 ml-auto mr-auto mt-4 mb-4 pt-6 pb-6 text-grey-darkest"><?php the_title(); ?></h1></div>
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

      <nav class="tab-nav flex flex-wrap w-full lg:w-2/3 m-auto">
        <a href="" class="w-1/2 active" data-tab-name="team">Team</a>
        <a href="" class="w-1/2" data-tab-name="review-panel">Review panel</a>
      </nav>
      
      <div class="tab-view active w-full" data-tab-view="team">
        <div class="flex flex-wrap w-full lg:w-2/3 m-auto p-6">
          <?php

          $team = new WP_Query( array(
            'post_type' => 'people',
            'category_name' => 'team'
          ) );

          if ( $team->have_posts() ) : while ( $team->have_posts() ) : $team->the_post(); ?>

          <div class="flex w-full lg:w-1/2 p-4">
            <div class="flex flex-wrap flex-1 items-center card shadow p-2">
              <?php if ( has_post_thumbnail() ) { ?>
                <img src="<?php echo the_post_thumbnail_url(); ?>" alt="">
              <?php } ?>
              <div class="w-full px-2">
                <h4 class="pb-1"><?php the_title(); ?></h4>
                <span class="text-xs"><?php the_content(); ?></span>
              </div>
            </div>
          </div>

          <?php endwhile; endif; wp_reset_postdata();?>
        </div>
      </div>
      <div class="tab-view hidden w-full" data-tab-view="review-panel">
        Show review panel data
      </div>
      
    </article>
  </section>
</main>
<?php get_footer(); ?>