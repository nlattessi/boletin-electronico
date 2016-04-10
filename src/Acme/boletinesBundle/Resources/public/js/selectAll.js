function post(path, params, arrayName, method) {
  method = method || 'post';

  var form = document.createElement("form");
  form.setAttribute("method", method);
  form.setAttribute("action", path);

  params.forEach(function(m) {
    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", arrayName);
    hiddenField.setAttribute("value", m);

    form.appendChild(hiddenField);
  });

  document.body.appendChild(form);
  form.submit();
};

function executePost(path, arrayName) {
  var ids = [];

  $("input:checkbox:checked").each(function(){
    ids.push($(this).attr('id'));
  });

  post(path, ids, arrayName);
};

// Listen for click on toggle checkbox
$('#select-all').click(function(event) {
  if(this.checked) {
    // Iterate each checkbox
    $(':checkbox').each(function() {
        this.checked = true;
    });
  } else {
    // Iterate each checkbox
    $(':checkbox').each(function() {
        this.checked = false;
    });
  }
});
