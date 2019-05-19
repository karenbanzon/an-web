<?php /* Template Name: Webinars */ ?>

<?php get_header(); ?>
<main id="content" class="page-content flex flex-wrap justify-center w-full">
  <section class="flex w-full">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('w-full'); ?>>
      <?php if ( has_post_thumbnail() ) { ?>
      <header class="header page-hero p-6" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>)">
        <div class="overlay bg-anblue"></div>
        <div class="page-title"><h1 class="entry-title w-full ml-auto mr-auto mt-4 mb-4 pt-6 pb-6 text-white"><?php the_title(); ?></h1></div>
      </header>
      <?php } else { ?>
      <header class="header w-full m-auto p-6">
        <h1 class="entry-title pt-4 pb-4 text-grey-darkest"><?php the_title(); ?></h1>
      </header>
      <?php } ?>
      <div class="w-full m-auto p-6">
        <?php the_content(); ?>
      </div>
      <?php endwhile; endif; ?>

      <hr class="w-full border-b border-grey">
        
      <!-- Webinars -->
      <div class="flex flex-wrap w-full m-auto p-6">
      <?php
        $regular = new WP_Query( array(
          'post_type' => 'events',
          'category_name' => 'webinar'
        ) );

        if ( $regular->have_posts() ) : ?>
        
        <?php while ( $regular->have_posts() ) : $regular->the_post(); ?>

        <div class="w-full lg:w-1/3 p-6 hover:shadow">
          <a href="<?php echo the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) { ?>
              <div class="bg-cover bg-center mb-2" style="background-image:url(<?php echo the_post_thumbnail_url(); ?>); height: 300px;">
              </div>
            <?php } ?>
            <h4 class="text-black"><?php the_title(); ?></h4>
            <?php $post_meta = get_post_meta( get_the_ID() ); ?>
            <?php echo '<script>console.log(' . json_encode($post_meta) . ')</script>' ?>
            <small class="text-grey"><?php echo $post_meta['_start_day'][0] . '.' . $post_meta['_start_month'][0] . '.' . $post_meta['_start_year'][0] ?></small>
            <br>
            <small class="text-grey"><?php echo $post_meta['_event_location'][0] ?></small>
          </a>
        </div>

        <?php endwhile; ?>
        
        <?php endif; wp_reset_postdata();?>
      </div>
    </article>
  </section>
</main>
<?php get_footer(); ?>