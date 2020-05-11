require('./bootstrap')
require('./fancybox')

function onChangeDivision (divisionSelector, categorySelector) {
  var division = $(divisionSelector).val()
  
  $(categorySelector).children().each(function () {
    $(this).addClass('hidden')
    $(this).attr('disabled', 'true')
  })
  
  $(categorySelector + ' option[division="' + division + '"]').each(function () {
    $(this).removeClass('hidden')
    $(this).removeAttr('disabled')
  })
  
  $(categorySelector).val($(categorySelector + ' option[division="' + division + '"]').first().val())
  
}

window.onChangeDivision = onChangeDivision