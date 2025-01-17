<?php
namespace Propel\generator\lib\model;

use Propel\generator\lib\exception\EngineException;
use Propel\generator\lib\model\ConstraintNameGenerator;
use Propel\generator\lib\model\NameGenerator;
use Propel\generator\lib\model\PhpNameGenerator;

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

/*require_once dirname(__FILE__) . '/../exception/EngineException.php';
require_once dirname(__FILE__) . '/NameGenerator.php';
require_once dirname(__FILE__) . '/PhpNameGenerator.php';
require_once dirname(__FILE__) . '/ConstraintNameGenerator.php';*/

/**
 * A name generation factory.
 *
 * @author     Hans Lellelid <hans@xmpl.org> (Propel)
 * @author     Daniel Rall <dlr@finemaltcoding.com> (Torque)
 * @version    $Revision$
 * @package    propel.generator.model
 */
class NameFactory
{

    /**
     * The class name of the PHP name generator.
     */
    const PHP_GENERATOR = 'PhpNameGenerator';

    /**
     * The fully qualified class name of the constraint name generator.
     */
    const CONSTRAINT_GENERATOR = 'ConstraintNameGenerator';

    /**
     * The single instance of this class.
     */
    private static $instance;

    /**
     * The cache of <code>NameGenerator</code> algorithms in use for
     * name generation, keyed by fully qualified class name.
     */
    private static $algorithms = array();

    /**
     * Factory method which retrieves an instance of the named generator.
     *
     * @param string $name The fully qualified class name of the name
     * generation algorithm to retrieve.
     */
    protected static function getAlgorithm($name)
    {
        if (!isset(self::$algorithms[$name])) {
	        $fqName = "\\Propel\\generator\\lib\\model\\" . $name;
	        self::$algorithms[$name] = new $fqName();
        }

        return self::$algorithms[$name];
    }

    /**
     * Given a list of <code>String</code> objects, implements an
     * algorithm which produces a name.
     *
     * @param string $algorithmName The fully qualified class name of the {@link NameGenerator}
     *             implementation to use to generate names.
     * @param array $inputs Inputs used to generate a name.
     *
     * @return string          The generated name.
     * @throws EngineException
     */
    public static function generateName($algorithmName, $inputs)
    {
        $algorithm = self::getAlgorithm($algorithmName);

        return $algorithm->generateName($inputs);
    }
}
