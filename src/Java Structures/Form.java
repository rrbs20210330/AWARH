public class Form {
    private int idForm;
    private int noQuestions;
    private String name;

    public Form(){
        this.idForm = 1;
        this.noQuestions = 0;
        this.name = "";
    }

    public Form(int IDFORM, int NOQUESTIONS, String NOMBRE){
        this.idForm = IDFORM;
        this.noQuestions = NOQUESTIONS;
        this.name = NOMBRE;
    }

    public void setName(String NewName){
        this.name = NewName;
    }

    public void setNoQuestions(int NumeroQ){
        this.noQuestions = NumeroQ;
    }

    public int getNoQuestions(){
        return noQuestions;
    }

    public String getName(){
        return name;
    }

    public int getIdForm(){
        return idForm;
    }

    
}
