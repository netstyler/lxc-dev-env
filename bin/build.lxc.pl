#!/usr/bin/perl

BEGIN {
        use FindBin;
        push @INC, $FindBin::Dir . '/../conf';
        push @INC, $FindBin::Dir . '/../lib';
        require 'lxcde.conf.pl';
}

my $pwuid = getpwuid( $< );
if ($pwuid  ne 'root' ) {
	die("Please run this script as sudo");
}

use Data::Dumper;
# print Dumper($config);
$vm = $ARGV[0];

if (!$vm){
	print "Please provide the vm name\n\n";
	print "Possible vm names as defined in the config:\n\n";
	print join ("\n", keys $config->{'lxc'}{'vm'});
	print "\n";
	exit;
} 


$vm_config = $config->{'lxc'}{'vm'}{$vm};
if (!$vm_config){
	die("Could not find any info about this vm\n\n");
}

$ip = $vm_config->{'ip'};
$base_dir = "/var/lib/lxc";



$config_dir = "$base_dir/$hostname/$vm";
$config_file = "$config_dir/config";
$vm_dir = "$base_dir/$vm";
$root_fs = "$vm_dir/rootfs";
$template_name = $config->{'lxc'}{'base_image'};
$template_directory = "$base_dir/$template_name";


if (-f $config_file){
	
	print "The config for this vm already exists.\n\n
	Do you want me to rebuild this machine?\n
	Type yes if you want me to: \n";
	my $input = <STDIN>;
	chomp $input;
	if ($input ne 'yes'){
		print "You typed: $input\n";
		die("Quitting now\n");
	}
	
}


$data = join ("", <DATA>);
$data =~ s/%name%/$vm/g;
$data =~ s/%ip%/$ip/g;


$roles = $vm_config->{'roles'};

@roles = split(/\s*,\s*/, $roles);
foreach(@roles){
	push @consul_roles, $_;
}
print Dumper(\@consul_roles);
open "F", ">/tmp/$vm.consul.roles";
print F join "\n", @consul_roles;
close("F");



# print Dumper(\@roles);

open "F", ">/tmp/$vm.config";
print F $data;
close("F");

@cmd=();
# stop the template container if its already running
push @cmd, "lxc-stop -n  $template_name";

if(-d $vm_dir) {
	push @cmd, "lxc-stop -n $vm";
	push @cmd, "lxc-destroy -n $vm";
}


# push @cmd, "lxc-clone -o $template_name -n $vm";
push @cmd, "mkdir -p $vm_dir";
push @cmd, "mkdir -p $config_dir";

push @cmd, "rm -rf $vm_dir/rootfs";
push @cmd, "rsync  -a $template_directory/rootfs $vm_dir/";
push @cmd, "echo $vm > $vm_dir/rootfs/etc/hostname";
push @cmd, "mkdir -p $vm_dir/rootfs/opt/wa-network";
push @cmd, "cp /tmp/$vm.config $config_file";
push @cmd, "cp /tmp/$vm.consul.roles $root_fs/etc/consul.roles";
push @cmd, "lxc-start -d -n $vm";


foreach(@cmd){
	print "$_\n";
	system ($_);
}








__END__

# Template used to create this container: /usr/share/lxc/templates/lxc-download
# Parameters passed to the template:
# For additional config options, please look at lxc.container.conf(5)

# Distribution configuration
lxc.include = /usr/share/lxc/config/ubuntu.common.conf
lxc.arch = x86_64

# Container specific configuration
lxc.rootfs = /var/lib/lxc/%name%/rootfs
lxc.utsname = %name%
lxc.aa_profile = unconfined


# Network configuration
lxc.network.type=veth
lxc.network.link=lxcbr0
lxc.network.flags=up
lxc.network.ipv4 = %ip%/24
lxc.network.ipv4.gateway = 172.16.0.1


lxc.mount.entry = /home home none bind,rw 0 0
lxc.mount.entry = /mnt/projects mnt/projects none bind,rw 0 0
lxc.mount.entry = /mnt/projects/PSA/wa-network opt/wa-network none bind,ro 0 0

lxc.start.auto = 1
