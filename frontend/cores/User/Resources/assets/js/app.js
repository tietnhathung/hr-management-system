$("#company_id").on("change", function() {
    $.ajax({
        url: "/company/ajaxRequest/getRoles",
        type:"POST",
        data: {
            companyId: $(this).val()
        }
    }).done(function(data) {
        $("#user_roles").empty();
        $.each(data, function(key, value) {
            $("#user_roles").append($('<option>', {value:value.id, text:value.name}));
        })
        $('#user_roles').bootstrapDualListbox('refresh');
    })
});