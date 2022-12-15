
public class index {
    
    public static void main(String [] args){

        //Clase Usuario
        User user1 = new User(1,"user", "pass", false);
        System.out.println("Salida Clase Usuario");
        System.out.println(user1.Login(1, "efe2"));
        user1.setPassword("efe2");
        user1.setIsAdmin(true);
        user1.setIdUser(4);
        System.out.println(user1.getIdUser());
        System.out.println(user1.getUsername());
        System.out.println(user1.getIsAdmin());

        //Clase Formulario
        Form f1 = new Form(2, 3, "Requisitos");
        System.out.println("\nSalida Clase Formulario");
        System.out.println(f1.getIdForm());
        System.out.println(f1.getName());
        System.out.println(f1.getNoQuestions());
        f1.setName("Requisitos 1");
        f1.setNoQuestions(3);
        //EliminarForm, este da como 0 o "" a todos los valores

        //Clase Expediente
        Employee_File exp1 = new Employee_File(1, 0);
        System.out.println("\nSalida Clase Expediente");
        System.out.println(exp1.getId());
        System.out.println(exp1.getIdForm());
        exp1.setIdForm(9);

        //Clase Empleado
        Employee Emp = new Employee();
        System.out.println("\nSalida Clase Empleado");
        Emp.setNombre("Manuelito");
        Emp.setEdad(14);
        Emp.setExperienciaL("nula por feo");
        Emp.setNEstudios("Mucha por nerd");
        Emp.setTelefono("3149012");
        Emp.setCorreo("feo123@123.123");
        Emp.setCURP("FEO!213");
        Emp.setReferencias(0);
        Emp.setDomicilio("feo123 cp 123 colonia feo");
        System.out.println(Emp.getNombre());
        System.out.println(Emp.getEdad());
        System.out.println(Emp.getExperienciaL());
        System.out.println(Emp.getNEstudios());
        System.out.println(Emp.getTelefono());
        System.out.println(Emp.getCorreo());
        System.out.println(Emp.getCURP());
        System.out.println(Emp.getReferencias());
        System.out.println(Emp.getDomicilio());
        Emp.Baja(); //ahora todo equivale a un valor "nulo"
        Emp.setActivo(true);
        System.out.println(Emp.getActivo());

        // Clase Contrato
        Contract cont = new Contract(1, 0);
        System.out.println("\nSalida Clase Contrato");
        System.out.println(cont.getDocument());
        System.out.println(cont.getId());
        cont.setDocument(0);

        // Clase Cargo
        Charge crg = new Charge(0, "Secretario", "Administracion");
        System.out.println("\nSalida Clase Cargo");   
        System.out.println(crg.getArea());
        crg.setName("Docente");
        System.out.println(crg.getName());
        crg.setArea("Maestria o yo que se");
        System.out.println(crg.getArea());
        System.out.println(crg.getId());

        // Clase Candidato
        Candidate cdt = new Candidate();
        System.out.println("\nSalida Clase Candidato");  
        cdt.setEmail("123@123.123");
        cdt.setPhoneNumber("314000");
        cdt.setCV(1);
        cdt.setFhEnterview("31 de febrero");
        System.out.println(cdt.getEmail());
        System.out.println(cdt.getPhoneNumber());
        System.out.println(cdt.getCV());
        System.out.println(cdt.getFhEnterview());

    }
}
