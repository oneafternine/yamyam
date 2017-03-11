<?php

namespace Substrakt\Platypus;

/**
 * @package Substrakt\Platypus
 * @author Stuart Maynes <stu@substrakt.com>
*/
class Post extends Platypus {

    public $wp;

    public function __construct($post) {
        $this->wp = $post;
    }

    /**
     * Returns instance of Substrakt\Platypus\User by default
     * @param null
     * @uses get_userdata To retrieve the user object
     * @return object Post author
    */
    public function author() {
        return new User(get_userdata($this->wp->post_author));
    }

    /**
     * @param array
     * @return array Post comments
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function comments($params = []) {
        $comments = get_comments(array_merge($params, [
            'post_id' => $this->ID()
        ]));
        return $this->to_object($comments, '\Substrakt\Platypus\Comment');
    }

    /**
     * @param null
     * @return string Post content
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function classes($extra = '') {
        return get_post_class($extra, $this->ID());
    }

    /**
     * @param null
     * @return string Post content
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function content() {
        return apply_filters('the_content', $this->wp->post_content);
    }

    /**
     * @param Integer $length Number of maximum excerpt length
     * @return string Post excerpt
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function excerpt($length = 100) {
        if ($excerpt = get_post_field('post_excerpt', $this->ID())) {
            return apply_filters('the_excerpt', $excerpt);
        }
        return apply_filters('the_excerpt', $this->content());
    }

    /**
     * @param $term
     * @param $taxonomy
     * @return boolean Has the post been assigned the term
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function has_term($term, $taxonomy = 'category') {
        return has_term($term, $taxonomy, $this->ID());
    }

    /**
     * @param null
     * @return integer Post ID
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function ID() {
        return $this->wp->ID;
    }

    /**
     * @param null
     * @return boolean Is the post a draft
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function is_draft() {
        return $this->status() === 'draft';
    }

    /**
     * @param null
     * @return boolean Is the post a future
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function is_future() {
        return $this->status() === 'future';
    }

    /**
     * @param null
     * @return boolean Is the post a private
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function is_private() {
        return $this->status() === 'private';
    }

    /**
     * @param null
     * @return boolean Is the post a published
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function is_published() {
        return $this->status() === 'publish';
    }

    /**
     * @param null
     * @return boolean Is the post a sticky post
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function is_sticky() {
        return in_array($this->ID(), get_option('sticky_posts'));
    }

    /**
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function meta($field, $single = true) {
        $meta = get_post_meta($this->ID(), $field, $single);
        return $meta;
    }

    /**
     * @param string $class Class to return a new instance of for parent
     * @return object Post parent
     * @uses get_post To retrieve a WP_Post object
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function parent($class = false) {
        $class = $this->get_class($class);

        if ($this->wp->post_parent) {
            return new $class(get_post($this->wp->post_parent));
        }

        return new NullObject();
    }

    /**
     * @param string $class Class to return a new instance for parents
     * @return array
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function parents($class = false) {
        $posts = [];
        $post  = $this->wp;

        while ($post->post_parent !== 0) {
            $posts[] = ($post = get_post($post->post_parent));
        }

        return $this->to_object(array_reverse($posts), $this->get_class($class));
    }

    /**
     * Return the permalink
     * @uses get_permalink To retrieve the url
     * @param null
     * @return string URL for post
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function permalink() {
        return get_permalink($this->ID());
    }

    /**
     * @param null
     * @return string Post status
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function status() {
        return get_post_status($this->ID());
    }

    /**
     * @param $params
     * @return array Taxonomy objects for taxonomies the post belongs to
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function taxonomies($params = []) {
        $terms = get_the_taxonomies($this->ID(), $params);
        return $this->to_object($terms, '\Substrakt\Platypus\Taxonomy');
    }

    /**
     * @param $taxonomy
     * @return array List of post terms
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function terms($taxonomy = 'category') {
        $terms = get_the_terms($this->ID(), $taxonomy);
        return $this->to_object($terms, '\Substrakt\Platypus\Term');
    }

    /**
     * @return object Attachment
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function thumbnail() {
        return new Attachment(get_post(get_post_thumbnail_id($this->ID())));
    }

    /**
     * @param null
     * @return string Post title
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function title() {
        return $this->wp->post_title;
    }

    /**
     * @param null
     * @return string Post type
     * @author Stuart Maynes <stu@substrakt.com>
    */
    public function type() {
        return $this->wp->post_type;
    }

}
