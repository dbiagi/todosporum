/**
 * Grava as interações
 * @param {fabric.Canvas} canvas
 * @constructor
 */
Animapp.Recorder = function (canvas) {
    var states = Animapp.Recorder.State

    /** @type {Number} */
    var currentState = states.STOPPED

    /** @type {Boolean} */
    var looping = false

    Object.defineProperties(this, {
        'state': {
            enumerable: true,
            get:        function () {
                return currentState
            }
        },
        'looping': {
            enumerable: true,
            get: function () {
                return looping
            },
            set: function (value) {
                looping = value
            }
        }
    })

    var objMove = function(e){
        console.log(e)
    }

    var registerEvents = function () {
        canvas.on('object:moving', objMove)
    }

    var unregisterEvents = function () {
        canvas.off('object:moving', objMove)
    }

    this.record = function () {
        currentState = states.RECORDING
        registerEvents()
    }

    this.pause = function () {
        currentState = states.PAUSED
        unregisterEvents()
    }

    this.stop = function () {
        currentState = states.STOPPED
        unregisterEvents()
    }

}

Animapp.Recorder.State = {
    PAUSED:    1,
    STOPPED:   2,
    RECORDING: 3,
    PLAYING:   4
}