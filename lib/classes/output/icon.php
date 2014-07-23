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
 * This file contains just the Icon atom class.
 *
 * The Icon atom is an element in the Output API.
 *
 * @package core
 * @category output
 * @copyright 2014 Sam Hemelryk
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\output;

defined('MOODLE_INTERNAL') || die();

/**
 * The Icon atom.
 *
 * This is a simple icon atpm.
 *
 * @package core
 * @category output
 * @copyright 2014 Sam Hemelryk
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class icon extends atom {

    /**
     * The icon name.
     * This will be the path to icon within the pix directory with the extension removed.
     * @var string
     */
    public $iconname;

    /**
     * The component that has this icon.
     * Defaults to 'moodle'
     * @var string
     */
    public $component = 'moodle';

    /**
     * The alt attribute to use for this icon.
     * This default to '' rather than null because all images must have an alt.
     * @var string
     */
    public $alt = '';

    /**
     * The title attribute to use for this icon if there is one.
     * @var string
     */
    public $title;

    /**
     * Constructs an icon.
     *
     * @param string $iconname The icon name to use.
     * @param string $component The component that has the icon.
     * @param string $alt The string to use as the alt attribute for this icon.
     * @param string $title The string to use as the title attribute if there is one.
     */
    public function __construct($iconname, $component = 'moodle', $alt = '', $title = null) {
        $this->iconname = $iconname;
        $this->component = $component;
        $this->set_attribute('alt', $alt);
        if ($title !== null) {
            $this->set_attribute('title', $title);
        }
    }

    /**
     * Pre-render - this icon is being rendered now.
     *
     * We'll use this opportunity to generate the URL for the icon and set it as the src attribute.
     * We'll also set the title and alt as attributes.
     *
     * @param \moodle_page $page The page for which this component is being rendered.
     */
    public function prerender(\moodle_page $page) {
        $this->set_attribute('src', $page->theme->pix_url($this->iconname, $this->component));
        $this->set_attribute('alt', $this->alt);
        if ($this->title !== null) {
            $this->set_attribute('title', $this->title);
        }
    }
}
