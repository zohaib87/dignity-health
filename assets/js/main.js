/*--------------------------------------------------------------
# Main Js Start
--------------------------------------------------------------*/
(function($) {

	/*--------------------------------------------------------------
  # Ajax in-page search
  --------------------------------------------------------------*/
  $('.wt-filter-product').on('keyup change', function(){
    var value = $(this).val().toLowerCase();

    $('.dh-inneraccordion').each(function() {

      var name = $(this).find('.filter-name').text();
      var cat = $(this).find('.filter-cat').text();
      var comp = $(this).find('.filter-comp').text();
      var targetValue = name + ' ' + cat + ' ' + comp;

      if (targetValue.toLowerCase().indexOf(value) > -1) {
        $(this).show();
      } else {
        $(this).hide();
      }

      var allHidden = true;
      $(this).closest('.dh-productswrap').children().each(function(){
        if ($(this).css('display') !== 'none') {
          allHidden = false;
          return false;
        }
      });

      if (allHidden == true) {
        $(this).closest('div[id^=dh-collapsemain-]').prev().hide();
        $(this).closest('div[id^=dh-collapsemain-]').removeClass('show');
      } else {
        $(this).closest('div[id^=dh-collapsemain-]').prev().show();
      }

    });

  });

})( jQuery );