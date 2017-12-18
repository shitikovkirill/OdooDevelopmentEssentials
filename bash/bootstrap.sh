#!/usr/bin/env bash
# Install system updates
echo -e "\n---- Install system updates ----"
apt-get update && apt-get upgrade -y
apt-get -y install sudo # Make sure 'sudo' is installed

file = "/home/vagrant/addons"
if [ -f "$file" ]
    then
	    echo "File $file exist. Link was not created."
    else
	    echo "File $file not found. Link was created."
	    ln -s /vagrant $file
fi

# Install PostgreSQL Server
echo -e "\n---- Install PostgreSQL Server ----"
apt-get -y install postgresql postgresql-contrib

# Install PIP
echo -e "\n---- Install PIP ----"
apt-get -y install python-pip

# python ./odoo/odoo.py
# sudo vi /etc/postgresql/9.*/main/pg_hba.conf
# add$ local     all    odoo     trust

# Install Git
echo -e "\n---- Install Git ----"
apt-get -y install git

# Install nodejs, npm
echo -e "\n---- Install nodejs, npm ----"
wget -qO- https://deb.nodesource.com/setup | bash -
apt-get install -y nodejs
apt-get install -y npm
ln -s /usr/bin/nodejs /usr/bin/node
npm install -g less less-plugin-clean-css

id -u odoo &>/dev/null || useradd -m -g sudo -s /bin/bash odoo -p odoo
