<?php body_metadata(); ?>
	<div class="subcontent press">
		<?php

  $custom_field_keys = get_post_custom_keys();
  foreach ( $custom_field_keys as $key => $value ) {
    $valuet = trim($value);
      if ( '_' == $valuet{0} )
      continue;
    $link = get_post_custom_values( $value );
  	echo '<p><a target="_blank" href="'.$link[0].'">'. $value .'</a></p><br>';
  }
?>
	</div>
	