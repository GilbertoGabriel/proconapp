/**
 * Extras.
 * 
 * @author  Mario Sakamoto <mskamot@gmail.com>
 * @license MIT http://www.opensource.org/licenses/MIT
 * @see     https://wtag.com.br/divmon
 * @version 1.0.0, 26 Jul 2014
 */

var dv_root = "http://localhost:8000/@_YOUR_PROJECT";
// var dv_root = "https://@_YOUR_PROJECT.com.br";
var dv_gateway = "http://localhost:8000/@_YOUR_PROJECT-api/api";
// var dv_gateway = "https://@_YOUR_PROJECT.com.br/@_YOUR_PROJECT-api";

/**
 * Request example.
 */
function requestExample() {
	if (validate(gI("dv-form"))) {
		var data = {
			"@_YOUR_COLUMN_01" : gV(gI("@_YOUR_COLUMN_01")),
			"@_YOUR_COLUMN_02" : gV(gI("@_YOUR_COLUMN_02"))
		};		
		request("POST", dv_gateway + "/@_YOUR_API", "", data, "responseExample", true, getCookie(gz_project));
	}
}

/**
 * Response example.
 *
 * @param {String} response 
 */
function responseExample(json) {
	var response = JSON.parse(json);
	if (!isEmpty(response)) {
		if (response.response.status == 200) {
			showMessage("Sucesso!", "A operação foi concluída com sucesso.<br><button type=\"button\" id=\"dv-close-message\" class=\"dv-auto-width dv-margin-top-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-blue dv-underline dv-cursor\" onclick=\"location.reload();\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
				dv_root + "/mod/page/img/icon/gray-close-circle-line.svg\" width=16>Fechar a mensagem</button>", 
				"green-check-circle-line.svg", "location.reload();");
		} else {	
			showMessage("Erro!", response.response.message + "<br><button type=\"button\" id=\"dv-close-message\" class=\"dv-auto-width dv-margin-top-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-blue dv-underline dv-cursor\" onclick=\"showMessage();\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
				dv_root + "/mod/page/img/icon/gray-close-circle-line.svg\" width=16>Fechar a mensagem</button>", 
				"red-close-circle-line.svg", "showMessage();");			
		}
	} else {
			showMessage("Erro!", "Houve algum erro interno no sistema.<br><button type=\"button\" id=\"dv-close-message\" class=\"dv-auto-width dv-margin-top-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-blue dv-underline dv-cursor\" onclick=\"showMessage();\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
				dv_root + "/mod/page/img/icon/gray-close-circle-line.svg\" width=16>Fechar a mensagem</button>", 
				"red-close-circle-line.svg", "showMessage();");	
	}
}

/**
 * Get selected line example.
 *
 * @param {Object} element 
 */
function getSelectedLineExample(element) {
	alert("Check your console.log");
	console.log(element.id);
}

/**
 * Form example.
 */
function formExample() {
	if (validate(gI("dv-form"))) {
		alert("Check your console.log");
		var data = {
			"users.name" : gV(gI("users.name")),
			"users.nick" : gV(gI("users.nick")),
			"users.birthday" : gV(gI("users.birthday")),
			"users.photo" : gV(gI("users.photo-base64")),
			"users.about" : gV(gI("users.about")),
			"users.city" : gV(gI("users.city")),
			"users.cities" : getDataListId("cities", "city"),
			"users.cellphone" : gV(gI("users.cellphone")),
			"users.mail" : gV(gI("users.mail")),
			"radio" : gI("first-radio").checked ? gV(gI("first-radio")) : gI("second-radio").checked ? 
					gV(gI("second-radio")) : gV(gI("third-radio")),
			"checkbox" : [
				{
					"item" : gI("first-checkbox").checked ? gV(gI("first-checkbox")) : null
				}, 
				{
					"item" : gI("second-checkbox").checked ? gV(gI("second-checkbox")) : null	
				},
				{
					"item" : gI("third-checkbox").checked ? gV(gI("third-checkbox")) : null	
				},
				{
					"item" : gI("fourth-checkbox").checked ? gV(gI("fourth-checkbox")) : null	
				}				
			]
		};
		console.log(data);
	}
}

/**
 * Go to search page.
 */
function searchExample() {
	goTo("/posts/search/" + gV(gI("search")));
}

/*
 * Controller response.
 *
 * @param {String} json 
 */
