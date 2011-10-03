# urler.pl
# Url logging and publishing script for irssi
# Copyright 2011 (c) Tuomas Starck

use strict;
use warnings;

use encoding qw(utf8);
use vars qw($VERSION %IRSSI);

use Irssi;
use POSIX;
use URI::Find;
use URI::Escape;
use LWP::Simple;

$VERSION = "0.9";

%IRSSI = (
	authors		=> 'Tuomas Starck',
	contact		=> 'dev@starck.fi',
	name		=> 'urler',
	license		=> 'WTFPLv2',
	description	=> 'Find and log urls'
);

my $base = "http://tljstarc.users.cs.helsinki.fi/urler/?url=%s&nick=%s&chan=%s";

sub forkget($$$) {
	my ($chan, $data, $nick) = @_;

	my $pid = fork();

	if ($pid) {
		Irssi::pidwait_add($pid);
		return;
	}
	else {
		my @all;

		my $finder = URI::Find->new(sub {
			my ($uri) = shift;
			push @all, $uri;
		});

		$finder->find(\$data);

		POSIX::_exit(0) unless (@all);

		for my $uri (@all) {
			get(
				sprintf(
					$base,
					uri_escape($uri),
					uri_escape($nick),
					uri_escape($chan)
				)
			);
		}

		POSIX::_exit(0);
	}
}

sub parsepublic($$$$$) {
	my ($server, $data, $nick, $mask, $target) = @_;
	forkget($target, $data, $nick);
}

sub parseprivate($$$$) {
	my ($server, $data, $nick, $address) = @_;
	forkget($server->{'nick'}, $data, $nick);
}

Irssi::signal_add_last('message public', 'parsepublic');
Irssi::signal_add_last('message private', 'parseprivate');

Irssi::print("urler $VERSION");

#EOF
