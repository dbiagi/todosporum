/**
 *
 * @param {fabric.Canvas} canvas
 * @constructor
 */
Animapp.Tool.Move = function (canvas, el) {
    var _self = this,
        selection = []

    var mouseDown = function (e) {
        if(e.target === null){
            return
        }

        selection.push(e.target)

        if(e.e.ctrlKey){
            var group = new fabric.Group(selection)
            return canvas.setActiveGroup(group)
        }

        selection = []
    }

    var registerEvents = function () {
        canvas.on('mouse:down', mouseDown)
    }

    var unRegisterEvents = function () {
        canvas.off('mouse:down', mouseDown)
    }

    this.activate = function () {
        registerEvents()

        canvas.isDrawingMode = false

        canvas.set({
            selection: true
        })

        canvas.getObjects().map(function (obj) {
            obj.selectable = true
        })
    }

    this.deactivate = function () {
        unRegisterEvents()

        canvas.getObjects().map(function (obj) {
            obj.selectable = false
        })
    }

}

Animapp.Tool.Move.prototype = new Animapp.Tool.Base()
