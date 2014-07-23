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
 * Abstract class defining a renderer test. The test is responsible for creating
 * an instance of a renderer and either calling render on a renderable or calling
 * a render_xxx method directly. The render test class contains additional properties
 * so that it can be displayed nicely in the element library admin tool.
 *
 * @package    core
 * @category   output
 * @copyright  2014 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\output\sample;
use \core\output\renderer_sample_base;

/**
 * A renderer test class for actions.
 *
 * @copyright  2014 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class action extends renderer_sample_base {

    /** @var \core\output\action[] $actions The list of sample actions */
    private $actions = array();

    /**
     * Simple constructor.
     */
    public function __construct() {
        global $PAGE;

        $this->name = 'Action';
        $this->docs = 'Shows the different ways an action atom can be renderered.';
        $this->category = renderer_sample_base::CATEGORY_ATOM;

        $action = new \core\output\action('Default action with icon',
                                          $PAGE->url,
                                          'Action atom',
                                          new \core\output\icon('e/layers'));
        array_push($this->actions, $action);

        $action = new \core\output\action('Action as POST with icon',
                                          $PAGE->url,
                                          'Action atom',
                                          new \core\output\icon('e/layers'));
        $action->method = 'POST';
        array_push($this->actions, $action);

        $action = new \core\output\action('Default action with no icon',
                                          $PAGE->url,
                                          'Action atom');
        array_push($this->actions, $action);

        $action = new \core\output\action('Action as POST with no icon',
                                          $PAGE->url,
                                          'Action atom');
        $action->method = 'POST';
        array_push($this->actions, $action);
    }

    /**
     * This method is responsible for running this test. It just calls $OUTPUT->heading().
     *
     * @return string
     */
    public function execute() {
        global $OUTPUT;
        $result = '';

        foreach ($this->actions as $index => $action) {
            $result .= $OUTPUT->render($action);
        }
        return $result;
    }

}
