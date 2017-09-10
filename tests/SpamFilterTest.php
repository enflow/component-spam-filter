<?php

namespace Enflow\Component\SpamFilter\Test;

use Enflow\Component\SpamFilter\SpamFilter;
use Exception;
use PHPUnit\Framework\TestCase;

class SpamFilterTest extends TestCase
{
    public function test_spam_matcher()
    {
        $spamFilter = new SpamFilter();

        $this->assertTrue($spamFilter->isPossibleSpam('viagra'));
        $this->assertTrue($spamFilter->isPossibleSpam('no WIN no FEE'));
        $this->assertFalse($spamFilter->isPossibleSpam('computer store'));
    }

    public function test_custom_blacklists()
    {
        $spamFilter = new SpamFilter(__DIR__ . '/resources/custom-blacklists');

        $this->assertFalse($spamFilter->isPossibleSpam('viagra'));
        $this->assertTrue($spamFilter->isPossibleSpam('nananan batman'));
        $this->assertTrue($spamFilter->isPossibleSpam('tigger'));
    }

    public function test_exception_on_non_existing_blacklist_folder()
    {
        $this->expectException(Exception::class);

        new SpamFilter(__DIR__ . '/resources/nada-blacklists');
    }
}
