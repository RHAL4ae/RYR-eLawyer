<?php

namespace RYReLawyer\Services;

use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class OCRService
{
    protected ?ImageAnnotatorClient $visionClient;

    public function __construct(?ImageAnnotatorClient $visionClient = null)
    {
        $this->visionClient = $visionClient;
    }

    /**
     * Perform OCR using either Tesseract or Google Vision.
     *
     * @param string $path Path to the file to scan
     * @return string Extracted text
     */
    public function extractText(string $path): string
    {
        if ($this->visionClient) {
            // Example using Google Vision
            $image = file_get_contents($path);
            $response = $this->visionClient->textDetection($image);
            $annotations = $response->getTextAnnotations();
            return $annotations[0]->getDescription();
        }

        // Fallback to Tesseract
        // Requires `tesseract` command to be installed
        $output = shell_exec("tesseract " . escapeshellarg($path) . " stdout 2>/dev/null");
        return trim($output ?? '');
    }
}
