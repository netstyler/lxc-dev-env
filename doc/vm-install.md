# Howto install a vm
all these commands should be run in projects/lxc-dev-env

sudo perl bin/build.lxc.vm.pl

the vm should exist in conf/lxcde.conf.pl

once the vm is installed

sudo lxc-attach -n vm-name

perl /opt/wa-network/projects/consul_manager/bin/provision.host.pl

reboot (twice, first to setup, second to install the templates and start the services)