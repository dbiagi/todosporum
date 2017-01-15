/**
 *
 * @param {fabric.Canvas} canvas
 * @constructor
 */
Animapp.Tool.Color = function (canvas, el) {
    var self = this,
        colorInput = $('<input>', {
            type:  'color',
            id:    'color-picker',
            style: 'display: none'
        })

    $('body').append(colorInput)

    var colorChanged = function (e) {
        var currentColor = $(this).val()
        el.css('color', currentColor)
        canvas.color = currentColor
    }

    var onClick = function () {
        colorInput.click()
    }

    el.on('click', onClick)
    colorInput.on('change', colorChanged)

    this.activate = function () {
        return false
    }

    this.deactivate = function () {
        return false
    }

}

Animapp.Tool.Color.prototype = new Animapp.Tool.Base()
