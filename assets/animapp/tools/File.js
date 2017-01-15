/**
 *
 * @param {fabric.Canvas} canvas
 * @constructor
 */
Animapp.Tool.File = function (canvas, el) {
    var fileInput = $('<input>', {
        type:   'file',
        id:     'file-input',
        accept: 'image/*'
    })

    fileInput.appendTo('body')

    fileInput.on('change', function () {
        var file = fileInput[0].files[0],
            reader = new FileReader()

        reader.onload = function (e) {
            var img = $('<img>', {
                id: 'canvas-image',
                src: e.target.result
            })

            var fbImage = new fabric.Image(img[0], {
                left: 50,
                top:  50,
                width: 50,
                height: 50,
                selectable: false
            })

            canvas.add(fbImage)
        }

        reader.readAsDataURL(file)
    })

    el.on('click', function () {
        fileInput.click()
    })

    this.activate = function () {
        return false
    }

    this.deactivate = function () {
        return false
    }

}

Animapp.Tool.File.prototype = new Animapp.Tool.Base()
