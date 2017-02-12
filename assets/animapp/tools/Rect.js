/**
 *
 * @param {fabric.Canvas} canvas
 * @constructor
 */
Animapp.Tool.Rect = function (canvas, el) {
    var _self = this,
        currentRect = null,
        defaultWidth = 50,
        defaultHeight = 50,
        defaultDashArray = [1, 0, 12]

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
            top:             t - h,
            left:            l - w,
            fill:            canvas.color,
            selectable:      false,
            strokeDashArray: defaultDashArray,
            fill:            null,
            stroke:          canvas.color,
            strokeWidth:     5
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

        var pointer = canvas.getPointer(e.e)

        var newWidth = Math.abs(pointer.x - currentRect.left)
        var newHeight = Math.abs(pointer.y - currentRect.top)

        currentRect.set({
            width: newWidth,
            height: newHeight
        })

        if (currentRect.left > pointer.x) {
            currentRect.set({originX: 'right'});
        } else {
            currentRect.set({originX: 'left'});
        }

        if (currentRect.top > pointer.y) {
            currentRect.set({originY: 'bottom'});
        } else {
            currentRect.set({originY: 'top'});
        }
    }

    var mouseUp = function () {
        currentRect.set({
            strokeDashArray: null
        })
        currentRect.setCoords()
        currentRect = null
    }

    var registerEvents = function () {
        canvas.on('mouse:down', mouseDown)
            .on('mouse:up', mouseUp)
            .on('mouse:move', mouseMove)
    }

    var unregisterEvents = function () {
        canvas.off('mouse:down', mouseDown)
            .off('mouse:up', mouseUp)
            .off('mouse:move', mouseMove)
    }

    this.activate = function () {
        registerEvents()
    }

    this.deactivate = function () {
        unregisterEvents()
    }

}

Animapp.Tool.Rect.prototype = new Animapp.Tool.Base()
