		<?php 
		global $post; 
		if ( is_page() && $post->post_parent ) {
			echo '<nav id="secondary-nav" class="subpages footer-buttons"><ul>';
			$children = wp_list_pages( array(
				'parent' => $post->post_parent,
				'title_li' => ''
			) );
			echo '</ul></nav>';
			echo count($children);
		}
		?>
		</div>
	</main>
	<?php wp_footer(); ?>
	</body>
</html>