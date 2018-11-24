<?php
/** j4s\diagram */

namespace j4s\diagram;

/**
 * Тесты для класса DiagramClasses
 *
 * @package     j4s\diagram\DiagramClassesTest
 * @author      Eugeniy Makarkin <soloscriptura@mail.ru>
 * @version     v1.0.2 2018-11-24 08:55:31
 */
class DiagramClassesTest
{
    /**
     * Запускает тесты данного класса
     * @version v1.0.1 2018-11-24 08:55:45
     * @return Null
     */
    public static function run()
    {
        echo '<div class="utest__section">';
        echo '<h5>DiagramClasses:</h5>';
        echo self::addClassTest();
        echo self::addClassesTest();
        echo self::parentClassesArrayTest();
        echo '</div>';
    }

    /**
     * Тест для метода addClass
     * @version v1.0.1 2018-11-24 08:56:03
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function addClassTest()
    {
        global $UTest;

        $UTest->methodName = 'addClass';


        // Arrange Test
        $UTest->nextHint = 'Добавляет к свойству (array)$classes имя заданного класса';
        $expect = 'j4s\diagram\Diagram, j4s\diagram\DiagramClasses';
        // Act
        $RE1 = new DiagramClasses();
        $RE1->addClass('j4s\diagram\DiagramClasses');
        $act = '';
        $act .= $RE1->classes[0] . ', ';
        $act .= $RE1->classes[1];
        // Assert Test
        $UTest->isEqual("addClass();", $expect, $act);

        // Arrange Test
        $UTest->nextHint = 'Добавляет к свойству (array)$blocks url класса и его родительских классов для диаграммы';
        $expect = '[j4s\diagram\Diagram%7Cblocks;links;diagramCode;duplicateLinks;direction;typeDiagram%7C__construct();addBlock();addBlocks();addLink();addLinks();build();linksFromArray();render()], [j4s\diagram\DiagramClasses%7Cclasses;blocks;links;diagramCode;duplicateLinks;direction;typeDiagram%7C__construct();addClass();addClasses();classesFromDirectory();parentClassesArray();parentInterfacesArray();addBlock();addBlocks();addLink();addLinks();build();linksFromArray();render()]';
        // Act
        $RE2 = new DiagramClasses();
        $RE2->addClass('j4s\diagram\DiagramClasses');
        $act = '';
        $act .= $RE1->blocks['j4s\diagram\Diagram'] . ', ';
        $act .= $RE1->blocks['j4s\diagram\DiagramClasses'];
        // Assert Test
        $UTest->isEqual("addClass();", $expect, $act);

        // Arrange Test
        $UTest->nextHint = 'Добавляет к свойству (array)$link url стрелки между классами';
        $expect = '[j4s\diagram\Diagram]^-[j4s\diagram\DiagramClasses]';
        // Act
        $RE3 = new DiagramClasses();
        $RE3->addClass('j4s\diagram\DiagramClasses');
        $act = '';
        $act .= $RE1->links[0];
        // Assert Test
        $UTest->isEqual("addClass('j4s\diagram\DiagramClasses');", $expect, $act);


        return $UTest->functionResults;
    }

    /**
     * Тест для метода addClasses
     * @version v1.0.1 2018-11-24 08:56:19
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function addClassesTest()
    {
        global $UTest;

        $UTest->methodName = 'addClasses';


        // Arrange Test
        $UTest->nextHint = 'Добавляет к свойству (array)$classes элементы заданного массива (имен классов)';
        $expect = 'j4s\diagram\Diagram, j4s\diagram\DiagramClasses, j4s\diagram\YUML';
        // Act
        $RE1 = new DiagramClasses();
        $i = array('j4s\diagram\DiagramClasses', 'j4s\diagram\YUML');
        $RE1->addClasses($i);
        $act = '';
        $act .= $RE1->classes[0] . ', ';
        $act .= $RE1->classes[1] . ', ';
        $act .= $RE1->classes[2];
        // Assert Test
        $UTest->isEqual("addClasses();", $expect, $act);


        return $UTest->functionResults;
    }

    /**
     * Тест для метода parentClassesArray
     * @version v1.0.1 2018-11-24 08:56:35
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function parentClassesArrayTest()
    {
        global $UTest;

        $UTest->methodName = 'parentClassesArray';


        // Arrange Test
        $UTest->nextHint = 'возвращает строку имен всех родительских классов относительно заданного класса(включая его) в порядке их наследования';
        $expect = 'j4s\diagram\Diagram, j4s\diagram\DiagramClasses';
        // Act
        $RE1 = new DiagramClasses();
        $i = $RE1->parentClassesArray('j4s\diagram\DiagramClasses');
        $act = implode(', ', $i);
        // Assert Test
        $UTest->isEqual("parentClassesArray('j4s\diagram\DiagramClasses');", $expect, $act);


        return $UTest->functionResults;
    }
}
