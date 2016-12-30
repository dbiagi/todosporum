/**
 *
 * @param {fabric.Canvas} canvas
 * @constructor
 */
Animapp.Tool.Pencil = function (canvas, el) {
    var _self = this

    this.active = function () {
        canvas.isDrawingMode = true
        canvas.freeDrawingBrush.color = canvas.color
    }

    this.deactive = function () {
        canvas.isDrawingMode = false
    }

}

Animapp.Tool.Pencil.prototype = new Animapp.Tool.Base()