<?php 
		global $post; 
		if ( is_page() && $post->post_parent ) {
			echo '<nav id="secondary-nav" class="subpages footer-buttons"><ul>';
			// $parents = get_post_ancestors( $post );
			// if ( ! empty( $parents ) && in_array('3787')) {
				
			// }
			$ancestors = get_post_ancestors($post); 
			if(count($ancestors) > 1){
				$parent = get_post($ancestors[0]); // Get the immediate parent
				$siblings = wp_list_pages(array(
                    'child_of' => $ancestors[1],
                    'title_li' => '',
                    'echo' => false,
                    'exclude' => $parent->ID // Now $parent is properly defined
                ));
                
                if ($siblings) {
                    echo $siblings;
                }
			}
			$children = wp_list_pages( array(
				'parent' => $post->post_parent,
				'title_li' => '',
				'walker' => new BS_Page_Walker(),
			) );
			echo '</ul></nav>';
			//echo count($children);
		}
		?>
		</div>
	</main>
	<?php wp_footer(); ?>
	</body>
</html>