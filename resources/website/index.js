import $ from 'jquery'

$(document).ready(function () {
    $(".logo-sketch").fancybox({
        helpers: {
            title: {
                type: 'inside',
                position: 'top'
            }
        }
    });
    $(".logo-final").fancybox({
        helpers: {
            title: {
                type: 'inside',
                position: 'top'
            }
        }
    });
    $(".layout").fancybox({
        helpers: {
            title: {
                type: 'inside',
                position: 'top'
            }
        }
    });
    $(".paudefitas").fancybox();


    $('[data-toogle="tooltip"]').tooltip();

    $('#part-modal').on('shown.bs.modal', function (e) {
        var $bt = $(e.relatedTarget),
            $modal = $($bt.data('target'));

        var img = new Image();
        img.src = $bt.data('thumbnail');
        $modal.find('.modal-body').html('').append(img);

        $modal.find('#edit').attr('href', $bt.data('url'));
    });

    $('#username').focus();
});