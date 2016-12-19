/**
 * Editor animapp.
 * @param {Object} div Div do editor.
 * @param {Object} toolbox Lista da toolbox.
 * @constructor
 */
Animapp.Editor = function (div, toolbox) {
    var _div = div,
        _toolbox = toolbox,
        _canvas = null,
        _currentTool = null,
        _tools = {}

    var createCanvas = function () {
        var el = $('<canvas>', {
            attr: {
                id: 'animapp-canvas',
                width: _div.innerWidth(),
                height: _div.innerHeight(),
                'data-color': 'black'
            }
        })

        el.appendTo(_div)

        _canvas = new fabric.Canvas('animapp-canvas')
        _canvas.isDrawingMode = true

        $(window).on('resize', function () {
            _canvas
                .setWidth(_div.innerWidth())
                .setHeight(_div.innerHeight())
        })


    }

    var registerEvents = function () {
        _toolbox.find('[data-tool]').on('click', function () {
            _currentTool = $(this).data('tool')
            _tools[_currentTool].active()

            // Deseleciona todas as ferramentas
            $('[data-tool]').removeClass('selected')

            // Seleciona a ferramenta clicada
            $(this).addClass('selected')
        })
    }

    var setupTools = function () {
        _tools = {
            pencil: new Animapp.Tool.Pencil(_canvas)
        }
    }

    this.initialize = function () {
        createCanvas()
        registerEvents()
        setupTools()
    }
}
 