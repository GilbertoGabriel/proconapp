/**
 * Handler
 * 
 * @author Mario Sakamoto <mskamot@gmail.com>
 * @license MIT http://www.opensource.org/licenses/MIT
 * @see https://wtag.com.br/getz
 */

/*
 * @example After response
 *
function tableRES(response, method) {
	var res = JSON.parse(response);

	if (res["message"] == "success")
		alert("Success!");
	else
		alert("Error!");

	if (method == "method")
		alert("method");
}
 */

function loginRES(response, method) {
	var res = JSON.parse(response);

	if (method == "login") {
		if (res["message"] == "success")
			goTo("/" + gz_home + "/1");	
		else
			showMessage(gz_titleAttetion, gz_msgErrorChangeInfo, "cancel();");
	}
}

function logoutRES(response, method) {
	var res = JSON.parse(response);
	
	if (method == "logout") {
		if (res["message"] == "success")
			goTo("/login/1");
		else
			showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
	}
}

function minha_contaRES(response, method) {
	var res = JSON.parse(response);
	
	if (method == "update") {
		if (res["message"] == "success")
			showMessage(gz_titleAttetion, gz_msgSuccess, "goTo('/" + gz_home + "/1');");		
		else
			showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
	}
}

function mudar_fotoRES(response, method) {
	var res = JSON.parse(response);
	
	if (method == "update") {
		if (res["message"] == "success")
			showMessage(gz_titleAttetion, gz_msgSuccess, "goTo('/" + gz_home + "/1');");		
		else
			showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
	}
}

/*
 * Insert your code here
 */			

/*
 * @example After selecting the item in <select>
 *
function screen_tableSHDL() { 
	var select = gI("screen.reference");

	for (var i = 0; i < select.length; i++) {
		select.remove(i);
	}
}
 */

/*
 * Insert your code here
 */	 
 
/*
 * @example Execute after the render
 *
function screen_tableHDL() { }
 */

function loginHDL() {
	sD(gI("gz-menu"), "none");
}

/*
 * Insert your code here
 */	

/**
 * Dashboard HDL.
 * 
function dashboardHDL() { 
	graphic("column", columnl, columnc, "", "", false, "#009688");
	pizza("total");
} */
function dashboardHDL() { 
	pizza("total");
}

/**
 * Relatórios HDL.
 *
function relatoriosHDL() {
	gz_method = "statePrint";
} */
			
function categoriasHDL() { /* Insert your code here... */ }
				
