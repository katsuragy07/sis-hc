export class Paciente{
    id: string;
    nro_historia: string;
    id_tipo_documento: string;
    nro_documento: string;
    nombres: string;
    descripcion: string;
    situacion: string;
    fecha_situacion: string;

    constructor(){
        this.id = "";
        this.nro_historia = "";
        this.id_tipo_documento = "";
        this.nro_documento = "";
        this.nombres = "";
        this.descripcion = "";
        this.situacion = "";
        this.fecha_situacion = "";
    }
}