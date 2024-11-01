<?php
/*
Plugin Name: Twitter Only Widget
 Plugin URI: http://viniwp.wordpress.com
Description: Twitter Only Widget is a widget to display twitter in your sidebar
Author: viniciusgomes
 Author URI: http://viniwp.wordpress.com
*/
add_action("init", "twitteronlywidget_init");
function twitteronlywidget_init(){
wp_register_sidebar_widget('Twitter_Only_Widget','Twitter Only Widget', 'twitteronlywidget');
wp_register_widget_control('Twitter_Only_Widget','Twitter Only Widget', 'twitteronlywidget_control');
}
function twitteronlywidget($args) {

 extract($args);
 $twitteronlywidget_options = unserialize(get_option('twitteronlywidget_options'));
?>
<style>
.tweet,
.tweet_list {list-style: none;margin: 0;padding: 0 !important;overflow-y: hidden;background-color: transparent;text-align:left;}
.tweet_list .awesome,.tweet_list .epic {text-transform: uppercase;}
.tweet_list li {overflow-y: auto;overflow-x: hidden;padding: 5px !important;}
.tweet_list li a {text-decoration:none; background:none !important;}
.tweet_list .tweet_avatar {padding-right: .5em; float: left;}
.tweet_list .tweet_avatar img {vertical-align: middle;}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script src="<?php echo plugins_url('jquery.tweet.js', __FILE__); ?>" charset="utf-8"></script>
<script>
 $(function(){
 $(".tweet").tweet({
 join_text: "auto",
 username: "<?php echo ($twitteronlywidget_options['user']?$twitteronlywidget_options['user']:'PHPDeveloperBr'); ?>",
 avatar_size: 25,
 count: <?php echo ($twitteronlywidget_options['size']?$twitteronlywidget_options['size']:5); ?>,
 auto_join_text_default: ": ",
 auto_join_text_ed: " ",
 auto_join_text_ing:": ",
 auto_join_text_reply: ": ",
 auto_join_text_url: ": ",
 loading_text: "&nbsp;&nbsp;loading tweets..."
 });
 });
</script>
<div class='tweet query'></div>
<?php }
function twitteronlywidget_control() {
?>
<?php
 if(!get_option('twitteronlywidget_options'))
 { add_option('twitteronlywidget_options', serialize(array('title'=>'Custom Text Widget', 'text'=>'This the widget text'))); }
 $twitteronlywidget_options = $twitteronlywidget_newoptions = @unserialize(get_option('twitteronlywidget_options'));
 if ($_POST['twitteronlywidget_user']){ $twitteronlywidget_newoptions['user'] = $_POST['twitteronlywidget_user']; }
if ($_POST['twitteronlywidget_size']){ $twitteronlywidget_newoptions['size'] = $_POST['twitteronlywidget_size']; }
 if($twitteronlywidget_options != $twitteronlywidget_newoptions){
 $twitteronlywidget_options = $twitteronlywidget_newoptions;
 update_option('twitteronlywidget_options', serialize($twitteronlywidget_options));
 } ?>
 <p>
<label for="twitteronlywidget_title">User:<br />
 <input id="twitteronlywidget_title" name="twitteronlywidget_user" type="text" value="<?php echo $twitteronlywidget_options['user']; ?>"/>
 </label>
 </p>
 <p>
<label for="twitteronlywidget_size">Number of Tweets:<br />
 <input id="twitteronlywidget_size" name="twitteronlywidget_size" type="text" value="<?php echo $twitteronlywidget_options['size']; ?>"/>
 </label>
 </p>
 <?php } ?>
