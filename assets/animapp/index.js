var Animapp = {}
Animapp.Tool = {}

$(function () {
    var app = new Animapp.Editor($('#animapp'), $('#ferramentas'))

    app.initialize()
})