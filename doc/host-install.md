# Howto install needed basics on the host machine

### Basic packages
```
sudo apt install git htop zsh
```

### Install Oh My Zsh
```
sh -c "$(curl -fsSL https://raw.githubusercontent.com/robbyrussell/oh-my-zsh/master/tools/install.sh)"
```

### Basic LXC packages
```
sudo apt install lxc lxc-templates wget bridge-utils
```

### Install honukai theme for zsh
``` 
cd ~/.oh-my-zsh/themes/
wget https://raw.githubusercontent.com/oskarkrawczyk/honukai-iterm-zsh/master/honukai.zsh-theme
```

### Install tweaked oh-my-zsh config
```
cd ~
wget https://raw.githubusercontent.com/oskarkrawczyk/honukai-iterm-zsh/master/honukai.zsh-theme
```