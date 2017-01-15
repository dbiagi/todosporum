/**
 *
 * @param {fabric.Canvas} canvas
 * @constructor
 */
Animapp.Tool.Eraser = function (canvas, el) {
    var _self = this

    var mouseDown = function(e){
        if(e.target !== null){
            e.target.remove()
        }
    }

    var registerEvents = function(){
        canvas.on('mouse:down', mouseDown)
    }

    var unregisterEvents = function(){
        canvas.off('mouse:down', mouseDown)
    }

    this.activate = function () {
        registerEvents()
    }

    this.deactivate = function () {
        unregisterEvents()
    }

}

Animapp.Tool.Eraser.prototype = new Animapp.Tool.Base()
