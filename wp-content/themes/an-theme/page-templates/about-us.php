<?php /* Template Name: About Us */ ?>

<?php get_header(); ?>
<main id="content" class="page-content flex flex-wrap justify-center w-full">
  <section class="flex w-full">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('w-full'); ?>>
      <?php if ( has_post_thumbnail() ) { ?>
      <header class="header page-hero p-6" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>)">
        <div class="overlay bg-anblue"></div>
        <div class="page-title"><h1 class="entry-title w-full lg:w-3/4 ml-auto mr-auto mt-4 mb-4 pt-6 pb-6 text-white"><?php the_title(); ?></h1></div>
      </header>
      <?php } else { ?>
      <header class="header w-full lg:w-3/4 m-auto p-6">
        <h1 class="entry-title pt-4 pb-4 text-grey-darkest"><?php the_title(); ?></h1>
      </header>
      <?php } ?>
      <div class="w-full lg:w-3/4 m-auto p-6">
        <?php the_content(); ?>
      </div>
      <?php endwhile; endif; ?>

      <hr class="w-full lg:w-3/4 border-b border-grey">

      <div class="flex flex-wrap w-full lg:w-3/4 m-auto my-6">
        <?php

          $strategy = new WP_Query( array(
            'post_type' => 'page',
            'name' => 'our-strategy',
            'posts_per_page' => 1
          ) );

          if ( $strategy->have_posts() ) : while ( $strategy->have_posts() ) : $strategy->the_post(); ?>
          <a href="<?php the_permalink(); ?>" class="w-full lg:w-1/3 bg-anblue hover:bg-anblue-dark p-4 bg-cover" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>);">

            <h2 class="pb-4 text-white"><?php the_title(); ?></h2>
            <p class="text-white"><?php echo wp_strip_all_tags(get_the_excerpt(), true); ?></p>
            <button href="<?php the_permalink(); ?>" class="bg-transparent border border-white hover:bg-white hover:text-anblue text-white font-semibold block text-center mt-2 py-3 px-2 rounded">Learn more &rarr;</button>

          </a>
        <?php endwhile; endif; wp_reset_postdata();?>

        <?php

          $members = new WP_Query( array(
            'post_type' => 'page',
            'name' => 'our-members',
            'posts_per_page' => 1
          ) );

          if ( $members->have_posts() ) : while ( $members->have_posts() ) : $members->the_post(); ?>
          <a href="<?php the_permalink(); ?>" class="w-full lg:w-1/3 bg-anblue hover:bg-anblue-dark p-4 bg-cover" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>);>

            <h2 class="pb-4 text-white"><?php the_title(); ?></h2>
            <p class="text-white"><?php echo wp_strip_all_tags(get_the_excerpt(), true); ?></p>
            <button href="<?php the_permalink(); ?>" class="bg-transparent border border-white hover:bg-white hover:text-anblue text-white font-semibold block text-center mt-2 py-3 px-2 rounded">Learn more &rarr;</button>

          </a>
        <?php endwhile; endif; wp_reset_postdata();?>

        <?php

          $team = new WP_Query( array(
            'post_type' => 'page',
            'name' => 'team-and-governance',
            'posts_per_page' => 1
          ) );

          if ( $team->have_posts() ) : while ( $team->have_posts() ) : $team->the_post(); ?>
          <a href="<?php the_permalink(); ?>" class="w-full lg:w-1/3 bg-anblue hover:bg-anblue-dark p-4 bg-cover" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>);>

            <h2 class="pb-4 text-white"><?php the_title(); ?></h2>
            <p class="text-white"><?php echo wp_strip_all_tags(get_the_excerpt(), true); ?></p>
            <button href="<?php the_permalink(); ?>" class="bg-transparent border border-white hover:bg-white hover:text-anblue text-white font-semibold block text-center mt-2 py-3 px-2 rounded">Learn more &rarr;</button>

          </a>
        <?php endwhile; endif; wp_reset_postdata();?>
      </div>
    </article>
  </section>
</main>
<?php get_footer(); ?>