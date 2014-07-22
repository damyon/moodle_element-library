<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This file contains just the base element class.
 *
 * @package core
 * @category output
 * @copyright 2014 Sam Hemelryk
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\output;

defined('MOODLE_INTERNAL') || die();

/**
 * The element class.
 *
 * The element class is the base class that atoms, molecules, and organisms all extend from.
 * It provide functionality common to all output components.
 *
 * @package local_output
 * @category output
 * @copyright 2014 Sam Hemelryk
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
abstract class element implements \renderable {

    /**
     * A key value array of attributes that this element has.
     * @var array
     */
    public $attributes = array();

    /**
     * The element that this element instance is used within or null if it is not used within another element.
     * @var element
     */
    public $parent = null;

    /**
     * An array of properties added to this instance by the molecule it is a part of.
     * @var array
     */
    protected $properties = array(
        'active' => false,
        'enabled' => true,
        'dimmed' => false,
    );

    /**
     * Sets the element this element is used within.
     * @param element $parent
     */
    protected function set_parent(element $parent) {
        $this->parent = $parent;
    }

    /**
     * Sets an attribute on this element.
     *
     * @param string $attr
     * @param string $value
     */
    public function set_attribute($attr, $value) {
        if ($attr === 'class') {
            $this->add_class($value);
        } else {
            $this->attributes[$attr] = $value;
        }
    }

    /**
     * Sets an array of attributes on this element.
     *
     * @param array $attrs A key => value array of attributes to set.
     */
    public function set_attributes(array $attrs) {
        if (isset($attrs['class'])) {
            $this->add_class($attrs['class']);
            unset($attrs['class']);
        }
        $this->attributes = array_merge($attrs, $this->attributes);
    }

    /**
     * Adds a class attribute to this element, or if its already got one adds the given class to it.
     * @param string $class
     */
    public function add_class($class) {
        if (isset($this->attributes['class'])) {
            $this->attributes['class'] .= ' '.$class;
        } else {
            $this->attributes['class'] = $class;
        }
    }

    /**
     * Returns the array of attributes this element has.
     *
     * @param bool $asstring
     * @return array|string
     */
    public function get_attributes($asstring = true) {
        if ($asstring) {
            $pairs = array();
            foreach ($this->attributes as $key => $value) {
                if ($value === null) {
                    $pairs[] = ' '.$key;
                } else {
                    $pairs[] = ' '.$key.'="'.s($value).'"';
                }
            }
            return join('', $pairs);
        }
        return $this->attributes;
    }

    /**
     * Adds a property.
     *
     * @param string $property
     * @param mixed $value
     * @throws \coding_exception
     */
    public function add_property($property, $value) {
        if (!is_scalar($value)) {
            // This also prevents NULL's, so we can use isset with $this->properties.
            throw new \coding_exception('Only scalar values can be passed through dynamic element properties.');
        }
        $this->properties[$property] = $value;
    }

    /**
     * Adds an array of properties.
     *
     * @param string[] $properties A key => value array
     */
    public function add_properties(array $properties) {
        foreach ($properties as $property => $value) {
            if (is_string($property)) {
                $this->add_property($property, $value);
            }
        }
    }

    /**
     * Sets a property
     *
     * @param string $property
     * @param int|float|string|bool $value
     * @throws coding_exception
     */
    public function set($property, $value) {
        if (!isset($this->properties[$property])) {
            throw new \coding_exception('Trying to set a non-existent property. All properties must be added before'.
                'they can be interacted with.', $property);
        }
        if (!is_scalar($value)) {
            // This also prevents NULL's, so we can use isset with $this->properties.
            throw new \coding_exception('Only scalar values can be passed through dynamic element properties.');
        }
        $this->properties[$property] = $value;
    }

    /**
     * Returns the value of a property.
     *
     * @param string $property
     * @param mixed $default
     * @return mixed
     */
    public function get($property, $default = null) {
        if (!isset($this->properties[$property])) {
            return $default;
        }
        return $this->properties[$property];
    }

    /**
     * Returns true if a property is set and is not empty.
     *
     * @param string $property
     * @return bool
     */
    public function is($property) {
        return (!empty($this->properties[$property]));
    }

    /**
     * Ensures that an ID attribute exists for this element.
     *
     * If no ID has being set then a short ID is assigned to the item.
     */
    public function require_id() {
        static $moodleidcount = 0;
        if (empty($this->attributes['id'])) {
            $moodleidcount++;
            $this->set_attribute('id', 'm-' . $moodleidcount);
        }
    }

    /**
     * Pre-render.
     *
     * Override this method to perform any necessary actions before rendering occurs.
     * If you need to translate properties to essential attributes or if you need to fire any essential JavaScript
     * then this is the place to do it.
     *
     * @param \moodle_page $page The page for which this component is being rendered.
     */
    public function prerender(\moodle_page $page) {
        // Nothing happens here by default.
    }
}
