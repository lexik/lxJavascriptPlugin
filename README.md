lxJavascriptPlugin
==================

lxJavascriptPlugin allows you to insert all your javascripts in a single place of your document, from partials, widgets, basically anywhere in your app.

![Project Status](http://stillmaintained.com/lexik/lxJavascriptPlugin.png)

Setup:
------

1. Enable `lxJavascriptPlugin` in your ProjectConfiguration
2. Edit `settings.yml` to include the helper `lxJavascript`

Usage:
------

The lxJavascript helper provides 3 simple methods following the JavascriptHelper syntax:

1. `lx_javascript($url = null, $prioritize = false)` creates a script tag to insert a remote javascript source from $url.
   `$prioritize` will place this tag in first place in the tags render queue.
   If `$url` is empty, `lx_javascript` will start a code block in the same way the regular `javascript()` does.

2. `lx_end_javascript($prioritize = false)` ends a code block started with `lx_javascript()`.
   If `$prioritize` is set to "true" the block will be placed first in the blocks render queue.

3. `lx_include_javascript()` renders the javascript stored with `lx_javascript`. Use it where you would use the regular `include_javascript`. Most of the time you will want it in your layout template, just before the </body> tag.


If you want to include javascript code from a widget or any other class with no direct access to a template, you can use the 4 static methods from the `lxJavascriptStorage` class:

    lxJavascriptStorage::addRemoteJavascript($url)
    lxJavascriptStorage::addRemoteJavascriptFirst($url)
    lxJavascriptStorage::addJavascriptCode($code)
    lxJavascriptStorage::addJavascriptCodeFirst($code)

They behave exactly like the helper methods.

Example:
--------

If you render a Facebook Like in a template using this:

    <fb:like></fb:like>
    <script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script>
    <script type="text/javascript">
      FB.init({
        appId  : '123456789000000000',
        status : true,
        cookie : true,
        xfbml  : true
      });
    </script>

You can use the helper:

    <fb:like></fb:like>
    <?php lx_javascript("http://connect.facebook.net/en_US/all.js") ?>
    <?php lx_javascript() ?>
      FB.init({
        appId  : '123456789000000000',
        status : true,
        cookie : true,
        xfbml  : true
      });
    <?php lx_end_javascript() ?>

Then in your layout:

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
      <head>
        ...
      </head>
      <body>
        ...
        <?php lx_include_javascripts() ?>
      </body>
    </html>

Your javascript code is now rendered at the end of your document.

License
-------

This plugin is licensed under the terms of the [MIT License](http://en.wikipedia.org/wiki/MIT_License).

Credits
-------

This plugin is developed and maintained by [Lexik](http://www.lexik.fr).
