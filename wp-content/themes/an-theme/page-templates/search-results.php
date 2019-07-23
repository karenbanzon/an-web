<?php /* Template Name: Search Page */ ?>

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

      <!-- General filters -->
      <div class="flex flex-wrap w-full m-auto p-6">
        <form class="m-auto" action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
          <div class="flex flex-wrap w-full">
            <select name="member_cat" class="mr-2 mb-2 md:mb-0 self-center w-full md:w-auto h-8">
              <option value="" selected disabled>Select member organization</option>
              <option value="">All</option>
              <?php
                $parentCategory = 'members';
                $parentCategoryObject = get_category_by_slug($parentCategory); 
                $parentCategoryId = $parentCategoryObject->term_id;
                $terms = get_terms( array(
                  'taxonomy' => 'category',
                  'child_of' => $parentCategoryId,
                  'hide_empty' => false
                ));

                foreach ( $terms as $term ) {
                    echo '<option class="p-4" value="' . $term->term_id . '">' . $term->name . '</option>';
                }
              ?>
            </select>
            <select name="topic_cat" class="mr-2 mb-2 md:mb-0 self-center w-full md:w-auto h-8">
              <option value="" selected disabled>Select topic</option>
              <option value="">All</option>
              <?php
                $parentCategory = 'topics';
                $parentCategoryObject = get_category_by_slug($parentCategory); 
                $parentCategoryId = $parentCategoryObject->term_id;
                $terms = get_terms( array(
                  'taxonomy' => 'category',
                  'child_of' => $parentCategoryId,
                  'hide_empty' => false
                ));

                foreach ( $terms as $term ) {
                    echo '<option class="p-4" value="' . $term->term_id . '">' . $term->name . '</option>';
                }
              ?>
            </select>
            <button id="filterButton" class="bg-transparent hover:bg-grey-lightest hover:border-anblue-dark hover:text-anblue-dark text-anblue border rounded border-anblue font-semibold py-2 px-4 mr-2 rounded">
              Filter results
            </button>
            <input type="hidden" name="action" value="filter_general">
          </div>
        </form>
      </div>

      <hr class="w-full border-b border-grey">

      <!-- Search results items -->
      <div class="flex flex-wrap w-full lg:w-3/4 m-auto p-6" id="response">
      <?php

        $items = new WP_Query( array(
          'post_type' => array('resources', 'events'),
          'posts_per_page' => 20,
          'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1
        ) );

        $temp_query = $wp_query;
        $wp_query   = NULL;
        $wp_query   = $items;

        if ( $items->have_posts() ) : while ( $items->have_posts() ) : $items->the_post();

        $topics = get_category_by_slug( 'topics' );
        $members = get_category_by_slug( 'members' );

        $post_topics = wp_get_post_categories(
          get_the_ID(),
          array(
            'exclude' => [$topics->term_id],
            'exclude_tree' => [$members->term_id]
          )
        );
        $cats = array();
            
        foreach($post_topics as $c){
            $cat = get_category( $c );
            $cats[] = array( 'name' => $cat->name, 'slug' => $cat->slug );
        }

        $post_members = wp_get_post_categories(
          get_the_ID(),
          array(
            'exclude' => [$members->term_id],
            'exclude_tree' => [$topics->term_id]
          )
        );
        $mems = array();
            
        foreach($post_members as $m){
            $mem = get_category( $m );
            $mems[] = array( 'name' => $mem->name, 'slug' => $mem->slug );
        }

        ?>

        <a href="<?php the_permalink() ?>"" class="w-full flex flex-wrap content-start items-center hover:shadow p-2">
          <div class="w-1/4 p-4">
            <?php if ( has_post_thumbnail() ) { ?>
              <img src="<?php echo the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
            <?php } ?>
          </div>
          <div class="w-3/4 p-4">
            <?php if ( has_category('webinar') ) { ?>
              <span class="rounded inline-block bg-grey-light text-grey-dark text-xs p-1 my-1">Webinar</span>
            <?php } else if ( has_category('workshop') ) { ?>
              <span class="rounded inline-block bg-grey-light text-grey-dark text-xs p-1 my-1">Workshop</span>
            <?php } else if ( get_post_type() == 'resources' ) { ?>
              <span class="rounded inline-block bg-grey-light text-grey-dark text-xs p-1 my-1">Good Practice Library</span>
            <?php } ?>
            <h2 class="text-black hover:text-anblue"><?php the_title(); ?></h2>
          </div>
        </a>

        <?php endwhile; ?>
      </div>
      <nav class="flex flex-wrap w-full lg:w-1/3 m-auto p-6">
        <?php if ( $items->max_num_pages > 1 ) {
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
        
      <?php
        $wp_query = NULL;
        $wp_query = $temp_query;

        endif;
        wp_reset_postdata();
      ?>
    </article>
  </section>
</main>
<?php get_footer(); ?>