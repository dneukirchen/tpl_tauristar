# JUiFramework

## Concept

The basic idea is to introduce a new JUiFramework helper, which acts as Frontend Framework manager and replaces the unflexible JHtmlBootstrap helper.
JUiFramework holds the drivers for the frameworks that are supported in the joomla core (currently bootstrap 2 and bootstrap 3),
but it can be extended to support other framework drivers like foundation, ui-kit, materialize or any other frontend framework out there. 

The joomla user should be responsible for selecting the frontend framework he wants to use. Not a 3rd party developer. 
The current joomla solution forces 3rd party developers to load a frontend framework together with their extension. This leads to many unnecessary/duplicate requests and conflicts. 

In the future 3rd party devs have to decide if they want to use a framework supported by the core or extend JUiFramework and deliver a different or a modified framework.

JUiFramework neither is responsible for adding the framework assets (js, fonts and styles), nor rendering the js/html output of a framework feature (modal, alert, accordion etc). 
Instead it redirects all requests to the concrete framework driver selected by the user (either as a template or joomla config parameter). The driver knows what he has to do and answers the request. 
This is the main difference between JUiFramework and the old JHtmlBootstrap helper.

JUiFramework allows 3rd party developers to overwrite the core implementations of the framework drivers (bootstrap 2 & 3) and replace/modify/extend one or all feature methods (modal, alert, accordion...) of the frameworks.
Any javascript/css conflict between frameworks or framework versions can be resolved in this way.

This structure makes it easy to support different frameworks or newer versions of a framework in the future. You just have to create and register a framework driver in JUiFramework.

## JUiFramework public api

### Loading assets

`JUiFramework::assets()`

Load all assets of the selected framework.
 
`JUiFramework::scripts()`

Load only the javascript assets of the selected framework.

`JUiFramework::styles()`

Load only the stylesheets of the selected framework.

## How to interact with a framework driver?

`JUiFramework::[METHODNAME]()`

If you wanna call a method on a framework driver you simply have to call JUiFramework::[METHODNAME]().
JUiFramework will load the framework driver selected by the user and redirect the method call to that driver.

Example: If you want to render a bootstrap modal, you would call JUiFramework::modal($selector), similar to the old JHtmlBootstrap::modal($selector) method.

### How can i register a different frontend framework?

`JUiFramework::register($name, $callback, $setDefault)`

If you want to use a different framework than bootstrap 2 or 3 you have to create the framework driver (a simple php class) and register the driver in JUiFramework.

#### Create a custom framework driver (in the template or extension folder), which implements the JUiFrameworkInterface

```
/**
 * Class MyFramework
 * 
 * for example in: templates/my_template/myframework
 */
class MyFramework implements JUiFrameworkInterface
{
    public function assets()
    {
        $this->styles();
        $this->scripts();
    }

    public function styles()
    {
        // add custom framework scripts
    }

    public function scripts()
    {
        // add custom framework styles
    }

    public function helloWorld() {
        return 'Hello World';
    }
}
```

#### Register your framework

```
// Register the custom frontend framework (for example in your template index.php)
// You can use any name you want. We use "my" in this example

JUiFramework::register('my', function() {
    
    // optional... any additional initialization code
    
    return new MyFramework;
}, true);

```

#### Use your custom framework

`JUiFramework::helloWorld()`

// Outputs: "Hello World"

### Switch the framework in special cases

`JUiFramework::shouldUse($name)->method()`

You can use a different framework for only one method if you use the shouldUse helper. 

This way you can use multiple frameworks in your extension.

### Override the core framework drivers

You can override one or more methods of the core framework drivers in the same manner as you register custom frameworks.

