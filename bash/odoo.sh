#!/usr/bin/env bash

sudo su - postgres -c "createuser -s $USER"

# Install Odoo
echo -e "\n---- Install Odoo ----"

cd /home/vagrant

echo -e "\n---- Git clone ----"
pwd
git clone https://github.com/odoo/odoo.git --depth 1 -b 8.0 --single-branch
cd odoo

echo -e "\n---- Install requirements ----"
sudo pip install -r requirements.txt

echo -e "\n---- Install requirements ----"
python odoo.py setup_deps -y
python odoo.py setup_pg
python odoo.py --save --addons-path=/home/vagrant --stop-after-init --auto-reload