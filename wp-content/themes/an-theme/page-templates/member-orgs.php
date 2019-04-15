<?php /* Template Name: Member orgs */ ?>

<?php get_header(); ?>
<main id="content" class="page-content flex flex-wrap justify-center w-full">
  <section class="flex w-full p-6">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('w-full p-6'); ?>>
      <?php if ( has_post_thumbnail() ) { ?>
      <header class="header page-hero p-6" style="background-image: url(<?php echo the_post_thumbnail_url() ?>)">
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

      <!-- Full members -->
      <div class="flex flex-wrap w-full lg:w-2/3 m-auto p-6">
      <?php

        $fullmembers = new WP_Query( array(
          'post_type' => 'members',
          'category_name' => 'full'
        ) );

        if ( $fullmembers->have_posts() ) : ?>
        <div class="w-full">
          <h2 class="text-grey-darkest">Full members</h2>
        </div>
        
        <?php while ( $fullmembers->have_posts() ) : $fullmembers->the_post(); ?>

        <div class="flex w-full lg:w-1/3 p-4">
          <div class="flex flex-wrap flex-1 items-center card shadow p-2">
            <div class="w-1/3">
              <?php if ( has_post_thumbnail() ) { ?>
                <img src="<?php echo the_post_thumbnail_url() ?>" alt="">
              <?php } ?>
            </div>
            <div class="w-2/3 px-2">
              <h4 class="pb-1"><?php the_title(); ?></h4>
              <span class="text-xs"><?php the_content(); ?></span>
            </div>
          </div>
        </div>

        <?php endwhile; endif; wp_reset_postdata();?>
      </div>

      <hr class="w-full lg:w-2/3 border-b border-grey">

      <!-- Affiliate members -->
      <div class="flex flex-wrap w-full lg:w-2/3 m-auto p-6">
      <?php

        $affiliates = new WP_Query( array(
          'post_type' => 'members',
          'category_name' => 'affiliate'
        ) );

        if ( $affiliates->have_posts() ) : ?>
        <div class="w-full">
          <h2 class="text-grey-darkest">Affiliates</h2>
        </div>
        
        <?php while ( $affiliates->have_posts() ) : $affiliates->the_post(); ?>

        <div class="flex w-full lg:w-1/3 p-4">
          <div class="flex flex-wrap flex-1 items-center card shadow p-2">
            <div class="w-1/3">
              <?php if ( has_post_thumbnail() ) { ?>
                <img src="<?php echo the_post_thumbnail_url() ?>" alt="">
              <?php } ?>
            </div>
            <div class="w-2/3 px-2">
              <h4 class="pb-1"><?php the_title(); ?></h4>
              <span class="text-xs"><?php the_content(); ?></span>
            </div>
          </div>
        </div>

        <?php endwhile; endif; wp_reset_postdata();?>
      </div>

    </article>
  </section>
</main>
<?php get_footer(); ?>