<?php /* Template Name: Good Practice Library */ ?>

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

      <!-- Resource filters -->
      <div class="flex flex-wrap w-full m-auto p-6">
        <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
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
            <input type="hidden" name="action" value="filter_resource">
          </div>
        </form>
      </div>

      <!-- Resource items -->
      <div class="flex flex-wrap w-full m-auto p-6" id="response">
      <?php

        $resources = new WP_Query( array(
          'post_type' => 'resources',
          'posts_per_page' => 12,
          'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1
        ) );

        $temp_query = $wp_query;
        $wp_query   = NULL;
        $wp_query   = $resources;

        if ( $resources->have_posts() ) : while ( $resources->have_posts() ) : $resources->the_post();

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
            $mems[] = array( 'name' => $mem->name, 'slug' => $mem->slug, 'id' => $mem->term_id );
        }

        ?>

        <a href="<?php the_permalink() ?>"" class="w-full md:w-1/2 lg:w-1/4 md:w-1/2 flex flex-wrap content-start items-center hover:shadow p-6">
          <div class="w-full p-4">
            <h2 class="text-black hover:text-anblue"><?php the_title(); ?></h2>
            <div class="pt-4">
            <?php if ($mems[0]['name']) { ?>
              <?php
                $args = array(
                  'numberposts' => 1,
                  'category' => $mems[0]['id'],
                  'post_type' => 'members'
                );

                $currentOrg = get_posts($args);

              ?>
              <?php if ( get_the_post_thumbnail_url($currentOrg[0]->ID) ) { ?>
                <img class="w-16" src="<?php echo get_the_post_thumbnail_url($currentOrg[0]->ID); ?>" alt="<?php echo $currentOrg[0]->post_title; ?>">
              <?php } else { ?>
                <span class="inline-block align-middle text-grey text-sm py-2"><?php echo $currentOrg[0]->post_title; ?></span>
              <?php } ?>
            <?php } ?>
            </div>
            <p class="text-grey-darker text-sm mt-2"><?php echo esc_html( get_the_excerpt() ); ?></p>
            <span class="text-grey text-sm">Topics:</span>
            <div>
              <?php foreach($cats as $cat) { ?>
                <span class="rounded inline-block bg-grey-light text-grey-dark text-xs p-1 my-1"><?php echo $cat['name']; ?></span>
              <?php } ?>
            </div>
          </div>
        </a>

        <?php endwhile; ?>
        <div class="w-full block m-auto p-6">
          <nav class="flex flex-wrap">
            <?php if ( $resources->max_num_pages > 1 ) {
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
        </div>
        
        <?php
          $wp_query = NULL;
          $wp_query = $temp_query;

          endif;
          wp_reset_postdata();
        ?>
      </div>
    </article>
  </section>
</main>
<?php get_footer(); ?>