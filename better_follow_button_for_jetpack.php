<?php
/*
Plugin Name: Better Follow Button for Jetpack
Plugin URI: http://antonpug.com/bfbj
Description: Adds a customizable floating follow button to Jetpack Powered sites which lets users sign up for email blog post delivery.
Version: 0.0.1
Author: Anton Pugachevsky
Author URI: http://antonpug.com
Licence: GNU GPL Version 3
*/

/*

Better Follow Button for Jetpack is free software.
You can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

Better Follow Button for Jetpack is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with Better Follow Button for Jetpack        
(see the root folder of the plugin for licence.txt) . If not, see <http://www.gnu.org/licenses/>.
*/

register_uninstall_hook(__FILE__, "bfbj_uninstall");
function bfbj_uninstall()
{
    delete_option('bfbj_buttontext');
    delete_option('bfbj_headingtext');
    delete_option('bfbj_emailplaceholder');
    delete_option('bfbj_signupbuttontext');
    delete_option('bfbj_buttoncolor');
    delete_option('bfbj_buttoncoloropen');
    delete_option('bfbj_modalbackgroundcolor');
    delete_option('bfbj_submitbuttoncolor');
    delete_option('bfbj_fontfamily');
    delete_option('bfbj_modalopacity');
    delete_option('bfbj_buttonfontsize');
    delete_option('bfbj_headingtextfontsize');
}
include_once(plugin_dir_path(__FILE__) . 'settings.php');

add_action('wp_footer', 'wpbfbj');

function wpbfbj()
{
?>
<style type="text/css" media="screen">
  #bit, #bit * {}
  #bit {
      bottom: -300px;
      font: 13px "<?php echo get_option("bfbj_fontfamily") ?: 'Avenir';?>;", "Helvetica Neue",sans-serif;
      position: fixed;
      right: 10px;
      z-index: 999999;
      width: 230px;
      cursor:pointer;
  }
  
  .loggedout-follow-typekit {
      margin-right: 4.5em;
  }
  
  #bit a.bsub {
      background-color: <?php echo get_option("bfbj_buttoncolor") ?: '#333333';?>; 
      opacity: <?php echo get_option("bfbj_modalopacity") ?: '0.95';?>;
      font: 13px "<?php echo get_option("bfbj_fontfamily") ?: 'Avenir';?>", "Helvetica Neue",sans-serif;
      border: 0 none;
      color: #CCCCCC;
      display: block;
      float: right;
      letter-spacing: normal;
      outline-style: none;
      outline-width: 0;
      overflow: hidden;
      padding: 5px 10px;
      text-decoration: none !important;
      text-shadow: 0 -1px 0 #444444;
  }
  
  #bit a.bsub {
      border-radius: 2px 2px 0 0;
  }
  
  #bit a:hover span, #bit a.bsub.open span {
      color: #FFFFFF !important;
  }
  
  #bit a.bsub.open {
      background-color: <?php echo get_option("bfbj_buttoncoloropen") ?: '#333333';?>; 
      opacity: <?php echo get_option("bfbj_modalopacity") ?: '0.95';?>;
  }
  
  #bitsubscribe {
      background: <?php echo get_option("bfbj_modalbackground") ?: '#464646';?>; 
      border-radius: 2px 0 0 0;
      color: #FFFFFF;
      margin-top: 27px;
      padding: 15px;
      width: 200px;
      float: right;
      margin-top: 0;
      opacity: <?php echo get_option("bfbj_modalopacity") ?: '0.95';?>;
  }
  
  #bitsubscribe div {
      overflow: hidden;
  }
  
  #bit h3, #bit #bitsubscribe h3 {
      color: #FFFFFF;
      font: 13px "<?php echo get_option("bfbj_fontfamily") ?: 'Avenir';?>", "Helvetica Neue",sans-serif;
      margin: 0 0 0.5em !important;
      text-align: left;
      text-shadow: 0 1px 0 #333333;
  }
  
  #bit #bitsubscribe p {
      color: #FFFFFF;
      font: 13px "<?php echo get_option("bfbj_fontfamily") ?: 'Avenir';?>", "Helvetica Neue",sans-serif;
      margin: 0 0 1em;
      text-shadow: 0 1px 0 #333333;
  }
  
  #bitsubscribe p a {
      margin: 20px 0 0;
  }
  
  #bitsubscribe input[type="submit"] { 
      font: 13px "<?php echo get_option("bfbj_fontfamily") ?: 'Avenir';?>", "Helvetica Neue",sans-serif;
      background: <?php echo get_option("bfbj_submitbuttoncolor") ?: '#282828';?>; 
      border: none;
      color: #CCCCCC;
      padding: 2px 20px;
      text-decoration: none;
      text-shadow: 0 1px 0 #000000;
      cursor: pointer;
  }
  
  #bitsubscribe input[type="submit"]:hover {
      color: #FFFFFF;
      text-decoration: none;
  }
  
  #bitsubscribe input[type="submit"]:active {
      color: #AAAAAA;
      text-decoration: none;
  }
  
  #bitsubscribe input[type="text"] {
      border: 0px;
      font: 13px "<?php echo get_option("bfbj_fontfamily") ?: 'Avenir';?>", "Helvetica Neue",sans-serif;
  }
  
  #bitsubscribe.open {
      display: block;
  }
  
  #bsub-subscribe-button {
      margin: 0 auto;
      text-align: center;
  }
  
  #bitsubscribe #bsub-credit {
      border-top: 1px solid #3C3C3C;
      font: 13px "<?php echo get_option("bfbj_fontfamily") ?: 'Avenir';?>", "Helvetica Neue",sans-serif;
      margin: 0 0 -15px;
      padding: 7px 0;
      text-align: center;
  }
  
  #bitsubscribe #bsub-credit a {
      background: none repeat scroll 0 0 transparent;
      color: #AAAAAA;
      text-decoration: none;
      text-shadow: 0 1px 0 #262626;
  }
  
  #bitsubscribe #bsub-credit a:hover {
      background: none repeat scroll 0 0 transparent;
      opacity: <?php echo get_option("bfbj_modalopacity") ?: '0.95';?>;
      color: #FFFFFF;
  }
