# CMS3 - My Content Management Sistem

> My Content Management Sistem is in Versin 3 and its inttent is to help while developping any kind of personal solution. 

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
    require_once "vendor/autoload.php";
    GMSHelp::Setup();
    
    ?>




[Markdown - Help](http://markdownlivepreview.com)