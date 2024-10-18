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
	'isOpen'       => false,
	'currentCount' => 0,
);
?>

<div
	<?php echo get_block_wrapper_attributes(); ?>
        data-wp-interactive="create-block"
	<?php echo wp_interactivity_data_wp_context( $context ); ?>
        data-wp-watch="callbacks.logIsOpen"
>
    <!-- Counter -->
    <h2>Counter</h2>
    <div class="counter">
        <div class="counter__value" data-wp-text="context.currentCount">

        </div>
        <div class="counter__controls">
            <button class="counter__increase" data-wp-on--click="actions.increaseCount">
                Increase
            </button>
            <button class="counter__decrease" data-wp-on--click="actions.decreaseCount">
                Decrease
            </button>
            <button class="counter__decrease" data-wp-on--click="actions.resetCount">
                Reset
            </button>
        </div>
    </div>
</div>