</style>   

<script type="text/javascript" charset="utf-8">
  jQuery.extend(jQuery.easing, {
      easeOutCubic: function (x, t, b, c, d) {
          return c * ((t = t / d - 1) * t * t + 1) + b;
      }
  });
  jQuery(document).ready(function () {
      var isopen = false,
          bitHeight = jQuery('#bitsubscribe').height();
      setTimeout(function () {
          jQuery('#bit').animate({
              bottom: '-' + bitHeight - 30 + 'px'
          }, 200);
      }, 300);
      jQuery('#bit a.bsub').click(function () {
          if (!isopen) {
              isopen = true;
              jQuery('#bit a.bsub').addClass('open');
              jQuery('#bit #bitsubscribe').addClass('open')
              jQuery('#bit').stop();
              jQuery('#bit').animate({
                  bottom: '0px'
              }, {
                  duration: 400,
                  easing: "easeOutCubic"
              });
          } else {
              isopen = false;
              jQuery('#bit').stop();
              jQuery('#bit').animate({
                  bottom: '-' + bitHeight - 30 + 'px'
              }, 200, function () {
                  jQuery('#bit a.bsub').removeClass('open');
                  jQuery('#bit #bitsubscribe').removeClass('open');
              });
          }
      });
  });
</script>

<div id="bit" class="">
  <a class="bsub"><span id='bsub-text'><?php echo get_option("bfbj_buttontext") ?: 'Follow';?></span></a>
  <div id="bitsubscribe">
<a name="subscribe-blog"></a>
    <form action="" method="post" accept-charset="utf-8" id="subscribe-blog">
      <p><?php echo get_option("bfbj_headingtext") ?: 'Get the latest posts delivered to your mailbox:';?></p>
      <p><input type="text" name="email" style="width: 95%; padding: 1px 2px" value="<?php echo get_option("bfbj_emailplaceholder") ?: 'Email Address';?>" 
        id="subscribe-field" onclick="if ( this.value == 'Email Address' ) { this.value = ''; }" onblur="if ( this.value == '' ) { this.value = '<?php echo get_option("bfbj_emailplaceholder") ?: 'Email Address';?>'; }" /></p>
      <p>
        <input type="hidden" name="action" value="subscribe" />
        <input type="hidden" name="source" value="<?php echo esc_url($referer);?>" />
        <input type="hidden" name="sub-type" value="<?php echo esc_attr($source);?>" />
        <input type="hidden" name="redirect_fragment" value="<?php echo esc_attr($widget_id);?>" />
        <?php wp_nonce_field('blogsub_subscribe_' . get_current_blog_id(), '_wpnonce', false);?>
        <input type="submit" value="<?php echo get_option("bfbj_signupbuttontext") ?: 'Sign up!';?>" name="jetpack_subscriptions_widget" />
      </p>
    </form>
  </div>
</div>
<?php
}
?>