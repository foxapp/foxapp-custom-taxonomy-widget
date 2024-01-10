<?php

class Elementor_Taxonomy_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'custom_taxonomy_widget';
	}

	public function get_title() {
		return __('FoxApp Taxonomy', 'elementor');
	}

	public function get_icon() {
		//return 'fa fa-tags';
		return 'faicon-post-taxonomy';
	}

	public function get_categories() {
		return ['foxapp'];
	}

	protected function register_controls() {
		$taxonomies = get_taxonomies();

		$taxonomy_options = [];
		foreach ($taxonomies as $taxonomy) {
			$taxonomy_options[$taxonomy] = $taxonomy;
		}

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'elementor' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'taxonomy_name',
			[
				'label' => __('Select Taxonomy', 'elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $taxonomy_options,
				'default' => 'category',
			]
		);

		$this->add_control(
			'taxonomy_name_show',
			[
				'label' => __('Show Taxonomy Name', 'elementor'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'No', 'elementor' ),
					'block' => esc_html__( 'Yes', 'elementor' )
				],
				'default' => 'block',
				'selectors' => [
					'{{WRAPPER}} .taxonomy-name' => 'display: {{VALUE}};',
				],
			]
		);

		$taxonomies = get_taxonomies();

		$taxonomy_options = [];
		foreach ($taxonomies as $taxonomy) {
			$taxonomy_options[$taxonomy] = $taxonomy;
		}

		$this->add_control(
			'taxonomy_logo',
			[
				'label' => __('ACF Logo Key', 'elementor'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'logo',
			]
		);

		$this->add_control(
			'taxonomy_width',
			[
				'label' => __('Logo Width', 'elementor'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
				'default' => [
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [
					'{{WRAPPER}}' => '--e-foxapp-taxonomy-logo-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .taxonomy-logo' => 'width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'taxonomy_height',
			[
				'label' => __('Logo Height', 'elementor'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
				'default' => [
					'unit' => 'custom',
					'size' => '100%',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--e-foxapp-taxonomy-logo-height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .taxonomy-logo' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'taxonomy_max_height',
			[
				'label' => __('Logo Max Height', 'elementor'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}}' => '--e-foxapp-taxonomy-logo-max-height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .taxonomy-logo' => 'max-height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'taxonomy_max_width',
			[
				'label' => __('Logo Max Width', 'elementor'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'em', 'rem', 'vw', 'custom' ],
				'default' => [
					'unit' => 'custom',
					'size' => 'max-content',
				],
				'selectors' => [
					'{{WRAPPER}}' => '--e-foxapp-taxonomy-logo-max-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .taxonomy-logo' => 'max-width: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'taxonomy_gap',
			[
				'label' => __('Gap', 'elementor'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'em', 'rem' ],
				'default' => [
					'unit' => 'px',
					'size' => 5,
				],
				'selectors' => [
					'{{WRAPPER}}' => '--e-foxapp-taxonomy-widget-gap: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'taxonomy_space',
			[
				'label' => __('Space After Logo', 'elementor'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'em', 'rem' ],
				'default' => [
					'unit' => 'px',
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .taxonomy-logo' => '--e-foxapp-taxonomy-logo-space: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .taxonomy-logo' => 'margin-right: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$post_id = get_the_ID();
		$show_taxonomy_name = $this->get_settings('taxonomy_name_show');
		$taxonomy_name = $this->get_settings('taxonomy_name');
		$taxonomy_logo = $this->get_settings('taxonomy_logo');

		$terms = get_the_terms($post_id, $taxonomy_name);

		echo '<div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:flex-start;gap:var(--e-foxapp-taxonomy-widget-gap)">';
		if ($terms && !is_wp_error($terms)) {
			foreach ($terms as $term) {
				if(get_field($taxonomy_logo, $term->taxonomy . '_' . $term->term_id)) {
					$logo = get_field($taxonomy_logo, $term->taxonomy . '_' . $term->term_id);
					//var_dump( get_field($taxonomy_logo, $term->taxonomy . '_' . $term->term_id));
					echo '<img class="taxonomy-logo" src="' . $logo['url'] . '"/> ';
				}
				if($show_taxonomy_name) echo '<span class="taxonomy-name">' . $term->name . '</span> ';

			}

		}
		echo '</div>';
	}
}
