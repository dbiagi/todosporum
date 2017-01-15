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
});