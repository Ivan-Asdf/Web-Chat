if [[ $(/usr/bin/id -u) -ne 0 ]]; then
	    echo "Not running as root"
	        exit
fi
cd $(dirname $0)
# Backend setup
apt install nginx php-fpm
cp nginx.conf /etc/nginx/nginx.conf
systemctl enable nginx php-fpm
systemctl restart nginx
systemctl start php-fpm

cd ..
cp ubuntu_setup/backend.env backend/src/.env
rm -rf /var/www/html/*
cp -r backend/* /var/www/html/
apt install php-curl php-sqlite3 composer
composer install -d/var/www/html
chown -R www-data /var/www/html
chgrp -R www-data /var/www/html

# Frontend setup
cp ubuntu_setup/frontend.env frontend/.env
apt install npm
cd frontend
npm ci
npm run build
npm install -g serve
serve -s build -p 80 &

