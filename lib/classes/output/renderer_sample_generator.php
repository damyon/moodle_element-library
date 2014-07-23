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
 * Implementation of renderer_sample_generator_base for core renderers.
 *
 * @package    core
 * @category   output
 * @copyright  2014 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace core\output;

/**
 * Implementation of renderer_sample_generator_base for core renderers.
 *
 * @copyright  2014 Damyon Wiese
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class renderer_sample_generator extends renderer_sample_generator_base {

    /**
     * Generate a list of renderer_sample_base instances.
     *
     * @return renderer_sample_base[] Array of renderer_sample_base classes.
     */
    public function create_samples() {
        $tests = array();

        // Headings.
        $test = new \core\output\sample\heading(
            'Heading 1',
            '# An example of a level 1 heading in a page.

*There should only ever be 1 instance of level 1 heading on any page.*',
            'Heading 1',
            1
        );
        $tests[] = $test;

        // Actions.
        $test = new \core\output\sample\action();
        $tests[] = $test;






        return $tests;
    }
}
