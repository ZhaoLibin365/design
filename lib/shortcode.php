<?php
/*
 * 注册短代码
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;

require_once __DIR__ . '/shortcode.main.php';

// 下载
function shortcode_button_dl( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'href' => 'https://',
        'target' => '_blank'
    ), $atts );
    return '<div class="post-download"><a href="//' .  $args['href'] . '" target="' . $args['target'] . '"><span>' . $content . '</span></a></div>';
}
add_shortcode( 'dl' , 'shortcode_button_dl' );


function shortcode_notice( $atts, $content = '' ) {
    return "<div class='shortcode-notice'>".$content."</div>";
}
add_shortcode( 'notice' , 'shortcode_notice' );


function shortcode_warn( $atts, $content = '' ) {
    return "<div class='shortcode-warn'>".$content."</div>";
}
add_shortcode( 'warn' , 'shortcode_warn' );

function shortcode_warn_block( $atts, $content = '' ) {
    return "<div class='post-content-warn'><div class='post-content-content'>".$content."</div></div>";
}
add_shortcode( 'warn-block' , 'shortcode_warn_block' );


function shortcode_notice_block( $atts, $content = '' ) {
    return "<div class='post-content-notice'><div class='post-content-content'>".$content."</div></div>";
}
add_shortcode( 'notice-block' , 'shortcode_notice_block' );


function shortcode_tag( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'type' => 'blue'
    ), $atts );
    return "<span class='post-content-tag tag-".$args["type"]."'>".$content."</span>";
}
add_shortcode( 'tag' , 'shortcode_tag' );

function shortcode_dplayer( $atts, $content = '' ) {
    $args = shortcode_atts( array(
        'id'=>'',
        'pic'=>'',
        'url'=>''
    ), $atts );
    return "
    <div id='dplayer-".$args["id"]."' class='dp'></div>
    <script>
    var dplayer". $args["id"] ." = new DPlayer({
    container: document.getElementById('dplayer-".$args["id"]."'),
    preload:'auto',
    autoplay: false,
    video: {
        url: '".$args["url"]."',
        pic: '".$args["pic"]."'
      }
    });
    </script>
    ";
}
add_shortcode( 'dplayer' , 'shortcode_dplayer' );

//画廊
function shortcode_pic($atts, $content = '')
{
    return '<div class="photos"><div class="grid-item">' . $content . '</div></div>';
}

add_shortcode('photos', 'shortcode_pic');
