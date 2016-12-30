/**
 *
 * @param {fabric.Canvas} canvas
 * @constructor
 */
Animapp.Tool.Rect = function (canvas, el) {
    var _self = this,
        currentRect = null,
        defaultWidth = 20,
        defaultHeight = 20

    /**
     * Cria um retângulo.
     * @param {Number} w Comprimento.
     * @param {Number} h Altura.
     * @param {Number} l Posição em relação a esquerda.
     * @param {Number} t Posição em relação ao topo.
     * @returns {fabric.Rect}
     */
    var createRect = function (w, h, t, l) {
        return new fabric.Rect({
            width:      w,
            height:     h,
            top:        t,
            left:       l,
            fill:       canvas.color,
            selectable: false
        })
    }

    var mouseDown = function (e) {
        var event = e.e

        var pointer = canvas.getPointer(event)

        currentRect = createRect(
            defaultWidth,
            defaultHeight,
            pointer.y,
            pointer.x
        )

        canvas.add(currentRect)
    }

    var mouseMove = function (e) {
        if (currentRect === null) {
            return
        }

        var event = e.e

        currentRect
            .set('top', event.layerX)
            .set('left', event.layerY)
            .setCoords()
    }

    var mouseUp = function () {
        currentRect = null
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

Animapp.Tool.Rect.prototype = new Animapp.Tool.Base()