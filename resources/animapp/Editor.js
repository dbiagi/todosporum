/**
 * Editor animapp.
 * @param {Object} div Div do editor.
 * @param {Object} toolbox Lista da toolbox.
 * @constructor
 */
export class AnimappEditor {
    constructor(div, toolbox) {
        this.div = div;
        this.toolbox = toolbox;
        this.canvas = null;
        this.currentTool = null;
        this.tools = {};
        this.recorder = null;
    }

    createCanvas() {
        const el = $('<canvas>', {
            attr: {
                id: 'animapp-canvas',
                width: div.innerWidth(),
                height: div.innerHeight(),
                'data-color': 'black'
            }
        });

        el.appendTo(div);

        this.canvas = new fabric.Canvas('animapp-canvas', {
            selection: false
        });
        this.canvas.color = '#000';
        this.canvas.freeDrawingBrush.color = canvas.color;
        this.canvas.freeDrawingBrush.width = 5;

        const content = $(div).data('content');

        if (content) {
            this.canvas.loadFromJSON(content);
        }

        // Deixa o objeto canvas disponível globalmente para fins de debug somente
        window.canvas = this.canvas;
    }

    createRecorder() {
        this.recorder = new Animapp.Recorder(canvas);
    }

    registerEvents() {
        this.resizeEvents();
        this.toolboxEvents();
        this.keyboardEvents();
        this.refreshLoop();
        this.recorderEvents();
        this.formEvents();
    }

    recorderEvents() {
        $('#animate').on('change', function () {
            if ($(this).is(':checked')) {
                return recorder.record();
            }

            this.recorder.pause();
        });

        $('#looping').on('change', function () {
            if ($(this).is(':checked')) {
                return recorder.looping = true;
            }

            recorder.looping = false;
        });
    }

    refreshLoop() {
        this.canvas.renderAll();
        window.requestAnimationFrame(this.refreshLoop);
    }

    resizeEvents() {
        $(window).on('resize', () => {
            this.canvas.setWidth(div.innerWidth())
                .setHeight(div.innerHeight());
        });
    }

    keyboardEvents() {
        $(window).on('keydown', (e) => {
            const obj = this.canvas.getActiveObject(),
                group = this.canvas.getActiveGroup();

            if (46 === e.which) {
                if (null !== obj) {
                    obj.remove();
                }

                if (null !== group) {

                    group.getObjects().forEach(function (obj) {
                        obj.remove();
                    });
                    group.removeWithUpdate();
                }
            }
        });
    }

    toolboxEvents() {
        this.toolbox.find('[data-tool]').on('click', () => {
            const selectedTool = $(this).data('tool');

            if (selectedTool === this.currentTool || tools[selectedTool] === undefined) {
                return;
            }

            // Desativa ferramenta atual se houver alguma
            if (this.currentTool !== null) {
                this.tools[this.currentTool].deactivate();
            }

            // Muda para a ferramenta escolhida
            this.currentTool = $(this).data('tool');

            // Ativa a nova ferramenta
            this.tools[this.currentTool].activate();

            // Deseleciona todas as ferramentas
            $('[data-tool]').removeClass('selected');

            // Seleciona a ferramenta clicada
            $(this).addClass('selected');
        });
    }

    setupTools() {
        this.tools = {
            pencil: new Animapp.Tool.Pencil(canvas, $('[data-tool="pencil"]')),
            color: new Animapp.Tool.Color(canvas, $('[data-tool="color"]')),
            line: new Animapp.Tool.Line(canvas, $('[data-tool="line"]')),
            rect: new Animapp.Tool.Rect(canvas, $('[data-tool="rect"]')),
            ellipse: new Animapp.Tool.Ellipse(canvas, $('[data-tool="ellipse"]')),
            file: new Animapp.Tool.File(canvas, $('[data-tool="file"]')),
            eraser: new Animapp.Tool.Eraser(canvas, $('[data-tool="eraser"]')),
            move: new Animapp.Tool.Move(canvas, $('[data-tool="move"]')),
            bucket: new Animapp.Tool.Bucket(canvas, $('[data-tool="bucket"]'))
        };
    }

    formEvents() {
        $('#save-form').submit(function (e) {
            const $form = $(this);

            $form.append($('<input>', {
                type: 'hidden',
                name: 'content',
                value: JSON.stringify(canvas)
            }));

            $form.append($('<input>', {
                type: 'hidden',
                name: 'thumbnail',
                value: canvas.toDataURL()
            }));
        });
    }

    initialize() {
        this.createCanvas();
        this.createRecorder();
        this.registerEvents();
        this.setupTools();
    }
}
 