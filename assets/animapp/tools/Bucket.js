/**
 * Bucket.
 * @param {fabric.Canvas} canvas
 * @constructor
 */
Animapp.Tool.Bucket = function (canvas, el) {
    var _self = this

    var mouseDown = function(e){
        if(e.target !== null){
            e.target.set({
                color: canvas.color,
                stroke: canvas.color,
                fill: canvas.color
            })
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
