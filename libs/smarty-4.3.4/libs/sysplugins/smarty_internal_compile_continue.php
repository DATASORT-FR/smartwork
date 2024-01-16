<?php
/**
 * Smarty Internal Plugin Compile Continue
 * Compiles the {continue} tag
 *
 * @package    Smarty
 * @category Compiler
 * @author     Uwe Tews
 */

/**
 * Smarty Internal Plugin Compile Continue Class
 *
 * @package    Smarty
 * @category Compiler
 */
class Smarty_Internal_Compile_Continue extends Smarty_Internal_Compile_Break
{
    /**
     * Tag name
     *
     * @var string
     */
    public $tag = 'continue';
}
