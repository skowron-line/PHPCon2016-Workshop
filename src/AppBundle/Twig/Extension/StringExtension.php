<?php


namespace AppBundle\Twig\Extension;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class StringExtension extends \Twig_Extension
{
    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('truncate', [$this, 'truncate']),
        ];
    }

    /**
     * @param $string
     * @param int $length
     *
     * @return string
     */
    public function truncate($string, $length = 100)
    {
        if (strlen($string) < $length) {
            return $string;
        }

        return sprintf('%s...', substr($string, 0, $length));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'string';
    }

}