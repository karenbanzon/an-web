<?php get_header(); ?>
<main id="content" class="page-content flex flex-wrap justify-center w-full">
  <section class="flex w-full">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('w-full'); ?>>
      <?php if ( has_post_thumbnail() ) { ?>
      <header class="header page-hero p-6 bg-anblue-darkest">
        <div class="page-title text-center py-6">
          <h1 class="entry-title w-full lg:w-3/4 ml-auto mr-auto mt-4 mb-4 text-white uppercase tracking-wide"><?php the_title(); ?></h1>
          <p class="w-full lg:w-3/4 ml-auto mr-auto mt-4 mb-4 text-white"><?php echo esc_html( get_the_excerpt() ); ?></p>
        </div>
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
    </article>
      
  </section>
</main>
<?php get_footer(); ?>