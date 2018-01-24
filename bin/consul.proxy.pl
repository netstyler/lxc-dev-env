#!/usr/bin/perl

BEGIN {
        use FindBin;
        push @INC, $FindBin::Dir . '/../conf';
        push @INC, $FindBin::Dir . '/../lib';
        require 'lxcde.conf.pl';
}

our $consul_directory = '/Users/aghaffar/www/wa-network/projects/consul_manager';
require "$consul_directory/lib/common.pl";
our $consul_directory = '/Users/aghaffar/www/wa-network/projects/consul_manager';


@x = getRoleNames();
print Dumper(\@x);