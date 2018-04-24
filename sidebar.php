<?php 
/**
 * The sidebar containing the main widget area
 *
 * Original Theme Created by Joints WP
 * Last Modified by Nessit on 3/2/18
 */

global $sidebar_width;

 ?>

<div id="sidebar1" class="sidebar large-<?php echo $sidebar_width; ?> medium-<?php echo $sidebar_width; ?> small-12 cell" role="complementary">

	<?php 
		do_action('joints_sidebar_inner');
	?>

</div>