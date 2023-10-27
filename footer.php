global $post; 
		<?php if ( is_page() && $post->post_parent ) {
			echo '<nav id="secondary-nav" class="subpages footer-buttons"><ul>';
			wp_list_pages( array(
				'parent' => $post->post_parent,
				'title_li' => ''
			) );
			echo '</ul></nav>';
		}?>
	</main>
	<?php wp_footer(); ?>
	</body>
</html>