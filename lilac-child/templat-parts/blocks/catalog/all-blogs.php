<?php

/**
 * blog Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'all-blogs-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'all-blogs-';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'post',
    'orderby'   => 'date',
    'post_status' => 'publish',
    'order'     => 'DES',
    'paged' => $paged,
    'posts_per_page'     => '12'
);
$query = new WP_Query( $args );
$total_pages = $query->max_num_pages;

?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> row">
    <div class="col-md-3 category-section-container">
        <h5 class="category-heading-text">Category</h5>
        <hr class="category-separator"></hr>

        
                <?php $categories = get_categories();
                            foreach($categories as $category) {
                            echo '<div class="col-md-4 category-links-container"><a class ="category-links" href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></div>';
                            } ?>
    </div>
    <div class="col">
    <div class="row">
        <?php if ( $query->have_posts() ) :  ?>
        <?php while ( $query->have_posts() ) { $query->the_post(); ?>
        <div class="col-sm-12 col-md-12 col-lg-6 col-xl-3 blog-box all-blogs-item">
            <div class="cont card-align all-blog-cont">
                <div class="thumb all-blog-thumb">
                    <div class="overlay"></div>
                    <?php 
                     $link = get_permalink();
                                if(has_post_thumbnail()){ ?>
                                    
                                    <a class="more-link" href="<?php echo $link ?>"><?php echo the_post_thumbnail( 'large' ); ?></a>
                               <?php }else{ ?>
                                        <a class="more-link" href="<?php echo $link ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/thumb-default.jpg"
                                            alt="<?php the_title(); ?>" /></a>
                    
                                     <?php } 
                    ?>

                    <div class="blog-info all-blog-info">
                        <div class="meta">
                            <?php

                                        $fname = get_the_author_meta('first_name');
                                        $lname = get_the_author_meta('last_name');
                                        $full_name = '';
                                       

                                        if( empty($fname)){
                                            $full_name = $lname;
                                        } elseif( empty( $lname )){
                                            $full_name = $fname;
                                        } else {
                                            //both first name and last name are present
                                            $full_name = "{$fname} {$lname}";
                                        }
                                    ?>
                            <!-- <div class="author">
                                <p><?php // echo $full_name; ?></p>
                            </div> -->
                            <!-- <div class="rt">
                                        <p>Reading time: <?php //echo get_field('reading_time', get_the_ID()); ?></p>
                                    </div> -->
                        </div>
                        <p class="mon"><?php echo get_the_date('M'); ?> <?php echo get_the_date('j'); ?>,
                            <?php echo get_the_date('Y'); ?></p>
                        
                        <a class="more-link" href="<?php echo $link ?>"><h2 class="blog-title"><?php the_title(); ?></h2></a>
                        

                        <?php //echo the_content() ?>
                        <?php echo wp_trim_words( get_the_excerpt(), 7); ?>

                        <?php// echo the_excerpt() ?>
                        



                        <a class="more-link" href="<?php echo $link ?>"><p class="read-more-btn">READ MORE</p></a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php
        if ($total_pages > 1){

            $current_page = max(1, get_query_var('paged'));

            $prev = "<";
            $next = ">";
            ?>
            <nav class="wp-container-48 is-content-justification-space-between blog-pagination-container"
                role="navigation" aria-label="Pagination">
                <?php

            echo '<div class="wp-block-query-pagination-numbers full-service"> '.paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '/page/%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text' => __($prev),
            'next_text' => __($next),
            )).'</div>';
            ?> </nav>
        <?php
        }
            
        ?>
        <?php wp_reset_postdata(); ?>
        
       
        <?php else : ?>
        <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
        <?php endif; ?>

        
    </div>
    </div>
    
</div>