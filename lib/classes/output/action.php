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
 * This file contains just the Actions atom class.
 *
 * The action atom is an element in the Output API.
 *
 * @package core
 * @category output
 * @copyright 2014 Sam Hemelryk
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace core\output;

defined('MOODLE_INTERNAL') || die();

/**
 * Action atom.
 *
 * The action atom is a special atom. It is used to represent an action that the user can take.
 * The renderer can then interpret this as it likes, usually either a link or a button.
 *
 * It is recommended to use this for actions unless a link or button is explicitly required in which case the link
 * or button atoms can be used instead.
 *
 * @package core
 * @category output
 * @copyright 2014 Sam Hemelryk
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class action extends atom {

    /**
     * Text content for this action. If this is a link it is the content of the a tag, if its a button its the value of
     * the button.
     * @var string
     */
    public $content = null;

    /**
     * The URL for this action.
     * @var \moodle_url
     */
    public $url = null;

    /**
     * A description of this action, suitable to use as a title attribute.
     * @var string
     */
    public $description = null;

    /**
     * An icon associated with this action. Null if there isn't one.
     * @var icon
     */
    public $icon = null;

    /**
     * A help icon associated with this action. Null if there isn't one.
     * @var icon
     */
    public $helpicon = null;

    /**
     * The prefered method for this action, either GET or POST. Defaults to null to inform that this button doesn't
     * require a method.
     * @var string
     */
    public $method = null;

    /**
     * An array of component actions.
     * @var \component_action[]
     */
    protected $jsactions = array();

    /**
     * Set to false when there are JS actions that require initialisation.
     * @var bool
     */
    protected $jsactionsinit = true;

    /**
     * Constructs a new action.
     *
     * An action can be interpreted into one of several states depending upon the frontend requirements.
     *
     * @param string $content
     * @param \moodle_url $url
     * @param string $description
     * @param icon $icon
     */
    public function __construct($content = null, \moodle_url $url = null, $description = null, icon $icon = null) {
        $this->content = $content;
        $this->url = $url;
        $this->description = $description;
        $this->icon = $icon;
    }

    /**
     * Adds a JS component action to this action instance.
     *
     * @param \component_action $action
     */
    public function add_js_action(\component_action $action) {
        $this->jsactions[] = $action;
        $this->jsactionsinit = false;
    }

    /**
     * Pre-render method.
     *
     * Called when the action is being rendered.
     * We use this method to initialise any required JS actions for this action.
     *
     * @param \moodle_page $page The page for which this component is being rendered.
     */
    public function prerender(\moodle_page $page) {
        // Initialise any attached actions.
        if (!$this->jsactionsinit) {
            // We only want to initialise actions once.
            // We shift each action of the start of the array and initialise it.
            // Once done we set jsactionsinit to true to signify that all actions have being initialised.
            $this->require_id();
            $selector = '#' . $this->attributes['id'];
            while ($action = array_shift($this->jsactions)) {
                $page->requires->event_handler($selector, $action->event, $action->jsfunction, $action->jsfunctionargs);
            }
            $this->jsactionsinit = true;
        }
    }
}
