/**
 * Editor animapp.
 * @param {Object} div Div do editor.
 * @param {Object} toolbox Lista da toolbox.
 * @constructor
 */
Animapp.Editor = function (div, toolbox) {
    var canvas = null,
        currentTool = null,
        tools = {},
        mouseIsDown = false

    var createCanvas = function () {
        var el = $('<canvas>', {
            attr: {
                id: 'animapp-canvas',
                width: div.innerWidth(),
                height: div.innerHeight(),
                'data-color': 'black'
            }
        })

        el.appendTo(div)

        canvas = new fabric.Canvas('animapp-canvas')
        canvas.color = '#000'
        canvas.freeDrawingBrush.color = canvas.color
        canvas.freeDrawingBrush.width = 5
        canvas.centeredScaling = true
        window.canvas = canvas

        $(window).on('resize', function () {
            canvas
                .setWidth(div.innerWidth())
                .setHeight(div.innerHeight())
        })

    }

    var registerEvents = function () {
        toolbox.find('[data-tool]').on('click', function () {
            var selectedTool = $(this).data('tool')

            if (selectedTool === currentTool || tools[selectedTool] === undefined) {
                return
            }

            // Desativa ferramenta atual se houver alguma
            if (currentTool !== null) {
                tools[currentTool].deactive()
            }

            // Muda para a ferramenta escolhida
            currentTool = $(this).data('tool')

            // Ativa a nova ferramenta
            tools[currentTool].active()

            // Deseleciona todas as ferramentas
            $('[data-tool]').removeClass('selected')

            // Seleciona a ferramenta clicada
            $(this).addClass('selected')
        })

        canvas.on('mouse:down', function () {
            mouseIsDown = true
        })
        canvas.on('mouse:move', function () {
            if (mouseIsDown) {
                canvas.renderAll()
            }
        })
        canvas.on('mouse:up', function () {
            mouseIsDown = false
        })
    }

    var setupTools = function () {
        tools = {
            pencil: new Animapp.Tool.Pencil(canvas, $('[data-tool="pencil"]')),
            color: new Animapp.Tool.Color(canvas, $('[data-tool="color"]')),
            line: new Animapp.Tool.Line(canvas, $('[data-tool="line"]')),
            rect: new Animapp.Tool.Rect(canvas, $('[data-tool="rect"]')),
            round: new Animapp.Tool.Round(canvas, $('[data-tool="round"]')),
            file: new Animapp.Tool.File(canvas, $('[data-tool="file"]')),
            eraser: new Animapp.Tool.Eraser(canvas, $('[data-tool="eraser"]')),
            move: new Animapp.Tool.Move(canvas, $('[data-tool="move"]'))
        }
    }

    this.initialize = function () {
        createCanvas()
        registerEvents()
        setupTools()
    }
}
 