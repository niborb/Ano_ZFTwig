<?php
/**
 * This file is part of the Ano_ZFTwig package
 * 
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.
 *
 * @copyright  Copyright (c) 2010-2011 Benjamin Dulau <benjamin.dulau@gmail.com>
 * @license    New BSD License
 */

/**
 * ZF Trans Extension for Twig's Zend Framework Integration
 *
 * Inspired from Symfony 2 Twig Bundle
 *
 * @package     Ano_ZFTwig
 * @subpackage  Extension
 * @author      Benjamin Dulau <benjamin.dulau@gmail.com>
 */
class Ano_ZFTwig_Extension_TransExtension extends Twig_Extension
{
    /**
     * @var \Twig_Environment
     */
    private $env;

    /**
     * @param Twig_Environment $environment
     */
    public function initRuntime(Twig_Environment $environment)
    {
        $this->env = $environment;
        parent::initRuntime($environment);
    }


    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            // {% tag "message"|trans %}
            'trans' => new Twig_Filter_Method($this, 'trans'),
        );
    }

    /**
     * Returns the token parser instance to add to the existing list.
     *
     * @return array An array of Twig_TokenParser instances
     */
    public function getTokenParsers()
    {
        return array(
            // {% trans "Hello world !" %}
            new Ano_ZFTwig_TokenParser_TransTokenParser(),
        );
    }

    /**
     * Calls the ZF translate view helper and
     * returns the translated string.
     *
     * @param string           $input The input to translate
     * @return string          The translated output
     */
    public function trans($input)
    {        
        return $this->env->getView()->translate($input);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'translator';
    }
}