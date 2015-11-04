 
//window.onload = alert('PAGINA CARGADA COMPLETAMENTE'); 

//VALIDA CAMPO OBLIGATORIO
function validaVacio(valor){
	if (valor==null || valor.length==0 || /^\s+$/.test(valor)){
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

//VALIDAR CAMPOS DE REGISTRAR
function validar_registrar() {

    //comprueba el campo NOMBRE Y APELLIDO
    valor = document.getElementById("nombreApellido").value;
    resultado = validaVacio(valor);
    if (resultado == false) {
        foco("nombreApellido");
        return false;
    } else {
        //comprueba el campo USUARIO
        valor = document.getElementById("usuario").value;
        resultado = validaVacio(valor);
        if (resultado == false) {
            foco("usuario");
            return false;
        } else {
            //comprueba el campo CONTRASEÑA
            valor = document.getElementById("contrasenia").value;
            resultado = validaVacio(valor);
            if (resultado == false) {
                foco("contrasenia");
                return false;
            } else {
                //comprueba el campo REPETIR CONTRASEÑA
                valor = document.getElementById("recontrasenia").value;
                resultado = validaVacio(valor);
                if (resultado == false) {
                    foco("recontrasenia");
                    return false;
                } else {
                    //comprueba el campo EMAIL
                    valor = document.getElementById("email").value;
                    resultado = validaVacio(valor);
                    if (resultado == false) {
                        foco("email");
                        return false;
                    } else {
                        //comprueba el campo TELEFONO
                        valor = document.getElementById("telefono").value;
                        resultado = validaVacio(valor);
                        if (resultado == false) {
                            foco("telefono");
                            return false;
                        } else {
                            resultado = validaNumerico(valor);
                            if (resultado == false) {
                                foco("telefono");
                                return false;
                            } else {
                                //CARGA CONTRASEÑA Y REPETIR CONTRASEÑA Y LAS VALIDA
                                valorcont = document.getElementById("contrasenia").value;
                                valorrecont = document.getElementById("recontrasenia").value;
                                result = validar_cont(valorcont,valorrecont);
                                if(result == false){
                                    foco("contrasenia");
                                    return false;
                                }else{
                                    return true;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}


//VALIDA CAMPOS DE INICIAR SESION
function validar_sesion() {

    //comprueba el campo USUARIO
    valor = document.getElementById("usuario").value;
    resultado = validaVacio(valor);
    if (resultado == false) {
        foco("usuario");
        return false;
    } else {
        //comprueba el campo CONTRASEÑA
        valor = document.getElementById("contrasenia").value;
        resultado = validaVacio(valor);
        if (resultado == false) {
            foco("contrasenia");
            return false;
        } else {
            return true;
        }
    }
}

//COMPRUEBA QUE CONTRASEÑA Y REPETIR CONTRASEÑA SEAN IGUALES
function validar_cont(valorcont,valorrecont) {
    
    if (valorcont != valorrecont) {
        alert("ERROR: Contraseña y Repetir Contraseña son diferentes");
        return false;
    }
}


//VALIDA CAMPOS ALTA DE PROPIEDAD
function validar_alta() {

    valor = document.getElementById("nombre").value;
    resultado = validaVacio(valor);
    if (resultado == false) {
        foco("nombre");
        return false;
    } else {
        valor = document.getElementById("destacado").value;
        resultado = validaVacio(valor);
        if (resultado == false) {
            foco("destacado");
            return false;
        } else {
            valor = document.getElementById("observaciones").value;
            resultado = validaVacio(valor);
            if (resultado == false) {
                foco("observaciones");
                return false;
            } else {
                valor = document.getElementById("capacidad").value;
                resultado = validaVacio(valor);
                if (resultado == false) {
                    foco("capacidad");
                    return false;
                } else {
                    resultado = validaNumerico(valor);
                    if (resultado == false) {
                        foco("capacidad");
                        return false;
                    } else {
                        valor = document.getElementById("disponibilidad").value;
                        resultado = validaVacio(valor);
                        if (resultado == false) {
                            foco("disponibilidad");
                            return false;
                        } else {
                            valor = document.getElementById("direccion").value;
                            resultado = validaVacio(valor);
                            if (resultado == false) {
                                foco("direccion");
                                return false;
                            } else {
                                return true;
                            }
                        }
                    }
                }
            }
        }
    }
}

//FUNCION DE OLVIDE MI CONTRASEÑA
function olvide_cont() {

    correo = window.prompt('Ingrese su correo electrónico', '');
    if (correo == null || correo.length==0 || /^\s+$/.test(correo)) {
        alert("Ingrese por favor su correo electrónico para enviarle un mail y poder restituir su contraseña");
    } else {
        alert("Se ha enviado un correo a " + correo);
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
	if ((campo.match(RegExPattern)) && (campo!='')) {
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
