Joomla! CMS™
====================

Build Status
---------------------
Travis-CI: [![Build Status](https://travis-ci.org/Digital-Peak-Incubator/tpl_tauristar.svg?branch=tpl_tauristar)](https://travis-ci.org/Digital-Peak-Incubator/tpl_tauristar)

What is this?
---------------------
This repository shows an approach how to introduce CSS/JS frameworks like bootstrap 3 or font awesome into the current Joomla version without breaking backwards compatibility.

How to get started?
---------------------
Install Joomla as usual by downloading it from this repository. As default template is tauristar set, which loads the bootstrap 3 framework without any template overrides.

You can install the sample blog data on the last installation screen or create some sample articles by yourself.

What is new?
---------------------
Templates define which framework (bs3, bs4) they want to work with and then the layouts are loaded with prefixes like bs3 according to the template (framework parameter)[templates/tauristar/templateDetails.xml#L48]. For example when tauristar is activated, then the file (default.bs3.php)[modules/mod_menu/tmpl/default.bs3.php] is loaded instead of the (default.php)[modules/mod_menu/tmpl/default.php] file. The same works for component views and JLayouts.

If the framework parameter is not set, then the layout is loaded as before. Like that backwards compatibility is guaranteed.

How to contribute?
---------------------
Play around with the installation, pick an issue and convert some layout files to bootstrap 3. Don't forget to open a pull request!! 

Copyright
---------------------
* Copyright (C) 2005 - 2016 Open Source Matters. All rights reserved.
* [Special Thanks](https://docs.joomla.org/Joomla!_Credits_and_Thanks)
* Distributed under the GNU General Public License version 2 or later
* See [License details](https://docs.joomla.org/Joomla_Licenses)
