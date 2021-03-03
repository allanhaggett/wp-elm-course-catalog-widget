<?php
/*
Plugin Name: wp-elm-course-catalog-widget
Plugin URI: https://github.com/allanhaggett/wp-elm-course-catalog-widget
Description: PeopleSoft ELM Course Catalog Wordpress Search Widget
Author: Allan Haggett <allan.haggett@gov.bc.ca>
Version: 1
Author URI: https://learningcentre.gww.gov.bc.ca
*/

class ELM_CourseCatalog_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'wp_elm_cc_widget',
			'description' => 'PeopleSoft ELM Course Catalog Wordpress Search Widget',
		);
		parent::__construct( 'wp_elm_cc_widget', 'ELM Course Catalog', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
        ?>
        <style>
        .wp-elm-cc-header {
            margin-bottom: 1em;
        }
        .wp-elm-cc-searchfield {
            border: 0;
            padding: 0;
        }
        .wp-elm-cc-item {
            margin: 0 0 1em 0;
            padding: .5em;
        }
        .wp-elm-cc-item-title {
            font-size: 1.1em;
        }
        .wp-elm-cc-item-summary {
            font-size: 1em;
        }
        .wp-elm-cc-item-meta {
            padding: 1em;
        }
        .wp-elm-cc-item-enroll {
            margin: 1em 0;
        }
        .wp-elm-cc-item-enroll-link {
            background-color: #333;
            color: #FFF !important;
            display: inline-block;
            padding: .5em 1.5em;
        }
        .wp-elm-cc-search {
            border: 3px solid #333;
            font-size: 1.5em;
            padding: .5em;
            width: 100%;
        }
        #wp-elm-cc-search-results {
            background: #FFF;
            box-shadow: 0 0 40px #999;
            position: absolute;
            width: 300px;
        }
        </style>
        <div role="section" class="wp-elm-cc">
            <div role="heading" aria-level="1" class="widget-title wp-elm-cc-header">PSA Learning System Course Search</div>
            <form role="search" class="wp-elm-cc-searchform">
                <fieldset class="wp-elm-cc-searchfield">
                    <input type="input" class="wp-elm-cc-search" id="wp-elm-cc-searchbox" placeholder="Type a course name">
                </fieldset>
            </form>
            <div id="wp-elm-cc-search-results"></div>
        </div>
        <script>
        <?php $feed = file_get_contents('https://learn.bcpublicservice.gov.bc.ca/learningcentre/courses/public-feed.json') ?>
        var data = <?= $feed ?>;
        var txtbox = document.getElementById('wp-elm-cc-searchbox');
        txtbox.onkeyup = function(e) {
        
            var searchfield = txtbox.value;
            if(searchfield === '')  {
                document.getElementById('wp-elm-cc-search-results').innerHTML = '';
                return;
            }
            
            var regex = new RegExp(searchfield, "i");
            var output = '<div class="wp-elm-cc-container">';
            data.forEach(function(item,index){
            if (
                    (item.title.search(regex) != -1) || 
                    (item.delivery_method.search(regex) != -1) || 
                    (item.summary.search(regex) != -1)
                ) {
                    output += '<div class="wp-elm-cc-item">';
                    output += '<div class="wp-elm-cc-item-title" role="heading" aria-level="3">' + item.title + '</div>';
                    output += '<div class="wp-elm-cc-item-summary">' + item.summary + '</div>';
                    output += '<div class="wp-elm-cc-item-meta">';
                    output += 'Delivery Method: ';
                    output += '<span class="wp-elm-cc-item-delivery-method">' + item.delivery_method + '</span>';
                    output += '<div class="wp-elm-cc-item-tags">Tagged: ' + item.tags + '</div>';
                    output += '</div>';
                    output += '<div class="wp-elm-cc-item-enroll">';
                    output += '<a class="wp-elm-cc-item-enroll-link" href="' + item.url + '" target="_blank">';
                    output += 'Enroll';
                    output += '</a>';
                    output += '</div>';
                    output += '</div>';
                }
            });
            output += '</div>';
            document.getElementById('wp-elm-cc-search-results').innerHTML = output;
         
        };
        </script><?php 
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'ELM_CourseCatalog_Widget' );
});
