<?php

namespace Substrakt\Health;

class Page extends \Substrakt\Platypus\Post {

    /**
     * @return array Featured news stories as defined in ACF.
     * @author Tom Cash <tom@substrakt.com>
     */
    public function featured_stories() {
        $stories = [];

        if ($featured = $this->field('featured')) {
            foreach ($featured as $i => $feature) {
                $feature = new \Substrakt\Health\Post($feature['story']);
                array_push($stories, $feature);
            }

            return $stories;
        }

        return [];
    }
}
