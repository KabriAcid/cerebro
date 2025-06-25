<?php
function set_title(string $title = 'Cerebro')
{
    if (isset($title)) {
        return $title;
    }
}