```
/**
 * Class MyFramework
 * 
 * for example in: templates/my_template/myframework
 * we extend the JuiFrameworkBootstrap3 driver
 */
class MyBootstrap3 extends JuiFrameworkBootstrap3
{
    /** 
     * Override the default alert
     **/ 
    public function alert($selector = 'alert') {
		
        // Attach the alerts to the document
        JFactory::getDocument()->addScriptDeclaration(
            'jQuery(function($){ $(' . json_encode('.' . $selector) . ').customAlert(); });'
        );
		
        return;
    }
}
```

```
// Register the framework override
JUiFramework::register('bs3', function() {
    return new MyBootstrap3;
}, true);

```

#### Create the override

### The bootstrap 2 framework driver 

`JUiFramework::assets()`

`JUiFramework::scripts()`

`JUiFramework::styles()`

`JUiFramework::affix($selector = 'affix', $params = array())`

`JUiFramework::alert($selector = 'alert')`

`JUiFramework::button($selector = 'button')`

`JUiFramework::carousel($selector = 'carousel', $params = array())`

`JUiFramework::dropdown($selector = 'dropdown-toggle')`

`JUiFramework::modal($selector = 'modal', $params = array())`

`JUiFramework::renderModal($selector = 'modal', $params = array(), $body = '')`

`JUiFramework::popover($selector = '.hasPopover', $params = array())`

`JUiFramework::scrollspy($selector = 'navbar', $params = array())`

`JUiFramework::tooltip($selector = '.hasTooltip', $params = array())`

`JUiFramework::startAccordion($selector = 'myAccordian', $params = array())`

`JUiFramework::endAccordion()`

`JUiFramework::addSlide($selector, $text, $id, $class = '')`

`JUiFramework::startTabSet($selector = 'myTab', $params = array())`

`JUiFramework::endTabSet()`

`JUiFramework::startPane($selector = 'myTab', $params = array())`

`JUiFramework::endPane()`

`JUiFramework::addPanel($selector, $id)`

`JUiFramework::endPanel()`


### The bootstrap 3 framework driver 

`JUiFramework::assets()`

`JUiFramework::scripts()`

`JUiFramework::styles()`

`JUiFramework::affix($selector = 'affix', $params = array())`

`JUiFramework::alert($selector = 'alert')`

`JUiFramework::button($selector = 'button')`

`JUiFramework::carousel($selector = 'carousel', $params = array())`

`JUiFramework::dropdown($selector = 'dropdown-toggle')`

`JUiFramework::modal($selector = 'modal', $params = array())`

`JUiFramework::renderModal($selector = 'modal', $params = array(), $body = '')`

`JUiFramework::popover($selector = '.hasPopover', $params = array())`

`JUiFramework::scrollspy($selector = 'navbar', $params = array())`

`JUiFramework::tooltip($selector = '.hasTooltip', $params = array())`

`JUiFramework::startAccordion($selector = 'myAccordian', $params = array())`

`JUiFramework::endAccordion()`

`JUiFramework::addSlide($selector, $text, $id, $class = '')`

`JUiFramework::startTabSet($selector = 'myTab', $params = array())`

`JUiFramework::endTabSet()`

`JUiFramework::startPane($selector = 'myTab', $params = array())`

`JUiFramework::endPane()`

`JUiFramework::addPanel($selector, $id)`

`JUiFramework::endPanel()`

## BC

JHtmlBootstrap should be marked as deprecated. 

Until then JHtmlBootstrap and JUiFramework can run parallel. 

JHtmlBootstrap will add the bootstrap 2 js files. This could be an issue with the js parts of the frameworks (js conflicts), but it is not differnt to the current situation, where a 3rd party developer adds boostrap 3/4 via on its own.

Perhaps we can redirect all JHtmlBootstrap calls to JUiFramework internal.

## TODO

* Replace all JHtml::_('framework.bootstrap') and JHtmlBootstrap::xxx() calls with the new JUiFramework calls.    
* Implement bootstrap 2 and 3 drivers    
* Tests
* Documentation & Examples

## Questions

* What should happen, when a custom framework driver doesnt support the requested method? 
    * Throw an exception?
    * Try to load the method from a core framework driver