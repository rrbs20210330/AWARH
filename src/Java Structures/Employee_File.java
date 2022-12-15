public class Employee_File {
    private int id;
    private int idForm;

    public Employee_File(){
        this.id = 0;
        this.idForm = 0; 
    }

    public Employee_File(int i_id, int i_idForm){
        this.id = i_id;
        this.idForm = i_idForm;
    }

    public void setIdForm(int NewIdForm){
        this.idForm = NewIdForm;
    }

    public int getId(){
        return id;
    }

    public int getIdForm(){
        return idForm;
    }
    
    

}
