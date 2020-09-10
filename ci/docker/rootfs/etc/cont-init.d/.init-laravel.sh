#!/usr/bin/with-contenv bash

source /root/.bashrc
echo -e "${BLUE}--- Caching Laravel configuration ---${NC}"

### Update config and routes cache
php artisan cache:clear
