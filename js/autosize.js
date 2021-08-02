/**
 * Javascript for applying JQuery Autosize to textareas.
 *
 * @param {Object} $
 */

(function ($) {

Drupal.behaviors.Autosize = {
  attach: function(context) {
    var trigger = drupalSettings.autosize.trigger;
    $(trigger).once('autosize').each(function() {
      autosize($(this));
    });
  }
}

})(jQuery);
