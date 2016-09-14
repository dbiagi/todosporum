$(document).ready(function() {
	$(".logo-sketch").fancybox({
		helpers:  {
        title : {
            type : 'inside',
            position: 'top'
        }
    }
	});
	$(".logo-final").fancybox({
		helpers:  {
        title : {
            type : 'inside',
            position: 'top'
        }
    }
	});
	$(".layout").fancybox({
		helpers:  {
        title : {
            type : 'inside',
            position: 'top'
        }
    }
	});
	$(".paudefitas").fancybox();
	$(".videos").fancybox({
		prevEffect	: 'none',
		nextEffect	: 'none'
	});

	$( "#login" ).validate({
	  rules: {
	    email: {
	      required: true,
	      email: true
	    },
	    senha: "required"
	  },
	  messages: {
	    email: {
	      required: "Preencha seu email",
	      email: "Email inválido"
	    },
	    senha: "Preencha sua senha."
	  }
	});
	$( "#cadastro" ).validate({
	  rules: {
	    email: {
	      required: true,
	      email: true
	    },
	    name: "required",
	    pass1: "required",
	    pass2: {
	      required: true,
	      equalTo: "#senha"
	    }
	  },
	  messages: {
	    email: {
	      required: "Preencha seu email",
	      email: "Email inválido"
	    },
	    name: "Preencha seu nome.",
	    pass1: "Preencha sua senha.",
	    pass2: {
		  required: "Confirme sua senha",
	      equalTo: "A senha e a confirmação precisam ser iguais."
	    }
	  }
	});
	$( "#contato" ).validate({
	  rules: {
	    nome: "required",
	   	email: {
	      required: true,
	      email: true
	    },
	    msg: "required"
	  },
	  messages: {
	    nome: "Nos diga seu nome.",
	    email: {
	      required: "Precisamos de um endereço para te responder.",
	      email: "Email inválido"
	    },
	    msg: "Escreva sua mensagem."
	  }
	});
});