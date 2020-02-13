<?php /* Template Name: Workshops */ ?>

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

      <hr class="w-full border-b border-grey">

      <!-- Workshop filters -->
      <div class="flex flex-wrap w-full m-auto p-6">
        <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
          <div class="flex flex-wrap w-full px-6">
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
            <input type="hidden" name="action" value="filter_workshop">
          </div>
        </form>
      </div>
      
      <!-- Workshop items -->
      <div class="flex flex-wrap w-full m-auto p-6" id="response">
      <?php
        $regular = new WP_Query( array(
          'post_type' => 'events',
          'category_name' => 'workshop',
          'posts_per_page' => 12,
          'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1
        ) );

        $temp_query = $wp_query;
        $wp_query   = NULL;
        $wp_query   = $regular;

        if ( $regular->have_posts() ) : ?>
        
        <?php while ( $regular->have_posts() ) : $regular->the_post(); ?>

        <div class="w-full md-1/2 lg:w-1/4 p-6 hover:shadow">
          <a href="<?php echo the_permalink(); ?>">
            <?php if ( has_post_thumbnail() ) { ?>
              <div class="bg-cover bg-center mb-2" style="background-image:url(<?php echo the_post_thumbnail_url(); ?>); height: 200px;">
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
        <div class="w-full block m-auto p-6">
          <nav class="flex flex-wrap">
            <?php if ( $regular->max_num_pages > 1 ) {
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