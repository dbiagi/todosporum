/**
 *
 * @param {fabric.Canvas} canvas
 * @constructor
 */
Animapp.Tool.Move = function (canvas, el) {
    var _self = this

    this.active = function () {
        _canvas.isDrawingMode = false
    }

    this.deactive = function(){

    }

}

Animapp.Tool.Move.prototype = new Animapp.Tool.Base()
