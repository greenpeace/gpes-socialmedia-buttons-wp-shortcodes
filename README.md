# Social media buttons

This shortcode creates 3 buttons to share a URL in social networks:

* Facebook
* Twitter
* Whatsapp

**Features:**

* It's a multilingual shortcode. See bellow on how to translate it.
* It creates links with [utm paramaters](https://en.wikipedia.org/wiki/UTM_parameters) that can be tracked with Google Analytics and other software. 
* It triggers a [Google Analytics event](https://support.google.com/analytics/answer/1033068) when the user clicks in a button.

## How to use

Copy-paste the example code bellow to your posts and pages.

```
[simple_socialmedia_buttons url='https://es.greenpeace.org/es/' tweet='This is my tweet' msg='This is my Whatsapp message' event_category='MyAnalyticsEventCategory']
```

## Graphic user interface

This shortcode includes a block to use with the plugin [Shortcake (Shortcode UI)](https://wordpress.org/plugins/shortcode-ui/). Install it if you prefer a graphic user interface to using shortcodes.

## How to install

1. Upload the **simple-socialmedia-buttons** folder to **wp-content/plugins/**.
2. Activate the **Simple socialmedia buttons** plugin.

If you use the plugin [Shortcake (Shortcode UI)](https://wordpress.org/plugins/shortcode-ui/) you can **install a GUI for this shortcode**.

1. Upload the **simple-socialmedia-buttons-ui** folder to **wp-content/plugins/**.
2. Activate the **Simple socialmedia buttons UI** plugin.
3. Add the code in `your-theme/editor-style.css` to your `editor-style.css` file inside your theme.

## How to translate to a new language

1. Open the files `languages/simple-socialmedia-buttons.pot` and `languages/simple-socialmedia-buttons-ui.pot` with **[Poedit](https://poedit.net/)**.
2. Create new language.
3. Translate.
4. Save the .po and .mo files as the Spanish example inside the languages folder.
