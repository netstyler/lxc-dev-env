#!/usr/bin/perl

$config = {};

$config->{'lxc'}{'base_image'} = 'ubuntu-16';

$config->{'lxc'}{'bridge'} = 'lxcbr0';
$config->{'lxc'}{'addr'} = '172.16.0.1';
$config->{'lxc'}{'netmask'} = '255.255.255.0';
$config->{'lxc'}{'network'} = '172.16.0.0/24';

$config->{'lxc'}{'vm'}{'wa-lb-00'}{'ip'} = '172.16.0.10';
$config->{'lxc'}{'vm'}{'wa-lb-00'}{'roles'} = 'wa,loadbalancer';

$config->{'lxc'}{'vm'}{'wa-session-00'}{'ip'} = '172.16.0.11';
$config->{'lxc'}{'vm'}{'wa-session-00'}{'roles'} = 'wa,redis,wa-session';

$config->{'lxc'}{'vm'}{'wa-cache-00'}{'ip'} = '172.16.0.12';
$config->{'lxc'}{'vm'}{'wa-cache-00'}{'roles'} = 'wa,redis,wa-cache';

$config->{'lxc'}{'vm'}{'wa-db-master'}{'ip'} = '172.16.0.13';
$config->{'lxc'}{'vm'}{'wa-db-master'}{'roles'} = 'wa,db,db-master';


$config->{'lxc'}{'vm'}{'wa-search-00'}{'ip'} = '172.16.0.14';
$config->{'lxc'}{'vm'}{'wa-search-00'}{'roles'} = 'wa,elasticsearch';

$config->{'lxc'}{'vm'}{'wa-app-00'}{'ip'} = '172.16.0.15';
$config->{'lxc'}{'vm'}{'wa-app-00'}{'roles'} = 'wa,wa-app';

$config->{'lxc'}{'vm'}{'wa-mailhog'}{'ip'} = '172.16.0.16';
$config->{'lxc'}{'vm'}{'wa-mailhog'}{'roles'} = 'wa,mailhog';





1;
