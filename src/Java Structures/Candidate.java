
public class Candidate {
    private int id;
    private String email;
    private String phoneNumber;
    private int cv;
    private String fhEnterview;

    public Candidate(){
        this.id = 0;
        this.email = "";
        this.phoneNumber = "";
        this.cv = 0;
        this.fhEnterview = "";
    }
    public Candidate(int i_id, String i_email, String i_phoneNumber, int i_CV, String i_fhEnterview){
        this.id = i_id;
        this.email = i_email;
        this.phoneNumber = i_phoneNumber;
        this.cv = i_CV;
        this.fhEnterview = i_fhEnterview;
    }

    public void setEmail(String newEmail){
        if(!newEmail.contains("@"))throw new Error("ESO NO ES UN CORREO");
        this.email = newEmail;
    }

    public void setPhoneNumber(String newPhoneNumber){

        if(!newPhoneNumber.matches("[+-]?[\\d]*[.]?[\\d]+"))throw new Error("ESO NO ES UN TELEFONO");
        
        if(newPhoneNumber.length() > 10 || newPhoneNumber.length() < 10)throw new Error("ESE NO ES UN TELEFONO VALIDO");
        this.phoneNumber = newPhoneNumber;
    }

    public void setCV(int newCV){
        this.cv = newCV;
    }

    public void setFhEnterview(String newFhEnterview){
        this.fhEnterview = newFhEnterview;
    }

    public int getCV(){
        return cv;
    }
    public String getPhoneNumber(){
        return phoneNumber;
    }
    public String getEmail(){
        return email;
    }
    public String getFhEnterview(){
        return fhEnterview;
    }

    
}
