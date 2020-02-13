<?php /* Template Name: Team */ ?>

<?php get_header(); ?>
<main id="content" class="page-content flex flex-wrap justify-center w-full">
  <section class="flex w-full">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('w-full'); ?>>
      <?php if ( has_post_thumbnail() ) { ?>
      <header class="header page-hero p-6 hidden" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>)">
        <div class="overlay bg-anblue"></div>
        <div class="page-title"><h1 class="entry-title w-full lg:w-3/4 ml-auto mr-auto mt-4 mb-4 pt-6 pb-6 text-white"><?php the_title(); ?></h1></div>
      </header>
      <?php } else { ?>
      <header class="header w-full lg:w-3/4 m-auto p-6 hidden">
        <h1 class="entry-title pt-4 pb-4 text-grey-darkest"><?php the_title(); ?></h1>
      </header>
      <?php } ?>
      <div class="w-full lg:w-3/4 m-auto p-6">
        <?php the_content(); ?>
      </div>
      <?php endwhile; endif; ?>

      <hr class="w-full lg:w-3/4 border-b border-grey">

      <nav class="tab-nav flex flex-wrap w-full lg:w-3/4 m-auto">
        <a href="" class="w-1/3 active" data-tab-name="full-members">Full members</a>
        <a href="" class="w-1/3" data-tab-name="affiliates">Affiliates</a>
        <a href="" class="w-1/3" data-tab-name="former-members">Former members</a>
      </nav>

      <div class="tab-view active w-full" data-tab-view="full-members">
        <div class="flex flex-wrap w-full lg:w-3/4 m-auto p-6">
          <?php

          $full = new WP_Query( array(
            'post_type' => 'members',
            'category_name' => 'full',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC'
          ) );

          if ( $full->have_posts() ) : while ( $full->have_posts() ) : $full->the_post();

          $link = get_post_meta( get_the_ID(), 'member_details_site-url', true );
          
          ?>
          <div class="flex w-full md:w-1/2 lg:w-1/4 p-4">
            <div class="flex flex-wrap flex-1 items-center card hover:shadow p-2">
              <?php if ( has_post_thumbnail() ) { ?>
                <img src="<?php echo the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
              <?php } ?>
              <a
                class="w-full text-center bg-transparent hover:bg-grey-lightest hover:border-anblue-dark hover:text-anblue-dark text-anblue border rounded border-anblue font-semibold text-sm py-2 px-2 mr-2 mb-2 rounded"
                href="<?php the_permalink() ?>"
              >
                View full profile
              </a>
              <a
                class="w-full text-center bg-transparent hover:bg-grey-lightest hover:border-anblue-dark hover:text-anblue-dark text-anblue border rounded border-anblue font-semibold text-sm py-2 px-2 mr-2 rounded"
                href="<?php echo $link ?>"
                target="_blank"
              >
                View member site
              </a>
            </div>
          </div>

          <?php endwhile; endif; wp_reset_postdata();?>
        </div>
      </div>

      <div class="tab-view hidden w-full" data-tab-view="affiliates">
        <div class="flex flex-wrap w-full lg:w-3/4 m-auto p-6">
          <?php

          $affiliates = new WP_Query( array(
            'post_type' => 'members',
            'category_name' => 'affiliate',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC'
          ) );

          if ( $affiliates->have_posts() ) : while ( $affiliates->have_posts() ) : $affiliates->the_post();
          
          $link = get_post_meta( get_the_ID(), 'member_details_site-url', true );
          
          ?>
          <div class="flex w-full md:w-1/2 lg:w-1/4 p-4">
            <div class="flex flex-wrap flex-1 items-center card hover:shadow p-2">
              <?php if ( has_post_thumbnail() ) { ?>
                <img src="<?php echo the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
              <?php } ?>
              <a
                class="w-full text-center bg-transparent hover:bg-grey-lightest hover:border-anblue-dark hover:text-anblue-dark text-anblue border rounded border-anblue font-semibold text-sm py-2 px-2 mr-2 mb-2 rounded"
                href="<?php the_permalink() ?>"
              >
                View full profile
              </a>
              <a
                class="w-full text-center bg-transparent hover:bg-grey-lightest hover:border-anblue-dark hover:text-anblue-dark text-anblue border rounded border-anblue font-semibold text-sm py-2 px-2 mr-2 rounded"
                href="<?php echo $link ?>"
                target="_blank"
              >
                View member site
              </a>
            </div>
          </div>

          <?php endwhile; endif; wp_reset_postdata();?>
        </div>
      </div>

      <div class="tab-view hidden w-full" data-tab-view="former-members">
        <div class="flex flex-wrap w-full lg:w-3/4 m-auto p-6">
          <?php

          $former = new WP_Query( array(
            'post_type' => 'members',
            'category_name' => 'former',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC'
          ) );

          if ( $former->have_posts() ) : while ( $former->have_posts() ) : $former->the_post();

          $link = get_post_meta( get_the_ID(), 'member_details_site-url', true );
          
          ?>
          <div class="flex w-full md:w-1/2 lg:w-1/4 p-4">
            <div class="flex flex-wrap flex-1 items-center card hover:shadow p-2">
              <?php if ( has_post_thumbnail() ) { ?>
                <img src="<?php echo the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
              <?php } ?>
              <a
                class="w-full text-center bg-transparent hover:bg-grey-lightest hover:border-anblue-dark hover:text-anblue-dark text-anblue border rounded border-anblue font-semibold text-sm py-2 px-2 mr-2 mb-2 rounded"
                href="<?php the_permalink() ?>"
              >
                View full profile
              </a>
              <a
                class="w-full text-center bg-transparent hover:bg-grey-lightest hover:border-anblue-dark hover:text-anblue-dark text-anblue border rounded border-anblue font-semibold text-sm py-2 px-2 mr-2 rounded"
                href="<?php echo $link ?>"
                target="_blank"
              >
                View member site
              </a>
            </div>
          </div>

          <?php endwhile; endif; wp_reset_postdata();?>
        </div>
      </div>
      
    </article>
  </section>
</main>
<?php get_footer(); ?>