function categoriasRES(response, method) {
	var res = JSON.parse(response);

	if (res["message"] == "success") {
		if (location.hash == "#from-screen") {
			window.close();
		} else {
			requestHandler(method);
		}
	} else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
					
function datalistReferenceCor(datalist) {
	if (document.getElementsByName("cor")[0].value == "") {
		for (var i = 0; i < gI("cores").options.length; i++) {
			if (gI("cores").options[i].value == datalistReference) {
				document.getElementsByName("cor")[0].value = datalistReference;
			}
		}	
	}
	isNull(datalist);
}
			
function coresHDL() { /* Insert your code here... */ }
				
function coresRES(response, method) {
	var res = JSON.parse(response);

	if (res["message"] == "success") {
		if (location.hash == "#from-screen") {
			window.close();
		} else {
			requestHandler(method);
		}
	} else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
			
function enderecosHDL() { /* Insert your code here... */ }
				
function enderecosRES(response, method) {
	var res = JSON.parse(response);

	if (res["message"] == "success") {
		if (location.hash == "#from-screen") {
			window.close();
		} else {
			requestHandler(method);
		}
	} else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
			
function estabelecimentosHDL() { /* Insert your code here... */ }
				
function estabelecimentosRES(response, method) {
	var res = JSON.parse(response);

	if (res["message"] == "success") {
		if (location.hash == "#from-screen") {
			window.close();
		} else {
			requestHandler(method);
		}
	} else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
					
function datalistReferenceEndereco(datalist) {
	if (document.getElementsByName("endereco")[0].value == "") {
		for (var i = 0; i < gI("enderecos").options.length; i++) {
			if (gI("enderecos").options[i].value == datalistReference) {
				document.getElementsByName("endereco")[0].value = datalistReference;
			}
		}	
	}
	isNull(datalist);
}
			
function marcasHDL() { /* Insert your code here... */ }
				
function marcasRES(response, method) {
	var res = JSON.parse(response);

	if (res["message"] == "success") {
		if (location.hash == "#from-screen") {
			window.close();
		} else {
			requestHandler(method);
		}
	} else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
			
function menusHDL() { /* Insert your code here... */ }
				
function menusRES(response, method) {
	var res = JSON.parse(response);

	if (res["message"] == "success") {
		if (location.hash == "#from-screen") {
			window.close();
		} else {
			requestHandler(method);
		}
	} else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
			
function perfil_telaHDL() { /* Insert your code here... */ }
				
function perfil_telaRES(response, method) {
	var res = JSON.parse(response);

	if (res["message"] == "success") {
		if (location.hash == "#from-screen") {
			window.close();
		} else {
			requestHandler(method);
		}
	} else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
					
function datalistReferencePerfil(datalist) {
	if (document.getElementsByName("perfil")[0].value == "") {
		for (var i = 0; i < gI("perfis").options.length; i++) {
			if (gI("perfis").options[i].value == datalistReference) {
				document.getElementsByName("perfil")[0].value = datalistReference;
			}
		}	
	}
	isNull(datalist);
}
					
function datalistReferencePermissao(datalist) {
	if (document.getElementsByName("permissao")[0].value == "") {
		for (var i = 0; i < gI("permissoes").options.length; i++) {
			if (gI("permissoes").options[i].value == datalistReference) {
				document.getElementsByName("permissao")[0].value = datalistReference;
			}
		}	
	}
	isNull(datalist);
}
					
function datalistReferenceTela(datalist) {
	if (document.getElementsByName("tela")[0].value == "") {
		for (var i = 0; i < gI("telas").options.length; i++) {
			if (gI("telas").options[i].value == datalistReference) {
				document.getElementsByName("tela")[0].value = datalistReference;
			}
		}	
	}
	isNull(datalist);
}
			
function perfisHDL() { /* Insert your code here... */ }
				
function perfisRES(response, method) {
	var res = JSON.parse(response);

	if (res["message"] == "success") {
		if (location.hash == "#from-screen") {
			window.close();
		} else {
			requestHandler(method);
		}
	} else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
			
function permissoesHDL() { /* Insert your code here... */ }
				
function permissoesRES(response, method) {
	var res = JSON.parse(response);

	if (res["message"] == "success") {
		if (location.hash == "#from-screen") {
			window.close();
		} else {
			requestHandler(method);
		}
	} else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
			
function produto_precosHDL() { /* Insert your code here... */ }
				
function produto_precosRES(response, method) {
	var res = JSON.parse(response);

	if (res["message"] == "success") {
		if (location.hash == "#from-screen") {
			window.close();
		} else {
			requestHandler(method);
		}
	} else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
					
function datalistReferenceProduto(datalist) {
	if (document.getElementsByName("produto")[0].value == "") {
		for (var i = 0; i < gI("produtos").options.length; i++) {
			if (gI("produtos").options[i].value == datalistReference) {
				document.getElementsByName("produto")[0].value = datalistReference;
			}
		}	
	}
	isNull(datalist);
}
					
function datalistReferenceEstabelecimento(datalist) {
	if (document.getElementsByName("estabelecimento")[0].value == "") {
		for (var i = 0; i < gI("estabelecimentos").options.length; i++) {
			if (gI("estabelecimentos").options[i].value == datalistReference) {
				document.getElementsByName("estabelecimento")[0].value = datalistReference;
			}
		}	
	}
	isNull(datalist);
}
			
function produtosHDL() { /* Insert your code here... */ }
				
function produtosRES(response, method) {
	var res = JSON.parse(response);

	if (res["message"] == "success") {
		if (location.hash == "#from-screen") {
			window.close();
		} else {
			requestHandler(method);
		}
	} else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
					
function datalistReferenceCategoria(datalist) {
	if (document.getElementsByName("categoria")[0].value == "") {
		for (var i = 0; i < gI("categorias").options.length; i++) {
			if (gI("categorias").options[i].value == datalistReference) {
				document.getElementsByName("categoria")[0].value = datalistReference;
			}
		}	
	}
	isNull(datalist);
}
					
function datalistReferenceMarca(datalist) {
	if (document.getElementsByName("marca")[0].value == "") {
		for (var i = 0; i < gI("marcas").options.length; i++) {
			if (gI("marcas").options[i].value == datalistReference) {
				document.getElementsByName("marca")[0].value = datalistReference;
			}
		}	
	}
	isNull(datalist);
}
			
function situacoes_registrosHDL() { /* Insert your code here... */ }
				
function situacoes_registrosRES(response, method) {
	var res = JSON.parse(response);

	if (res["message"] == "success") {
		if (location.hash == "#from-screen") {
			window.close();
		} else {
			requestHandler(method);
		}
	} else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
					
function datalistReferenceCor(datalist) {
	if (document.getElementsByName("cor")[0].value == "") {
		for (var i = 0; i < gI("cores").options.length; i++) {
			if (gI("cores").options[i].value == datalistReference) {
				document.getElementsByName("cor")[0].value = datalistReference;
			}
		}	
	}
	isNull(datalist);
}
			
function telasHDL() { /* Insert your code here... */ }
				
function telasRES(response, method) {
	var res = JSON.parse(response);

	if (res["message"] == "success") {
		if (location.hash == "#from-screen") {
			window.close();
		} else {
			requestHandler(method);
		}
	} else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
					
function datalistReferenceMenu(datalist) {
	if (document.getElementsByName("menu")[0].value == "") {
		for (var i = 0; i < gI("menus").options.length; i++) {
			if (gI("menus").options[i].value == datalistReference) {
				document.getElementsByName("menu")[0].value = datalistReference;
			}
		}	
	}
	isNull(datalist);
}
			
function usuariosHDL() { /* Insert your code here... */ }
				
function usuariosRES(response, method) {
	var res = JSON.parse(response);

	if (res["message"] == "success") {
		if (location.hash == "#from-screen") {
			window.close();
		} else {
			requestHandler(method);
		}
	} else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
					
function datalistReferenceSituacao_registro(datalist) {
	if (document.getElementsByName("situacao_registro")[0].value == "") {
		for (var i = 0; i < gI("situacoes_registros").options.length; i++) {
			if (gI("situacoes_registros").options[i].value == datalistReference) {
				document.getElementsByName("situacao_registro")[0].value = datalistReference;
			}
		}	
	}
	isNull(datalist);
}
					
function datalistReferencePerfil(datalist) {
	if (document.getElementsByName("perfil")[0].value == "") {
		for (var i = 0; i < gI("perfis").options.length; i++) {
			if (gI("perfis").options[i].value == datalistReference) {
				document.getElementsByName("perfil")[0].value = datalistReference;
			}
		}	
	}
	isNull(datalist);
}
			
function cardsHDL() { /* Insert your code here... */ }
				
function cardsRES(response, method) {
	var res = JSON.parse(response);

	if (res["message"] == "success") {
		if (location.hash == "#from-screen") {
			window.close();
		} else {
			requestHandler(method);
		}
	} else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
			
function estabelecimento_produtosHDL() { /* Insert your code here... */ }
				
function estabelecimento_produtosRES(response, method) {
	var res = JSON.parse(response);

	if (res["message"] == "success") {
		if (location.hash == "#from-screen") {
			window.close();
		} else {
			requestHandler(method);
		}
	} else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
					
function datalistReferenceEstabelecimento(datalist) {
	if (document.getElementsByName("estabelecimento")[0].value == "") {
		for (var i = 0; i < gI("estabelecimentos").options.length; i++) {
			if (gI("estabelecimentos").options[i].value == datalistReference) {
				document.getElementsByName("estabelecimento")[0].value = datalistReference;
			}
		}	
	}
	isNull(datalist);
}
					
function datalistReferenceProduto(datalist) {
	if (document.getElementsByName("produto")[0].value == "") {
		for (var i = 0; i < gI("produtos").options.length; i++) {
			if (gI("produtos").options[i].value == datalistReference) {
				document.getElementsByName("produto")[0].value = datalistReference;
			}
		}	
	}
	isNull(datalist);
}
			
function estabelecimento_produtos_precoHDL() { /* Insert your code here... */ }
				
function estabelecimento_produtos_precoRES(response, method) {
	var res = JSON.parse(response);

	if (res["message"] == "success") {
		if (location.hash == "#from-screen") {
			window.close();
		} else {
			requestHandler(method);
		}
	} else
		showMessage(gz_titleAttetion, gz_msgErrorServer, "cancel();");
}
					
function datalistReferenceEstabelecimeto_produto(datalist) {
	if (document.getElementsByName("estabelecimeto_produto")[0].value == "") {
		for (var i = 0; i < gI("estabelecimento_produtos").options.length; i++) {
			if (gI("estabelecimento_produtos").options[i].value == datalistReference) {
				document.getElementsByName("estabelecimeto_produto")[0].value = datalistReference;
			}
		}	
	}
	isNull(datalist);
}