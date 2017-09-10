<?php

// Spamfilter.php -- Filter through text, searching for spam
// Copyright (C) 2013 Andreas Renberg <iq_andreas@hotmail.com>
// Copyright (C) 2017 Michel Bardelmeijer <michel@enflow.nl>
//
//  This program is free software; you can redistribute it and/or modify it
//  under the terms of the GNU General Public License version 3, as
//  published by the Free Software Foundation.
//
//  This program is distributed in the hope that it will be useful, but
//  WITHOUT ANY WARRANTY; without even the implied warranty of
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
//  General Public License for more details.
//
//  You should have received a copy of the GNU General Public License along
//  with this program; if not, see <http://www.gnu.org/licences/>

namespace Enflow\Component\SpamFilter;

use Exception;

class SpamFilter
{
    public function __construct(string $blacklistDirectory = null)
    {
        if ($blacklistDirectory === null) {
            $blacklistDirectory = __DIR__ . '/../../spam-filter-blacklists';
        }

        if (!file_exists($blacklistDirectory)) {
            throw new Exception("Unable to find blacklist directory at '{$blacklistDirectory}'");
        }

        $this->blacklists = glob($blacklistDirectory . '/*.txt');
    }

    public function isPossibleSpam($text)
    {
        foreach ($this->blacklists as $blacklist) {
            if ($this->matchesBlacklist($text, $blacklist)) {
                return true;
            }
        }

        return false;
    }

    private function matchesBlacklist($text, string $blacklist): bool
    {
        $keywords = file($blacklist, FILE_SKIP_EMPTY_LINES);
        $currentLine = 0;

        foreach ($keywords as $regex) {
            $currentLine++;

            // Remove comments and whitespace before and after a keyword
            $regex = preg_replace('/(^\s+|\s+$|\s*#.*$)/i', "", $regex);
            if (empty($regex)) {
                continue;
            }

            $match = preg_match("/$regex/i", $text, $regex_match);
            if ($match) {
                return true;
            } elseif ($match === false) {
                throw new Exception("Invalid regular expression in `$blacklist` line $currentLine.");
            }
        }

        return false;
    }
}
