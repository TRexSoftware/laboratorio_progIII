//VALIDA CAMPO OBLIGATORIO
function validaVacio(valor){
	if (valor===null || valor.length===0 || /^\s+$/.test(valor)){
		alert("ERROR: Debe ingresar un valor obligatorio");
		return false;
	}
}
        
//PONE EL FOCO EN EL ELEMENTO
function foco(idElemento){
	document.getElementById(idElemento).focus();
}

//CONTROLA SI EL VALOR ES NUMERICO
function validaNumerico(valor){
	if(isNaN(valor)){
		alert("ERROR: Debe ingresar un valor numérico");
		return false;
	}
}

// VALIDAR SESION
function validarSesion() {
    if(validaVacio(document.getElementById("email").value) === false) {
        foco("email");
        return false;
    } else {
        if(validaVacio(document.getElementById("pass").value) === false) {
            foco("pass");
            return false;
        } else
            return true;
    }
}
//VALIDAR CAMPOS DE REGISTRAR
function validarRegistro() {
    //comprueba el campo NOMBRE
    valor = document.getElementById("name").value;
    if (validaVacio(valor)) {
        foco("name");
        return false;
    } else {
        // Comprueba el campo APELLIDO
        resultado = validaVacio(document.getElementById("lastn").value);
        if(resultado === false) {
            foco("lastn");
            return false;
        } else {
            // Comprueba el campo SEXO
            if(validaVacio(document.getElementById("sexo").value) === false) {
                foco("sexo");
                return false;
            } else {
                if(validaVacio(document.getElementById("fecnac").value) === false) {
                    foco("fecnac");
                    return false;
                } else {
                    if(validaVacio(document.getElementById("direccion").value) === false) {
                        foco("direccion");
                        return false;
                    } else {
                        if(validaVacio(document.getElementById("email").value) === false) {
                            foco("email");
                            return false;
                        } else {
                            if(validaVacio(document.getElementById("pass").value) === false) {
                                foco("pass");
                                return false;
                            } else {
                                if(validaVacio(document.getElementById("dni").value) === false) {
                                    foco("dni");
                                    return false;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

//COMPRUEBA SI LA FECHA ES VALIDA
function existeFecha(fecha){
	var fechaf = fecha.split("/");
	var day = fechaf[0];
	var month = fechaf[1];
	var year = fechaf[2];
	var date = new Date(year,month,'0');
	if((day-0)>(date.getDate()-0)){
		return false;
	}
	return true;
}

//COMPRUEBA EL FORMATO DE LA FECHA
function validaFecha(campo) {
	var RegExPattern = /^\d{1,2}\/\d{1,2}\/\d{2,4}$/;
	if ((campo.match(RegExPattern)) && (campo!=='')) {
		if(existeFecha(campo)){
			return true;
		}else{
			alert("ERROR: Fecha Incorrecta, no existe "+campo);
			return false;
			}
	}else{
		alert("ERROR: Debe ingresar un formato de fecha valido");
		return false;
	}
}
