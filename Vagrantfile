VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "ubuntu/trusty64"

  config.vm.hostname = "php-assert"

  config.vm.network "private_network", ip: "192.168.100.127"

  config.vm.synced_folder "./", "/home/vagrant/work"

  config.vm.provider "virtualbox" do |vb|
    vb.customize ["modifyvm", :id, "--memory", "1024"]
  end

  config.vm.provision "shell", path: ".provision/init.sh"
end
