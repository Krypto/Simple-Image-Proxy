# Simple-Image-Proxy

### get the code
git clone https://github.com/darkalchemy/Simple-Image-Proxy.git image-proxy

### set ownership
chown -R www-data:www-data image-proxy

### install dependancies
cd image-proxy

composer install

### set webroot to path image-proxy/public

### edit settings.php


## Usage

use Blocktrail\CryptoJSAES\CryptoJSAES;
$encrypte = CryptoJSAES::encrypt(url, key);
return 'http://image_proxy_url/image?' . base64_encode($encrypted . '&uid=' . uid);
