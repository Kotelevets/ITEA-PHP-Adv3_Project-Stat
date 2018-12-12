<?php

namespace App\Info;

/**
 * Analyzer that provides total information about classes.
 *
 * @author Kotyaaa <kotya.aa@gmail.com>
 */
final class ClassInfoAnalyzer
{
    private const TAB = '     ';

    public function analyze(string $fullClassName): string
    {
        $reflection = new \ReflectionClass($fullClassName);

        return $this->getClassInfo($reflection) . \PHP_EOL
             . $this->getPropertiesInfo($reflection) . \PHP_EOL
             . $this->getMethodsInfo($reflection);
    }

    private function getClassInfo(\ReflectionClass $reflection): string
    {
        $finalAbstract = '';

        if ($reflection->isFinal() && $reflection->isAbstract()) {
            $finalAbstract = ' (Final class / Abstract class)';
        } elseif (!$reflection->isFinal() && $reflection->isAbstract()) {
            $finalAbstract = ' (Abstract class)';
        } elseif ($reflection->isFinal() && !$reflection->isAbstract()) {
            $finalAbstract = ' (Final class)';
        }

        return 'Class: ' . $reflection->getName() . $finalAbstract;
    }

    private function getPropertiesInfo(\ReflectionClass $reflection): string
    {
        $publicProperty = 0;
        $publicStaticProperty = 0;
        $protectedProperty = 0;
        $protectedStaticProperty = 0;
        $privateProperty = 0;
        $privateStaticProperty = 0;

        foreach ($reflection->getProperties() as $property) {
            if ($property->isPublic() && $property->isStatic()) {
                ++$publicProperty;
                ++$publicStaticProperty;
            } elseif ($property->isPublic() && !$property->isStatic()) {
                ++$publicProperty;
            }

            if ($property->isProtected() && $property->isStatic()) {
                ++$protectedProperty;
                ++$protectedStaticProperty;
            } elseif ($property->isProtected() && !$property->isStatic()) {
                ++$protectedProperty;
            }

            if ($property->isPrivate() && $property->isStatic()) {
                ++$privateProperty;
                ++$privateStaticProperty;
            } elseif ($property->isPrivate() && !$property->isStatic()) {
                ++$privateProperty;
            }
        }

        return  'Properties:'
                . \PHP_EOL
                . self::TAB . 'public: '
                . $publicProperty
                . ($publicStaticProperty ? ' (' . $publicStaticProperty . ' static)' : '')
                . \PHP_EOL
                . self::TAB . 'protected: '
                . $protectedProperty
                . ($protectedStaticProperty ? ' (' . $protectedStaticProperty . ' static)' : '')
                . \PHP_EOL
                . self::TAB . 'private: '
                . $privateProperty
                . ($privateStaticProperty ? ' (' . $privateStaticProperty . ' static)' : '');
    }

    private function getMethodsInfo(\ReflectionClass $reflection): string
    {
        $publicMethod = 0;
        $publicStaticMethod = 0;
        $protectedMethod = 0;
        $protectedStaticMethod = 0;
        $privateMethod = 0;
        $privateStaticMethod = 0;

        foreach ($reflection->getMethods() as $property) {
            if ($property->isPublic() && $property->isStatic()) {
                ++$publicMethod;
                ++$publicStaticMethod;
            } elseif ($property->isPublic() && !$property->isStatic()) {
                ++$publicMethod;
            }

            if ($property->isProtected() && $property->isStatic()) {
                ++$protectedMethod;
                ++$protectedStaticMethod;
            } elseif ($property->isProtected() && !$property->isStatic()) {
                ++$protectedMethod;
            }

            if ($property->isPrivate() && $property->isStatic()) {
                ++$privateMethod;
                ++$privateStaticMethod;
            } elseif ($property->isPrivate() && !$property->isStatic()) {
                ++$privateMethod;
            }
        }

        return  'Methods:'
            . \PHP_EOL
            . self::TAB . 'public: '
            . $publicMethod
            . ($publicStaticMethod ? ' (' . $publicStaticMethod . ' static)' : '')
            . \PHP_EOL
            . self::TAB . 'protected: '
            . $protectedMethod
            . ($protectedStaticMethod ? ' (' . $protectedStaticMethod . ' static)' : '')
            . \PHP_EOL
            . self::TAB . 'private: '
            . $privateMethod
            . ($privateStaticMethod ? ' (' . $privateStaticMethod . ' static)' : '');
    }
}
