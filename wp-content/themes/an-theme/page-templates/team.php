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

          <div class="flex w-full lg:w-1/3 md:w-1/2 p-4">
            <div class="flex flex-wrap flex-1 content-between items-center card shadow p-2">
              <?php if ( has_post_thumbnail() ) { ?>
                <div class="flex flex-wrap w-2/3 m-auto">
                  <div class="round-image mb-4" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>)">
                  </div>
                </div>
              <?php } ?>
              <div class="w-full px-2">
                <h4 class="pb-1"><?php the_title(); ?></h4>
                <span class="text-xs"><?php the_excerpt(); ?></span>
              </div>
              <a
                class="member-modal-open w-full text-center bg-transparent hover:bg-grey-lightest hover:border-anblue-dark hover:text-anblue-dark text-anblue border rounded border-anblue font-semibold text-sm py-2 px-2 mr-2 rounded"
                data-img="<?php echo the_post_thumbnail_url(); ?>"
                data-title="<?php echo the_title(); ?>"
                data-desc="<?php esc_html(the_content()); ?>"
              >
                View full profile
              </a>
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

          <div class="flex w-full lg:w-1/3 md:w-1/2 p-4">
            <div class="flex flex-wrap flex-1 content-start items-center card shadow p-2">
              <?php if ( has_post_thumbnail() ) { ?>
                <div class="flex flex-wrap w-2/3 m-auto">
                  <div class="round-image mb-4" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>)">
                  </div>
                </div>
              <?php } ?>
              <div class="w-full px-2">
                <h4 class="pb-1"><?php the_title(); ?></h4>
                <span class="text-xs"><?php the_excerpt(); ?></span>
              </div>
              <a
                class="member-modal-open w-full text-center bg-transparent hover:bg-grey-lightest hover:border-anblue-dark hover:text-anblue-dark text-anblue border rounded border-anblue font-semibold text-sm py-2 px-2 mr-2 rounded"
                data-img="<?php echo the_post_thumbnail_url(); ?>"
                data-title="<?php echo the_title(); ?>"
                data-desc="<?php esc_html(the_content()); ?>"
              >
                View full profile
              </a>
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
            <div class="flex flex-wrap flex-1 content-start items-center card shadow p-2">
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
<div id="member-modal-container" class="hidden fixed flex-col w-full h-full items-center p-4 md:mt-4" style="background-color: rgba(0,0,0,.75); top: 0">
  <div id="member-modal" class="hidden modal w-full lg:w-1/3 md:w-3/4 h-full md:h-auto z-50 absolute inset-auto bg-white shadow mt-8 p-8">
    <span id="member-modal-close" class="absolute cursor-pointer" style="top: 16px; right: 16px">
      <svg class="svg-icon" viewBox="0 0 20 20" width=28>
        <path fill="auto" d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"></path>
      </svg>
    </span>
    <div class="flex flex-wrap w-1/3 lg:w-1/3 m-auto">
      <div class="round-image mb-4 board-img" style="background-image: url(<?php echo the_post_thumbnail_url(); ?>)">
      </div>
    </div>
    <div class="w-full px-2">
      <h2 class="pb-1 board-title"><?php echo the_title(); ?></h2>
      <br>
      <span class="text-base leading-normal board-desc"><?php the_content(); ?></span>
    </div>
  </div>
</div>
<?php get_footer(); ?>