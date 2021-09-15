export class Solicitud{
    id: string;
    sol_id: string;
    sol_dni: string;
    sol_nombre: string;
    sol_parentesco: string;
    sol_solicitud: string;
    pac_id: string;
    pac_dni: string;
    pac_nombre: string;
    pac_situacion: string;
    pac_fecha: string;
    pag_estado: string;
    pag_nro: string;
    pag_fecha: string;
    pag_obs: string;
    constructor(){
        this.id = "";
        this.sol_id = "";
        this.sol_dni = "";
        this.sol_nombre = "";
        this.sol_parentesco = "";
        this.sol_solicitud = "";
        this.pac_id = "";
        this.pac_dni = "";
        this.pac_nombre = "";
        this.pac_situacion = "";
        this.pac_fecha = "";
        this.pag_estado = "";
        this.pag_nro = "";
        this.pag_fecha = "";
        this.pag_obs = "";
    }
}