<?php /* Template Name: Team v2 */ ?>

<?php get_header(); ?>
<main id="content" class="page-content flex flex-wrap justify-center w-full">
  <section class="flex w-full">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class('w-full'); ?>>
      <?php if ( has_post_thumbnail() ) { ?>
      <header class="hidden header page-hero p-6" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>)">
        <div class="overlay bg-anblue"></div>
        <div class="page-title"><h1 class="entry-title w-full lg:w-3/4 ml-auto mr-auto mt-4 mb-4 pt-6 pb-6 text-white"><?php the_title(); ?></h1></div>
      </header>
      <?php } else { ?>
      <header class="hidden header w-full lg:w-3/4 m-auto p-6">
        <h1 class="entry-title pt-4 pb-4 text-grey-darkest"><?php the_title(); ?></h1>
      </header>
      <?php } ?>
      <div class="w-full lg:w-3/4 m-auto px-6">
        <?php the_content(); ?>
      </div>
      <?php endwhile; endif; ?>

      <hr class="w-full lg:w-3/4 border-b border-grey">

      <div class="active w-full">
        <div class="flex flex-wrap w-full lg:w-3/4 m-auto p-6">
          <h2 class="flex flex-wrap w-full">Board</h2>
          <?php

          $board = new WP_Query( array(
            'post_type' => 'people',
            'category_name' => 'board',
            'posts_per_page' => 15
          ) );

          if ( $board->have_posts() ) : while ( $board->have_posts() ) : $board->the_post();

          $title = get_post_meta( get_the_ID(), 'people_details_title', true );

          ?>

          <div class="flex w-full p-4">
            <div class="flex flex-wrap flex-1 content-between items-center card shadow p-2">
              <?php if ( has_post_thumbnail() ) { ?>
                <div class="flex flex-wrap w-1/4 m-auto px-2">
                  <div class="round-image mb-4" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>)">
                  </div>
                </div>
              <?php } ?>
              <div class="flex flex-wrap w-3/4 px-2">
                <h4 class="flex flex-wrap w-full pb-1"><?php the_title(); ?></h4>
                <p class="flex flex-wrap w-full text-xs text-grey"><em><?php echo $title; ?></em></p>
                <span class="flex flex-wrap w-full text-xs"><?php the_excerpt(); ?></span>
                <a
                  class="flex text-center bg-transparent hover:bg-grey-lightest hover:border-anblue-dark hover:text-anblue-dark text-anblue border rounded border-anblue font-semibold text-sm py-2 px-2 mr-2 rounded"
                  href="<?php the_permalink() ?>"
                >
                  View full profile
                </a>
              </div>
              <!-- <a
                class="member-modal-open w-full text-center bg-transparent hover:bg-grey-lightest hover:border-anblue-dark hover:text-anblue-dark text-anblue border rounded border-anblue font-semibold text-sm py-2 px-2 mr-2 rounded"
                data-img="<?php echo the_post_thumbnail_url(); ?>"
                data-title="<?php echo the_title(); ?>"
                data-desc="<?php esc_html(the_content()); ?>"
              >
                View full profile
              </a> -->
            </div>
          </div>

          <?php endwhile; endif; wp_reset_postdata();?>
        </div>

        <div class="flex flex-wrap w-full lg:w-3/4 m-auto p-6">
          <h2 class="flex flex-wrap w-full">Secretariat</h2>
          <?php

          $team = new WP_Query( array(
            'post_type' => 'people',
            'category_name' => 'secretariat',
            'posts_per_page' => 15
          ) );

          if ( $team->have_posts() ) : while ( $team->have_posts() ) : $team->the_post();
          
          $email = get_post_meta( get_the_ID(), 'people_details_email-address', true );
          $linkedin = get_post_meta( get_the_ID(), 'people_details_linkedin-url', true );
          $phone = get_post_meta( get_the_ID(), 'people_details_phone', true );
          
          ?>

          <div class="flex w-full p-4">
            <div class="flex flex-wrap flex-1 content-start items-center card shadow p-2">
              <div class="flex flex-wrap items-center w-full">
                <?php if ( has_post_thumbnail() ) { ?>
                  <div class="w-1/4 flex px-6">
                    <div class="round-image mb-4" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>)">
                    </div>
                  </div>
                <?php } ?>
                <div class="w-3/4 flex flex-wrap">
                  <h4 class="flex flex-wrap w-full pb-1"><?php the_title(); ?></h4>
                  <span class="flex flex-wrap w-full text-xs"><?php the_content(); ?></span>
                  <p class="flex flex-wrap w-full text-xs text-center"><a href="mailto:<?php echo $email ?>" class="text-grey hover:font-bold hover:text-anblue">Email</a>&nbsp;|&nbsp;<a href="<?php echo $linkedin ?>" class="text-grey hover:font-bold hover:text-anblue">Linkedin</a>&nbsp;|&nbsp;<a href="tel:<?php echo $phone ?>" class="text-grey hover:font-bold hover:text-anblue">Phone: <?php echo $phone ?></a></p>
                </div>
              </div>
            </div>
          </div>

          <?php endwhile; endif; wp_reset_postdata();?>
        </div>
      </div>

      <div class="flex flex-wrap w-full lg:w-3/4 m-auto p-6">
          <h2 class="flex flex-wrap w-full">Independent review panel</h2>
          <?php

          $board = new WP_Query( array(
            'post_type' => 'people',
            'category_name' => 'independent-review-panel',
            'posts_per_page' => 15
          ) );

          if ( $board->have_posts() ) : while ( $board->have_posts() ) : $board->the_post();

          $title = get_post_meta( get_the_ID(), 'people_details_title', true );

          ?>

<div class="flex w-full p-4">
            <div class="flex flex-wrap flex-1 content-between items-center card shadow p-2">
              <?php if ( has_post_thumbnail() ) { ?>
                <div class="flex flex-wrap w-1/4 m-auto px-2">
                  <div class="round-image mb-4" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>)">
                  </div>
                </div>
              <?php } ?>
              <div class="flex flex-wrap w-3/4 px-2">
                <h4 class="flex flex-wrap w-full pb-1"><?php the_title(); ?></h4>
                <p class="flex flex-wrap w-full text-xs text-grey"><em><?php echo $title; ?></em></p>
                <span class="flex flex-wrap w-full text-xs"><?php the_excerpt(); ?></span>
                <a
                  class="flex text-center bg-transparent hover:bg-grey-lightest hover:border-anblue-dark hover:text-anblue-dark text-anblue border rounded border-anblue font-semibold text-sm py-2 px-2 mr-2 rounded"
                  href="<?php the_permalink() ?>"
                >
                  View full profile
                </a>
              </div>
              <!-- <a
                class="member-modal-open w-full text-center bg-transparent hover:bg-grey-lightest hover:border-anblue-dark hover:text-anblue-dark text-anblue border rounded border-anblue font-semibold text-sm py-2 px-2 mr-2 rounded"
                data-img="<?php echo the_post_thumbnail_url(); ?>"
                data-title="<?php echo the_title(); ?>"
                data-desc="<?php esc_html(the_content()); ?>"
              >
                View full profile
              </a> -->
            </div>
          </div>

          <?php endwhile; endif; wp_reset_postdata();?>
        </div>
      </div>
      
    </article>
  </section>
</main>
<?php get_footer(); ?>