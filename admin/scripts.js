jQuery(window).load(function () {

  var initConfigManager = function () {

    configForm = jQuery("#config_manager_form").parent();
    configForm.css("margin", 0);
    configForm.parent().parent().find(".control-group:gt(0)").css("display", "none");
    configForm.parent().parent().find(".control-label").css("display", "none");

    jQuery("#config_manager_load").click(function (a) {
      a.stopPropagation();
      a.preventDefault();
      loadSaveOperation("load")
    });

    jQuery("#config_manager_save").click(function (a) {
      a.stopPropagation();
      a.preventDefault();
      loadSaveOperation("save")
    });

    jQuery("#config_manager_delete").click(function (a) {
      a.stopPropagation();
      a.preventDefault();
      loadSaveOperation("delete")
    })
  }()
});

function loadSaveOperation(a) {
  var b = window.location; - 1 !== (b + "").indexOf("#", 0) && (b = b.substr(0, (b + "").indexOf("#", 0) - 1));
  b = b + "&template_task=" + a + "&template_file=" + jQuery("#config_manager_" + a + "_filename").val();
  window.location = b
}