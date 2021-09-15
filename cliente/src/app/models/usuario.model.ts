
export class Usuario{
    id: string;
    privilegios: string;
    nombres: string;
    apellidos: string;
    id_tipo_doc: string;
    nro_doc: string;
    telefono: string;
    email: string;
    estado: string;
    constructor(){
        this.id = "";
        this.privilegios = "";
        this.nombres = "";
        this.apellidos = "";
        this.id_tipo_doc = "";
        this.nro_doc = "";
        this.telefono = "";
        this.email = "";
        this.estado = "";
    }
}