<?php

if (!function_exists('generateQrSvg')) {
    /**
     * Generate a QR code SVG string using bacon/bacon-qr-code v3.
     * No external image extension required (SVG backend).
     *
     * @param  string  $text   The content to encode
     * @param  int     $size   Size in pixels
     * @param  int     $margin Margin in modules (default 0)
     * @return string  Raw SVG markup
     */
    function generateQrSvg(string $text, int $size = 80, int $margin = 0): string
    {
        $renderer = new \BaconQrCode\Renderer\ImageRenderer(
            new \BaconQrCode\Renderer\RendererStyle\RendererStyle($size, $margin),
            new \BaconQrCode\Renderer\Image\SvgImageBackEnd()
        );

        $writer = new \BaconQrCode\Writer($renderer);
        return $writer->writeString($text);
    }
}
