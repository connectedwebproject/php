<?php

/*
connectedwebproject/php
Copyright (C) 2018  Fabio Endrizzi (jcte02)

This file is part of connectedwebproject/php.

connectedwebproject/php is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

connectedwebproject/php is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with connectedwebproject/php.  If not, see <http://www.gnu.org/licenses/>.
*/

class MediaEmitter
{
    public static function parse($node)
    {
        switch ($node->tagName()) {
            case 'a':
                if ($node->child()->nodeName == 'img') {
                    $node->down();
                    return new Image([
                        'url' => $node->attribute('src'),
                        'width' => $node->attributeSearch('width', 'intval'),
                        'height' => $node->attributeSearch('height', 'intval')
                    ]);
                } else {
                    // if href ends in .file !ht*
                    return new Link([
                        'value' => $node->attribute('href'),
                        'title' => $node->attribute('title'),
                        'description' => $node->nextText()->wholeText()
                    ]);
                }
                break;
            case 'audio':
                break;
            case 'video':
                break;
            case 'img':
                return new Image([
                    'url' => $node->attribute('src'),
                    'width' => $node->attributeSearch('width', 'intval'),
                    'height' => $node->attributeSearch('height', 'intval')
                ]);
                break;
            case 'iframe':
                break;
        }
    }
}
