<?php

namespace Lindelius\JWT\Tests;

use Lindelius\JWT\Exception\BeforeValidException;
use Lindelius\JWT\Exception\JwtException;
use Lindelius\JWT\Tests\JWT\LeewayJWT;
use PHPUnit\Framework\TestCase;

final class IatClaimTest extends TestCase
{
    /**
     * @return void
     * @throws JwtException
     */
    public function testDecodeWithIatWithinLeewayTime(): void
    {
        $jwt = LeewayJWT::create(LeewayJWT::HS256);
        $jwt->setClaim('iat', time() + 30);

        $decodedJwt = LeewayJWT::decode($jwt->encode('my_key'));
        $decodedJwt->verify('my_key');

        $this->assertInstanceOf(LeewayJWT::class, $decodedJwt);
    }

    /**
     * @return void
     * @throws JwtException
     */
    public function testDecodeWithIatOutsideOfLeewayTime(): void
    {
        $this->expectException(BeforeValidException::class);

        $jwt = LeewayJWT::create(LeewayJWT::HS256);
        $jwt->setClaim('iat', time() + 100);

        $decodedJwt = LeewayJWT::decode($jwt->encode('my_key'));
        $decodedJwt->verify('my_key');
    }
}
