<?php

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function themefurnace_add_meta_box() {

    $screens = array( 'staff' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'themefurnace_twitter',
            __( 'Twitter URL', 'themefurnace' ),
            'themefurnace_meta_box_callback',
            $screen,
            'side',
            'default',
            array(
                'meta_key' => 'themefurnace_meta_box_twitter',
                'label' => 'Twitter URL'
            )
        );
        add_meta_box(
            'themefurnace_facebook',
            __( 'Facebook page URL', 'themefurnace' ),
            'themefurnace_meta_box_callback',
            $screen,
            'side',
            'default',
            array(
                'meta_key' => 'themefurnace_meta_box_facebook',
                'label' => 'Facebook profile URL'
            )
        );
        add_meta_box(
            'themefurnace_linkedin',
            __( 'Linkedin profile URL', 'themefurnace' ),
            'themefurnace_meta_box_callback',
            $screen,
            'side',
            'default',
            array(
                'meta_key' => 'themefurnace_meta_box_linkedin',
                'label' => 'Linkedin profile URL'
            )
        );
        add_meta_box(
            'themefurnace_googleplus',
            __( 'Google+ profile URL', 'themefurnace' ),
            'themefurnace_meta_box_callback',
            $screen,
            'side',
            'default',
            array(
                'meta_key' => 'themefurnace_meta_box_google-plus',
                'label' => 'Google+ profile URL'
            )
        );

    }
}
add_action( 'add_meta_boxes', 'themefurnace_add_meta_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function themefurnace_meta_box_callback( $post, $args = array() ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'themefurnace_meta_box', 'themefurnace_meta_box_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */

    $value = get_post_meta( $post->ID, $args['args']['meta_key'], true );

    echo '<label for="themefurnace_'.$args['args']['meta_key'].'">';
    _e( $args['args']['label'], 'themefurnace' );
    echo '</label> ';
    echo '<input type="text" id="themefurnace_'.$args['args']['meta_key'].'" name="themefurnace_social['.$args['args']['meta_key'].']" value="' . ( ( isset( $value ) && is_scalar( $value ) ) ? esc_attr( $value ) : '' ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function themefurnace_save_meta_box_data( $post_id ) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['themefurnace_meta_box_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['themefurnace_meta_box_nonce'], 'themefurnace_meta_box' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'staff' === $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }


        /* OK, it's safe for us to save the data now. */

        // Make sure that it is set.
        if ( ! isset( $_POST['themefurnace_social'] ) ) {
            return;
        }

        foreach( $_POST['themefurnace_social'] as $meta_key => $val ) {
            // Sanitize user input.
            $my_data = sanitize_text_field( $val );
            // Update the meta field in the database.
            update_post_meta( $post_id, esc_attr($meta_key), $my_data );
        }
    }
}
add_action( 'save_post', 'themefurnace_save_meta_box_data' );