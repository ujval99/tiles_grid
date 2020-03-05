/**
 * @file
 * Attaches the behaviors for the Tiles Grid module.
 */

(function ($) {
  Drupal.behaviors.tiles_grid = {
    attach: function(context, settings) {

      // init Isotope
      var $grid = $('.grid').isotope({
        itemSelector: '.element-item',
        layoutMode: 'fitRows',
        getSortData: {
          category: '[data-category]',
        }
      });

      $grid.imagesLoaded().progress( function() {
        $grid.isotope('layout');
      });

      // filter items on button click
      $('.filter-button-group').on( 'click', 'div', function() {
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({ filter: filterValue });
      });

      $('.grid .item-title').html(function (i, html) {
          return html.replace(/(\w+\s\w+\s\w+)/, '<span>$1</span>')
      });

      // change is-checked class on buttons
      $('.filter-button-group').each( function( i, buttonGroup ) {
        var $buttonGroup = $( buttonGroup );
        $buttonGroup.on( 'click', 'div', function() {
          $buttonGroup.find('.is-checked').removeClass('is-checked');
          $( this ).addClass('is-checked');
        });
      });

    }
  }
})(jQuery);