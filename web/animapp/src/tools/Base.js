Animapp.Tool.Base = function () {
    var _name = null

    Object.defineProperties(this, {
        name: {
            get: function () {
                return _name
            }
        }
    })

    this.active = function () {
        throw 'not implemented'
    }
}

Animapp.Tool.Base.prototype = new EventEmitter()