/**
 * Editor animapp.
 * @param {Object} div Div do editor.
 * @param {Object} toolbox Lista da toolbox.
 * @constructor
 */
Animapp.Editor = function (div, toolbox) {
    /** @type {fabric.Canvas} */
    var canvas = null

    /** @type {fabric.Object} */
    var currentTool = null

    /** @type {Object} */
    var tools = {}

    /** @type {Animapp.Recorder} */
    var recorder = null

    var createCanvas = function () {
        var el = $('<canvas>', {
            attr: {
                id:           'animapp-canvas',
                width:        div.innerWidth(),
                height:       div.innerHeight(),
                'data-color': 'black'
            }
        })

        el.appendTo(div)

        canvas = new fabric.Canvas('animapp-canvas', {
            selection: false
        })
        canvas.color = '#000'
        canvas.freeDrawingBrush.color = canvas.color
        canvas.freeDrawingBrush.width = 5

        // Deixa o objeto canvas disponível globalmente para fins de debug somente
        window.canvas = canvas
    }

    var createRecorder = function () {
        recorder = new Animapp.Recorder(canvas)
    }

    var registerEvents = function () {
        resizeEvents()
        toolboxEvents()
        keyboardEvents()
        refreshLoop()
        recorderEvents()

        // debug
        canvas.on('mouse:down', function (e) {
            obj = e.target
        })
    }

    var recorderEvents = function () {
        $('#animate').on('change', function () {
            if ($(this).is(':checked')) {
                return recorder.record()
            }

            recorder.pause()
        })

        $('#looping').on('change', function(){
            if($(this).is(':checked')){
                return recorder.looping = true
            }

            recorder.looping = false
        })
    }

    var refreshLoop = function () {
        canvas.renderAll()
        window.requestAnimationFrame(refreshLoop)
    }

    var resizeEvents = function () {
        $(window).on('resize', function () {
            canvas
                .setWidth(div.innerWidth())
                .setHeight(div.innerHeight())
        })
    }

    var keyboardEvents = function () {
        $(window).on('keydown', function (e) {
            var obj = canvas.getActiveObject()

            if (e.which === 46 && obj !== null) {
                obj.remove()
            }
        })
    }

    var toolboxEvents = function () {
        toolbox.find('[data-tool]').on('click', function () {
            var selectedTool = $(this).data('tool')

            if (selectedTool === currentTool || tools[selectedTool] === undefined) {
                return
            }

            // Desativa ferramenta atual se houver alguma
            if (currentTool !== null) {
                tools[currentTool].deactivate()
            }

            // Muda para a ferramenta escolhida
            currentTool = $(this).data('tool')

            // Ativa a nova ferramenta
            tools[currentTool].activate()

            // Deseleciona todas as ferramentas
            $('[data-tool]').removeClass('selected')

            // Seleciona a ferramenta clicada
            $(this).addClass('selected')
        })
    }

    var setupTools = function () {
        tools = {
            pencil:  new Animapp.Tool.Pencil(canvas, $('[data-tool="pencil"]')),
            color:   new Animapp.Tool.Color(canvas, $('[data-tool="color"]')),
            line:    new Animapp.Tool.Line(canvas, $('[data-tool="line"]')),
            rect:    new Animapp.Tool.Rect(canvas, $('[data-tool="rect"]')),
            ellipse: new Animapp.Tool.Ellipse(canvas, $('[data-tool="ellipse"]')),
            file:    new Animapp.Tool.File(canvas, $('[data-tool="file"]')),
            eraser:  new Animapp.Tool.Eraser(canvas, $('[data-tool="eraser"]')),
            move:    new Animapp.Tool.Move(canvas, $('[data-tool="move"]')),
            bucket:  new Animapp.Tool.Bucket(canvas, $('[data-tool="bucket"]'))
        }
    }

    this.initialize = function () {
        createCanvas()
        createRecorder()
        registerEvents()
        setupTools()
    }
}
 