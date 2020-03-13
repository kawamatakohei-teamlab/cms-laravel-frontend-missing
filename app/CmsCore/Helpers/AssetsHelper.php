<?php
/**
 * assetsに関するHelper関数。assetsを作る
 */

function imageUrl($name_or_id, $thumber_size = 'original', $mode = 'name', $absolutely = false)
{
    if ($mode == 'name') return imageUrlByName($name_or_id, $thumber_size, $absolutely);
    if ($mode == 'id') return imageUrlById($name_or_id, $thumber_size, $absolutely);
    return '';
}

function imageUrlById($name, $thumber_size = 'original', $absolutely = false)
{
    return route('assets.image.id', ['thumb_size' => $thumber_size, 'id' => $name], $absolutely);
}

function imageUrlByName($name, $thumber_size = 'original', $absolutely = false)
{
    return route('assets.image.name', ['thumb_size' => $thumber_size, 'name' => $name], $absolutely);
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

function fileUrl($name_or_id, $mode = 'name' ,$absolutely = false)
{
    if ($mode == 'name') return fileUrlByName($name_or_id, $absolutely);
    if ($mode == 'id') return fileUrlById($name_or_id, $absolutely);
    return '';
}
function fileUrlByName($name, $absolutely = false)
{
    return route('assets.file.name', ['name' => $name], $absolutely);
}
function fileUrlById($id, $absolutely = false)
{
    return route('assets.file.id', ['id' => $id], $absolutely);
}
