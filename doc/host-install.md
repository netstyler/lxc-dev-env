# Howto install needed basics on the host machine

## Add user to sudoers
```
nano /etc/sudoers
falk ALL=(root:root) NOPASSWD: ALL
```

## Basic packages
```
sudo apt install curl git unzip htop tmux zsh software-properties-common build-essential
```

## Setup Oh My Zsh
```
sh -c "$(curl -fsSL https://raw.githubusercontent.com/robbyrussell/oh-my-zsh/master/tools/install.sh)"
```

#### Install honukai theme for zsh
``` 
cd ~/.oh-my-zsh/themes/
wget https://raw.githubusercontent.com/oskarkrawczyk/honukai-iterm-zsh/master/honukai.zsh-theme
```

#### Install tweaked oh-my-zsh config
```
cd ~
wget https://raw.githubusercontent.com/netstyler/lxc-dev-env/master/doc/templates/host/oh-my-zsh/.zshrc
```

If done restart the terminal to get the changes affected.

## Create basic projects setup for W-A

### Create projects folder
```
mkdir ~/projects 
```

### clone wa3 project
** NOTE: Install personal ssh keys first**
```
git clone git@github.com:World-Architects/WA3.git  ~/projects/WA3
``` 

### Install needed host packages for php/nodejs/es6 development

#### PHP SETUP
```
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install php7.2-cli php7.2-mysql php7.2-intl php7.2-curl php7.2-gd php7.2-json php-imagick php7.2-mbstring php7.2-zip php7.2-xml php-redis php7.2-sqlite3
sudo apt install composer php-codesniffer phpunit
```

#### NODE JS SETUP
```
curl -sL https://deb.nodesource.com/setup_8.x | sudo -E bash -
sudo apt install nodejs
sudo npm install -g yarn
```

## Install HeidiSql

```
sudo apt install wine
```

[Download](http://www.heidisql.com/download.php) HeidSql installer

Open the installer for HeidiSQL with Wine and follow the steps to install the application.


## Setup LXC
Goal is to have a development env within lxc containers.
But the Projects files should be normal be available on the host.
This allows to make code changes on the host and reflect them on the lxc machine foreach project. 

### Basic LXC packages
```
sudo apt install lxc lxc-templates wget bridge-utils
```


## Software to download and install
- [phpstorm](https://www.jetbrains.com/phpstorm/) 
- [gitraken](https://www.gitkraken.com/download)
- [skype](https://www.skype.com/de/get-skype/)
- [Visual Studio Code](https://code.visualstudio.com/Download)
- [VLC](https://www.videolan.org/vlc/download-ubuntu.html)
- [Chrome](https://www.google.de/chrome/browser/desktop/index.html)
- [MailSpring](https://getmailspring.com/) ** only if thunderbird is not fine ;)
- [WunderList](https://github.com/edipox/wunderlistux/releases)

## Software we can search in the Gui App Manager
- shutter (awesome screenshot tool with dropbox sharing)
- slack
- filezilla

## Software apt install

#### peek - screen recorder
```
sudo add-apt-repository ppa:peek-developers/stable
sudo apt update
sudo apt install peek
```

#### enpass.io Password Manager
```
sudo echo "deb http://repo.sinew.in/ stable main" > /etc/apt/sources.list.d/enpass.list
sudo wget -O - https://dl.sinew.in/keys/enpass-linux.key | apt-key add -
sudo apt update
sudo apt install enpass
 ```
 
 #### docky osx like dock
```
sudo add-apt-repository ppa:ricotz/docky
sudo apt-get update
sudo apt-get install docky
 ```
 
#### redis-cli
 ```
 sudo apt install redis-tools
 ```
 
#### mysql-cli
 ```
sudo apt install mariadb-client
 ```

