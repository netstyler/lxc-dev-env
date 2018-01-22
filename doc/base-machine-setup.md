# Intro
Here is the setup for creating this VM. (It should not be needed unless a change needs to be done on the base vm)

# Network
Assuming that the network for the VMs is 172.16.0.0/24

The first IP would be used by the host machine's bridge: lxcbr0. ( 172.16.0.1 )
The last IP will be used by the base-template ( 172.16.0.254 )



# Create an ubuntu template
    lxc-create --name ubuntu-16 -t download

> Distribution: ubuntu
> Release: xenial
> Architecture: amd64

## Start the base vm once it has been installed
> lxc-start -d -n ubuntu-16


# copy the users and groups from the host
> cp -av /etc/passwd* /etc/shadow* /etc/group* /etc/gshadow* /var/lib/lxc/ubuntu-16/rootfs/etc/


## Attach a console to this vm (note the VM has no password and none is needed)
> lxc-attach -n ubuntu-16

## Check if the users are present. 
> cat /etc/passwd
> id (Your user) 


# Remove resolvconf
> apt-get remove --purge resolvconf
> rm /etc/resolv.conf

## setup resolver
> echo nameserver 8.8.8.8 > /etc/resolv.conf

## Get some packages
> apt-get update

> apt-get dist-upgrade

> apt install -y nfs-common sudo rsync libwww-perl curl git



## Shutdown the VM
> shutdown -h now

     # BASE VM Config
     # Template used to create this container: /usr/share/lxc/templates/lxc-download
     # Parameters passed to the template:
     # For additional config options, please look at lxc.container.conf(5)

     # Distribution configuration
     lxc.include = /usr/share/lxc/config/ubuntu.common.conf
     lxc.arch = x86_64

     # Container specific configuration. 
     # Make sure that this folder is synced with other hosts
     lxc.rootfs = /var/lib/lxc/ubuntu-16/rootfs
     lxc.utsname = ubuntu-16
     lxc.aa_profile = unconfined

     # Network configuration
     lxc.network.type=veth
     lxc.network.link=vmbr0
     lxc.network.flags=up

     lxc.network.ipv4 = 172.16.0.254/24
     lxc.network.ipv4.gateway = 172.16.0.1

     # Mount the /home from the host filesystem in read-write mode
     lxc.mount.entry = /home /var/lib/lxc/ubuntu-16/rootfs/home none bind,rw 0 0

## Restart and reattach to the base image