function controllerResponse(json) {
	var response = JSON.parse(json);
	if (!isEmpty(response)) {
		if (response.response.status == 200) {
			sD(gI("dv-message"), "none");
			showMessage("Sucesso!", "A operação foi concluída com sucesso.<br><button type=\"button\" id=\"dv-close-message\" class=\"dv-auto-width dv-margin-top-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-blue dv-underline dv-cursor\" onclick=\"location.reload();\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
					dv_root + "/mod/page/img/icon/gray-close-circle-line.svg\" width=16>Fechar a mensagem</button>", 
					"green-check-circle-line.svg", "location.reload();");
		} else {
			sD(gI("dv-message"), "none");
			showMessage("Erro!", response.response.message + "<br><button type=\"button\" id=\"dv-close-message\" class=\"dv-auto-width dv-margin-top-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-blue dv-underline dv-cursor\" onclick=\"showMessage();\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
					dv_root + "/mod/page/img/icon/gray-close-circle-line.svg\" width=16>Fechar a mensagem</button>", 
					"red-close-circle-line.svg", "showMessage();");		
		}
	} else {
		sD(gI("dv-message"), "none");
		showMessage("Erro!", "Atenção! Houve algum erro interno no sistema.<br><button type=\"button\" id=\"dv-close-message\" class=\"dv-auto-width dv-margin-top-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-blue dv-underline dv-cursor\" onclick=\"showMessage();\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
				dv_root + "/mod/page/img/icon/gray-close-circle-line.svg\" width=16>Fechar a mensagem</button>", 
				"red-close-circle-line.svg", "showMessage();");		
	}
}

/*
 * Crud show create.
 */
function crudShowCreate() {
	sV(gI("crud.id"), "");
	sV(gI("crud.field"), "");				
	sV(gI("crud.file-base64"), "");
	sD(gI("dv-clear-selected-file-crud.file"), "none");
	sD(gI("dv-download-file-crud.file"), "none");
	sH(gI("dv-form-controller-title-content"), "Adicionar um novo registro");
	sD(gI("form"), "block");
	sF(gI("crud.field"));
}

/*
 * Crud show update.
 */
function crudShowUpdate(id) {
	request("GET", dv_gateway + "/crud/resource/" + id, "", null, "crudShowUpdateResponse", true, getCookie(gz_project));
}

/*
 * Crud show update response.
 *
 * @param {String} json 
 */
function crudShowUpdateResponse(json) {
	var response = JSON.parse(json);
	if (!isEmpty(response)) {
		if (response.response.status == 200) {
			sV(gI("crud.id"), response[0]["crud.id"]);
			sV(gI("crud.field"), response[0]["crud.field"]);				
			sD(gI("dv-clear-selected-file-crud.file"), "none");
			if (response[0]["crud.file"] != "") {
				gI("dv-download-file-crud.file").onclick = function() {
					goToBlank(dv_root + "/file/crud/" + response[0]["crud.id"]);
				};
				sD(gI("dv-download-file-crud.file"), "inline-block;");
			} else {
				sD(gI("dv-download-file-crud.file"), "none");
			}
			sH(gI("dv-form-controller-title-content"), "Editar os dados do registro");
			sD(gI("form"), "block");
			sF(gI("crud.field"));
		} else {
			showMessage("Erro!", response.response.message + "<br><button type=\"button\" id=\"dv-close-message\" class=\"dv-auto-width dv-margin-top-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-blue dv-underline dv-cursor\" onclick=\"location.reload();\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
					dv_root + "/mod/page/img/icon/gray-close-circle-line.svg\" width=16>Fechar a mensagem</button>", 
					"red-close-circle-line.svg", "location.reload();");		
		}
	} else {
		showMessage("Erro!", "Houve algum erro interno no sistema.<br><button type=\"button\" id=\"dv-close-message\" class=\"dv-auto-width dv-margin-top-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-blue dv-underline dv-cursor\" onclick=\"location.reload();\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
				dv_root + "/mod/page/img/icon/gray-close-circle-line.svg\" width=16>Fechar a mensagem</button>", 
				"red-close-circle-line.svg", "location.reload();");		
	}
}

/*
 * Crud delete.
 */
function crudDelete(id) {
	showMessage("Confirmação!", "Você realmente deseja excluir o registro?<br><button type=\"button\" id=\"dv-no\" class=\"dv-auto-width dv-margin-top-mdpi dv-margin-right-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-red dv-underline dv-cursor\" onclick=\"showMessage();\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
			dv_root + "/mod/page/img/icon/red-close-circle-line.svg\" width=16>Não</button><button type=\"button\" class=\"dv-auto-width dv-margin-top-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-blue dv-underline dv-cursor\" onclick=\"crudDeleteRequest(" + id + ");\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
			dv_root + "/mod/page/img/icon/check-circle-line.svg\" width=16>Sim</button>", "red-alert.svg", "showMessage();");
}
	
/*
 * Crud delete request.
 */
function crudDeleteRequest(id) {
	var data = {
		"id" : id
	};
	request("DELETE", dv_gateway + "/crud/resource/" + id, "", data, "controllerResponse", true, getCookie(gz_project));
}

