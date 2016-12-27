/**
 *
 * @param {fabric.Canvas} canvas
 * @constructor
 */
Animapp.Tool.Line = function (canvas, el) {
    var self = this,
        strokeWidth = 10,
        currentLine = null

    var mouseDown = function(e){
        var currentLine = createLine([

        ])

        canvas.add(currentLine)
    }

    var mouseUp = function(){
        currentLine = null
    }

    var mouseMove = function(e){



    }

    var createLine = function(coords){
        return new fabric.Line(coords, {
            fill: canvas.color,
            stroke: canvas.color,
            strokeWidth: strokeWidth
        })
    }

    var registerEvents = function(){
        canvas.on('mouse:down', mouseDown)
        canvas.on('mouse:up', mouseUp)
        canvas.on('mouse:move', mouseMove)
    }

    var unregisterEvents = function(){
        canvas.off('mouse:down', mouseDown)
        canvas.off('mouse:up', mouseUp)
        canvas.off('mouse:move', mouseMove)
    }

    this.active = function () {
        registerEvents()
    }

    this.deactive = function(){
        unregisterEvents()
    }

}

Animapp.Tool.Line.prototype = new Animapp.Tool.Base()