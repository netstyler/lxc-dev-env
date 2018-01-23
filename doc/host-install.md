# Howto install needed basics on the host machine

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
```
git clone git@github.com:World-Architects/WA3.git  ~/projects/WA3
``` 

### Install needed host packages for php/nodejs/es6 development

#### PHP SETUP
```
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install php7.2-cli php7.2-mysql php7.2-intl php7.2-curl php7.2-gd php7.2-json php7.2-imagick php7.2-mbstring php7.2-zip php7.2-mcrypt php7.2-xml php7.2-redis php7.2-sqlite3
sudo apt install composer php-code-sniffer phpunit php-cs-fixer
```

#### NODE JS SETUP
```
curl -sL https://deb.nodesource.com/setup_8.x | sudo -E bash -
sudo apt update
sudo apt install nodejs
```

## Setup LXC
Goal is to have a development env within lxc containers.
But the Projects files should be normal be available on the host.
This allows to make code changes on the host and reflect them on the lxc machine foreach project. 

## Basic LXC packages
```
sudo apt install lxc lxc-templates wget bridge-utils
```
