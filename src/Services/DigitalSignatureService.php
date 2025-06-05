<?php

namespace RYReLawyer\Services;

use RobRichards\XMLSecLibs\XMLSecurityDSig;
use RobRichards\XMLSecLibs\XMLSecurityKey;

class DigitalSignatureService
{
    /**
     * Sign the given XML document with XAdES/XMLSign approach.
     *
     * @param string $xmlPath Path to the XML file
     * @param string $privateKeyPath Path to the signing key
     * @param string $certPath Path to the certificate
     * @return string Signed XML
     */
    public function signXml(string $xmlPath, string $privateKeyPath, string $certPath): string
    {
        $doc = new \DOMDocument();
        $doc->load($xmlPath);

        $objDSig = new XMLSecurityDSig();
        $objDSig->setCanonicalMethod(XMLSecurityDSig::EXC_C14N);
        $objDSig->addReference(
            $doc,
            XMLSecurityDSig::SHA256,
            ['http://www.w3.org/2000/09/xmldsig#enveloped-signature']
        );

        $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA256, ['type' => 'private']);
        $objKey->loadKey($privateKeyPath, true);

        $objDSig->sign($objKey);
        $objDSig->add509Cert(file_get_contents($certPath));
        $objDSig->appendSignature($doc->documentElement);

        return $doc->saveXML();
    }
}
