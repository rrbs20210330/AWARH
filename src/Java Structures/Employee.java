public class Employee {
    private String RFC;
    private int idCargo;
    private boolean bActivo;
    private String Experiencia_laboral;
    private String NivelEstudios;
    private String Telefono;
    private String Correo;
    private String CURP;
    private int referencias;
    private String Domicilio;
    private String NombreCompleto;
    private int Edad;
    
    public String getNombre(){
        return NombreCompleto;
    }

    public void setNombre(String Nombre){
        this.NombreCompleto = Nombre;
    }
    public void setEdad(int EDAD){
        this.Edad = EDAD;
    }
    public int getEdad(){
        return Edad;
    }
    public void setExperienciaL(String EXPL){
        this.Experiencia_laboral = EXPL;
    }
    public String getExperienciaL(){
        return Experiencia_laboral;
    }
    
    public void setNEstudios(String NESTUDIO){
        this.NivelEstudios = NESTUDIO;
    }
    public String getNEstudios(){
        return NivelEstudios;
    }

    public void setTelefono(String  TELEFONO){
        if(!TELEFONO.matches("[+-]?[\\d]*[.]?[\\d]+"))throw new Error("ESO NO ES UN TELEFONO");
        
        if(TELEFONO.length() > 10 || TELEFONO.length() < 10)throw new Error("ESE NO ES UN TELEFONO VALIDO");
        this.Telefono = TELEFONO;
    }
    public String getTelefono(){
        return Telefono;
    }

    public void setCorreo(String CORREO){
        if(!CORREO.contains("@"))throw new Error("ESO NO ES UN CORREO");
        this.Correo = CORREO;
    }
    public String getCorreo(){
        return Correo;
    }
    public void setCURP(String CURP){
        this.CURP = CURP;
    }
    public String getCURP(){
        return CURP;
    }

    public void setReferencias(int REFERENCIAS){
        this.referencias = REFERENCIAS;
    }
    public int getReferencias(){
        return referencias;
    }
    public void setDomicilio(String DOMICILIO){
        this.Domicilio = DOMICILIO;
    }
    public String getDomicilio(){
        return Domicilio;
    }
    public void Baja(){
        this.RFC = "";
        this.idCargo = 0;
        this.bActivo = false;
        this.Experiencia_laboral = "";
        this.NivelEstudios = "";
        this.Telefono = "";
        this.Correo = "";
        this.CURP = "";
        this.referencias = 0;
        this.Domicilio = "";
        this.NombreCompleto = "";
        this.Edad = 0; 
    }

    public void setActivo(boolean active){
        this.bActivo = active;
    }
    public boolean getActivo(){
        return bActivo;
    }

    public Employee(){
        this.RFC = "";
        this.idCargo = 0;
        this.bActivo = true;
        this.Experiencia_laboral = "";
        this.NivelEstudios = "";
        this.Telefono = "";
        this.Correo = "";
        this.CURP = "";
        this.referencias = 0;
        this.Domicilio = "";
        this.NombreCompleto = "";
        this.Edad = 0; 
    }
    public Employee(String rfc, int idcargo, boolean active, String experiencialaboral, String nivelestudios, String telefono, String correo,String curp, int referencias,String domicilio, String nombrecompleto, int edad){
        this.RFC = rfc;
        this.idCargo = idcargo;
        this.bActivo = active;
        this.Experiencia_laboral = experiencialaboral;
        this.NivelEstudios = nivelestudios;
        this.Telefono = telefono;
        this.Correo = correo;
        this.CURP = curp;
        this.referencias = referencias;
        this.Domicilio = domicilio;
        this.NombreCompleto = nombrecompleto;
        this.Edad = edad; 
    }
        
}
