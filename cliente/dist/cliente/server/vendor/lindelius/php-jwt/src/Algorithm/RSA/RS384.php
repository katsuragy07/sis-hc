<?php

namespace Lindelius\JWT\Algorithm\RSA;

use Lindelius\JWT\Exception\InvalidKeyException;

/**
 * A trait for enabling support of the "RS384" algorithm.
 */
trait RS384
{
    /**
     * Encode given data using a given key.
     *
     * @param  mixed  $key
     * @param  string $dataToSign
     * @return string|null
     * @throws InvalidKeyException
     */
    protected function encodeWithRS384($key, string $dataToSign): ?string
    {
        if (!is_string($key) && !is_resource($key)) {
            throw new InvalidKeyException('Invalid key.');
        }

        $signature = null;

        openssl_sign($dataToSign, $signature, $key, 'SHA384');

        return $signature;
    }

    /**
     * Verify a given signature using a given key.
     *
     * @param  mixed  $key
     * @param  string $dataToSign
     * @param  string $signature
     * @return bool
     * @throws InvalidKeyException
     */
    protected function verifyWithRS384($key, string $dataToSign, string $signature): bool
    {
        if (!is_string($key) && !is_resource($key)) {
            throw new InvalidKeyException('Invalid key.');
        }

        return openssl_verify($dataToSign, $signature, $key, 'SHA384') === 1;
    }
}