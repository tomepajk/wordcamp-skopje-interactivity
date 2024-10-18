<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

// Generates a unique id for aria-controls.

$unique_id = wp_unique_id( 'p-' );

$context = array(
        'likes' => []
);

$query = new WP_Query( [
	'post_type'      => 'post',
	'posts_per_page' => 5,
] );

if ( $query->have_posts() ) {
	$context['posts'] = [];

	while ( $query->have_posts() ) {
		$query->the_post();

		$context['posts'][] = [
            'id'      => get_the_ID(),
			'title'   => get_the_title(),
			'url'     => get_the_permalink(),
			'excerpt' => get_the_excerpt(),
		];
	}

	wp_reset_postdata();
}

$context['active_post'] = $context['posts'][0] ?? [];
?>

<div class="posts"
	<?php echo get_block_wrapper_attributes(); ?>
     data-wp-interactive="posts-block"
	<?php echo wp_interactivity_data_wp_context( $context ); ?>
>
    <div class="main">
        <template data-wp-each="context.posts" >
            <h3 data-wp-bind--data-post-id="context.item.id" data-wp-text="context.item.title" data-wp-on--click="actions.setCurrentPost"></h3>
            <button data-wp-on--click="actions.likePost" data-wp-bind--data-post-id="context.item.id">Like</button>
        </template>
    </div>
</div>