/*
 * Crud controller.
 */
function crudController() {
	var data = {
		"id" : gV(gI("crud.id")),
		"field" : gV(gI("crud.field")),
		"file" : gV(gI("crud.file-base64")),
		"fkInput" : {
			"id" : gz_code
		}
	};	
	if (gV(gI("crud.id")) != "") {
		if (validate(gI("dv-form"))) {
			request("PUT", dv_gateway + "/crud/resource/" + gV(gI("crud.id")), "", data, "controllerResponse", true, 
					getCookie(gz_project));
		}
	} else {
		if (validate(gI("dv-form"))) {
			request("POST", dv_gateway + "/crud", "", data, "controllerResponse", true, getCookie(gz_project));
		}
	}
}

/*
 * Criar uma conta request.
 */
function criarUmaContaRequest() {
	if (!gI("dv-termos-uso").checked) {
		showMessage("Atenção!", "É necessário marcar a opção \"Aceitar os termos de uso\" para continuar.<br><button type=\"button\" id=\"dv-close-message\" class=\"dv-auto-width dv-margin-top-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-blue dv-underline dv-cursor\" onclick=\"showMessage();\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
				dv_root + "/mod/page/img/icon/gray-close-circle-line.svg\" width=16>Fechar a mensagem</button>", 
				"red-alert.svg", "showMessage();");
	} else {
		if (validate(gI("dv-form"))) {
			var data = {
				"usuario" : gV(gI("usuario")),
				"email" : gV(gI("email")),
				"senha" : gV(gI("senha"))
			};
			request("POST", dv_gateway + "/criar_uma_conta", "", data, "criarUmaContaResponse", true, getCookie(gz_project));
		}
	}
}

/**
 * Criar uma conta response.
 */
function criarUmaContaResponse(json) {
	var response = JSON.parse(json);
	if (!isEmpty(response)) {
		if (response.response.status == 200) {
			showMessage("Sucesso!", "A sua conta foi criada com sucesso. Acesse a sua caixa de e-mail para ativar a sua conta.<br><button type=\"button\" id=\"dv-close-message\" class=\"dv-auto-width dv-margin-top-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-blue dv-underline dv-cursor\" onclick=\"goTo('/home');\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
					dv_root + "/mod/page/img/icon/gray-close-circle-line.svg\" width=16>Fechar a mensagem</button>", 
					"green-check-circle-line.svg", "goTo('/home');");
		} else {
			showMessage("Erro!", response.response.message + "<br><button type=\"button\" id=\"dv-close-message\" class=\"dv-auto-width dv-margin-top-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-blue dv-underline dv-cursor\" onclick=\"showMessage();\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
					dv_root + "/mod/page/img/icon/gray-close-circle-line.svg\" width=16>Fechar a mensagem</button>", 
					"red-close-circle-line.svg", "showMessage();");
		}
	} else {
		showMessage("Erro!", "Houve alguma erro interno no sistema.<br><button type=\"button\" id=\"dv-close-message\" class=\"dv-auto-width dv-margin-top-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-blue dv-underline dv-cursor\" onclick=\"showMessage();\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
				dv_root + "/mod/page/img/icon/gray-close-circle-line.svg\" width=16>Fechar a mensagem</button>", 
				"red-close-circle-line.svg", "showMessage();");
	}
}

/*
 * Efetuar o login request.
 */
function efetuarOLoginRequest() {
	if (validate(gI("dv-form"))) {
		var data = {
			"email" : gV(gI("email")),
			"senha" : gV(gI("senha"))
		};
		request("POST", dv_gateway + "/efetuar_o_login", "", data, "efetuarOLoginResponse", true, getCookie(gz_project));
	}
}

/**
 * Efetuar o login response.
 */
function efetuarOLoginResponse(json) {
	var response = JSON.parse(json);
	if (!isEmpty(response)) {
		if (response.response.status == 200) {
			setCookie(gz_project, response.response.usuarios.value.access_token, 365);
			goTo("/inicio");
		} else {
			showMessage("Erro!", response.response.message + "<br><button type=\"button\" id=\"dv-close-message\" class=\"dv-auto-width dv-margin-top-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-blue dv-underline dv-cursor\" onclick=\"showMessage();\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
					dv_root + "/mod/page/img/icon/gray-close-circle-line.svg\" width=16>Fechar a mensagem</button>", 
					"red-close-circle-line.svg", "showMessage();");		
		}
	} else {
		showMessage("Erro!", "Houve algum erro interno no sistema.<br><button type=\"button\" id=\"dv-close-message\" class=\"dv-auto-width dv-margin-top-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-blue dv-underline dv-cursor\" onclick=\"showMessage();\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
				dv_root + "/mod/page/img/icon/gray-close-circle-line.svg\" width=16>Fechar a mensagem</button>", 
				"red-close-circle-line.svg", "showMessage();");	
	}
}

