<?php
use Df\Core\Format\Html;

/**
 * 2016-11-13
 * @used-by df_quote_russian()
 * @param string[] $args
 * @return string|string[]
 */
function df_html_b(...$args) {return df_call_a(function($s) {return df_tag('b', [], $s);}, $args);}

/**
 * 2015-12-21
 * 2015-12-25 Пустой тег style приводит к белому экрану в Chrome: <style type='text/css'/>.
 * @used-by df_style_inline_hide()
 * @param string $css
 * @return string
 */
function df_style_inline($css) {return !$css ? '' : df_tag('style', ['type' => 'text/css'], $css);}

/**
 * 2016-12-04
 * @param string[] $selectors
 * @return string
 */
function df_style_inline_hide(...$selectors) {return !$selectors ? '' : df_style_inline(
	df_csv_pretty($selectors) . ' {display: none !important;}'
);}

/**
 * 2015-04-16
 * Отныне значением атрибута может быть массив:
 * @see \Df\Core\Format\Html\Tag::getAttributeAsText()
 * Передавать в качестве значения массив имеет смысл, например, для атрибута «class».
 *
 * 2016-05-30
 * Отныне в качестве параметра $attributes можно передавать строку вместо массива.
 * В этом случае значение $attributes считается классом CSS формируемого элемента.
 *
 * @used-by df_format_kv_table()
 * @used-by df_js_data()
 * @used-by df_js_x()
 * @param string $tag
 * @param string|array(string => string|string[]|int|null) $attrs [optional]
 * @param string|string[] $content [optional]
 * @param bool $multiline [optional]
 * @return string
 */
function df_tag($tag, $attrs = [], $content = null, $multiline = null) {return Html\Tag::render(
	$tag, is_array($attrs) ? $attrs : ['class' => $attrs], $content, $multiline
);}

/**
 * 2016-11-17
 * @param string $text
 * @param string[] $url
 * @return string
 */
function df_tag_ab($text, ...$url) {return df_tag('a', ['href' => implode($url), 'target' => '_blank'], $text);}

/**
 * 2016-10-24
 * @param string $content
 * @param bool $condition
 * @param string $tag
 * @param string|array(string => string|string[]|int|null) $attributes [optional]
 * @param bool $multiline [optional]
 * @return string
 */
function df_tag_if($content, $condition, $tag, $attributes = [], $multiline = null) {return
	!$condition ? $content : df_tag($tag, $attributes, $content, $multiline)
;}

/**
 * @param string[] $items
 * @param bool $isOrdered [optional]
 * @param string|null $cssList [optional]
 * @param string|null $cssItem [optional]
 * @return string
 */
function df_tag_list(array $items, $isOrdered = false, $cssList = null, $cssItem = null) {return
	Html\ListT::render($items, $isOrdered, $cssList, $cssItem
);}