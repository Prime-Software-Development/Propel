<?php
namespace Propel\generator\lib\builder\om;

use Propel\generator\lib\builder\om\ObjectBuilder;

/**
 * This file is part of the Propel package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT License
 */

/*require_once dirname(__FILE__) . '/ObjectBuilder.php';*/

/**
 * Generates the empty PHP5 stub node object class for user object model (OM).
 *
 * This class produces the empty stub class that can be customized with application
 * business logic, custom behavior, etc.
 *
 * @author     Hans Lellelid <hans@xmpl.org>
 * @package    propel.generator.builder.om
 */
class PHP5ExtensionNodeBuilder extends ObjectBuilder
{

    /**
     * Returns the name of the current class being built.
     *
     * @return string
     */
    public function getUnprefixedClassname()
    {
        return $this->getTable()->getPhpName() . 'Node';
    }

    /**
     * Adds the include() statements for files that this class depends on or utilizes.
     *
     * @param string &$script The script will be modified in this method.
     */
    protected function addIncludes(&$script)
    {
        $script .= "
require '" . $this->getNodeBuilder()->getClassFilePath() . "';
";
    } // addIncludes()

    /**
     * Adds class phpdoc comment and opening of class.
     *
     * @param string &$script The script will be modified in this method.
     */
    protected function addClassOpen(&$script)
    {

        $table = $this->getTable();
        $tableName = $table->getName();
        $tableDesc = $table->getDescription();

        $baseClassname = $this->getNodeBuilder()->getClassname();

        $script .= "

/**
 * Skeleton subclass for representing a node from the '$tableName' table.
 *
 * $tableDesc
 *";
        if ($this->getBuildProperty('addTimeStamp')) {
            $now = strftime('%c');
            $script .= "
 * This class was autogenerated by Propel " . $this->getBuildProperty('version') . " on:
 *
 * $now
 *";
        }
        $script .= "
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator." . $this->getPackage() . "
 */
class " . $this->getClassname() . " extends $baseClassname {
";
    }

    /**
     * Specifies the methods that are added as part of the stub object class.
     *
     * By default there are no methods for the empty stub classes; override this method
     * if you want to change that behavior.
     *
     * @see        ObjectBuilder::addClassBody()
     */
    protected function addClassBody(&$script)
    {
        // there is no class body
    }

    /**
     * Closes class.
     *
     * @param string &$script The script will be modified in this method.
     */
    protected function addClassClose(&$script)
    {
        $script .= "
} // " . $this->getClassname() . "
";
    }
} // PHP5ExtensionObjectBuilder
