(function(window, document, $) {
   $("#cuit")
    .inputmask(
      "99-99999999-9",
      {
        removeMaskOnSubmit: true,
        clearMaskOnLostFocus: true,
        showMaskOnFocus: true,
        showMaskOnHover: false
      }
    );
})(window, document, jQuery);
