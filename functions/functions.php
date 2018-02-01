<?php

require_once ROOT_DIR . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use Intervention\Image\ImageManager;
use Blocktrail\CryptoJSAES\CryptoJSAES;
use Spatie\ImageOptimizer\OptimizerChainFactory;

$dotenv = new Dotenv\Dotenv(ROOT_DIR);
$dotenv->load();

/**
 * @param $img_string
 *
 * @return mixed|null
 */
function decrypt_url($img_string)
{
    $manager = new ImageManager();
    $passphrase = $_ENV['KEY'];
    $url = CryptoJSAES::decrypt(base64_decode($img_string), $passphrase);

    $pieces = parse_url($url);
    parse_str($pieces['query'], $query);
    $width = isset($query['width']) ? $query['width'] : '';
    $height = isset($query['height']) ? $query['height'] : '';

    unset($query['width'], $query['height'], $pieces['scheme'], $pieces['query']);
    $pieces = implode('', $pieces) . '?' . http_build_query($query);

    if (!empty($pieces)) {
        $hash = hash('sha512', $pieces);
        $path = ROOT_DIR . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $hash;
        if (file_exists($path)) {
            if (!empty($width) && !empty($height)) {
                $image = $manager->make($path)->resize($width, $height);
            } else {
                $image = $manager->make($path);
            }
            return $image->response();
        } elseif (file_put_contents($path, file_get_contents($url))) {
            optimize($path);
            if (!empty($width) && !empty($height)) {
                $image = $manager->make($path)->resize($width, $height);
            } else {
                $image = $manager->make($path);
            }
            return $image->response();
        }
    }
    return null;
}

/**
 * @param $path
 */
function optimize($path)
{
    $optimizerChain = OptimizerChainFactory::create();
    $optimizerChain->optimize($path);
}
