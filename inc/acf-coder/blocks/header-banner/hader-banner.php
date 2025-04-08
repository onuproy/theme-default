<?php

/**
 * Header Banner Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'hader_banner-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'hader_banner';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.
$title = get_field('title') ?: 'Your Title here...';
$subtitle = get_field('subtitle') ?: 'Subtitle';
$button = get_field('button') ?: 'Button';
$button_url = get_field('button_url') ?: 'URL';
$image = get_field('image');
$image_url = get_field('image_url') ?: 'Image URL';

?>
<section id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> bennar_area">
    <div class="container-fluid">
        <div class="row align-items-center">

            <div class="col-lg-8 col-md-12">
                <div class="bennat_left">
                    <h1><?php echo $title;?></h1>
                    <p><?php echo $subtitle;?></p>

                    <a href="<?php echo $button_url;?>"><?php echo $button;?></a>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="bennar_right">
                    <a href="<?php echo $image_url;?>"><img src="<?php echo $image['url'];?>" alt="Group"></a>
                </div>
            </div>

        </div>
    </div>
</section>
