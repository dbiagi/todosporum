/**
 *
 * @param {fabric.Canvas} canvas
 * @constructor
 */
Animapp.Tool.Ellipse = function (canvas, el) {
    var _self = this,
        currentEllipse = null,
        defaultDashArray = [1, 0, 12]


    var createRound = function (x, y) {
        return new fabric.Ellipse({
            angle:           0,
            top:             y,
            left:            x,
            originX:         'left',
            originY:         'top',
            fill:            null,
            strokeDashArray: defaultDashArray,
            stroke:          canvas.color,
            strokeWidth:     5,
            selectable:      false
        })
    }

    var mouseDown = function (e) {
        var pointer = canvas.getPointer(e.e)

        currentEllipse = createRound(
            pointer.x,
            pointer.y
        )

        canvas.add(currentEllipse)
    }

    var mouseMove = function (e) {
        if (currentEllipse === null) {
            return
        }

        var pointer = canvas.getPointer(e.e)

        currentEllipse.set({
            rx: Math.abs(currentEllipse.left - pointer.x)/2,
            ry: Math.abs(currentEllipse.top - pointer.y)/2
        })

        if (currentEllipse.left > pointer.x) {
            currentEllipse.set({originX: 'right'});
        } else {
            currentEllipse.set({originX: 'left'});
        }

        if (currentEllipse.top > pointer.y) {
            currentEllipse.set({originY: 'bottom'});
        } else {
            currentEllipse.set({originY: 'top'});
        }
    }

    var mouseUp = function () {
        currentEllipse.set({
            fill: canvas.color,
            strokeDashArray: null
        })
        currentEllipse.setCoords()

        currentEllipse = null
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

Animapp.Tool.Ellipse.prototype = new Animapp.Tool.Base()
