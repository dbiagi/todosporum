Animapp.Tool.Base = function () {
    /**
     * Ativa a ferramenta.
     */
    this.activate = function () {
        throw 'not implemented'
    }

    /**
     * Desativa a ferramenta.
     */
    this.deactivate = function () {
        throw 'not  implemented'
    }
}

Animapp.Tool.Base.prototype = new EventEmitter()