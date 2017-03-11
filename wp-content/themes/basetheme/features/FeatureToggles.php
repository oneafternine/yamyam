<?php

class FeatureToggles {

    static public $instance;
    static public $environment;

    public function __construct() {
        static::$environment = 'local';
    }

    public function available($feature, $location = false) {
        if (isset($this->unavailable->$feature)) {

            if ($this->unavailable->$feature === true) return false;

            return (is_array($this->unavailable->$feature) &&
                   !in_array($this->template(), $this->unavailable->$feature) &&
                   !in_array($location, $this->unavailable->$feature));
        }
        return true;
    }

    public static function getInstance() {
        if (static::$instance === null) {
            static::$instance = new static();
            static::$instance->setConfigFile()->loadConfig();
        }
        return static::$instance;
    }

    public static function setEnvironment($env) {
        return static::$environment = $env;
    }

    public static function getEnvironment() {
        return static::$environment;
    }

    private function template() {
        global $template;
        return $template ? preg_replace('/\\.[^.\\s]{1,4}$/', '', basename($template)) : '';
    }

    private function setConfigFile() {
        $environment = getenv('ENVIRONMENT') ? getenv('ENVIRONMENT') : static::$environment;
        $this->configfile = dirname(__DIR__) . "/config/{$environment}.json";
        return $this;
    }

    private function loadConfig() {
        if (! isset($this->unavailable) && file_exists($this->configfile)) {
            $features = file_get_contents($this->configfile);
            return $this->unavailable = json_decode($features);
        }
        return $this->unavailable = new stdClass;
    }
}

if (! function_exists('feature')) {
    function feature($feature, $location = false) {
        $toggles = FeatureToggles::getInstance();
        return $toggles->available($feature, $location);
    }
}
