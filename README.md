# Simple-Image-Proxy

### get the code
git clone https://github.com/darkalchemy/Simple-Image-Proxy.git image-proxy

### set ownership
chown -R www-data:www-data image-proxy

### install dependancies
cd image-proxy

composer install

npm install

### set webroot to path image-proxy/public

### copy .env.sample to .env
cp .env.sample .env

### edit .env and supply the key used to encrypt
