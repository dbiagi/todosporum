Animapp.Tool.Base = function () {
    this.active = function () {
        throw 'not implemented'
    }

    this.deactive = function(){
        throw 'not  implemented'
    }
}

Animapp.Tool.Base.prototype = new EventEmitter()