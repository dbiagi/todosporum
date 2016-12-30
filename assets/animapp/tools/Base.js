Animapp.Tool.Base = function () {
    /**
     * Ativa a ferramenta.
     */
    this.active = function () {
        throw 'not implemented'
    }

    /**
     * Desativa a ferramenta.
     */
    this.deactive = function () {
        throw 'not  implemented'
    }
}

Animapp.Tool.Base.prototype = new EventEmitter()