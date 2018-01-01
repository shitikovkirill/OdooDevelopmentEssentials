Vagrant.configure("2") do |config|
  config.vm.box = "debian/jessie64"

  config.vm.provision :shell, path: "bash/bootstrap.sh"
  config.vm.provision :shell, privileged: false, path: "bash/odoo.sh"
  config.vm.provision :shell, privileged: false, path: "bash/run.sh", run: "always"

  config.vm.network :forwarded_port, guest: 8069, host: 8069

end
