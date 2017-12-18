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

echo -e "\n---- Create config file ----"
cd 
cat <<EOF
[options]
addons_path = /home/vagrant/odoo/openerp/addons,/home/vagrant/odoo/addons,/vagrant
admin_passwd = admin
auto_reload = True
EOF > .openerp_serverrc

echo -e "\n---- For finish install run this comands ----"
echo "python odoo.py setup_deps"
echo "python odoo.py setup_pg"
echo 'python odoo.py --save --addons-path="./openerp/addons,./addons,/vagrant" --stop-after-init --auto-reload'