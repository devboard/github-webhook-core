<?php

declare(strict_types=1);

namespace tests\DevboardLib\GitHubWebhook\Core;

use DevboardLib\GitHubWebhook\Core\CompareChangesUrl;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\CompareChangesUrl
 * @group  unit
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class CompareChangesUrlTest extends \PHPUnit_Framework_TestCase
{
    /** @dataProvider provideChangesUrls */
    public function testItExposesValue(string $apiUrl)
    {
        $sut = new CompareChangesUrl($apiUrl);
        $this->assertEquals($apiUrl, $sut->getValue());
    }

    /** @dataProvider provideChangesUrls */
    public function testItCanBeAutoConvertedToString(string $apiUrl)
    {
        $sut = new CompareChangesUrl($apiUrl);
        $this->assertEquals($apiUrl, (string) $sut);
    }

    public function provideChangesUrls()
    {
        return [
            ['https://github.com/devboard-test/super-library/compare/9049f1265b7d...0d1a26e67d8f'],
        ];
    }
}
