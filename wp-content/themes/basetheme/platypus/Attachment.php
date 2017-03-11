<?php

namespace Substrakt\Platypus;

/**
 * @package Substrakt\Platypus
 * @author Stuart Maynes <stu@substrakt.com>
*/
class Attachment extends Post {

    public $wp;

    public function __construct($wp) {
        $this->wp = (object) $this->build((array) $wp);
    }

    /**
     * @return string Caption text
    */
    public function caption() {
        return $this->wp->post_excerpt;
    }

    /**
     * @return string Description text
    */
    public function description() {
        return $this->content();
    }

    /**
     * @return integer Attachment ID
    */
    public function ID() {
        return $this->wp->ID;
    }

    /**
     *
     * @param string $size Image size to retrieve the src url for
     * @param array $attr HTML attributes to add to the tag
     * @return string image tag
    */
    public function image($size = 'thumbnail', $attr = []) {
        return wp_get_attachment_image($this->ID(), $size, false, $attr);
    }

    /**
     *
     * @param string $size Image size to retrieve the src url for
     * @param array $attr HTML attributes to add to the tag
     * @return string image tag
    */
    public function tag($size = 'thumbnail', $attr = []) {
        return $this->image($size, $attr);
    }

    /**
     * Return url for the attachemnt at a given size
     * @param string $size Image size to retrieve the src url for
     * @return string URL
    */
    public function url($size = 'thumbnail') {
        if ($image = wp_get_attachment_image_src($this->ID(), $size, false)) {
            return $image[0];
        }
        return '';
    }

    private function build(array $post) {
        $meta = get_post_meta($post['ID'], '_wp_attachment_metadata', true);
        if (is_array($meta)) {
            $post = array_merge($post, $meta);
        }
        return $post;
    }
}
