		<?php 
		global $post; 
		if ( is_page() && $post->post_parent ) {
			echo '<nav id="secondary-nav" class="subpages footer-buttons"><ul>';
			// $parents = get_post_ancestors( $post );
			// if ( ! empty( $parents ) && in_array('3787')) {
				
			// }
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