<?php

use Kanboard\Core\Translator;

/**
 * Sum all values from a single column in the input array
 *
 * $input = [
 *   ['column' => 2'], ['column' => 3']
 * ]
 *
 * array_column_sum($input, 'column') returns 5
 *
 * @param  array   $input
 * @param  string  $column
 * @return double
 */
function array_column_sum(array &$input, $column)
{
    $sum = 0.0;

    foreach ($input as &$row) {
        if (isset($row[$column])) {
            $sum += (float) $row[$column];
        }
    }

    return $sum;
}

/**
 * Build version number from git-archive output
 *
 * @param  string $ref
 * @param  string $commit_hash
 * @return string
 */
function build_app_version($ref, $commit_hash)
{
    $version = 'master';

    if ($ref !== '$Format:%d$') {
        $tag = preg_replace('/\s*\(.*tag:\sv([^,]+).*\)/i', '\1', $ref);

        if (!is_null($tag) && $tag !== $ref) {
            return $tag;
        }
    }

    if ($commit_hash !== '$Format:%H$') {
        $version .= '.'.$commit_hash;
    }

    return $version;
}

/**
 * Translate a string
 *
 * @return string
 */
function t()
{
    return call_user_func_array(array(Translator::getInstance(), 'translate'), func_get_args());
}

/**
 * Translate a string with no HTML escaping
 *
 * @return string
 */
function e()
{
    return call_user_func_array(array(Translator::getInstance(), 'translateNoEscaping'), func_get_args());
}

/**
 * Translate a number
 *
 * @param  mixed $value
 * @return string
 */
function n($value)
{
    return Translator::getInstance()->number($value);
}
