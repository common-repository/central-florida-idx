<?php
/*
Plugin Name: Central Florida IDX
Plugin URI: http://www.idxblue.com/
Description: Displays real estate listings as HTML output
Version: 1.3.3
Author: QBlue.com
Author URI: http://www.idxblue.com
*/
 
/* Copyright 2018 QBlue.com
*/
 
// Start class  //
 
class idxblue_widget extends WP_Widget {
 
// Constructor //
 
function idxblue_widget() {
$widget_ops = array( 'classname' => 'idxblue_widget', 'description' => 'Displays listings' ); // Widget Settings
$control_ops = array( 'id_base' => 'idxblue_widget' ); // Widget Control Settings
$this->WP_Widget( 'idxblue_widget', 'IDXblue', $widget_ops, $control_ops ); // Create the widget
}
 
// Extract Args //
 
function widget($args, $instance) {
extract( $args );
$title = apply_filters('widget_title', $instance['title']); // the widget title
$url = isset($instance['url']) ? $instance['url'] : false ; // give plugin author credit
 
// Before widget //
 
echo $before_widget;
 
// Title of widget //
 
if ( $title ) { echo $before_title . $title . $after_title; }
 
// Widget output //
 $remote_content=wp_remote_get($url);
 echo $remote_content['body'];
 
// After widget //
 
echo $after_widget;
}
 
// Update Settings //
 
function update($new_instance, $old_instance) {
$instance['title'] = strip_tags($new_instance['title']);
$instance['url'] = strip_tags($new_instance['url']);
return $instance;
}

 
// Widget Control Panel //
 
function form($instance) {
 
$defaults = array( 'title' => 'Listings', 'url' => 'http://tmls.idxblue.com/');
$instance = wp_parse_args( (array) $instance, $defaults ); ?>
 
<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" type="text" name="<?php echo $this->get_field_name('title'); ?>'" value="<?php echo $instance['title']; ?>" />
 
<label for="<?php echo $this->get_field_id('url'); ?>"><?php _e('URL'); ?></label>
<input class="widefat" id="<?php echo $this->get_field_id('url'); ?>" type="text" name="<?php echo $this->get_field_name('url'); ?>" value="<?php echo $instance['url']; ?>" />
 
 
<?php }
 
}
 
// End class soup_widget
 
add_action('widgets_init', create_function('', 'return register_widget("idxblue_widget");'));
?>