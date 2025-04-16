<!-- header.php -->
<?php
if ( is_front_page() ) { 
    // Load header-white.php for the homepage
    get_template_part( 'header', 'white' );
} else { 
    // Load header-black.php for all other pages
    get_template_part( 'header', 'black' );
}
?>
