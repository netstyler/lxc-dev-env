#!/usr/bin/perl

$config = {};

$config->{'lxc'}{'base_image'} = 'ubuntu-16';

$config->{'lxc'}{'bridge'} = 'lxcbr0';
$config->{'lxc'}{'addr'} = '172.16.0.1';
$config->{'lxc'}{'netmask'} = '255.255.255.0';
$config->{'lxc'}{'network'} = '172.16.0.0/24';

$config->{'lxc'}{'vm'}{'wa-dev-consul'}{'ip'} = '172.16.0.2';
$config->{'lxc'}{'vm'}{'wa-dev-consul'}{'roles'} = 'wa';

$config->{'lxc'}{'vm'}{'wa-dev-lb'}{'ip'} = '172.16.0.10';
$config->{'lxc'}{'vm'}{'wa-dev-lb'}{'roles'} = 'wa,loadbalancer';

$config->{'lxc'}{'vm'}{'wa-dev-session'}{'ip'} = '172.16.0.11';
$config->{'lxc'}{'vm'}{'wa-dev-session'}{'roles'} = 'wa,redis,wa-session';

$config->{'lxc'}{'vm'}{'wa-dev-cache'}{'ip'} = '172.16.0.12';
$config->{'lxc'}{'vm'}{'wa-dev-cache'}{'roles'} = 'wa,redis,wa-cache';

$config->{'lxc'}{'vm'}{'wa-dev-mysql'}{'ip'} = '172.16.0.13';
$config->{'lxc'}{'vm'}{'wa-dev-mysql'}{'roles'} = 'wa,db,db-master';


$config->{'lxc'}{'vm'}{'wa-dev-search'}{'ip'} = '172.16.0.14';
$config->{'lxc'}{'vm'}{'wa-dev-search'}{'roles'} = 'wa,elasticsearch';

$config->{'lxc'}{'vm'}{'wa-dev-app'}{'ip'} = '172.16.0.15';
$config->{'lxc'}{'vm'}{'wa-dev-app'}{'roles'} = 'wa,wa-app';

$config->{'lxc'}{'vm'}{'wa-dev-mailhog'}{'ip'} = '172.16.0.16';
$config->{'lxc'}{'vm'}{'wa-dev-mailhog'}{'roles'} = 'wa,mailhog';





1;
