<?php
/**
 * Created by PhpStorm.
 * User: sinhpv86
 * Date: 9/3/18
 * Time: 3:24 PM
 */
if (! function_exists('get_facebook_thumb')) {
    function get_facebook_thumb($fb_id, $type = 'facebook') {
        if ($type == 'facebook') {
            $img = 'https://graph.facebook.com/'. $fb_id .'/picture?type=full_picture';
            return $img;
        }else {
            $vv='https://img.youtube.com/vi/'.$fb_id.'/0.jpg';
            return $vv;
        }
    }
}

if (!function_exists('fb_embed_link')) {
    //get facebook embed link
    function fb_embed_link($link) {
        $link = 'https://www.facebook.com/plugins/video.php?href='.$link.'&show_text=0&width=560';
        return $link;
    }
}
