<?php
/** j4s\diagram */

namespace j4s\diagram;

/**
 * Class DiagramTest - Тесты для класса Diagram
 *
 * @package     j4s\diagram\DiagramTest
 * @author      Eugeniy Makarkin <soloscriptura@mail.ru>
 * @version     v1.0.1 2018-11-24 08:57:10
 */
class DiagramTest
{
    /**
     * Запускает тесты данного класса
     * @version v1.0.1 2018-11-24 08:57:51
     * @return Null
     */
    public static function run()
    {
        echo '<div class="utest__section">';
        echo '<h5>Diagram:</h5>';
        echo self::addBlockTest();
        echo self::addBlocksTest();
        echo self::addLinkTest();
        echo self::addLinksTest();
        echo self::buildTest();
        echo '</div>';
    }

    /**
     * Тест для метода addBlock
     * @version v1.0.1 2018-11-24 08:58:03
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function addBlockTest()
    {
        global $RE, $UTest;
            
        $UTest->methodName = 'addBlock';
    
    
        // Arrange Test
        $UTest->nextHint = 'Добавляет в свойство(blocks) блоки';
        $expect = '[Diagram]';
        // Act
        $RE1 = new Diagram();
        $RE1->addBlock('Diagram');
        $act = $RE1->blocks['Diagram'];
        // Assert Test
        $UTest->isEqual("addBlock();", $expect, $act);

        // Arrange Test
        $UTest->nextHint = 'Добавляет в свойство(blocks) блоки с заданным телом блока';
        $expect = '[YUML%7C%7C__construct();urlUml();array2YumlClass()]';
        // Act
        $RE1 = new Diagram();
        $RE1->addBlock('YUML', '[YUML%7C%7C__construct();urlUml();array2YumlClass()]');
        $act = $RE1->blocks['YUML'];
        // Assert Test
        $UTest->isEqual("addBlock();", $expect, $act);

        // Arrange Test
        $UTest->nextHint = 'Добавляет в свойство(blocks) блок с телом блока ip:128.128.128.128';
        $expect = '[httpWww|ip:128.128.128.128]';
        // Act
        $RE1 = new Diagram();
        $RE1->addBlock('httpWww', '[httpWww|ip:128.128.128.128]');
        $act = $RE1->blocks['httpWww'];
        // Assert Test
        $UTest->isEqual("addBlock('httpWww', '[httpWww|ip:128.128.128.128]');", $expect, $act);


        return $UTest->functionResults;
    }

    /**
     * Тест для метода addBlocks
     * @version v1.0.1 2018-11-24 08:58:22
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function addBlocksTest()
    {
        global $RE, $UTest;
            
        $UTest->methodName = 'addBlocks';
    
    
        // Arrange Test
        $UTest->nextHint = 'Добавляет в свойство(blocks) блоки';
        $expect = '[Diagram][YUML]';
        // Act
        $RE1 = new Diagram();
        $arrName = array('Diagram', 'YUML');
        $RE1->addBlocks($arrName);
        $act = '';
        $act .= $RE1->blocks['Diagram'];
        $act .= $RE1->blocks['YUML'];
        // Assert Test
        $UTest->isEqual("addBlocks();", $expect, $act);


        return $UTest->functionResults;
    }

    /**
     * Тест для метода addLink
     * @version v1.0.1 2018-11-24 08:58:37
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function addLinkTest()
    {
        global $RE, $UTest;
            
        $UTest->methodName = 'addLink';
    
    
        // Arrange Test
        $UTest->nextHint = 'Добавляет заданную связь(обычно стрелку) в свойство $links между двумя заданными блоками';
        $expect = '[Pet]^-[Cat]';
        // Act
        $RE1 = new Diagram();
        $RE1->addLink('Pet', 'Cat', '^-');
        $act = $RE1->links[0];
        // Assert Test
        $UTest->isEqual("addLink();", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Добавляет заданную связь(обычно стрелку) в свойство $links между двумя заданными блоками с переворачиванием';
        $expect = '[Cat]^-[Pet]';
        // Act
        $RE1 = new Diagram();
        $RE1->addLink('Pet', 'Cat', '^-', true);
        $act = $RE1->links[0];
        // Assert Test
        $UTest->isEqual("addLink();", $expect, $act);


        return $UTest->functionResults;
    }

    /**
     * Тест для метода addLinks
     * @version v1.0.1 2018-11-24 08:58:52
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function addLinksTest()
    {
        global $RE, $UTest;
            
        $UTest->methodName = 'addLinks';
    
    
        // Arrange Test
        $UTest->nextHint = 'Добавляет заданные связи(обычно стрелки) в свойство $links между парами заданных классов';
        $expect = '[Pet]^-[Cat][j4s\base\Controller]^-[Pet]';
        // Act
        $RE1 = new Diagram();
        $links = array(array('Pet', 'Cat', '^-'), array('j4s\base\Controller', 'Pet', '^-'));
        $RE1->addLinks($links);
        $act = '';
        $act .= $RE1->links[0];
        $act .= $RE1->links[1];
        // Assert Test
        $UTest->isEqual("addLinks();", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Добавляет заданные связи(обычно стрелки) в свойство $links между парами заданных классов С переворачиванием одной из связей';
        $expect = '[Pet]^-[Cat][Pet]^-[j4s\base\Controller]';
        // Act
        $RE1 = new Diagram();
        $links = array(array('Pet', 'Cat', '^-'), array('j4s\base\Controller', 'Pet', '^-', true));
        $RE1->addLinks($links);
        $act = '';
        $act .= $RE1->links[0];
        $act .= $RE1->links[1];
        // Assert Test
        $UTest->isEqual("addLinks();", $expect, $act);


        return $UTest->functionResults;
    }

    /**
     * Тест для метода build
     * @version v1.0.1 2018-11-24 08:59:05
     * @return string - html тег с сообщением результата прохождения теста
     */
    public static function buildTest()
    {
        global $RE, $UTest;
            
        $UTest->methodName = 'build';
    
    
        // Arrange Test
        $UTest->nextHint = 'Пустая диаграмма';
        $expect = '';
        // Act
        $RE1 = new Diagram();
        $RE1->build();
        $act = $RE1->diagramCode;
        // Assert Test
        $UTest->isEqual("build(); - Собирает код диаграммы в свойство diagramCode", $expect, $act);


        // Arrange Test
        $UTest->nextHint = 'Строим код небольшой диаграммы';
        $expect = '[hello],[hi],[hello]->[hi]';
        // Act
        $RE1 = new Diagram();
        $RE1->addBlocks(array('hello', 'hi'));
        $RE1->addLink('hello', 'hi', '->');
        $RE1->build();
        $act = $RE1->diagramCode;
        // Assert Test
        $UTest->isEqual("build(); - Собирает код диаграммы в свойство diagramCode", $expect, $act);


        return $UTest->functionResults;
    }
}
