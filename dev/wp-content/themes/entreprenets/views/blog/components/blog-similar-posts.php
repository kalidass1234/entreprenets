<?php

/**
 * template part for Similar Posts module located in single.php. views/blog/components
 *
 * @author      Artbees
 * @package     jupiter/views
 * @version     5.0.0
 */

if(mk_get_blog_single_style() == 'bold') return false;

global $post, $mk_options;

if ($mk_options['enable_single_related_posts'] == 'true' && get_post_meta($post->ID, '_disable_related_posts', true) != 'false') :

require_once (THEME_INCLUDES . "/bfi_thumb.php");

$backup = $post;
$tags = wp_get_post_tags($post->ID);
$tagIDs = array();
$related_post_found = false;

$layout = get_post_meta($post->ID, '_layout', true);
$layout = !empty($layout) ? $layout : 'full';
$layout = ($layout == 'default') ? $mk_options['single_layout'] : $layout;

if ($layout == 'full') {
    $showposts = 4;
    $width = ($mk_options['grid_width'] / 4) - 30;
    $height = ($mk_options['grid_width'] / 4) - 80;
    $column_css = 'four-cols';
} 
else {
    $showposts = 3;
    $width = (($mk_options['content_width'] / 100) * $mk_options['grid_width']) / 3;
    $height = ((($mk_options['content_width'] / 100) * $mk_options['grid_width']) / 3) - 40;
    $column_css = 'three-cols';
}

if (!function_exists('mk_similar_posts_html')) {
    function mk_similar_posts_html($title, $width, $height, $column_css, $query) {
        $output = '<section class="blog-similar-posts">';
        $output.= '<div class="similar-post-title">' . $title . '</div>';
        $output.= '<ul class="' . $column_css . '">';
        while ($query->have_posts()) {
            $query->the_post();
            $output.= '<li><div class="similar-post-holder">';
            $output.= '<a class="mk-similiar-thumbnail" href="' . get_permalink() . '" title="' . the_title_attribute(array('echo' => false)) . '">';
            if (has_post_thumbnail()) {
                $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id() , 'full', true);
                $image_src = bfi_thumb($image_src_array[0], array(
                    'width' => $width,
                    'height' => $height
                ));
            } 
            else {
                $image_src = bfi_thumb(THEME_IMAGES . '/empty-thumb.png', array(
                    'width' => $width,
                    'height' => $height
                ));
            }
            $output.= '<img src="' . mk_image_generator($image_src, $width, $height) . '" alt="' . the_title_attribute(array('echo' => false)) . '" />';
            $output.= '<div class="image-hover-overlay"></div></a>';
            $output.= '<a href="' . get_permalink() . '" class="mk-similiar-title">' . get_the_title() . '</a>';
            $output.= '</div></li>';
        }
        $output.= '</ul>';
        $output.= '<div class="clearboth"></div></section>';
        echo $output;
    }
}

if ($tags) {
    $tagcount = count($tags);
    for ($i = 0; $i < $tagcount; $i++) {
        $tagIDs[$i] = $tags[$i]->term_id;
    }
    $related = new WP_Query(array(
        'tag__in' => $tagIDs,
        'post__not_in' => array(
            $post->ID
        ) ,
        'showposts' => $showposts,
        'ignore_sticky_posts' => 1
    ));
    $output = '';
    if ($related->have_posts()) {
        $related_post_found = true;
        mk_similar_posts_html(__('Recommended Posts', 'mk_framework') , $width, $height, $column_css, $related);
    }
    $post = $backup;
}
if (!$related_post_found) {
    $recent = new WP_Query(array(
        'showposts' => $showposts,
        'nopaging' => 0,
        'post_status' => 'publish',
        'ignore_sticky_posts' => 1
    ));
    $output = '';
    if ($recent->have_posts()) {
        $related_post_found = true;
        mk_similar_posts_html(__('Recent Posts', 'mk_framework') , $width, $height, $column_css, $recent);
    }
}
wp_reset_postdata();
echo $output;

endif;