/*
 * Esqueci a minha senha request.
 */
function esqueciAMinhaSenhaRequest() {
	if (validate(gI("dv-form"))) {
		var data = {
			"email" : gV(gI("email"))
		};
		request("POST", dv_gateway + "/esqueci_a_minha_senha", "", data, "esqueciAMinhaSenhaResponse", true, getCookie(gz_project));
	}
}

/**
 * Esqueci a minha senha response.
 */
function esqueciAMinhaSenhaResponse(json) {
	var response = JSON.parse(json);
	if (!isEmpty(response)) {
		if (response.response.status == 200) {
			showMessage("Sucesso!", "A operação foi realizada com sucesso. Acesse a sua caixa de e-mail para alterar a sua senha.<br><button type=\"button\" id=\"dv-close-message\" class=\"dv-auto-width dv-margin-top-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-blue dv-underline dv-cursor\" onclick=\"goTo('/home');\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
					dv_root + "/mod/page/img/icon/gray-close-circle-line.svg\" width=16>Fechar a mensagem</button>", 
					"green-check-circle-line.svg", "goTo('/home');");			
		} else {
			showMessage("Erro!", response.response.message + "<br><button type=\"button\" id=\"dv-close-message\" class=\"dv-auto-width dv-margin-top-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-blue dv-underline dv-cursor\" onclick=\"showMessage();\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
					dv_root + "/mod/page/img/icon/gray-close-circle-line.svg\" width=16>Fechar a mensagem</button>", 
					"red-close-circle-line.svg", "showMessage();");				
		}
	} else {
		showMessage("Erro!", "Houve algum erro interno no sistema.<br><button type=\"button\" id=\"dv-close-message\" class=\"dv-auto-width dv-margin-top-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-blue dv-underline dv-cursor\" onclick=\"showMessage();\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
				dv_root + "/mod/page/img/icon/gray-close-circle-line.svg\" width=16>Fechar a mensagem</button>", 
				"red-close-circle-line.svg", "showMessage();");	
	}
}

/*
 * Alterar a minha senha request.
 */
function alterarAMinhaSenhaRequest() {
	if (validate(gI("dv-form"))) {
		var data = {
			"senha" : gV(gI("senha"))
		};
		var authorization = gV(gI("password_token"));
		if (authorization == null || authorization == undefined) {
			authorization = getCookie(gz_project);
		}
		request("POST", dv_gateway + "/alterar_a_minha_senha", "", data, "alterarAMinhaSenhaResponse", true, authorization);
	}
}

/**
 * Alterar a minha senha response.
 */
function alterarAMinhaSenhaResponse(json) {
	var response = JSON.parse(json);
	if (!isEmpty(response)) {
		if (response.response.status == 200) {
			removeCookie(gz_project);
			showMessage("Sucesso!", "A operação foi realizada com sucesso.<br><button type=\"button\" id=\"dv-close-message\" class=\"dv-auto-width dv-margin-top-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-blue dv-underline dv-cursor\" onclick=\"goTo('/home');\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
					dv_root + "/mod/page/img/icon/gray-close-circle-line.svg\" width=16>Fechar a mensagem</button>", 
					"green-check-circle-line.svg", "goTo('/home');");				
		} else {
			showMessage("Erro!", response.response.message + "<br><button type=\"button\" id=\"dv-close-message\" class=\"dv-auto-width dv-margin-top-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-blue dv-underline dv-cursor\" onclick=\"showMessage();\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
					dv_root + "/mod/page/img/icon/gray-close-circle-line.svg\" width=16>Fechar a mensagem</button>", 
					"red-close-circle-line.svg", "showMessage();");				
		}
	} else {
		showMessage("Erro!", "Houve algum erro interno no sistema.<br><button type=\"button\" id=\"dv-close-message\" class=\"dv-auto-width dv-margin-top-mdpi dv-padding-mdpi dv-white-bg dv-border dv-radius dv-blue dv-underline dv-cursor\" onclick=\"showMessage();\"><img class=\"dv-vertical-align-middle dv-margin-right-ldpi\" src=\"" + 
				dv_root + "/mod/page/img/icon/gray-close-circle-line.svg\" width=16>Fechar a mensagem</button>", 
				"red-close-circle-line.svg", "showMessage();");	
	}
}

/**
 * Efetuar o logout.
 */
function efetuarOLogout() {
	removeCookie("portalunico");
	goTo("/home");
}

function showMenu(){
	if(gD(gI("menu")) == "block"){
		sD(gI("menu"), "none")
	}else{
		sD(gI("menu"), "block")
	}
}