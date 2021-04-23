import Sortable, { MultiDrag, Swap } from 'sortablejs';

$(function (){
    $(".btn-delete-menu").on('click', async function (e) {
        e.preventDefault();
        let url = $(this).attr("data-ajax-url");
        let element = $(this);
        if (confirm('Bạn có chắc muốn xóa?')) {
            UserInterface.prototype.showLoading();
            fetch(url, {
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                method: 'DELETE',
            }).then(
                response => response.json()
            ).then(data => {
                UserInterface.prototype.hideLoading();
                if (data.status === 0){
                    element.closest('.menu-item').remove();
                    toastr.success(data.message);
                }else{
                    toastr.success(error);
                }
            }).catch(error => {
                toastr.success(error);
                UserInterface.prototype.hideLoading();
            });

        }
    });

    $('.changeStatusmenu').on('change', function () {
        let id = $(this).attr('abbr');
        let state = $(this).prop('checked') ? 1 : 0;
        $.ajax({
            type: 'POST',
            url: $(this).attr('abbr-url'),
            dataType: 'JSON',
            data: {
                id: id,
                status: state
            }
        }).done(function (msg) {
            window.location.reload();
        });
    });

    $(".chk-item").on("change",function (){
        let status = $(this).is(":checked");
        let listCheckBox = $(this).closest('.menu-item').find('.list-group-menu').find(".chk-item");
        for (let i = 0 ; listCheckBox.length > i ; i ++){
            listCheckBox[i].checked = status;
        }
    });

    $(".chk-all").on("change",function (){
        let status = $(this).is(":checked");
        let listCheckBox =$(".chk-item");
        for (let i = 0 ; listCheckBox.length > i ; i ++){
            listCheckBox[i].checked = status;
        }
    })

    var nestedSortables = document.getElementsByClassName('list-group-menu');
    for (var i = 0; i < nestedSortables.length; i++) {
        new Sortable(nestedSortables[i], {
            group: 'nested',
            animation: 150,
            fallbackOnBody: true,
            swap: true,
            swapThreshold: 0.65,
            swapClass: 'highlight',
            filter: '.filtered',
            onEnd: function (evt) {
                if (evt.to ===  evt.from && evt.oldIndex === evt.newIndex){
                    return
                }
                UserInterface.prototype.showLoading();
                let parent = $(evt.to).attr("data-id");
                let ids = [];
                $("> .menu-item",evt.to).each(function (){
                    ids.push($(this).attr("data-id"));
                });
                $.ajax({
                    method: "POST",
                    url: "/menu/updateOrder",
                    data: { ids: ids, parent: parent }
                }).done(function( msg ) {
                    if (msg.status){
                        UserInterface.prototype.showFlashMessageInfo(msg.message);
                        window.location.reload();
                    }else{
                        UserInterface.prototype.showFlashMessageError(msg.message);
                    }
                    UserInterface.prototype.hideLoading();
                });
            },
        });
    }

})
