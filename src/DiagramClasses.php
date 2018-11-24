<?php
/** j4s\diagram */

declare(strict_types=1);

namespace j4s\diagram;

/**
 * Построение диаграммы классов
 * 
 * @package     j4s\diagram
 * @author      Eugeniy Makarkin <soloscriptura@mail.ru>
 * @version     v1.0.3 2018-11-23 16:20:12
 */

class DiagramClasses extends Diagram
{
    /** @var array $classes Массив имен классов, которые попадут в диаграмму */
    public $classes = array();

    /**
     * Конструктор
     * @version v1.0.1 2018-11-23 16:20:52
     */
    public function __construct()
    {
    }

    /**
     * Добавляет класс и его окружение в диаграмму.
     * Добавляет к свойству (array)$classes имя заданного класса,
     * к свойству (array)$blocks код класса и его родительских классов для диаграммы,
     * к свойству (array)$link код стрелки между классами
     * @version v1.0.3 2018-11-23 16:21:16
     * @param string $className - Имя класса
     * @return void
     */
    public function addClass(string $className)
    {
        $YUML = new YUML();

        // Собираем массив имен родительских классов
        $classesParents = $this->parentClassesArray($className);

        // Собираем массив интерфейсов
        $interfaces = $this->parentInterfacesArray($className);

        foreach ($classesParents as $classesParent) {
            if (!in_array($classesParent, $this->classes)) {
                $this->classes[] = $classesParent;
                $ClassDetails = new ClassDetails($classesParent);
                $formationURL = $YUML->array2YumlClass($ClassDetails->result());
                $this->addBlock($classesParent, $formationURL);
            }

            for ($i=0; $i < count($classesParents) - 1; $i++) {
                $this->addLink($classesParents[$i], $classesParents[$i + 1], '^-');
            }
        }

        foreach ($interfaces as $interface) {
            $this->classes[] = $interface;
            $ClassDetails = new ClassDetails($interface);
            $formationURL = $YUML->array2YumlClass($ClassDetails->result());
            $this->addBlock($interface, $formationURL);
            $this->addLink($interface, $className, '^-.-');
        }

    }

    /**
     * Добавляет к свойству (array)$classes элементы заданного массива (имен классов)
     * @version v1.0.1 2018-11-23 14:49:55
     * @param array $classes - Массив имен классов
     * @return void
     */
    public function addClasses(array $classes)
    {
        foreach ($classes as $class) {
            $this->addClass($class);
        }
    }

    /**
     * Возвращает массив имен классов, находящихся в папке расположенной по заданному пути
     * @version v1.0.1 2018-11-23 14:50:08
     * @param string $dir - Путь к папке
     * @return void
     */
    public function classesFromDirectory(string $dir)
    {
        $classesDirectorys = scandir($dir, 1);
        array_pop($classesDirectorys);
        array_pop($classesDirectorys);
        $classesDirectorys = preg_replace('#\.php#', '', $classesDirectorys);

        foreach ($classesDirectorys as $classesDirectory) {
            $this->addClass($classesDirectory);
        }
    }

    /**
     * Возвращает массив имен всех родительских относительно заданного класса
     * (включая его) в порядке их наследования
     * @version v1.0.2 2018-11-23 16:23:03
     * @param string $className - Имя класса
     * @return array
     */
    public function parentClassesArray(string $className) : array
    {
        $classesArray = array();

        $parentClassName = get_parent_class($className);

        if ($parentClassName) {
            $classesArray = $this->parentClassesArray($parentClassName);
        }

        $classesArray[] = $className;

        return $classesArray;
    }

    /**
     * Возвращает массив имен всех интерфейсов
     * @version v0.0.2 2018-11-23 14:51:09
     * @since v1.0.1
     * @param string $className - Имя класса
     * @return array
     */
    public function parentInterfacesArray(string $className) : array
    {
        if (is_array(class_implements($className))) {
            $interfaces = class_implements($className);
        } else {
            $interfaces = array();
        }

        return $interfaces;
    }
}
