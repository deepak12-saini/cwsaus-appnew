<?php 

require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );

?>


<?php

$id=74;
$post = get_post($id);
$title = apply_filters('the_title', $post->post_title);
echo $title;
$content = apply_filters('the_content', $post->post_content);
//echo $content;

$content1 = explode('[vc_column_text]', $content);

$content2 = explode('[/vc_column_text]', $content1[1]);

print_r( $content2[0]);


?>


