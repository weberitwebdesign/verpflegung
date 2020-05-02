$(document).ready(function (){
	var $tabelle = $('#tabelle_users');

	$tabelle.on('click', 'button', function(){
		var $element = $(this);
		if ($element.hasClass('status')){
			aendere_status($element);
		} else if ($element.hasClass('delete')){
			if (confirm("Eintrag wirklich löschen?")){
				loesche_eintrag($element);
			}
		}
	})
});

function aendere_status($element){
	var tabelle_id_status = $element.attr('id').split('_');
	var table = tabelle_id_status[0].replace(/-/,"_");

	$.ajax({
		url:	base_url + controller_name + "/setStatus/" + tabelle_id_status[1] + "/" + tabelle_id_status[2],
		type: "POST",
		success: function(r) {
      if (r.indexOf("nok") == -1){
        if (r == "inaktiv"){
          var new_id          = tabelle_id_status[0] + "_" + tabelle_id_status[1] + "_1";
          var new_class       = "btn status";
          var new_aria        = "Status inaktiv";
          var new_child_class = "glyphicon glyphicon-remove-sign";
          var new_style       = "color:#646864; background-color: #e5e5e5;";
        }

        if (r == "prüfung"){
          var new_id          = tabelle_id_status[0] + "_" + tabelle_id_status[1] + "_2";
          var new_class       = "btn alert-warning status";
          var new_aria        = "Status prüfung";
          var new_child_class = "glyphicon glyphicon-question-sign";
          var new_style       = "";
        }

				if (r == "aktiv"){
          var new_id          = tabelle_id_status[0] + "_" + tabelle_id_status[1] + "_0";
          var new_class       = "btn alert-success status";
          var new_aria        = "Status aktiv";
          var new_child_class = "glyphicon glyphicon-ok-sign";
          var new_style       = "";
        }

        $element.attr({'id'         : new_id,
                       'class'      : new_class,
                       'aria-label' : new_aria,
                       'style'      : new_style
        });

				document.getElementById(new_id).childNodes[1].className = new_child_class;
      }
    }
	})
}

function loesche_eintrag($element) {
  var tabelle_id = $element.attr('id').split('_');
  $.ajax({
    url:      base_url  + controller_name + "/deleteRecord",
    type:    "POST",
    data:    "iId=" + tabelle_id[1],
    success:  function(r) {
                if (r != "nok") {
                  $("#item_" + tabelle_id[1]).remove();
                }
              }
  });
}
