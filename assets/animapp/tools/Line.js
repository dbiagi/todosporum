/**
 *
 * @param {fabric.Canvas} canvas
 * @constructor
 */
Animapp.Tool.Line = function (canvas, el) {
    var self = this,
        strokeWidth = 10,
        currentLine = null

    var mouseDown = function (e) {
        var event = e.e,
            x = event.layerX,
            y = event.layerY

        currentLine = createLine([x,y,x,y])

        canvas.add(currentLine)
    }

    var mouseUp = function () {
        currentLine = null
    }

    var mouseMove = function (e) {
        if(currentLine === null){
            return
        }

        var event = e.e

        currentLine
            .set('x2', event.layerX)
            .set('y2', event.layerY)
            .setCoords()
    }

    /**
     * Cria linha.
     * @param {Array} coords
     * @returns {fabric.Line}
     */
    var createLine = function (coords) {
        return new fabric.Line(coords, {
            fill:        canvas.color,
            stroke:      canvas.color,
            strokeWidth: strokeWidth,
            selectable: false
        })
    }

    window.createLine = createLine

    /**
     * Registra eventos.
     */
    var registerEvents = function () {
        canvas.on('mouse:down', mouseDown)
        canvas.on('mouse:up', mouseUp)
        canvas.on('mouse:move', mouseMove)
    }

    /**
     * Remove eventos.
     */
    var unregisterEvents = function () {
        canvas.off('mouse:down', mouseDown)
        canvas.off('mouse:up', mouseUp)
        canvas.off('mouse:move', mouseMove)
    }

    /**
     * {@inheritDoc}
     */
    this.active = function () {
        registerEvents()
    }

    /**
     * {@inheritDoc}
     */
    this.deactive = function () {
        unregisterEvents()
    }

}

Animapp.Tool.Line.prototype = new Animapp.Tool.Base()