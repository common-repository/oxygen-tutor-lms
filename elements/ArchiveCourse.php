<?php
namespace Oxygen\TutorElements;

class ArchiveCourse extends \OxygenTutorElements {

	function name() {
		return 'Archive Courses';
	}

	function icon() {
		return plugin_dir_url(OTLMS_FILE) . 'assets/icons/'.basename(__FILE__, '.php').'.svg';
	}

	function render($options, $defaults, $content) {
		$course_post_type = tutor()->course_post_type;

		global $wp_query;
		/**
		 * Start Tutor Template
		 */
		$post_type = get_query_var('post_type');
		$course_category = get_query_var('course-category');
		if ( ($post_type === $course_post_type || ! empty($course_category) )  && $wp_query->is_archive){
			$template = otlms_get_template('archive-course');
			include_once $template;
		}
		/**
		 * End Tutor Template
		 */
	}

	function tutor_button_place() {
		return "archive";
	}

	function controls() {
		$selector = '.tutor-courses-wrap';
		/* Filter section */
		$filter_selector = $selector.' .tutor-course-filter-container';

		$sorting_select = $this->addControlSection("sorting_select", __("Course Filter","oxygen-tutor-lms"), "assets/icon.png", $this);
        $sorting_select_selector = $filter_selector.' .tutor-course-filter .tutor-widget';
        $sorting_select->typographySection(__("Filter Widget Title","oxygen-tutor-lms"), $sorting_select_selector . ' .tutor-widget-title ', $this);
        $sorting_select->typographySection(__("Filter Items","oxygen-tutor-lms"), $sorting_select_selector . ' .tutor-list-item label ', $this);

		/* Course grid */
		$course_col_selector = $selector.' .tutor-course-list';
		$course_grid_selector = $course_col_selector.' .tutor-course-card';
		$course_grid = $this->addControlSection("course_grid", __("Course Grid","oxygen-tutor-lms"), "assets/icon.png", $this);

		/* wishlist icon */
		$wishlist_icon = $course_grid->addControlSection("wishlist_icon", __("Wishlist Icon","oxygen-tutor-lms"), "assets/icon.png", $this);
		$wishlist_icon_selector = $course_grid_selector." .tutor-course-bookmark .tutor-iconic-btn-secondary";
		$wishlist_icon->addStyleControls(
			array(
				array(
					"name" 		=> __('Font Size','oxygen-tutor-lms'),
					"selector" 	=> $wishlist_icon_selector.'i',
					"property" 	=> 'font-size',
				),
				array(
					"name" 		=> __('Font Color','oxygen-tutor-lms'),
					"selector" 	=> $wishlist_icon_selector.' i',
					"property" 	=> 'color',
				),
				array(
					"name" 		=> __('Hover Font Color','oxygen-tutor-lms'),
					"selector" 	=> $wishlist_icon_selector.':hover i',
					"property" 	=> 'color',
				),
				array(
					"name" 		=> __('Background Color','oxygen-tutor-lms'),
					"selector" 	=> $wishlist_icon_selector,
					"property" 	=> 'background-color',
				),
				array(
					"name" 		=> __('Hover Background Color','oxygen-tutor-lms'),
					"selector" 	=> $wishlist_icon_selector.':hover',
					"property" 	=> 'background-color',
				)
			)
		);

		$loop_course_container = $course_grid_selector.' .tutor-card-body';

		/* Stars */
		$stars_section = $course_grid->addControlSection("stars", __("Course Ratings","oxygen-tutor-lms"), "assets/icon.png", $this);
		$star_selector = $loop_course_container." .tutor-course-ratings .tutor-ratings-stars span";
        $stars_section->addStyleControls(
        	array(
        		array(
					"name" 		=> __('Star Color','oxygen-tutor-lms'),
					"selector" 	=> $star_selector,
					"property" 	=> 'color',
				),
				array(
					"name" 		=> __('Star Size','oxygen-tutor-lms'),
					"selector" 	=> $star_selector,
					"property" 	=> 'font-size',
				)
        	)
		);
		$stars_section = $course_grid->typographySection(__("Average Rating","oxygen-tutor-lms"), $loop_course_container . ' .tutor-ratings-average', $this);
		$stars_section = $course_grid->typographySection(__("Total Ratings","oxygen-tutor-lms"), $loop_course_container . ' .tutor-ratings-count', $this);
		
		$course_grid->typographySection(__("Course Title","oxygen-tutor-lms"), $loop_course_container.' .tutor-course-name a', $this);
		$course_grid->typographySection(__("Meta Icon","oxygen-tutor-lms"), $loop_course_container.' .tutor-meta .tutor-meta-icon', $this);
		$course_grid->typographySection(__("Meta Info","oxygen-tutor-lms"), $loop_course_container.' .tutor-meta .tutor-meta-value', $this);
		$course_grid->typographySection(__("Author Label","oxygen-tutor-lms"), $loop_course_container.' .tutor-meta', $this);
		$course_grid->typographySection(__("Author Value","oxygen-tutor-lms"), $loop_course_container.' .tutor-meta a, '.$loop_course_container.' .tutor-course-lising-category a', $this);
		
		$loop_course_container_footer = $course_grid_selector.' .tutor-card-footer';
		$course_grid->typographySection(__("Course Price","oxygen-tutor-lms"), $loop_course_container_footer.' .list-item-price span', $this);

		$add_to_cart_btn = $course_grid->addControlSection("add_to_cart_button", __("Add to Cart","oxygen-tutor-lms"), "assets/icon.png", $this);
		$add_to_cart_btn_selector1 = $loop_course_container_footer.' .tutor-btn-primary';
        $add_to_cart_btn_selector2 = $loop_course_container_footer.' .tutor-btn-outline-primary';
        $add_to_cart_btn_selector = $add_to_cart_btn_selector1.', '.$add_to_cart_btn_selector2;
        $add_to_cart_btn->addPreset(
            "padding",
            "submit_padding",
            __("Button Paddings","oxygen-tutor-lms"),
            $add_to_cart_btn_selector
        );
        $add_to_cart_btn->addStyleControls(
            array(
                array(
                    "name" => __('Background Color','oxygen-tutor-lms'),
                    "selector" => $add_to_cart_btn_selector,
                    "property" => 'background-color',
                ),
                array(
                    "name" => __('Color','oxygen-tutor-lms'),
                    "selector" => $add_to_cart_btn_selector,
                    "property" => 'color',
                ),
				array(
                    "name" => __('Border Color','oxygen-tutor-lms'),
                    "selector" => $add_to_cart_btn_selector,
                    "property" => 'border-color',
                ),
                array(
                    "name" =>__('Hover Background Color','oxygen-tutor-lms'),
                    "selector" => $add_to_cart_btn_selector1.':hover, '.$add_to_cart_btn_selector2.':hover',
                    "property" => 'background-color',
                )
            )
        );
		
		/* grid border and shadows */
		$course_grid->borderSection(__("Border","oxygen-tutor-lms"), $course_grid_selector, $this);
        $course_grid->borderSection(__("Hover Border","oxygen-tutor-lms"), $course_grid_selector.":hover", $this);
		$course_grid->boxShadowSection(__("Box Shadow","oxygen-tutor-lms"), $course_grid_selector, $this);
		$course_grid->boxShadowSection(__("Hover Box Shadow","oxygen-tutor-lms"), $course_grid_selector.":hover", $this);

		/* grid spacing */
		$grid_spacing = $course_grid->addControlSection("grid_spacing", __("Spacing","oxygen-tutor-lms"), "assets/icon.png", $this);
		$grid_spacing->addPreset("padding", "grid_padding", __("Padding","oxygen-tutor-lms"), $course_grid_selector);
		$grid_spacing->addPreset("margin", "grid_margin", __("Margin","oxygen-tutor-lms"), $course_grid_selector);
		
		/* Pagination */
		$pagination_selector = $selector.' .tutor-pagination';
        $pagination = $this->addControlSection("pagination", __("Pagination","oxygen-tutor-lms"), "assets/icon.png", $this);

        $pagination->addStyleControls(
             array(
                array(
                    "selector" => $pagination_selector,
                    "property" => 'font-size',
                ),
                array(
                    "name" => __("Links Text Color","oxygen-tutor-lms"),
                    "selector" => $pagination_selector." a",
                    "property" => 'color',
                ),
                //hover
                array(
                    "name" => __("Hover Text Color","oxygen-tutor-lms"),
                    "selector" => $pagination_selector." a:hover",
                    "property" => 'color',
                ),
                //Active
                array(
                    "name" => __("Active Text Color","oxygen-tutor-lms"),
                    "selector" => $pagination_selector." span.current",
                    "property" => 'color',
                ),
            )
		);
		//border and box shadow
		$pagination->borderSection(__("Border","oxygen-tutor-lms"), $pagination_selector, $this);
        $pagination->borderSection(__("Hover Border","oxygen-tutor-lms"), $pagination_selector, $this);
        $pagination->boxShadowSection(__("Box Shadow","oxygen-tutor-lms"), $pagination_selector, $this);
		$pagination->boxShadowSection(__("Hover Box Shadow","oxygen-tutor-lms"), $pagination_selector, $this);
		
		//pagination spacing
		$pagination_spacing = $pagination->addControlSection("spacing", __("Spacing","oxygen-tutor-lms"), "assets/icon.png", $this);
        $pagination_spacing->addPreset("padding", "pagination_item_padding", __("Padding","oxygen-tutor-lms"), $pagination_selector);
		$pagination_spacing->addPreset("margin", "pagination_item_margin", __("Margin","oxygen-tutor-lms"), $pagination_selector);
	}
}


new ArchiveCourse();