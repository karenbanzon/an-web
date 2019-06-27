<?php /* Template Name: Member Reports */ ?>

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
      <div class="flex flex-wrap w-full m-auto p-6">
        <table class="w-full">
          <thead class="text-left">
            <th class="p-4">Organization</th>
            <th class="p-4">Report status</th>
            <th class="p-4">Notes</th>
            <th class="p-4 w-64">Report link</th>
          </thead>
          <tbody sheetsu="https://sheetsu.com/apis/v1.0su/7dbc76110d43/">
            <tr class="hover:bg-grey-lightest">
              <td class="p-4">{{member_organization}}</td>
              <td class="p-4"><small class="text-white {{status_color}} p-2 rounded">{{status}}</small></td>
              <td class="p-4"><small class="text-grey">{{notes}}</small></td>
              <td class="p-4 w-64"><a href="{{report_link}}" target="_blank" class="px-4 py-2 bg-white hover:bg-anblue hover:border-anblue hover:text-white text-anblue border rounded border-anblue font-semibold text-sm rounded">View report</a></td>
            </tr>
          </tbody>
        </table>
        <hr>
      </div>
    </article>
  </section>
</main>

<script src="//load.sheetsu.com"></script>
<?php get_footer(); ?>