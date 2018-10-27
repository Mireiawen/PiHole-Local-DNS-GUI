
# PiHole local DNS GUI
I was tired of logging into the console to edit the lan.list file when i added new records so i added a basic editor to the GUI. This is a frist stab at it and while its fully functional there is no error checking or anything fancy. If there is enough interest i'll make it more record based and add error checking. The other solution i keep reading is to use PiHole as my DHCP server and assign out addresses that way but for my environment that doesn't work out. Also once the new UI comes out i will have to update this to be compatible with it.

Prereq: Make sure you have PiHole setup to serve local DNS:

https://discourse.pi-hole.net/t/howto-using-pi-hole-as-lan-dns-server/533

## Installation
### Automatic
1. Copy the contents of the repository to your PiHole
2. Run `install.sh`

### Manual
1. Configure PiHole to serve local DNS: https://discourse.pi-hole.net/t/howto-using-pi-hole-as-lan-dns-server/533
2. Make sure the PiHole user has access to read and write the `/etc/pihole/lan.list`
3. Copy the `local_dns.php` into your `webroot/admin` -folder
4. Edit the `webroot/admin/scripts/pi-hole/php/header.php` to include the `entry.php`, good position is for example before the *Logout* -button

### Docker
There is ready-made Docker image [mireiawen/pihole](https://hub.docker.com/r/mireiawen/pihole/) that build on the official PiHole Docker image and adds the GUI

## Using
After installing, refresh the GUI and the navigation bar should have option to *Manage Local DNS*. The GUI is relatively simple, just showing the editbox with the current contents of the `lan.list` file allowing to edit and save it. Once done with the modifications you need to Restart the dnsmasq service from *Settings* -> *System* -> *Restart dnsmasq*.

The format of the file is:
> IP FQDN Shortname

For example
> 10.0.0.1 myrouter.mydomain.local myrouter

If you enter things incorrectly the service might not restart.
