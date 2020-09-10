FROM node:12-alpine as static-builder

# Add static sources, JS packages & versions lock file
ADD package.json yarn.lock /build/
WORKDIR /build

# 1. Install native packages, required to build NPM packages
# 2. Install NPM packages
# 3. Remove unnecessary native packages
# 4. Caches clean up
RUN apk add --no-cache --virtual .build-deps \
    git python g++ make file nasm autoconf zlib-dev &&\
    yarn install --non-interactive &&\
    apk del .build-deps &&\
    rm -rf /var/cache/apk/* &&\
    rm -rf /tmp/* &&\
    rm -rf /usr/local/share/.cache/yarn

ADD webpack.mix.js artisan .eslintrc.js .*rc ./
ADD public public/
ADD resources/ resources/
ADD docs docs/

RUN npm run production &&\
    npx swagger-cli validate docs/API/index.yaml &&\
    npx swagger-cli bundle --type yaml --outfile docs/API/api.yaml docs/API/index.yaml


FROM vinhvo:base

### Install composer dependencies
COPY composer.* ./
RUN php composer.phar global require --no-progress hirak/prestissimo
RUN php composer.phar install \
    --prefer-dist \
    --no-interaction \
    --no-progress \
    --no-suggest \
    --no-scripts \
    --no-autoloader &&\
    rm -rf ${COMPOSER_HOME}

### Copy application files
ADD ./ /home/www/app
COPY --from=static-builder /build/public public

### Optimize Composer autoloader
RUN php composer.phar install \
    --prefer-dist \
    --no-interaction \
    --no-progress \
    --no-suggest \
    --optimize-autoloader &&\
    php artisan config:cache &&\
    php artisan route:cache &&\
    php artisan api:cache &&\
    chown -R nginx:nginx storage
