/**
 *
 * @param {fabric.Canvas} canvas
 * @constructor
 */
Animapp.Tool.Circle = function (canvas, el) {
    var _self = this,
        currentRound = null,
        defaultRadius = 20

    var createRound = function(r, t, l){
        return new fabric.Circle({
            radius: r,
            top: t,
            left: l,
            fill: canvas.color,
            selectable: false
        })
    }

    var mouseDown = function (e) {
        var event = e.e

        var pointer = canvas.getPointer(event)

        currentRound = createRound(
            defaultRadius,
            pointer.y,
            pointer.x
        )

        canvas.add(currentRound)
    }

    var mouseMove = function (e) {
        if (currentRound === null) {
            return
        }

        var event = e.e

        currentRound
            .set('top', event.layerX)
            .set('left', event.layerY)
            .setCoords()
    }

    var mouseUp = function () {
        currentRound = null
    }

    var registerEvents = function () {
        canvas.on('mouse:down', mouseDown)
        /*.on('mouse:up', mouseUp)
         .on('mouse:move', mouseMove)*/
    }

    var unregisterEvents = function () {
        canvas.off('mouse:down', mouseDown)
            .off('mouse:up', mouseUp)
            .off('mouse:move', mouseMove)
    }

    this.active = function () {
        registerEvents()
    }

    this.deactive = function () {
        unregisterEvents()
    }

}

Animapp.Tool.Circle.prototype = new Animapp.Tool.Base()
