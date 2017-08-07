<?php
/*
Plugin Name: MooTools Accessible Button
Plugin URI: http://wordpress.org/extend/plugins/mootools-accessible-button/
Description: WAI-ARIA Enabled Button Plugin for Wordpress
Author: Kontotasiou Dionysia
Version: 1.0
Author URI: http://www.iti.gr/iti/people/Dionisia_Kontotasiou.html
*/

add_action("plugins_loaded", "MooToolsAccessibleButton_init");
function MooToolsAccessibleButton_init() {
    register_sidebar_widget(__('MooTools Accessible Button'), 'widget_MooToolsAccessibleButton');
    register_widget_control(   'MooTools Accessible Button', 'MooToolsAccessibleButton_control', 200, 200 );
    if ( !is_admin() && is_active_widget('widget_MooToolsAccessibleButton') ) {
     
        wp_deregister_script('jquery');

        // add your own script
       
        wp_register_script('mootools-core', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-button/lib/mootools-core.js'));
        wp_enqueue_script('mootools-core');

        wp_register_style('MooToolsAccessibleButton_css', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-button/lib/demo.css'));
        wp_enqueue_style('MooToolsAccessibleButton_css');

        wp_register_script('MooToolsAccessibleButton', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-button/lib/demo.js'));
        wp_enqueue_script('MooToolsAccessibleButton');
		
		wp_register_script('button', ( get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-button/lib/button.js'));
        wp_enqueue_script('button');
    }
}

function widget_MooToolsAccessibleButton($args) {
    extract($args);

    $options = get_option("widget_MooToolsAccessibleButton");
    if (!is_array( $options )) {
        $options = array(
            'title' => 'MooTools Accessible Button',
            'archives' => 'Archives',
            'posts' => 'Posts',
            'comments' => 'Comments',
            'recent' => 'Recent',
            'text' => 'Select the appropriate button'
        );
    }

    echo $before_widget;
    echo $before_title;
    echo $options['title'];
    echo $after_title;

    //Our Widget Content
    MooToolsAccessibleButtonContent();
    echo $after_widget;
}

function MooToolsAccessibleButtonContent() {
    $options = get_option("widget_MooToolsAccessibleButton");
    if (!is_array( $options )) {
        $options = array(
            'title' => 'MooTools Accessible Button',
            'archives' => 'Archives',
            'posts' => 'Posts',
            'comments' => 'Comments',
            'recent' => 'Recent',
            'text' => 'Select the appropriate button'
        );
    }

    echo '<div class="demo" role="application">

		<input class="button" id="MooAccessToggleButton" type="button" value="Toggle me"/>
		<span id="buttonLive" span="status" aria-live="assertive" style="position:"absolute";padding:5px;color:grey;"></span> 

	</div>';
}

function MooToolsAccessibleButton_control() {
    $options = get_option("widget_MooToolsAccessibleButton");
    if (!is_array( $options )) {
        $options = array(
            'title' => 'MooTools Accessible Button',
            'archives' => 'Archives',
            'posts' => 'Posts',
            'comments' => 'Comments',
            'recent' => 'Recent',
            'text' => 'Select the appropriate button'
        );
    }

    if ($_POST['MooToolsAccessibleButton-SubmitTitle']) {
        $options['title'] = htmlspecialchars($_POST['MooToolsAccessibleButton-WidgetTitle']);
        update_option("widget_MooToolsAccessibleButton", $options);
    }
    if ($_POST['MooToolsAccessibleButton-SubmitArchives']) {
        $options['archives'] = htmlspecialchars($_POST['MooToolsAccessibleButton-WidgetArchives']);
        update_option("widget_MooToolsAccessibleButton", $options);
    }
    if ($_POST['MooToolsAccessibleButton-SubmitRecent']) {
        $options['recent'] = htmlspecialchars($_POST['MooToolsAccessibleButton-WidgetRecent']);
        update_option("widget_MooToolsAccessibleButton", $options);
    }
    if ($_POST['MooToolsAccessibleButton-SubmitPosts']) {
        $options['posts'] = htmlspecialchars($_POST['MooToolsAccessibleButton-WidgetPosts']);
        update_option("widget_MooToolsAccessibleButton", $options);
    }
    if ($_POST['MooToolsAccessibleButton-SubmitComments']) {
        $options['comments'] = htmlspecialchars($_POST['MooToolsAccessibleButton-WidgetComments']);
        update_option("widget_MooToolsAccessibleButton", $options);
    }
    if ($_POST['MooToolsAccessibleButton-SubmitText']) {
        $options['text'] = htmlspecialchars($_POST['MooToolsAccessibleButton-WidgetText']);
        update_option("widget_MooToolsAccessibleButton", $options);
    }
    ?>
    <p>
        <label for="MooToolsAccessibleButton-WidgetTitle">Widget Title: </label>
        <input type="text" id="MooToolsAccessibleButton-WidgetTitle" name="MooToolsAccessibleButton-WidgetTitle" value="<?php echo $options['title'];?>" />
        <input type="hidden" id="MooToolsAccessibleButton-SubmitTitle" name="MooToolsAccessibleButton-SubmitTitle" value="1" />
    </p>
    <p>
        <label for="MooToolsAccessibleButton-WidgetArchives">Translation for "Archives": </label>
        <input type="text" id="MooToolsAccessibleButton-WidgetArchives" name="MooToolsAccessibleButton-WidgetArchives" value="<?php echo $options['archives'];?>" />
        <input type="hidden" id="MooToolsAccessibleButton-SubmitArchives" name="MooToolsAccessibleButton-SubmitArchives" value="1" />
    </p>
    <p>
        <label for="MooToolsAccessibleButton-WidgetPosts">Translation for "Posts": </label>
        <input type="text" id="MooToolsAccessibleButton-WidgetPosts" name="MooToolsAccessibleButton-WidgetPosts" value="<?php echo $options['posts'];?>" />
        <input type="hidden" id="MooToolsAccessibleButton-SubmitPosts" name="MooToolsAccessibleButton-SubmitPosts" value="1" />
    </p>
    <p>
        <label for="MooToolsAccessibleButton-WidgetComments">Translation for "Comments": </label>
        <input type="text" id="MooToolsAccessibleButton-WidgetComments" name="MooToolsAccessibleButton-WidgetComments" value="<?php echo $options['comments'];?>" />
        <input type="hidden" id="MooToolsAccessibleButton-SubmitComments" name="MooToolsAccessibleButton-SubmitComments" value="1" />
    </p>
    <p>
        <label for="MooToolsAccessibleButton-WidgetRecent">Translation for "Recent": </label>
        <input type="text" id="MooToolsAccessibleButton-WidgetRecent" name="MooToolsAccessibleButton-WidgetRecent" value="<?php echo $options['recent'];?>" />
        <input type="hidden" id="MooToolsAccessibleButton-SubmitRecent" name="MooToolsAccessibleButton-SubmitRecent" value="1" />
    </p>
    <p>
        <label for="MooToolsAccessibleButton-WidgetText">Translation for "Select the appropriate button": </label>
        <input type="text" id="MooToolsAccessibleButton-WidgetText" name="MooToolsAccessibleButton-WidgetText" value="<?php echo $options['text'];?>" />
        <input type="hidden" id="MooToolsAccessibleButton-SubmitText" name="MooToolsAccessibleButton-SubmitText" value="1" />
    </p>
    
    <?php
}

?>
