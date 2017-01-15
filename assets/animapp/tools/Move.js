/**
 *
 * @param {fabric.Canvas} canvas
 * @constructor
 */
Animapp.Tool.Move = function (canvas, el) {
    var _self = this

    this.activate = function () {
        canvas.isDrawingMode = false

        canvas.getObjects().map(function (obj) {
            obj.selectable = true
        })
    }

    this.deactivate = function () {
        canvas.getObjects().map(function (obj) {
            obj.selectable = false
        })
    }

}

Animapp.Tool.Move.prototype = new Animapp.Tool.Base()
