define([
    "jquery",
    "Magento_Ui/js/modal/modal",
], function($,modal) {
    "use strict";

    var options = {
        type: 'popup',
        responsive: true,
        title: 'Popup title'
    };
    let myModal = $('#modal');
    let popup = modal(options, myModal);
    $("#button").click(function() {
        $('#modal').modal('openModal');
    });
    $(".popupSubmit").click(function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        let dataForm = $('#form-validate');
        dataForm.mage('validation', {});
        if (dataForm.valid()) {
            $.ajax({
                url: dataForm.attr('action'),
                type:'POST',
                dataType:'json',
                data: $('#form-validate').serialize(),
                complete: function(data) {
                    console.log('Request was sent');
                },
                error: function () {
                    console.log('Error happens. Try again.');
                }
            });
            $('#modal').modal('closeModal');
        }
        return false;
    });
});
