<?php
/**
 * To run these tests cd into the basetheme directory and run
 * phpunit --testsuite basetheme
*/
class FeatureToggleTest extends PHPUnit_Framework_TestCase {

    public function setUp() {
        $this->features = FeatureToggles::getInstance();
        $this->features->unavailable = new stdClass();
        $this->features->unavailable->timeTravel = true;
    }

    public function testGetInstanceReturnsAnInstance() {
        $this->assertInstanceOf('FeatureToggles', $this->features);
    }

    public function testDefaultEnvironmentCanBeSet() {
        FeatureToggles::setEnvironment('production');
        $this->assertEquals('production', FeatureToggles::getEnvironment());
    }

    public function testFeaturesIsNotAvaliable() {
        $this->assertFalse($this->features->available('timeTravel'), 'Time travel is available');
    }

    public function testFeaturesIsAvaliable() {
        $this->assertTrue($this->features->available('header'));
    }
}
