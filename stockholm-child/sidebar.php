<?php 
global $qode_options;
global $qode_page_id;
$sidebar_id =  $qode_page_id;
?>
	<div class="column_inner">
		<aside class="sidebar">
			<?php	
			$sidebar = "";

            $is_woocommerce=false;
            if(function_exists("is_woocommerce")) {
                $is_woocommerce = is_woocommerce();
                if($is_woocommerce){
					$sidebar_id = get_option('woocommerce_shop_page_id');
                }
            }
		
			if(get_post_meta($sidebar_id, 'qode_choose-sidebar', true) != ""){
				$sidebar = get_post_meta($sidebar_id, 'qode_choose-sidebar', true);
			}else{
				if (is_singular("post")) {
					if($qode_options['blog_single_sidebar_custom_display'] != ""){
						$sidebar = $qode_options['blog_single_sidebar_custom_display'];
					}else{
						$sidebar = "Sidebar";
					}
				} elseif (is_singular("portfolio_page") && $qode_options['portfolio_single_sidebar_custom_display'] != ""){
					$sidebar = $qode_options['portfolio_single_sidebar_custom_display'];
				} else {
					$sidebar = "Sidebar Page";
				}
			}
			?>
				
			<?php if(function_exists('dynamic_sidebar') && dynamic_sidebar($sidebar)) : 
			endif;  ?>
            <!--sidebar content for glossary pages-->
            <div id="post_image">
            <?php
			//related image
			$related_image = get_field('related_image');
			$related_caption =  get_field('related_caption'); 
			if (!empty($related_image)) { 
			  //add related image
			  echo '<img src="'.$related_image['url'].'" alt="'.$related_caption.'"/>';
			  
			  echo '<p class="related_caption">' . $related_caption .'</p>'; 
			 }
			?>
            </div>
            <div id="related_artist">
            <?php
			if (get_field('artist_acquisitions') || get_field('artist_exhibitions') || get_field('artist_writings') || get_field('artist_media')) { 
				echo '<p class="spacer"></p>';
				echo '<ul class="related-list">';
				if (get_field('artist_acquisitions')) {
				  echo '<li class="relatedside">';
				  echo '<h3 class="related">Artist Acquisitions</h3>';
				  echo '<p>' . get_field('artist_acquisitions') . '</p>'; 
				  echo '</li>';
				}
				if (get_field('artist_exhibitions')) {
				  echo '<li class="relatedside">';
				  echo '<h3 class="related">Artist Exhibitions</h3>';
				  echo '<p>' . get_field('artist_exhibitions') . '</p>'; 
				  echo '</li>';
				}
				if (get_field('artist_writings')) {
				  echo '<li class="relatedside">';
				  echo '<h3 class="related">Writings</h3>';
				  echo '<p>' . get_field('artist_writings') . '</p>'; 
				  echo '</li>';
				}
				if (get_field('artist_media')) {
				  echo '<li class="relatedside">';
				  echo '<h3 class="related">Media</h3>';
				  echo '<p>' . get_field('artist_media') . '</p>'; 
				  echo '</li>';
				}
				echo '</ul>';
			  }		
			?>   
            </div>
		</aside>
	</div>
