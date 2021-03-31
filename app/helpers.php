<?php 

function readingTime($content = '', $wpm = 250)
{
    $clean_content = strip_tags( $content );
    $word_count = str_word_count( $clean_content );
    $time = ceil( $word_count / $wpm );
    return $time;
}