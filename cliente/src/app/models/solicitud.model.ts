export class Solicitud{
    id: string;
    expediente_sgd: string;
    id_estado_solicitud: string;
    estado_solicitud: string;

    sol_id: string;
    sol_dni: string;
    sol_nombre: string;
    sol_parentesco: string;
    sol_solicitud: string;

    pac_id: string;
    pac_dni: string;
    pac_nro_historia: string;
    pac_nombre: string;
    pac_situacion: string;
    pac_fecha_situacion: string;


    encontro_fisico: number;
    orden_cronologico: number;
    rotulo: number;
    cruce_informacion: number;
    control_calidad: number;
    f_emergencia: number;
    f_hospitalizacion: number;
    f_uci: number;
    f_anestesio: number;
    f_enfermeria: number;
    f_salud_mental: number;
    f_infectologia: number;
    f_laboratorio: number;
    f_rx: number;
    f_farmacia: number;

    observacion: string;

    pag_folios: string;
    pag_otros_gastos: string;
    pag_total: string;
    pag_fecha: string;
    pag_id_tipo_pago: string;

    pag_estado: string;
    pag_nro: string;
    pag_obs: string;


    constructor(){
        this.id = "";
        this.expediente_sgd = "";
        this.id_estado_solicitud = "";
        this.estado_solicitud = "";

        this.sol_id = "";
        this.sol_dni = "";
        this.sol_nombre = "";
        this.sol_parentesco = "";
        this.sol_solicitud = "";

        this.pac_id = "";
        this.pac_nombre = "";
        this.pac_situacion = "";
        this.pac_fecha_situacion = "";
        
        this.pag_estado = "";
        this.pag_nro = "";
        this.pag_fecha = "";
        this.pag_obs = "";
    }
}