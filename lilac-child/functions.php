<?php
add_action( 'wp_enqueue_scripts', 'lilac_child_enqueue_styles', 100);
function lilac_child_enqueue_styles() {
	wp_enqueue_style( 'lilac-parent', get_stylesheet_directory_uri('/style.css') );
}

function append_query_string( $url, $post ) {
    if ( 'my_custom_post_type' == get_post_type( $post ) ) {
        return add_query_arg( $_GET, $catalog_link );
    }
    return $url;
}
add_filter( 'post_type_link', 'append_query_string', 10, 2 );

// function custom_shop_page_title( $title ) {
//     if ( is_shop() ) { // Check if it's the shop page
//         $title = 'Products'; // Replace 'Your New Shop Title' with your desired title
//     }
//     return $title;
// }
// add_filter( 'the_title', 'custom_shop_page_title' );

add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {
    // Check function exists.
    if( function_exists('acf_register_block_type') ) {
        // register a banner block.
        acf_register_block_type(array(
            'name'              => 'committee-list',
            'title'             => __('Committee List'),
            'description'       => __('A custom committee list block.'),
            'render_template'   => 'template-parts/blocks/catalog/all-blogs.php',
            'category'          => 'formatting',
            'icon'              => 'format-gallery',
            'keywords'          => array( 'committee list', 'quote' ),
        ));

    }
}

// Function to generate the content for the custom blog block
function custom_blog_block_shortcode($atts) {

    ob_start(); // Start output buffering

    // Your existing code
    $id = 'all-blogs-' . uniqid();
    $className = 'all-blogs-';
    // ... (rest of your existing code)
    // Load values and assign defaults.
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'post',
    'orderby'   => 'date',
    'post_status' => 'publish',
    'order'     => 'DES',
    'paged' => $paged,
    'posts_per_page'     => -1
);
$query = new WP_Query( $args );
$total_pages = $query->max_num_pages;

?>
<div
  class="elementor-element elementor-element-2c444f8 elementor-widget elementor-widget-wdt-blog-posts"
  data-id="2c444f8"
  data-element_type="widget"
  data-settings='{"wdt_animation_effect":"none"}'
  data-widget_type="wdt-blog-posts.default"
>
  <div class="elementor-widget-container">
    <div class="wdt-posts-list-wrapper">
      <div class="tpl-blog-holder apply-equal-height">
        <!-- card -->
        <div class="grid-sizer entry-grid-layout wdt-simple-style wdt-fadeinleft-hover wdt-default-overlay alignnone column wdt-one-third wdt-post-entry"></div>
<?php
 if ( $query->have_posts() ) :  
    while ( $query->have_posts() ) :
        
    $query->the_post(); 
    $post_id = get_the_ID(); 
        $file = get_field('catalog_link');
        ?>
                <div class="entry-grid-layout wdt-simple-style wdt-fadeinleft-hover wdt-default-overlay alignnone column wdt-one-third wdt-post-entry">
          <article
            id="post-<?php echo $post_id; ?>"
            class="post-<?php echo $post_id; ?> post type-post status-publish format-standard has-post-thumbnail hentry category-matte-makeup category-nude-makeup tag-fragrance tag-suspensions blog-entry"
            style="min-height: 566.417px"
          >
            <!-- Featured Image -->
            <div class="entry-thumb">
              <a
                href="<?php echo  $file['url'];?>"
                target="_blank"
                title="<?php echo esc_attr(get_the_title()); ?>"
                ><img
                  fetchpriority="high"
                  src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>"
                  class="attachment-wdt-blog-iii-column size-wdt-blog-iii-column wp-post-image"
                  alt="<?php echo esc_attr(get_the_title()); ?>"
                  decoding="async"
                  sizes="(max-width: 1300px) 100vw, 1300px"
                  width="1300"
                  height="780"
              /></a>
            </div>
            <!-- Featured Image -->
            <!-- Entry Date -->
            <div class="entry-date">
              <i class="wdticon-calendar"> </i>
              June 12, 2023
            </div>
            <!-- Entry Date -->
            <!-- Entry Title -->
            <div class="entry-title">
              <h4>
                <a
                  href="<?php echo  $file['url'];?>"
                  target="_blank"
                  title="<?php echo esc_attr(get_the_title()); ?>"
                  ><?php echo get_the_title()?></a
                >
              </h4>
            </div>
            <!-- Entry Title -->
            <div class="entry-body">
              <p>
              <?php echo wp_trim_words( get_the_excerpt(), 50); ?>
              </p>
            </div>

            <!-- Entry Button -->
            <div class="entry-button wdt-core-button">
              <a
                href="<?php echo  $file['url'];?>"
                target="_blank"
                title="<?php get_the_title()?>"
                class="wdt-button"
                >View Catalog<span
                  ><svg
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    x="0px"
                    y="0px"
                    viewBox="0 0 100 59"
                    style="enable-background: new 0 0 100 59"
                    xml:space="preserve"
                  >
                    <polygon
                      points="59.9,6.1 79.4,25.7 6,25.7 6,33.3 79.4,33.3 59.9,52.9 65.3,58.2 94,29.5 65.3,0.8 "
                    ></polygon></svg></span
              ></a>
            </div>
            <!-- Entry Button -->
          </article>
        </div>
        <?php
    endwhile;
 endif;
?>

        <!-- ------------ -->
      </div>   
      <div class="pagination blog-pagination">
        <div class="column one pager_wrapper">
          <ul class="page-numbers">
            <li>
              <span aria-current="page" class="page-numbers current">1</span>
            </li>
            <li>
              <a
                class="page-numbers"
                href="http://localhost/vizoCosmetics/catalog/page/2/"
                >2</a
              >
            </li>
            <li>
              <a
                class="next page-numbers"
                href="http://localhost/vizoCosmetics/catalog/page/2/"
                ><i class="wdticon-angle-double-right"></i
              ></a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

</div>

<?php
    // Output buffering contents
    $output = ob_get_clean();

    return $output;
    
}
the_content();
// Register the shortcode
add_shortcode('custom_blog_block', 'custom_blog_block_shortcode');
