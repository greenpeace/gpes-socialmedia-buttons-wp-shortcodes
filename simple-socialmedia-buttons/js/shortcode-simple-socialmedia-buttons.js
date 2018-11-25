console.log("Shortcode Timber plugin javascript loaded");

document.addEventListener("DOMContentLoaded", function(){

    var analyticsEvent = function(category, action, label) {
      if (typeof(ga) == "function") {
        ga('send', 'event', category, action, label);
      } else if (typeof(gtag) == "function") {
        gtag('event', action, {
          'event_category': category,
          'event_label': label
        });
      } else {
        console.error("Analytics event not tracked: " + category + ", " + action + ", " + label);
      }
    };

    jQuery(".fb-link").each(function() {
      var fb = "http://www.facebook.com/sharer.php?u=" + encodeURIComponent(jQuery(this).data("url"));
      jQuery(this).attr("href", fb);
    });

    jQuery(".tw-link").each(function() {
      var tw = "https://twitter.com/intent/tweet?text=" + encodeURIComponent(jQuery(this).data("tweet")) + "&amp;source=webclient";
      jQuery(this).attr("href", tw);
    });

    jQuery(".wa-link").each(function() {
      var wa = "https://api.whatsapp.com/send?text=" + encodeURIComponent(jQuery(this).data("msg"));
      jQuery(this).attr("href", wa);
    });

    jQuery(".fb-link, .tw-link, .wa-link").attr("target", "_blank");

    jQuery("a[data-clickeventcategory], a[data-clickeventlabel]").on("click", function() {
      var category = jQuery(this).data("clickeventcategory") ? jQuery(this).data("clickeventcategory") : "Default category";
      var label = jQuery(this).data("clickeventlabel") ? jQuery(this).data("clickeventlabel") : "Default label";
      analyticsEvent(category, "click", label);
    });

});
