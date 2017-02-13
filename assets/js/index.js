$(document).ready(function () {
    $(".logo-sketch").fancybox({
        helpers: {
            title: {
                type:     'inside',
                position: 'top'
            }
        }
    });
    $(".logo-final").fancybox({
        helpers: {
            title: {
                type:     'inside',
                position: 'top'
            }
        }
    });
    $(".layout").fancybox({
        helpers: {
            title: {
                type:     'inside',
                position: 'top'
            }
        }
    });
    $(".paudefitas").fancybox();
    $(".videos").fancybox({
        prevEffect: 'none',
        nextEffect: 'none'
    });

    $('[data-toogle="tooltip"]').tooltip()

    $('#galery-modal').on('show.bs.modal', function (e) {
        var bt = e.relatedTarget

        $(this).append($('<img>', {
            src: bt.data('thumbnail')
        }))
    })
});