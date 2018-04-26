<?php
// Adds your styles to the WordPress editor
add_action( 'after_setup_theme', 'add_editor_styles' );
function add_editor_styles() {
    add_editor_style( get_template_directory_uri() . '/assets/css/style.min.css' );
}