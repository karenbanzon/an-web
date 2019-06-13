<?php /* Template Name: Good Practice Library */ ?>

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

      <!-- Resource filters -->
      <div class="flex flex-wrap w-full lg:w-3/4 m-auto p-6">
        <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
          <div class="flex w-full pl-6 pr-6 justify-center">
            <select name="member_cat" class="mr-2">
              <option value="" selected disabled>Select member organization</option>
              <option value="">All</option>
              <?php
                $parentCategory = 'members';
                $parentCategoryObject = get_category_by_slug($parentCategory); 
                $parentCategoryId = $parentCategoryObject->term_id;
                $terms = get_term_children( $parentCategoryId, 'category' );

                foreach ( $terms as $term ) {
                    $item = get_term_by( 'id', $term, 'category' );
                    echo '<option class="p-4" value="' . $item->term_id . '">' . $item->name . '</option>';
                }
              ?>
            </select>
            <select name="topic_cat" class="mr-2">
              <option value="" selected disabled>Select topic</option>
              <option value="">All</option>
              <?php
                $parentCategory = 'topics';
                $parentCategoryObject = get_category_by_slug($parentCategory); 
                $parentCategoryId = $parentCategoryObject->term_id;
                $terms = get_term_children( $parentCategoryId, 'category' );

                foreach ( $terms as $term ) {
                    $item = get_term_by( 'id', $term, 'category' );
                    echo '<option class="p-4" value="' . $item->term_id . '">' . $item->name . '</option>';
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
      <div class="flex flex-wrap w-full lg:w-3/4 m-auto pb-4" id="response">
      <?php

        $resources = new WP_Query( array(
          'post_type' => 'resources',
          'posts_per_page' => -1
        ) );

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
            $mems[] = array( 'name' => $mem->name, 'slug' => $mem->slug );
        }

        ?>

        <a href="<?php the_permalink() ?>"" class="w-full flex flex-wrap items-center hover:shadow p-6">
          <div class="w-full lg:w-1/3">
            <?php if ( has_post_thumbnail() ) { ?>
              <img src="<?php echo the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
            <?php } ?>
          </div>
          <div class="w-full lg:w-2/3 p-4">
            <h2 class="text-black hover:text-anblue"><?php the_title(); ?></h2>
            <?php if ($mems[0]['name']) { ?>
              <span class="inline-block text-grey text-sm py-2"><?php echo $mems[0]['name']; ?></span>
            <?php } ?>
            <p class="text-grey-darker text-sm mt-4"><?php echo esc_html( get_the_excerpt() ); ?></p>
            <span class="text-grey text-sm">Topics:</span>
            <div>
              <?php foreach($cats as $cat) { ?>
                <span class="rounded inline-block bg-grey-light text-grey-dark text-xs p-1 my-1"><?php echo $cat['name']; ?></span>
              <?php } ?>
            </div>
          </div>
        </a>

        <?php endwhile; endif; wp_reset_postdata();?>
      </div>
    </article>
  </section>
</main>
<?php get_footer(); ?>