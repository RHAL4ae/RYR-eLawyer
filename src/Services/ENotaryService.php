<?php

namespace RYReLawyer\Services;

class ENotaryService
{
    protected DigitalSignatureService $signer;
    protected BlockchainLogger $logger;

    public function __construct(DigitalSignatureService $signer, BlockchainLogger $logger)
    {
        $this->signer = $signer;
        $this->logger = $logger;
    }

    /**
     * Notarize a document by signing it and storing its hash on the blockchain.
     *
     * @param string $xmlPath
     * @param string $privateKey
     * @param string $certPath
     * @return string Signed XML
     */
    public function notarize(string $xmlPath, string $privateKey, string $certPath): string
    {
        $signedXml = $this->signer->signXml($xmlPath, $privateKey, $certPath);
        $hash = hash('sha256', $signedXml);
        $this->logger->logHash($hash);
        return $signedXml;
    }
}
