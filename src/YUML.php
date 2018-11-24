<?php
/** j4s\diagram */

declare(strict_types=1);

namespace j4s\diagram;

/**
 * Подготавливает и возвращает ссылку на yUML диаграмму, созданную на основе заданных параметров.
 * Объект - одна конкретная диаграмма
 * 
 * @package     j4s\diagram
 * @author      Eugeniy Makarkin <soloscriptura@mail.ru>
 * @version     v1.0.2 2018-11-23 14:51:39
 */
class YUML
{
    /**
     * Конструктор
     * @version v1.0.1 2018-11-23 16:03:33
     */
    public function __construct()
    {
    }

    /**
     * Возвращает сформированний url для yuml
     * @version v1.0.2 2018-11-23 16:05:29
     * @param string $data - Данные диаграммы
     * @param string $type - Тип диаграммы
     * @param string $dir - Направление диаграммы lr или td (слева направо или сверху вниз)
     * @return string
     */
    public function urlUml(string $data, string $type = 'plain', string $dir = 'lr') : string
    {
        return 'https://yuml.me/diagram/' . $type . ';dir:' . $dir . '/class/' . $data;
    }

    /**
     * Возвращает строку данных класса для yuml
     * @version v1.0.2 2018-11-23 16:05:51
     * @param array $array Массив данных класса
     * @return string
     */
    public function array2YumlClass(array $array) : string
    {
        return '[' . $array['className'] . '%7C' . implode(";", $array['properties']) . '%7C' .  implode("();", $array['methods']) . '()]';
    }
}
