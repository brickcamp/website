**BrickCamp** is a visual dictionary for LEGO`®` building techniques.

I envision it to be a timeless point of reference for this and other LEGO`®` related stuff.  
Currently, this project is still in beta stage.


## Foundation
> A dwarf standing on the shoulders of a giant may see farther than a giant himself. <br>
> _Bernard of Chartres_

BrickCamp is only possible because of some amazing projects and technologies out there. This project is based on:

- [Grav](https://getgrav.org/): An amazing flat-file open-source content management system.
- [Twig Templating](http://twig.sensiolabs.org/): An easy-to-learn templating engine used by Grav.
- [Markdown](https://en.wikipedia.org/wiki/Markdown): A simple markup language for formatting text
- [YAML](http://yaml.org/): One more markup language, this time for configuration and metadata.
- [LDraw](http://www.ldraw.org/): An open standard for LEGO`®` 3D modelling
- [MLCAD](http://mlcad.lm-software.com/): A CAD programm based on the LDraw standard
- [Rebrickable.com](https://rebrickable.com/): A LEGO`®` creations platform with open-accesible data/images.
- [GitLab](http://gitlab.com/): A source-code versioning platform with many additional tools

A huge thanks to each and every one of these projects and their supporting communities.  
_Legal Notice: LEGO`®` is a trademark of the LEGO Group which does not sponsor, authorize or endorse this site._

## License
> Life would be much easier if I had the source code. <br>
> _Unknown Author_

The **source code** of this project is released under the [MIT License](https://choosealicense.com/licenses/mit/), which can also be found in the LICENSE file.

The **content** (images, texts, ...) published on Brick.Camp (and stored in this repository) is licensed under the [Creative Commons Attribution ShareAlike 4.0 International license](https://choosealicense.com/licenses/cc-by-sa-4.0/). Excluded from this are all images / vector graphics concerning the BrickCamp logo, which currently remains under normal copyright.


## Local Setup
> I know what to do and I go and execute. <br>
> _Usain Bolt_

_Disclaimer: This setup is currently only tested with the admin user of this (and the connected) repositories. So you might run into trouble with following these steps currently._

1. [Download Grav](http://getgrav.org/downloads) from the https://getgrav.org site
2. Extract the ZIP archive into a directory in your webroot (e.g. `~/www/brick.camp/`)
3. Switch into the `user`-subfolder (e.g. `~/www/brick.camp/user/`) and run the following command:
`git clone --recurse-submodules https://gitlab.com/brick.camp/brick.camp.git .`
4. Switch back to the Grav root folder (e.g. `~/www/brick.camp/` ) and run the following command:
`bin/grav install`
5. Run the scripts in subfolder /data/brick-work to load the part names and part images from [Rebrickable.com](https://rebrickable.com/downloads/).
6. Start the included server by mapping the router.php to a local address (as quick development setup) - for example by:
`php -S 127.0.0.1:8080 system/router.php`
7. You should be ready to go.

## Thanks for your attention
> I think quotes are very dangerous things. <br>
> _Kate Bush_