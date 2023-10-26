<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_Video_Carousel_Widget extends \Elementor\Widget_Base {


	public function get_name() {
		return 'video-carousel';
	}


	public function get_title() {
		return esc_html__( 'Video Carousel', 'elementor-video-carousel-widget' );
	}


	public function get_icon() {
		return 'eicon-media-carousel';
	}

	
	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}


	public function get_categories() {
		return [ 'general' ];
	}

	
	public function get_keywords() {
		return [ 'media', 'carousel', 'video', 'lightbox' ];
	}


	protected function register_controls() {
		$this->start_controls_section(
			'section_video_carousel',
			[
				'label' => esc_html__( 'Video Carousel', 'elementor-video-carousel-widget' ),
			]
		);

		$this->add_control(
			'pods-field',
			[
				'label' => esc_html__( 'Video Files Pod Name', 'elementor-video-carousel-widget' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => [],		
			]
		);

		$this->add_control(
			'video-field-type',
			[
				'label' => esc_html__( 'Choose Video Type in field', 'elementor-video-carousel-widget' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'hosted/uploaded',
				'options' => [
					'youtube' => esc_html__( 'YouTube', 'elementor-video-carousel-widget' ),
					'hosted/uploaded' => esc_html__( 'Self Hosted or Uploaded', 'elementor-video-carousel-widget' ),
				],
				'frontend_available' => true,
				
			]
		);
		$this->add_control(
			'slide_width',
			[
				'label' => __('Slide Width', 'elementor-video-carousel-widget'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 100, // Set your default slide width
				'max' =>100,
			]
		);
	
		$this->add_control(
			'slide_height',
			[
				'label' => __('Slide Height', 'elementor-video-carousel-widget'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 400, // Set your default slide height
				"min" => 400,
			]
		);
		$this->add_control(
			'loop',
			[
				'label' => __('Enable Loop', 'elementor-video-carousel-widget'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
	
		$this->add_control(
			'margin',
			[
				'label' => __('Margin', 'elementor-video-carousel-widget'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 20, // Default margin value
			]
		);
	
		$this->add_control(
			'nav',
			[
				'label' => __('Show Navigation Arrows', 'elementor-video-carousel-widget'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
	
		$this->add_control(
			'nav_size',
			[
				'label' => __('Navigation Size', 'elementor-video-carousel-widget'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 30, // Default nav size in pixels
			]
		);
		
		$this->add_control(
			'nav_color',
			[
				'label' => __('Navigation Color', 'elementor-video-carousel-widget'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000000', // Default nav color
			]
		);
		
		
		
		$this->add_control(
			'show_dots',
			[
				'label' => __('Show Dots', 'elementor-video-carousel-widget'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		
	
		$this->add_control(
			'autoplay',
			[
				'label' => __('Autoplay', 'elementor-video-carousel-widget'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
	
		$this->add_control(
			'autoplay_timeout',
			[
				'label' => __('Autoplay Timeout (ms)', 'elementor-video-carousel-widget'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 6000, // Default autoplay timeout value
			]
		);
		$this->add_control(
			'enable_plyr',
			[
				'label' => __('Enable Plyr.js', 'elementor-video-carousel-widget'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __('Yes', 'elementor-video-carousel-widget'),
				'label_off' => __('No', 'elementor-video-carousel-widget'),
				'return_value' => 'yes', // Value when enabled
				'default' => 'yes', // Default to enabled
			]
		);
		$this->add_control(
			'items_mobile',
			[
				'label' => __('Items on Mobile', 'elementor-video-carousel-widget'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 1, // Default number of items on mobile
			]
		);
	
		$this->add_control(
			'items_tablet',
			[
				'label' => __('Items on Tablet', 'elementor-video-carousel-widget'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 1, // Default number of items on tablet
			]
		);
	
		$this->add_control(
			'items_laptop',
			[
				'label' => __('Items on Laptop', 'elementor-video-carousel-widget'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 1, // Default number of items on laptop
			]
		);
	
		$this->add_control(
			'items_desktop',
			[
				'label' => __('Items on Desktop', 'elementor-video-carousel-widget'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 2, // Default number of items on desktop
			]
		);
	
	
		$this->end_controls_section();
	}

	/**
	 * Render image carousel widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	// protected function render() {
	// 	$settings = $this->get_settings_for_display();
	// 	$pods_field_name = $settings['pods-field'];
	// 	echo "<pre>";
	// 	var_dump(pods_field($pods_field_name));
	// 	var_dump($settings);
	// 	echo "</pre>";
	
	// }
	protected function render() {
		$settings = $this->get_settings_for_display();
	
		$pods_field_name = $settings['pods-field'];
		$videos = pods_field($pods_field_name);
		$enable_plyr = $settings['enable_plyr'];
	
		if (!empty($videos)) {
			$carousel_id = 'video-carousel-' . $this->get_id();
			$include_plyr_script = false; // Initialize a flag to include Plyr.js script
	
			if ($enable_plyr === 'yes') {
				// If Plyr.js is enabled, set the flag to include the script
				$include_plyr_script = true;
			}
	
			?>
			<div id="<?php echo esc_attr($carousel_id); ?>" class="elementor-video-carousel owl-carousel">
				<?php
				if (is_array($videos) && isset($videos[0]['guid'])) {
					// Scenario 1: Array of videos
					foreach ($videos as $video) {
						$video_url = $video['guid'];
						?>
						<div class="elementor-video-slide">
						<video class="plyr" height="100%" controls>
							 <source src="<?php echo esc_url($video_url); ?>"  type="video/mp4"></video>
						</div>
					<?php }
				} else {
					// Scenario 2: Array of video URLs
					foreach ($videos as $video_url) {
						?>
						<div class="elementor-video-slide">
						<a class="owl-video" href="<?php echo esc_url($video_url); ?>"></a>
						</div>
					<?php }
				}
				?>
			</div>
	
			<style>
				#<?php echo esc_attr($carousel_id); ?> .elementor-video-slide {
					width: <?php echo esc_attr($settings['slide_width']); ?>%;
					height: <?php echo esc_attr($settings['slide_height']); ?>px;
					margin-bottom : 20px;

				}
				.plyr{
					height:100%;
				}
				.owl-prev{
					margin-right: 10px;
				}
				.owl-next{
					margin-left: 10px;
				}
				.owl-dots {
				text-align: center;
				margin-top: 10px; /* Add some spacing between dots and navigation */
				}
				
				.owl-dot {
				display: inline-block;
				margin: 0 5px;
				}
				
				.owl-dot span {
				width: 10px;
				height: 10px;
				background-color: lightblue;
				border-radius: 50%;
				display: block;
				}
				
				/* Customize active pagination dot */
				.owl-dots .owl-dot.active span {
				width: 5px;
				height: 5px;
				border-radius: 50%;
				background-color: black;
				}
			</style>
	
			<script>
				jQuery(document).ready(function($) {
					var owl = $("#<?php echo esc_js($carousel_id); ?>");
		
					owl.owlCarousel({
						loop: <?php echo $settings['loop'] ? 'true' : 'false'; ?>,
						margin: <?php echo esc_js($settings['margin']); ?>,
						nav: <?php echo $settings['nav'] ? 'true' : 'false'; ?>,
						navText: [
							'<i class="fa fa-angle-left" style="border:2px solid black; border-radius:50%; padding: 10px 20px; font-size: <?php echo esc_js($settings['nav_size']); ?>px; color: <?php echo esc_js($settings['nav_color']); ?>"></i>',
							'<i class="fa fa-angle-right" style="border:2px solid black; border-radius:50%; padding: 10px 20px; font-size: <?php echo esc_js($settings['nav_size']); ?>px; color: <?php echo esc_js($settings['nav_color']); ?>"></i>'
						],
						dots: <?php echo $settings['show_dots'] ? 'true' : 'false'; ?>,
						autoplay: <?php echo $settings['autoplay'] ? 'true' : 'false'; ?>,
						autoplayTimeout: <?php echo esc_js($settings['autoplay_timeout']); ?>,
						video: true,
						responsive: {
							0: {
								items: <?php echo esc_js($settings['items_mobile']); ?>
							},
							768: {
								items: <?php echo esc_js($settings['items_tablet']); ?>
							},
							992: {
								items: <?php echo esc_js($settings['items_laptop']); ?>
							},
							1200: {
								items: <?php echo esc_js($settings['items_desktop']); ?>
							}
						}
					});

				owl.on('mouseover', function () {
        		owl.trigger('stop.owl.autoplay');
        	});

        // Resume autoplay on mouseout
        		owl.on('mouseout', function () {
           		owl.trigger('play.owl.autoplay');
        	});
		});
			</script>


			<?php if ($include_plyr_script) : ?>
				<script>
					document.addEventListener('DOMContentLoaded', () => {
					const players = Plyr.setup('.plyr');
					});
				</script>
			<?php endif; ?>

			<?php
		} else {
			echo 'No videos found.';
		}
	}

}