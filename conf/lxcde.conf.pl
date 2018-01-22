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





1;
