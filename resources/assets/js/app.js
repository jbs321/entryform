require('./bootstrap')
require('./fancybox')

function onChangeDivision (divisionSelector, categorySelector) {
  var division = $(divisionSelector).val()
  
  $(categorySelector + " option.category").each(function () {
    $(this).addClass('hidden')
    $(this).attr('disabled', 'true')
  })
  
  $(categorySelector + ' option[division="' + division + '"].category').each(function () {
    $(this).removeClass('hidden')
    $(this).removeAttr('disabled')
  })
  
  // console.log($(categorySelector).val());
  // $(categorySelector).val($(categorySelector + ' option[division="' + division + '"]').first().val())
}

window.onChangeDivision = onChangeDivision