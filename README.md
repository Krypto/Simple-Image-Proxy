# Simple-Image-Proxy
The purpose of this image proxy is to reduce the exposure of the requesting sites url by using the image proxy to make the http request, store the image and return the http response. 


# How To:
#### get the code

```
git clone https://github.com/darkalchemy/Simple-Image-Proxy.git image-proxy
```

#### set ownership

```
chown -R www-data:www-data image-proxy
```

#### install dependancies

```
cd image-proxy
composer install
```

#### set webroot to path image-proxy/public

#### edit settings.php

```
replace the uid and key with values given to the requsting site. These values must match.
```


### Usage by the requsting site

##### add class with composer
```
composer require blocktrail/cryptojs-aes-php
```

#### use class in site
```
use Blocktrail\CryptoJSAES\CryptoJSAES;
```

#### to return image without modification

```
$encrypted = CryptoJSAES::encrypt($url, $key);
return 'http://image_proxy_url/image?' . base64_encode($encrypted . '&uid=' . uid);
```

#### to return image and resize the image
```
$encrypted = CryptoJSAES::encrypt("$url&width={$width}&height={$height}", $key);
return 'http://image_proxy_url/image?' . base64_encode($encrypted . '&uid=' . uid);
```
