/**
 *
 * @param {fabric.Canvas} canvas
 * @constructor
 */
Animapp.Tool.Bucket = function (canvas, el) {
    var _self = this

    var mouseDown = function(e){
        if(e.target !== null){
            e.target.setColor(canvas.color)
            e.target.setStroke(canvas.color)
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

Animapp.Tool.Bucket.prototype = new Animapp.Tool.Base()
