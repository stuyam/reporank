# Repo Rank
### GitHub respository rank badge

[![GitHub Rank](http://reporank.com/yamartino/reporank)](http://reporank.com)

##Setup
###Install Homestead

-Consult https://laravel.com/docs/5.2/homestead for help

1. Install Virtual Box https://www.virtualbox.org/wiki/Downloads
2. Install Vagrant https://www.vagrantup.com/downloads.html
3. Run the command ```vagrant box add laravel/homestead``` Enter Option "1" when asked in the setup.
4. Run this command in a seperate folder OUTSIDE of this repo to install Homestead on your computer ```git clone https://github.com/laravel/homestead.git Homestead```
5. "cd" into the Homestead folder and run ```bash init.sh```
6. Run ```sudo nano ~/.homestead/Homestead.yaml```
7. Set the "folder - map:" to the folder where you store all of your code or Laravel projects.
8. Set the "sites - map:" to the domain you want to test it on localy. I set mine to dev.app because it is short.
9. Set the "site - to:" to the folder containing this Laravel app.

Example:
```
  folders:
    - map: ~/Documents/Code
      to: /home/vagrant/Code
```
```
  sites:
    - map: dev.app
      to: /home/vagrant/Code/Laravel/reporank/public
```

10. Run ```sudo nano /etc/hosts```
11. Set ```192.168.10.10  dev.app``` in the hosts file
12. Run the ```vagrant up command``` from your Homestead directory
12. Go to http://dev.app or what you set in your hosts

IF you get an error like: No such file or directory @ rb_sysopen - /Users/name/.ssh/id_rsa (Errno::ENOENT)
Run the following
1)```cd ~ ; mkdir .ssh ; cd .ssh```
2)```ssh-keygen -b 1024 -t rsa -f id_rsa -P ""```
Then try running ```vagrant up``` again
