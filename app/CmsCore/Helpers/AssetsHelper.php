<?php
/**
 * assetsに関するHelper関数。assetsを作る
 */

function imageUrl($name, $thumber_size = 'original', $absolutely = false)
{
    return route('assets.image', ['thumb_size' => $thumber_size, 'name' => $name], $absolutely);
}

function cssUrl($name, $absolutely = false)
{
    return route('assets.css', ['name' => $name], $absolutely);
}

function styleSheetUrl($name, $absolutely = false)
{
    return route('assets.css', ['name' => $name], $absolutely);
}

function javascriptUrl($name, $absolutely = false)
{
    return route('assets.js', ['name' => $name], $absolutely);
}

function jsUrl($name, $absolutely = false)
{
    return route('assets.js', ['name' => $name], $absolutely);
}

function materialUrl($name, $absolutely = false)
{
    return route('assets.material', ['name' => $name], $absolutely);
}

function fileUrl($name, $absolutely = false)
{
    return route('assets.file', ['name' => $name], $absolutely);
}
