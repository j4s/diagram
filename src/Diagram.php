<?php
/** j4s\diagram */

declare(strict_types=1);

namespace j4s\diagram;

/**
 * Построение диаграммы.
 * Формирует и выводит диаграмму.
 * 
 * @package     j4s\diagram
 * @author      Eugeniy Makarkin <soloscriptura@mail.ru>
 * @version     v2.0.0 2018-11-26 22:28:51
 */
class Diagram
{
    /** @var array $blocks Массив блоков */
    public $blocks = array();
    /** @var array $links Массив связей(обычно стрелок) */
    public $links = array();
    /** @var string $diagramCode Код диаграммы */
    public $diagramCode;
    /** @var bool $duplicateLinks Разрешать ли дублирующие связи(обычно стрелки) у которых совпадают начало и конец */
    public $duplicateLinks = false;
    /** @var string $direction Направление диаграммы */
    public $direction = 'lr';
    /** @var string $typeDiagram Тип диаграммы */
    public $typeDiagram = 'plain';

    /**
     * Конструктор
     * @version v1.0.1 2018-11-23 16:10:47
     */
    public function __construct()
    {
    }

    /**
     * Добавляет в список блоков блок с заданным именем.
     * @version v1.0.2 2018-11-23 16:12:18
     * @param string $blockName - Имя блока
     * @param string|bool $block - Тело блока либо false, если тело содержит только имя.
     * @return void
     */
    public function addBlock(string $blockName, $block = false)
    {
        if ($block == false) {
            $this->blocks[$blockName] = '[' . $blockName . ']';
        } else {
            $this->blocks[$blockName] = $block;
        }
    }

    /**
     * Добавляет в список блоков элементы заданного массива
     * @version v1.0.1 2018-11-23 14:43:37
     * @param array $blocks - Массив имен блоков
     * @return void
     */
    public function addBlocks(array $blocks)
    {
        foreach ($blocks as $block) {
            if (is_array($block)) {
                $this->addBlock($block[0], $block[1]);
            } else {
                $this->addBlock($block);
            }
        }
    }

    /**
     * Добавляет заданную связь(обычно стрелку) в свойство $links между двумя заданными блоками
     * @version v1.1.0 2019-04-20 18:50:51
     * @param string $block1Name - Имя первого блока
     * @param string $block2Name - Имя второго блока
     * @param string $linkType - Тип связи
     * @param bool $turnAround - Переворачивать ли связь
     * @return void
     */
    public function addLink(string $block1Name, string $block2Name, string $linkType, bool $turnAround = false)
    {
        if ($turnAround === false) {
            $linkPossible = "[" . $block1Name . "]" . $linkType . "[" . $block2Name . "]";
        } else {
            $linkPossible = "[" . $block2Name . "]" . $linkType . "[" . $block1Name . "]";
        }
        if ($this->duplicateLinks || !in_array($linkPossible, $this->links)) {
            $this->links[] = $linkPossible;
        }
    }

    /**
     * Добавляет заданные связи(обычно стрелки) в свойство $links между парами заданных блоков
     * @version v1.0.1 2018-11-23 14:45:50
     * @param array $links - массив связей
     * @return void
     */
    public function addLinks(array $links)
    {
        foreach ($links as $link) {
            if (isset($link[3])) {
                $this->addLink($link[0], $link[1], $link[2], $link[3]);
            } else {
                $this->addLink($link[0], $link[1], $link[2]);
            }
        }
    }

    /**
     * Собирает код диаграммы в свойство $diagramCode
     * @version v1.0.1 2018-11-23 14:46:19
     * @return void
     */
    public function build()
    {
        $this->diagramCode .= implode(',', $this->blocks);
        if (!empty($this->links)) {
            $this->diagramCode .= ',' . implode(',', $this->links);
        }
    }

    /**
     * Возвращает массив ссылок для заданной в массиве последовательности блоков
     * @version v2.0.0 2018-11-26 22:28:29
     * @param array $sequenceArray - Последовательность блоков
     * @return void
     */
    public function linksFromArray(array $sequenceArray)
    {
        foreach ($sequenceArray as $sequenceElement) {
            if (isset($lastElement)) {
                $from = $lastElement[0];
                $to = $sequenceElement[0];
                $arrow = $sequenceElement[1] ?? '->';
                $this->addLink($from, $to, $arrow);
            }
    
            $lastElement = $sequenceElement;
        }
    }

    /**
     * Выводит картинку.
     * Выводит с помощью php функции echo html код с картинкой диаграммы.
     * @version v1.0.2 2018-11-23 16:19:28
     * @return void
     */
    public function render()
    {
        $this->build();
        $YUML = new YUML();
        $result = $YUML->urlUml($this->diagramCode, $this->typeDiagram, $this->direction);

        echo '<center><img src="' . $result . '" /></center>';
    }
}
