<?php

namespace Substrakt\Health;

class Post extends \Substrakt\Platypus\Post {
    /**
     * @return string Featured image or fallback image.
     * @author Tom Cash <tom@substrakt.com>
     */
    public function fallback_image_class() {
        if ($this->has_featured_image()) {
            return '';
        }

        return ' img-fallback';
    }

    /**
     * @return string Featured image or fallback image.
     * @author Tom Cash <tom@substrakt.com>
     */
    public function featured_image($size = '800x480') {
        if ($this->has_featured_image()) {
            return $this->thumbnail()->image($size, [
                'title' => $this->title(),
                'alt' => $this->title()
            ]);
        }

        // Build the fallback image before returning it.
        $fallback_img = CHILD_THEME_URL . '/assets/images/list-img-fallback.png';
        $fallback_img = '<img src="' . $fallback_img . '" title="' . $this->title() . '" alt="' . $this->title() . '">';

        return $fallback_img;
    }

    /**
     * @return bool True of false depending on if the post has a featured image or not.
     * @author Tom Cash <tom@substrakt.com>
     */
    public function has_featured_image() {
        if (isset($this->thumbnail()->wp->sizes['800x480'])) {
            return true;
        }

        return false;
    }

    /**
     * @return string Post introduct from ACF.
     * @author Tom Cash <tom@substrakt.com>
     */
    public function introduction() {
        if ($this->field('introduction')) {
            return $this->field('introduction');
        }

        return '';
    }

    /**
     * @return array Related news stories as defined in ACF.
     * @author Tom Cash <tom@substrakt.com>
     */
    public function related_stories() {
        $stories = [];

        if ($related = $this->field('related_stories')) {
            foreach ($related as $i => $story) {
                $story = new \Substrakt\Health\Post($story['story']);
                array_push($stories, $story);
            }

            return $stories;
        }

        return [];
    }

    /**
     * @return bool an array of image objects from the ACF gallery.
     * @author Tom Cash <tom@substrakt.com>
     */
     public function related_images() {
         if (is_array($this->field('post_images'))){
             return $this->field('post_images');
         }

         return [];
     }
}
