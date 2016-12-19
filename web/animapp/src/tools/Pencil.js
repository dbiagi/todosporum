/**
 *
 * @param {Object} canvasDiv
 * @constructor
 */
Animapp.Tool.Pencil = function (canvasDiv) {
    var _self = this,
        _div = canvasDiv,
        _name = 'pencil',
        _isMouseDown = false,
        _points = []

    this.active = function () {
        console.log('ativado')

        _div.on('mousedown', function(){
            _isMouseDown = true
            _self.trigger('start')
        })

        _div.on('mouseup', function(){
            _isMouseDown = false
            _self.trigger('finish', data)
        })

        _div.on('mousemove', function(e){
            _points.push = {
                x: e.pageX,
                y: e.pageY
            }

        })
    }

}

Animapp.Tool.Pencil.prototype = new Animapp.Tool.Base()