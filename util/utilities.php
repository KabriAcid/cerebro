<?php
function set_title(string $title = 'Cerebro')
{
    if (isset($title)) {
        return $title;
    }
}

// Helper function to sanitize input
function clean_input($data)
{
    return htmlspecialchars(trim($data));
}