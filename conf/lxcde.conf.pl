#!/usr/bin/perl

$config = {};

$config->{'lxc'}{'base_image'} = 'ubuntu-16';

$config->{'lxc'}{'bridge'} = 'lxcbr0';
$config->{'lxc'}{'addr'} = '172.16.0.1';
$config->{'lxc'}{'netmask'} = '255.255.255.0';
$config->{'lxc'}{'network'} = '172.16.0.0/24';

$config->{'lxc'}{'vm'}{'wa-dev-consul'}{'ip'} = '172.16.0.2';
$config->{'lxc'}{'vm'}{'wa-dev-consul'}{'roles'} = 'wa';

$config->{'lxc'}{'vm'}{'wa-dev-sys'}{'ip'} = '172.16.0.3';
$config->{'lxc'}{'vm'}{'wa-dev-sys'}{'roles'} = 'wa';

$config->{'lxc'}{'vm'}{'wa-dev-mailhog'}{'ip'} = '172.16.0.4';
$config->{'lxc'}{'vm'}{'wa-dev-mailhog'}{'roles'} = 'wa,mailhog';

$config->{'lxc'}{'vm'}{'wa-dev-redis'}{'ip'} = '172.16.0.5';
$config->{'lxc'}{'vm'}{'wa-dev-redis'}{'roles'} = 'wa,redis';

$config->{'lxc'}{'vm'}{'wa-dev-mysql'}{'ip'} = '172.16.0.10';
$config->{'lxc'}{'vm'}{'wa-dev-mysql'}{'roles'} = 'wa,db,db-master';

$config->{'lxc'}{'vm'}{'wa-dev-elastic'}{'ip'} = '172.16.0.12';
$config->{'lxc'}{'vm'}{'wa-dev-elastic'}{'roles'} = 'wa,elasticsearch';

$config->{'lxc'}{'vm'}{'wa-dev-elastic'}{'ip'} = '172.16.0.12';
$config->{'lxc'}{'vm'}{'wa-dev-elastic'}{'roles'} = 'wa,cerebro'

$config->{'lxc'}{'vm'}{'wa-dev-wa-app'}{'ip'} = '172.16.0.15';
$config->{'lxc'}{'vm'}{'wa-dev-wa-app'}{'roles'} = 'wa,wa-app';

$config->{'lxc'}{'vm'}{'wa-dev-wa-app-admin'}{'ip'} = '172.16.0.16';
$config->{'lxc'}{'vm'}{'wa-dev-wa-app-admin'}{'roles'} = 'wa,wa-app';

$config->{'lxc'}{'vm'}{'wa-dev-fr-test'}{'ip'} = '172.16.0.20';
$config->{'lxc'}{'vm'}{'wa-dev-fr-test'}{'roles'} = 'wa';

$config->{'lxc'}{'vm'}{'wa-dev-ag-test'}{'ip'} = '172.16.0.21';
$config->{'lxc'}{'vm'}{'wa-dev-ag-test'}{'roles'} = 'wa';






1;
