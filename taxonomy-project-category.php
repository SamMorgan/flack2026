<?php get_header(); ?>
<div class="project-category-container" id="work-index-wrapper">
    <?php
    $term = get_queried_object();
    $project_query = null;

    if ( $term instanceof WP_Term ) {
    $menu_parent_id = $term->parent ? $term->parent : $term->term_id;
    $children = get_terms(array(
        'taxonomy' => $term->taxonomy,
        'parent' => $menu_parent_id,
        'hide_empty' => true,
    ));

    if ( ! is_wp_error($children) && ! empty($children) ) {
        $parent_term = $term->parent ? get_term($term->parent, $term->taxonomy) : $term;
        $parent_link = $parent_term && ! is_wp_error($parent_term) ? get_term_link($parent_term) : '';
        $parent_markup = '';
        $parent_markup_dupe = '';
        if ( $parent_term && ! is_wp_error($parent_term) && ! is_wp_error($parent_link) ) {
            if ( $term->term_id === $parent_term->term_id ) {
                $parent_markup = '<span class="current">' . esc_html($parent_term->name) . '</span>';
                $parent_markup_dupe = '<span class="current" aria-hidden="true">' . esc_html($parent_term->name) . '</span>';
            } else {
                $parent_markup = '<a href="' . esc_url($parent_link) . '">' . esc_html($parent_term->name) . '</a>';
                $parent_markup_dupe = '<a href="' . esc_url($parent_link) . '" rel="nofollow" tabindex="-1">' . esc_html($parent_term->name) . '</a>';
            }
        }

        $child_links = array();
        $child_links_dupe = array();
        foreach ( $children as $child ) {
            $child_link = get_term_link($child);
            if ( ! is_wp_error($child_link) ) {
                if ( $child->term_id === $term->term_id ) {
                $child_links[] = '<span class="current">' . esc_html($child->name) . '</span>';
                $child_links_dupe[] = '<span class="current" aria-hidden="true">' . esc_html($child->name) . '</span>';
                } else {
                $child_links[] = '<a href="' . esc_url($child_link) . '">' . esc_html($child->name) . '</a>';
                $child_links_dupe[] = '<a href="' . esc_url($child_link) . '" rel="nofollow" tabindex="-1">' . esc_html($child->name) . '</a>';
                }
            }
        }
        if ( ! empty($child_links) ) {
        ?>
        <div class="project-category-submenu">
            <?php
                if ( $parent_markup ) {
                    echo $parent_markup . ' — ';
                }
                echo implode(', ', $child_links);
            ?>
        </div>
        <div class="project-category-submenu clickable" aria-hidden="true" data-nosnippet="true">
            <?php
                if ( $parent_markup_dupe ) {
                    echo $parent_markup_dupe . ' — ';
                }
                echo implode(', ', $child_links_dupe);
            ?>
        </div>
        <?php
        }
    }

    $upcoming_term = get_term_by('slug', 'upcoming', 'status');
    $upcoming_term_id = $upcoming_term ? $upcoming_term->term_id : 0;

    $args = array(
        'post_type' => 'projects',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => $term->taxonomy,
                'field' => 'term_id',
                'terms' => array($term->term_id),
                'include_children' => true,
            ),
            array(
                'taxonomy' => 'status',
                'field' => 'term_id',
                'terms' => array($upcoming_term_id),
                'operator' => 'NOT IN',
                'include_children' => false,
            ),
        ),
    );

    $project_query = new WP_Query($args);
    }
    ?>
    <div class="work-index current">
    <?php if ( $project_query && $project_query->have_posts() ) : while ( $project_query->have_posts() ) : $project_query->the_post();
        get_template_part('includes/project-card');
    endwhile; wp_reset_postdata(); endif; ?>
    </div>
</div>
<?php get_footer(); ?>