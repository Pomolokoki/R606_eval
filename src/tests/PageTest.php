<?php

use PHPUnit\Framework\TestCase;

class PageTest extends TestCase
{
    public function testHomePageIsRendered(): void
    {
        $url = "http://localhost:8080";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        // ✅ Test 1: HTTP status
        $this->assertSame(
            200,
            $httpCode,
            "Homepage did not return HTTP 200"
        );

        // ✅ Test 2: HTML exists
        $this->assertStringContainsString(
            '<html',
            $response,
            "Response does not contain HTML"
        );

        // ✅ Test 3: Expected content
        $this->assertStringContainsString(
            'Evaluation',
            $response,
            "Expected text 'Evaluation' not found in page"
        );
    }
}
