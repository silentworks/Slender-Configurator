<?php
/**
 * Slender Configurator
 *
 * @author      Alan Pich <alan.pich@gmail.com>
 * @copyright   2015 Alan Pich
 * @link        http://github.com/alanpich/Slender-Configurator
 * @license     http://github.com/alanpich/Slender-Configurator/blob/master/LICENSE
 * @package     Slender\Configurator
 *
 * MIT LICENSE
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
namespace Slender\Configurator\FileTypeAdapter;

use Slender\Configurator\Interfaces\FileTypeAdapterInterface;
use Symfony\Component\Yaml\Yaml as YamlParser;


/**
 * Class YAML
 * @package Slender\Configurator\FileTypeAdapter
 */
class YAML implements FileTypeAdapterInterface
{
    /**
     * @var string
     */
    private $glob = '*.yml';


    /**
     * @param bool $recursive
     */
    public function __construct( $recursive = false )
    {
        if($recursive){
            $this->glob = "**/*.yml";
        }
    }


    /**
     * Load configuration from a specified directory,
     * and return it as a nested array
     *
     * @param string $dir Directory to load from
     * @return array    The configuration
     */
    public function loadFrom($dir)
    {
        $pattern = $dir.'/'.$this->glob;
        $files = glob($pattern);

        $conf = [];

        foreach($files as $filePath){
            $arr = YamlParser::parse(file_get_contents($filePath));
            $conf = array_merge_recursive($conf, $arr );
        }


        return $conf;
    }



}
