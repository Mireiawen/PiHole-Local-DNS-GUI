#!/bin/bash
set -e

# Verify the directory
ADMIN_DIR="${ADMIN_DIR:-"/var/www/html/admin"}"
if [ ! -d "${ADMIN_DIR}" ]
then
	echo "Directory ${ADMIN_DIR} was not found" >&2
	exit 1
fi

# Create the directories, just in case
mkdir --parents \
	'/etc/pihole' \
	'/etc/dnsmasq.d'

# Create the file for local DNS
if [ ! -f '/etc/pihole/lan.list' ]
then
	echo "127.0.0.1 pihole.local pihole" >'/etc/pihole/lan.list'
fi

# Create the configuration file
echo 'add-hosts=/etc/pihole/lan.list' >'/etc/dnsmasq.d/02-lan.conf'

# Copy the local DNS panel page
cp "local_dns.php" "${ADMIN_DIR}/local_dns.php"

# Update the menu header
sed -i $'/<!-- Logout -->/{e cat entry.php\n}' "${ADMIN_DIR}/scripts/pi-hole/php/header.php"
