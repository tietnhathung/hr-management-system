class Validate {
    isInt(value) {
        let x = parseFloat(value);
        return !isNaN(value) && (x | 0) === x && value.toString().indexOf('e') == -1;
    }

    isDate(value) {
        value = value.split('/');
        let date = new Date(value[2] + '/' + value[1] + '/' + value[0]);
        return !!(date && (date.getMonth() + 1) == value[1] && date.getDate() == Number(value[0]));
    }

    isTime(value) {
        let reg = /^([01]?[0-9]|2[0-3])(:[0-5][0-9])$/;
        return reg.test(value);
    }

    isEmail(value) {
        let reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return reg.test(String(value).toLowerCase());
    }

    isNullOrWhiteSpace(value) {
        if (value == undefined)
            return true;

        if (value == null)
            return true;

        return value.replace(/\s/g, '').length == 0;
    }
}

class Utilities {
    formatDisplayRate(value) {
        return value + '%';
    }

    formatDisplayCurrency(amount, decimalCount = 0, decimal = ',', thousands = '.') {
        try {
            decimalCount = Math.abs(decimalCount);
            decimalCount = isNaN(decimalCount) ? 0 : decimalCount;

            const negativeSign = amount < 0 ? '-' : '';

            let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
            let j = (i.length > 3) ? i.length % 3 : 0;

            return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, '$1' + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : '') + ' ₫';
        } catch (e) {
            console.error(e)
        }
    }

    formatDisplayDateOnly(value) {
        return moment(value).format('DD/MM/YYYY')
    }

    guid() {
        function s4() {
            return Math.floor((1 + Math.random()) * 0x10000)
                .toString(16)
                .substring(1);
        }
        return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
    }
}

class UserInterface {
    showFlashMessage(message, type) {
        toastr.options = {
            'closeButton': true,
            'preventDuplicates': false,
            'positionClass': 'toast-top-right',
            'showDuration': '400',
            'hideDuration': '1000',
            'timeOut': '3500',
            'extendedTimeOut': '1000',
            'showEasing': 'swing',
            'hideEasing': 'linear',
            'showMethod': 'fadeIn',
            'hideMethod': 'fadeOut'
        };

        if (type == 1) {
            toastr.success(message, 'Thông báo');
        } else {
            toastr.error(message, 'Thông báo');
        }
    }

    showFlashMessageInfo(message) {
        this.showFlashMessage(message, 1);
    }

    showFlashMessageError(message) {
        this.showFlashMessage(message, 0);
    }

    showLoading() {
        $('body').addClass('show-loading');
    }

    hideLoading() {
        $('body').removeClass('show-loading');
    }
}

$(document).ready(function () {
    $.ajaxPrefilter(function (options, originalOptions, jqXhr) {
        if (options.type.toUpperCase() === 'POST') {
            let token = $('input[name^=_token]').first();
            if (!token.length) return;

            let tokenName = token.attr('name');

            if (options.contentType === false) {
                return;
            };

            if (options.contentType.indexOf('application/json') === 0) {
                options.url += ((options.url.indexOf('?') === -1) ? '?' : '&') + token.serialize();
            } else if (typeof options.data === 'string' && options.data.indexOf(tokenName) === -1) {
                options.data += (options.data ? '&' : '') + token.serialize();
            }
        }
    });

    $('.select2 select').select2({
        width: '100%'
    });

    $('.date-time-picker').each(function () {
        let option = {
            format: 'DD/MM/YYYY',
            locale: 'vi',
            icons: {
                time: 'far fa-clock',
                date: 'far fa-calendar-alt',
                up: 'fas fa-chevron-up',
                down: 'fas fa-chevron-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right',
                today: 'fas fa-bullseye',
                clear: 'far fa-trash-alt',
                close: 'fas fa-times'
            }
        };

        let value = $(this).val();
        if (value != '') {
            value = moment(value, 'DD/MM/YYYY');
            value = moment(value).format('YYYY-MM-DD');
            $(this).val('');
            option.defaultDate = value;
        }

        $(this).datetimepicker(option);
    });

    $('.table-data').checkAll();


    $(".btn-delete-one").on('click', async function (e) {
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
                    element.closest('tr').remove();
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

    $('.btn-delete-multi').click(function () {
        let id = [];

        let idx = $('.btn-delete-multi').index(this);
        let tbl = $('.table-data:eq(' + idx + ')');

        let url = $(this).attr('data-ajax-url');
        let urlGoback = $(this).attr('data-ajax-url-go-back');

        $('.chk-item:checked', tbl).each(function () {
            id.push(parseInt($(this).val()));
        });

        if (id.length === 0) {
            alert('Bạn chưa chọn dữ liệu cần xóa!');
            return;
        }

        if (confirm('Bạn có chắc muốn xóa?')) {
            $.ajax({
                type: 'POST',
                url: url,
                contentType: 'application/json',
                dataType: 'json',
                data: JSON.stringify({
                    id: id
                }),
                traditional: true,
                complete: function () {
                    if (!Validate.prototype.isNullOrWhiteSpace(urlGoback)) {
                        window.location.href = urlGoback;
                    } else {
                        window.location.reload();
                    }
                }
            });
        }
    });

    $('.changeStatus').on('change', function () {
        let id = $(this).attr('abbr');
        let state = $(this).prop('checked') ? 1 : 0;
        UserInterface.prototype.showLoading();
        $.ajax({
            type: 'POST',
            url: $(this).attr('abbr-url'),
            dataType: 'JSON',
            data: {
                id: id,
                status: state
            }
        }).done(function (msg) {
            UserInterface.prototype.hideLoading();
            toastr.success(msg.message);
        });
    });

    $('body').on('blur', 'input.require-int-unsigned', function () {
        let value = $(this).val();
        if (!Validate.prototype.isInt(value) || (Validate.prototype.isInt(value) && value < 1)) {
            value = 1;
        }
        value = value.toString().replace(/(\+|-)/g, '');
        $(this).val(value);
    });

    $('body').on('blur', 'input.require-int-unsigned-zero', function () {
        let value = $(this).val();
        if (!Validate.prototype.isInt(value) || (Validate.prototype.isInt(value) && value < 0)) {
            value = 0;
        }
        value = value.toString().replace(/(\+|-)/g, '');
        $(this).val(value);
    });
});
