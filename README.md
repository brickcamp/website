**BrickCamp** is a visual dictionary for LEGO`®` building techniques.

## Foundation

BrickCamp is only possible because of some amazing projects and technologies out there. This project is based on:

- [Grav](https://getgrav.org/): An amazing flat-file open-source content management system
- [Twig Templating](http://twig.sensiolabs.org/): An easy-to-learn templating engine used by Grav
- [Markdown](https://en.wikipedia.org/wiki/Markdown): A simple markup language for formatting text
- [YAML](http://yaml.org/): One more markup language, this time for configuration and metadata
- [LDraw](http://www.ldraw.org/): An open standard for LEGO`®` 3D modelling
- [LeoCAD](https://www.leocad.org/): A CAD programm based on the LDraw standard
- [Rebrickable.com](https://rebrickable.com/): A LEGO`®` creations platform with open-accesible data/images
- [GitLab](http://gitlab.com/): The source-code versioning platform where this project started

A huge thanks to each and every one of these projects and their supporting communities.

_Legal Notice: LEGO`®` is a trademark of the LEGO Group which does not sponsor, authorize or endorse this site._


## License

The **project including all content** is released under the [Creative Commons Attribution ShareAlike 4.0 International license](https://choosealicense.com/licenses/cc-by-sa-4.0/).


## Local Setup

1. [Download Grav](http://getgrav.org/downloads) from the https://getgrav.org site
2. Extract the ZIP archive into a directory in your webroot (e.g. `~/www/brick.camp/`)
3. Switch into the `user`-subfolder (e.g. `~/www/brick.camp/user/`) and run the following command:
`git clone https://github.com/brickcamp/website.git .`
4. Switch back to the Grav root folder (e.g. `~/www/brick.camp/` ) and run the following command:
`bin/grav install`
5. Run the scripts in subfolder /data/brick-camp to load the part names and part images from [Rebrickable.com](https://rebrickable.com/downloads/).
6. Start the included server:
`bin/grav server`
7. You should be ready to go.