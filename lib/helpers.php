<?php
$basePath = '/pbl'; 

if (!function_exists('h')) {
    function h($value) {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('assetUrl')) {
    function assetUrl(?string $src): string {
        global $basePath;
        
        if (empty($src)) {
            return 'https://placehold.co/600x400?text=No+Image'; 
        }

        if (preg_match('~^(https?:)?//~', $src)) {
            return $src;
        }

        $src = trim($src);

        if (strpos($src, 'assets/') === false) {
            $src = 'assets/images/' . ltrim($src, '/'); 
        }

        return rtrim($basePath, '/') . '/' . ltrim($src, '/');
    }
}

if (!function_exists('mapImageList')) {
    function mapImageList(array $items, string $key = 'image'): array {
        foreach ($items as &$item) {
            if (isset($item[$key])) {
                $item[$key] = assetUrl($item[$key]);
            }
        }
        return $items;
    }
}
?>