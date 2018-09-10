# CMS3 - My Content Management Sistem

> My Content Management Sistem (v.3) intended to help developping simple personal solutions. 

----
## composer.json
    {
	"require" : {
		"manguto/cms3":"*"
	},
	"autoload":{
		"psr-4":{
			"lib\\":"lib/"
		}
	},
	"minimum-stability":"dev"
    }

## index.php
    <?php    
    use manguto\cms3\gms\GMSHelp;
    require_once "vendor/autoload.php";
    GMSHelp::Setup();    
    ?>



[Markdown - Help](http://markdownlivepreview.com)
