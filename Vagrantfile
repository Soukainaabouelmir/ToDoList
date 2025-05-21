Vagrant.configure("2") do |config|
  # VM Jenkins
  config.vm.define "jenkins" do |jenkins|
    jenkins.vm.box = "ubuntu/focal64"
    jenkins.vm.hostname = "jenkins.local"
    jenkins.vm.network "private_network", ip: "192.168.56.10"
    jenkins.vm.provider "virtualbox" do |vb|
      vb.memory = "2048"
    end
     end

  # VM Kubernetes
  config.vm.define "k8s" do |k8s|
    k8s.vm.box = "ubuntu/focal64"
    k8s.vm.hostname = "k8s.local"
    k8s.vm.network "private_network", ip: "192.168.56.11"
    k8s.vm.provider "virtualbox" do |vb|
      vb.memory = "4096"
    end
    k8s.vm.provision "ansible" do |ansible|
      ansible.playbook = "provision/k8s_playbook.yml"
    end
  end
end
