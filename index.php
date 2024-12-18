<?php

// Paste this code in your template or use a plugin like WPCode Lite to embed the php in your posts/pages.

$the_query = new WP_Query(
    array(
        's' => get_the_permalink(), // Current post/page
        'post_type' => 'post',      // Type: post, page or curtom (remove for all)
        "posts_per_page" => "-1",   // Numer of results (-1 for all)
        "order" => "ASC"            // Order: ASC/DES
    )
);

if ( !$the_query->have_posts() ) {
    return;
}
else{ ?>

<div class="related">
	<h3>Linking here:</h3>
  <ul>
		
<?php
while ( $the_query->have_posts() ) {                 // loop through the posts/pages

    $the_query->the_post();
    $id            = get_the_ID();                   // get post ID
    $title         = esc_html( get_the_title() );    // get post title
    $url           = get_the_permalink();            // get url 
    $year          = get_the_date( "Y" );            // get date
    $post_type     = get_post_type();                // get post type (post, page, custon...)
    $categories	   = get_the_category();             // get post categories
    $tags		       = get_the_tags();                 // get post tags
    $suctom_term   = get_the_terms($id, 'custom-term-name'); // for whatever custom terms you use

    if ( has_post_thumbnail( $id) ) {                //  get the thumbnail
        $thumb = get_the_post_thumbnail( $rid, 'full',
            array( "class"   => "related-post-img")
        );
    } else {
        $thumb = null;
    }
  
    echo '<li><a href="' . $url . '">' . $thumb . $title . $year . '</a><br>';
    echo 'Categories:';
    foreach($category as $categories) echo $category;
    echo '<br>Tags:';
    foreach($tag as $tags) echo $tag;
    echo '</li>';
      
	}?>
</ul>
</div> <!-- related div -->
<?php } ?>
