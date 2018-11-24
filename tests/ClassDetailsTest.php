<?php
/** j4s\diagram */

namespace j4s\diagram;

/**
 * Тесты для класса ClassDetails
 *
 * @package     j4s\diagram\ClassDetailsTest
 * @author      Eugeniy Makarkin <soloscriptura@mail.ru>
 * @version     v1.0.2 2018-11-24 08:54:42
 */
class ClassDetailsTest
{
    /**
     * Запускает тесты данного класса
     * @version v1.0.1 2018-11-24 08:54:30
     * @return Null
     */
    public static function run()
    {
        echo '<div class="utest__section">';
        echo '<h5>ClassDetails:</h5>';
        echo self::resultTest();
        echo '</div>';
    }

    /**
     * Тест для метода result
     * @version v1.0.1 2018-11-24 08:54:14
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function resultTest()
    {
        global $UTest;

        $UTest->methodName = 'result';


        // Arrange Test
        $UTest->nextHint = 'Массив данных класса';
        $expect = array(
                'className' => 'j4s\diagram\DiagramClasses',
                'parentClassName' => 'j4s\diagram\Diagram',
                'properties' => array('classes', 'blocks', 'links', 'diagramCode', 'duplicateLinks', 'direction', 'typeDiagram'),
                'methods' => array('__construct', 'addClass', 'addClasses', 'classesFromDirectory', 'parentClassesArray', 'parentInterfacesArray', 'addBlock', 'addBlocks', 'addLink', 'addLinks', 'build', 'linksFromArray', 'render'),
                'interfaces' => array()
            );
        // Act
        $RE1 = new ClassDetails('j4s\diagram\DiagramClasses');
        $act = $RE1->result();
        // Assert Test
        $UTest->isEqual("result();", $expect, $act);


        return $UTest->functionResults;
    }
}
