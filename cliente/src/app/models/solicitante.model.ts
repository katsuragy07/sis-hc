export class Solicitante{
    id: string;
    nombres: string;
    apellido_pat: string;
    apellido_mat: string;
    tipo_doc: string;
    nro_doc: string;
    telefono: string;
    correo: string;
    observacion: string;

    constructor(){
        this.id = "";
        this.nombres = "";
        this.apellido_pat = "";
        this.apellido_mat = "";
        this.tipo_doc = "";
        this.nro_doc = "";
        this.telefono = "";
        this.correo = "";
        this.observacion = "";
    }
}