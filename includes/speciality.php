<?php

function tmd_speciality_redirect() {

    if ( tmd_is_speciality() && !is_user_logged_in() ) {
        wp_redirect( add_query_arg( array( 'redirect_to' => get_permalink() ), site_url( '/register' ) ) );
        exit;
    }

}