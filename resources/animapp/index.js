var Animapp = {}
Animapp.Tool = {}

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
    var app = new Animapp.Editor($('#animapp'), $('#ferramentas'))
    app.initialize()
})