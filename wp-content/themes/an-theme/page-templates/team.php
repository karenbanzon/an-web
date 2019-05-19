<?php /* Template Name: Team */ ?>

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

      <nav class="tab-nav flex flex-wrap w-full lg:w-3/4 m-auto">
        <a href="" class="w-1/3 active" data-tab-name="board">Board</a>
        <a href="" class="w-1/3" data-tab-name="independent-review-panel">Independent review panel</a>
        <a href="" class="w-1/3" data-tab-name="secretariat">Secretariat</a>
      </nav>

      <div class="tab-view active w-full" data-tab-view="board">
        <div class="flex flex-wrap w-full lg:w-3/4 m-auto p-6">
          <?php

          $board = new WP_Query( array(
            'post_type' => 'people',
            'category_name' => 'board'
          ) );

          if ( $board->have_posts() ) : while ( $board->have_posts() ) : $board->the_post(); ?>

          <div class="flex w-full lg:w-1/4 p-4">
            <div class="flex flex-wrap flex-1 items-center card shadow p-2">
              <?php if ( has_post_thumbnail() ) { ?>
                <div class="flex flex-wrap w-2/3 m-auto">
                  <div class="round-image mb-4" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>)">
                  </div>
                </div>
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
    
      <div class="tab-view hidden w-full" data-tab-view="independent-review-panel">
        <div class="flex flex-wrap w-full lg:w-3/4 m-auto p-6">
          <?php

          $irp = new WP_Query( array(
            'post_type' => 'people',
            'category_name' => 'independent-review-panel'
          ) );

          if ( $irp->have_posts() ) : while ( $irp->have_posts() ) : $irp->the_post(); ?>

          <div class="flex w-full lg:w-1/4 p-4">
            <div class="flex flex-wrap flex-1 items-center card shadow p-2">
              <?php if ( has_post_thumbnail() ) { ?>
                <div class="flex flex-wrap w-2/3 m-auto">
                  <div class="round-image mb-4" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>)">
                  </div>
                </div>
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

      <div class="tab-view hidden w-full" data-tab-view="secretariat">
        <div class="flex flex-wrap w-full lg:w-3/4 m-auto p-6">
          <?php

          $team = new WP_Query( array(
            'post_type' => 'people',
            'category_name' => 'secretariat'
          ) );

          if ( $team->have_posts() ) : while ( $team->have_posts() ) : $team->the_post();
          
          $email = get_post_meta( get_the_ID(), 'people_details_email-address', true );
          $linkedin = get_post_meta( get_the_ID(), 'people_details_linkedin-url', true );
          $phone = get_post_meta( get_the_ID(), 'people_details_phone', true );
          
          ?>

          <div class="flex w-full lg:w-1/2 p-4">
            <div class="flex flex-wrap flex-1 items-center card shadow p-2">
              <div class="flex flex-wrap items-center w-full">
                <?php if ( has_post_thumbnail() ) { ?>
                  <div class="w-1/3 flex px-6">
                    <div class="round-image mb-4" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>)">
                    </div>
                  </div>
                <?php } ?>
                <div class="w-2/3 flex">
                  <h4 class="pb-1"><?php the_title(); ?></h4>
                </div>
              </div>
              
              <div class="w-full px-2">
                <span class="text-xs"><?php the_content(); ?></span>
                <p class="text-xs text-center"><a href="mailto:<?php echo $email ?>" class="text-grey hover:font-bold hover:text-anblue">Email</a> | <a href="<?php echo $linkedin ?>" class="text-grey hover:font-bold hover:text-anblue">Linkedin</a> | <a href="tel:<?php echo $phone ?>" class="text-grey hover:font-bold hover:text-anblue">Phone: <?php echo $phone ?></a></p>
              </div>
            </div>
          </div>

          <?php endwhile; endif; wp_reset_postdata();?>
        </div>
      </div>
      
    </article>
  </section>
</main>
<?php get_footer(); ?>