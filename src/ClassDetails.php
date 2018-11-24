<?php
/** j4s\diagram */

declare(strict_types=1);

namespace j4s\diagram;

/**
 * Класс для получения информации о заданном классе.
 * Информация о классе - (свойства, методы, родительский класс, интерфейсы и т.д.) может
 * быть получена в результате вызова метода result();
 * 
 * @package     j4s\diagram\ClassDetails
 * @author      Eugeniy Makarkin <soloscriptura@mail.ru>
 * @version     v1.0.4 2018-11-23 15:53:24
 */
class ClassDetails
{
    /** @var string $className Имя рассматриваемого класса */
    public $className;

    /**
     * Конструктор
     * @version v1.0.1 2018-11-23 15:55:17
     * @param string $className - Имя рассматриваемого класса
     */
    public function __construct(string $className)
    {
        $this->className = $className;
    }

    /**
     * Возвращает имя родительского класса
     * @version v1.0.0 2018-10-30 09:39:06
     * @return string|bool
     */
    public function parentClassName()
    {
        return get_parent_class($this->className);
    }

    /**
     * Возвращает массив свойств класса
     * @version v1.0.1 2018-11-03 19:18:57
     * @return array
     */
    public function properties() : array
    {
        if (is_array(get_class_vars($this->className))) {
            $properties = array_keys(get_class_vars($this->className));
        } else {
            $properties = array();
        }

        return $properties;
    }

    /**
     * Возвращает массив методов класса
     * @version v1.0.1 2018-11-03 19:18:17
     * @return array
     */
    public function methods() : array
    {
        if (is_array(get_class_methods($this->className))) {
            $methods = get_class_methods($this->className);
        } else {
            $methods = array();
        }

        return $methods;
    }

    /**
     * Возвращает массив имен интерфейсов, реализованных в классе и его родительских классах
     * @version v0.0.1 2018-11-03 19:30:27
     * @return array
     */
    public function interfaces() : array
    {
        if (is_array(class_implements($this->className))) {
            $interfaces = class_implements($this->className);
        } else {
            $interfaces = array();
        }

        return $interfaces;
    }

    /**
     * Возвращает результирующий массив данных класса
     * @version v1.0.1 2018-11-03 19:18:08
     * @return array
     */
    public function result() : array
    {
        $arrArguments = array();
        $arrArguments['className']  = $this->className;
        $arrArguments['parentClassName'] = $this->parentClassName();
        $arrArguments['properties'] = $this->properties();
        $arrArguments['methods']    = $this->methods();
        $arrArguments['interfaces']    = $this->interfaces();

        return $arrArguments;
    }
}
